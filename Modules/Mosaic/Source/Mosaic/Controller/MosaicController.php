<?php
    namespace Mosaic\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;
	
	use Mosaic\Form\ContactForm;

	/** The sole controller of the Mosaic module. */
    class MosaicController extends BaseController
    {
    	// Properties.
    	private $ProductTable;
		
        /** Retrieves the PictureTable instance. */
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
					
        public function homeAction()
        {
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Home - Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Home.css'],
                'Scripts' => ['/js/pages/Home.js']
            ]);
			
            return (new ViewModel())->setTemplate('Mosaic/Home.phtml');
        }
        public function catalogueAction()
        {
        	// Get URL params.
            $Category = $this->params()->fromRoute('category') ? $this->params()->fromRoute('category') : "";
			
			// Render the markup with the products to be displayed.
			$Products = $this->renderProducts($Category);
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Catalogue - Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Catalogue.css'],
                'Scripts' => ['/js/pages/Catalogue.js']
            ]);
			
            return (new ViewModel(['Products' => $Products]))->setTemplate('Mosaic/Catalogue.phtml');
        }
        public function technicalAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Technical - Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Technical.css'],
                'Scripts' => ['/js/pages/Pullup.js']
            ]);
			
			// Get the URL param that determines which type of technical to show.
			$Param = strtolower($this->params()->fromRoute('technicalparam') ? $this->params()->fromRoute('technicalparam') : "winckelmans");
			
            return (new ViewModel([]))->setTemplate("Mosaic/Technical/$Param.phtml");	
        }
		public function specialoffersAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Special offers - Martin's mosaics",
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Specialoffers.phtml');	
        }
		public function informationAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Information - Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Information.css'],
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');	
        }
		public function accessoriesAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Accessories - Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Accessories.css'],
                'Scripts' => ['/js/pages/Pullup.js']
            ]);
			
			// Get the URL param that determines which type of accessories to show.
			$Param = strtolower($this->params()->fromRoute('accessoriesparam') ? $this->params()->fromRoute('accessoriesparam') : 'decorative1');
			
            return (new ViewModel([]))->setTemplate("Mosaic/Accessories/$Param.phtml");		
        }
        public function contactAction()
        {
			// Create a ContactForm instance.
            $ContactForm = new ContactForm();
			
			// Check if the request is POST (that is, if the form was submitted)
			if($this->getRequest()->isPost())
			{
				// Feed the data into the form.
				$ContactForm->setData($this->getRequest()->getPost()->toArray());
				
				if($ContactForm->isValid())
				{					
					// Bind the POST data to variables so it's easier to interpolate it.
					$Name = $_POST['name'];
					$EmailFrom = $_POST['email'];
					$PhoneNumber = $_POST['phoneNumber'];
					$Comments = $_POST['comments'];
					
					// Message parts.
					$Receiver = 'info@martinmosaic.com';
				    $Subject = "Contact request from $Name";
				
				    $Message = "Name: $Name\r\n";
				    $Message .= "Email: $EmailFrom\r\n";
				    $Message .= "Telephone: $PhoneNumber\r\n";
				    $Message .= "Comments: $Comments\r\n";
				 
					$Headers = "From: $EmailFrom\r\n";
					$Headers .= "Reply-To: $EmailFrom\r\n";
					$Headers .= 'X-Mailer: PHP/' . phpversion();
					
					// Send the email.
					mail($Receiver, $Subject, $Message, $Headers);
				}
			}
        	
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Contact - Martin's mosaics",
                'Styles' => [],
                'Scripts' => ['/js/pages/Contact.js']
            ]);
            
            return (new ViewModel(['ContactForm' => $ContactForm]))->setTemplate('Mosaic/Contact.phtml');
        }
		
		/** A page with a description of a particular product. */
		public function productAction()
		{
        	// Get the ProductID from the URL param. Fetch the product from database and construct an AddToCartForm isntance.
            $ProductID = $this->params()->fromRoute('productid') ? $this->params()->fromRoute('productid') : "";
			$Product = $this->getProductTable()->select(['ProductID' => $ProductID])->buffer()->current();
			$AddToCartForm = new \Mosaic\Form\AddToCartForm($Product);
			
			// Check whether the request is a POST request.
			if($this->getRequest()->isPost())
			{
				// Save data in a variable and feed it to the form.
				$Data = $this->getRequest()->getPost();
				$AddToCartForm->setData($Data);

				// Check whether the form is valid.
				if($AddToCartForm->isValid())
				{
					// Assemble the name of the getter that gets the product's price basing on the product type.
					$Getter = "get" . $Data['productType'];
					
					// Add the OrderProduct instance to cart.
					$OrderProduct = new \Mosaic\Model\OrderProduct(
					[
						'ProductID' => $ProductID,
						'ProductName' => $Product->getProductName(),
						'Price' => $Product->$Getter(),
						'Amount' => $Data['productAmount'],
						'Path' => $Product->getPath(),
						'Type' => $Data['productType']
					]);
					
					// Set an appropriate type of the ordered product (appropriate for being displayed).
					$OrderProduct->setDisplayTypeFromPriceType($Data['productType']);
					
					// Add the product to the cart. Each product (identified by its ID) can be added to cart multiple times,
					// but only once per type.
					$_SESSION['Cart'][$ProductID][$Data['productType']] = $OrderProduct->toArray();
					
					// Redirect the user to his cart.
					$this->redirect()->toRoute('mosaic', ['action' => 'cart']);
				}
			}

            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Creator - Martin's mosaics",
                'Scripts' => ['/js/pages/Product.js'],
                'Styles' => ['/css/pages/mosaic/Product.css']
            ]);
						
            return (new ViewModel(['Product' => $Product, 'AddToCartForm' => $AddToCartForm]))->setTemplate('Mosaic/Product.phtml');
		}
		
		/** A page on which the user can view the terms of use. */
		public function tosAction()
		{
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Terms of use - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
						
            return (new ViewModel())->setTemplate('Mosaic/Tos.phtml');
		}
		
		/** A page on which the user can view the contens of his cart. */
		public function cartAction()
		{
			$Cart = '';
			if(isset($_SESSION['Cart']) && $_SESSION['Cart'] != [])
			{
				$Cart = '<h1>My cart</h1>';
				$Cart .= $this->renderCartProducts($_SESSION['Cart']);
			}
			else
			{
				$Cart = '<h1>Your cart is empty</h1>';
			}
			
			// Compute the grand total (the sum) of all the items in the cart.
			$GrandTotal = $this->computeGrandTotal($_SESSION['Cart']);
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Cart - Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/mosaic/Cart.css']
            ]);
						
            return (new ViewModel(['Cart' => $Cart, 'GrandTotal' => $GrandTotal]))->setTemplate('Mosaic/Cart.phtml');
		}
		
		/** Removes a product with the cart identifier given in the url parameter from the cart. */
		public function cartRemoveAction()
		{
        	// Get URL params.
            $ID = $this->params()->fromRoute('productid');
            $Type = $this->params()->fromRoute('producttype');
			
			//var_dump($_SESSION['Cart'][$ID][$Type]);exit;
			
			// Check whether actually a cart is set in the session.
			if(isset($_SESSION['Cart'][$ID][$Type]))
			{
				// Unset the requested item.
				unset($_SESSION['Cart'][$ID][$Type]);
			}
			
			return $this->redirect()->toRoute('mosaic', ['action' => 'cart']);
		}
		
		/** A page on which the user can finalize the transaction. */
		public function checkoutAction()
		{
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Cart - Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/mosaic/Cart.css']
            ]);
						
            return (new ViewModel([]))->setTemplate('Mosaic/Checkout.phtml');				
		}
		
		/** Return the list of thumbnail paths in JSON format. */
		public function productsjsonAction()
		{
			// Assert that this route is accessed via a POST-AJAX request.
			$this->assertPostAjax();
			
			// Render the products' markup.
			$Products = $this->renderProducts($_POST['category']);
			
			// Return the list encoded as JSON.
			return new JsonModel(['html' => $Products]);
		}
		
		/** Renders the html code of the products that are to be displayed. */
		public function renderProducts($Category)
		{
			// Fetch products of the desored category from the database.
			$Products = $this->getProductTable()->select(['Category' => $Category])->buffer();
			
			// Variable to hold the markup.
			$HTML = "";
			
			// Iterate over all products and build up the markup.
			foreach($Products as $Product)
			{
				// Save the product's attributes to make life easier.
				$Name = $Product->getProductName();
				$Path = $Product->getPath();
				$Price = $Product->getPrice();
				
				$HTML .= "<div class='col-lg-3'>
							<span class='productName'>" . $Name . "</span>
							<a class='thumbnail' href='" . '/product/' . $Product->getProductID() . "' title='" . $Name . " " . $Price . "£'>
								<img class='' src='" . $Product->getPath() . "' alt='" . $Product->getProductName() . "'>
							</a>
						  </div>";
			}
			
			// Return the markup.
			return $HTML;
		}
		
		/** Renders products as displayed in the cart. */
		public function renderCartProducts($Cart)
		{
			// Variables that gold the markup and grand total.
			$Markup = '';
			
			// Iterate over all items in the cart and render their markup (that requires double foreach loop).
			foreach($Cart as $OrderProducts)
			{
				foreach($OrderProducts as $OrderProduct)
				{
					// Fetch the properties of the OrderProduct instance for easy interpolation.
					$ID = $OrderProduct['ProductID'];
					$Path = $OrderProduct['Path'];
					$ProductName = $OrderProduct['ProductName'];
					$Type = $OrderProduct['Type'];
					$DisplayType = $OrderProduct['DisplayType'];
					$Amount = $OrderProduct['Amount'];
					$Price = $OrderProduct['Price'];
					$Subtotal = $Price * $Amount;
					
					// Assemble the markup.
					$Markup .= 
					"<div class='cartProduct col-lg-7'>
						<div class='imgWrapper col-lg-5'>
							<a href='/product/$ID'><img src='$Path' alt='$ProductName'/></a>
						</div>
						<div class='infoWrapper col-lg-5'>
							<h1>$ProductName</h1>
							<h2>$DisplayType</h2>
							<p>Amount: $Amount</p>
							<p>Unit price: £$Price</p>
							<p>Subtotal: £$Subtotal</p>
							<a class='btn btn-primary col-lg-12' href='/cart/remove/$ID/$Type'>Remove from cart</a>
						</div>
						<div class='btnWrapper col-lg-0'>
							<!--<a class='btn btn-primary col-lg-12' href='/product/$ID'>Change</a>-->
						</div>
					</div>";
				}
			}
			
			// Return the assembled markup.
			return $Markup;
		}

		/** Computes the cart's grand total. */
		public function computeGrandTotal($Cart)
		{
			$GrandTotal = 0;
			
			// Iterate over all items in the cart to compute the grand total.
			foreach($Cart as $OrderProducts)
			{
				foreach($OrderProducts as $OrderProduct)
				{
					$GrandTotal += $OrderProduct['Amount'] * $OrderProduct['Price'];
				}
			}
			
			return $GrandTotal;
		}
    }
?>