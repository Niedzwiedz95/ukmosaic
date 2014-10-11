<?php
    namespace Admin\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;
	
	use Mosaic\Form\ContactForm;

	/** The sole controller of the Mosaic module. */
    class AdminController extends BaseController
    {
    	// Properties.
    	private $ProductTable;
		protected $AddressTable;
		protected $OrderTable;
		protected $OrderProductTable;
		
        /** Retrieves the ProductTable instance. */
        public function getProductTable()
        {
            // If the PictureTable is null, it gets loaded from the ServiceManager.
            if($this->ProductTable == null)
            {
                $ServiceLocator = $this->getServiceLocator();
                $this->ProductTable = $ServiceLocator->get('Mosaic\Model\ProductTable');
            }
            return $this->ProductTable;
        }
		
        /** Retrieve the AddressTable instance. */
        public function getAddressTable()
        {
            /* If the UserTable is null, it gets loaded from the ServiceManager. */
            if($this->AddressTable == null)
            {
                $this->AddressTable = $this->getServiceLocator()->get('User\Model\AddressTable');
            }
            return $this->AddressTable;
        }
		
        /** Retrieve the OrderTable instance. */
        public function getOrderTable()
        {
            /* If the UserTable is null, it gets loaded from the ServiceManager. */
            if($this->OrderTable == null)
            {
                $this->OrderTable = $this->getServiceLocator()->get('Mosaic\Model\OrderTable');
            }
            return $this->OrderTable;
        }
		
        /** Retrieve the OrderProductTable instance. */
        public function getOrderProductTable()
        {
            // If the UserTable is null, it gets loaded from the ServiceManager.
            if($this->OrderProductTable == null)
            {
                $this->OrderProductTable = $this->getServiceLocator()->get('Mosaic\Model\OrderProductTable');
            }
            return $this->OrderProductTable;
        }
		
		/** A page on which the admin can add a product to the database. */
		public function addProductAction()
		{
			// Assert that the user requesting the page is an admin.
			$this->assertIsAdmin();
			
			// Save the request in a variable and create an AddProductForm instance.
            $Request = $this->getRequest();
			$AddProductForm = new \Admin\Form\AddProductForm();

			// Check if it's a POST request with the form submitted.
			if($Request->isPost())
			{
                // Merges the $_POST and $_FILES data into one array.
                $Data = array_merge_recursive($Request->getPost()->toArray(), $Request->getFiles()->toArray());
				
				// Feed the data into the form.
				$AddProductForm->setInputFilter($AddProductForm->getInputFilter());
				$AddProductForm->setData($Data);
				
				// Save the results of validating the form in a variable and check whether it's valid.
				$FileTransfer = $AddProductForm->isReallyValid($Data['picture']);

				if($FileTransfer == true)
				{
					$this->getProductTable()->insertProduct($FileTransfer, $Data);
				}
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Add product | Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
            return (new ViewModel(['AddProductForm' => $AddProductForm]))->setTemplate('Admin/AddProduct.phtml');
		}
		
		/** A page on which the admin can edit a product. */
		public function editProductAction()
		{
			// Assert that the user requesting the page is an admin.
			$this->assertIsAdmin();
			
			// Fetch the product id from the route parameter and then the product from database.
			$ProductID = $this->params()->fromRoute('productid');
			$Product = $this->getProductTable()->select(['ProductID' => $ProductID])->buffer()->current();
			
			// Create an EditProductForm instance.
			$EditProductForm = new \Admin\Form\EditProductForm($ProductID);
			
			// Check if it's a POST request with the form submitted.
			if($this->getRequest()->isPost())
			{
				// Feed the data into the form and validate it.
				$Data = $this->getRequest()->getPost()->toArray();
				$EditProductForm->setData($Data);
				if($EditProductForm->isValid())
				{
					// Assemble the edited product's instance and update the database.
					$Product = new \Mosaic\Model\Product(
					[
						'ProductName' => $Data['productName'],
						'Category' => $Data['category'],
						'Description' => $Data['description'],
						'Price' => $Data['price'],
						'PriceSquareLoose' => $Data['priceSquareLoose'],
		  				'PriceSquareAssembled' => $Data['priceSquareAssembled'],
		  				'PriceLinearLoose' => $Data['priceLinearLoose'],
		 				'PriceLinearAssembled' => $Data['priceLinearAssembled'],
						'Price1x1' => $Data['price1x1'],
						'Price2x2' => $Data['price2x2'],
						'Price25x25' => $Data['price25x25'],
					
					]);
					$this->getProductTable()->update($Product, new \Mosaic\Model\Product(['ProductID' => $ProductID]));
				}
			}
			
			// Set form data (this line is here so that both edited and unedited product will display fine).
			$EditProductForm->setData(
			[
				'productName' => $Product->getProductName(),
				'category' => $Product->getCategory(),
				'description' => $Product->getDescription(),
				'price' => $Product->getPrice(),
				'priceSquareLoose' => $Product->getPriceSquareLoose(),
  				'priceSquareAssembled' => $Product->getPriceSquareAssembled(),
  				'priceLinearLoose' => $Product->getPriceLinearLoose(),
 				'priceLinearAssembled' => $Product->getPriceLinearAssembled(),
				'price1x1' => $Product->getPrice1x1(),
				'price2x2' => $Product->getPrice2x2(),
				'price25x25' => $Product->getPrice25x25(),
			]);
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Edit product | Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
            return (new ViewModel(['EditProductForm' => $EditProductForm]))->setTemplate('Admin/EditProduct.phtml');
		}
		
		public function ordersAction()
		{
			// Assert that the user viewing this is an admin.
			$this->assertIsAdmin();
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "All orders | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/user/Orders.css']
            ]);
			
			// Renders all orders made by users.
			$Orders = $this->renderAllOrders();
			
            return (new ViewModel(['Orders' => $Orders]))->setTemplate('Admin/Orders.phtml');
			
		}
		
		/** Asserts that the user currently signed in is an admin. */
		public function assertIsAdmin()
		{
			// This little hack makes sure that the redirect works as expected. This is because the redirect() method only
			// works after using return. This makes it hard to use, because one needs either to call it like
			// 'return $this->redirect()...' or paste paste the body of this method directl. Rather than paste, it would be
			// way better to have an inline function, and this hack does just this: it makes this function work like an
			// inline function in, exempli gratia, C++. 
			$assertIsAdmin = function($this)
			{
				if(isset($_SESSION['User']['IsAdmin']) == false || $_SESSION['User']['IsAdmin'] == false)
				{
					return $this->redirect()->toRoute('mosaic', ['action' => 'home']);
				}
			};
			$assertIsAdmin($this);
		}

		/** Renders the markup of all the orders every made by the user. */
		public function renderAllOrders()
		{
			// Fetch the orders from the database.
			$Orders = $this->getOrderTable()->select()->buffer();
			
			// Variables to hold the headers and markup.
			$Headers = "<div class='orderHeader'>
					       <div class='col-lg-2'>OrderID</div>
					       <div class='col-lg-2'>Value</div>
					       <div class='col-lg-2'>Status</div>
					       <div class='col-lg-3'>Placement date</div>
					       <div class='col-lg-2'>Details</div>
					   </div>";
			$Markup = '';
			
			// Iterate over all orders and render them.
			foreach($Orders as $Order)
			{
				$OrderID = $Order->getOrderID();
				$Value = $Order->getValue();
				$Status = $Order->getStatus();
				$PlacementDate = $Order->getPlacementDate();
				$Details = "<a class='btn btn-primary' href='/order/$OrderID'>Details</a>";
				
				// Markup is prepended to the previous markup so that newer orders are displayed first.
				$Markup = "<div class='order'>
					            <div class='col-lg-2'>$OrderID</div>
					            <div class='col-lg-2'>£$Value</div>
					            <div class='col-lg-2'>$Status</div>
					            <div class='col-lg-3'>$PlacementDate</div>
					            <div class='col-lg-2'>$Details</div>
							</div>" . $Markup;
			}
			
			return "<div class='orderWrapper col-lg-7'>" . $Headers . $Markup . "</div>";
		}
    }
?>