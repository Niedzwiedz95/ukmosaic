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
			
			// Create an AddProductForm instance.
			$AddProductForm = new \Admin\Form\AddProductForm();
			
			// Check if it's a POST request with the form submitted.
			if($this->getRequest()->isPost())
			{
				// Feed the data into the form.
				$AddProductForm->setData($this->getRequest()->getPost()->toArray());
				
				if($AddProductForm->isValid())
				{
					
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
			
			// Create an AddProductForm instance.
			$EditProductForm = new \Admin\Form\EditProductForm();
			
			// Check if it's a POST request with the form submitted.
			if($this->getRequest()->isPost())
			{
				// Feed the data into the form.
				$EditProductForm->setData($this->getRequest()->getPost()->toArray());
				
				if($EditProductForm->isValid())
				{
					
				}
			}
			
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