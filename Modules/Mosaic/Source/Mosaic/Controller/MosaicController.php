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
					
        public function homeAction()
        {
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Martin Mosaic Victorian Tiles: Mosaic Designs",
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
                'Title' => "Catalogue | Martin's mosaics",
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
                'Title' => "Technical | Martin's mosaics",
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
                'Title' => "Special offers | Martin's mosaics",
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Specialoffers.phtml');	
        }
		public function informationAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Information | Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Information.css'],
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');	
        }
		public function accessoriesAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Accessories | Martin's mosaics",
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
                'Title' => "Contact | Martin's mosaics",
                'Styles' => ['/css/pages/mosaic/Contact.css'],
                'Scripts' => ['/js/pages/Contact.js', 'https://maps.googleapis.com/maps/api/js']
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
						'Quantity' => $Data['quantity'],
						'Price' => $Product->$Getter(),
						'Path' => $Product->getPath(),
						'Description' => $Product->getDescription(),
						'PriceType' => $Data['productType']
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
                'Title' => "Product details | Martin's mosaics",
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
                'Title' => "Terms of use | Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
						
            return (new ViewModel())->setTemplate('Mosaic/Tos.phtml');
		}
		
		/** A page on which the user can view the contens of his cart. */
		public function cartAction()
		{
			// Variables to store the cart's markup and the grand total price.
			$Cart = '';
			$GrandTotal = 0;
			
			// Assemble the cart's markup and compute the grand total
			if(isset($_SESSION['Cart']) && $_SESSION['Cart'] != [])
			{
				$Cart = '<h1>My cart</h1>';
				$Cart .= $this->renderCartProducts($_SESSION['Cart']);
				$GrandTotal = $this->computeGrandTotal($_SESSION['Cart']);
			}
			else
			{
				$Cart = '<h1>Your cart is empty</h1>';
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Cart | Martin's mosaics",
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
			
			// Check whether actually a cart is set in the session.
			if(isset($_SESSION['Cart'][$ID][$Type]))
			{
				// Unset the requested item.
				unset($_SESSION['Cart'][$ID][$Type]);
				
				// If all types of some product we're removed from the cart, remove the index $ID so that the products in the
				// cart are counted correctly.
				if($_SESSION['Cart'][$ID] == [])
				{
					unset($_SESSION['Cart'][$ID]);
				}
			}
			
			return $this->redirect()->toRoute('mosaic', ['action' => 'cart']);
		}
		
		/** A page on which the user can finalize the transaction. */
		public function checkoutAction()
		{			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Checkout | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/mosaic/Checkout.css']
            ]);
            
			// If the user is not signed in, redirect him to the sign up page.
			if(isset($_SESSION['User']) == false)
			{
				return $this->redirect()->toRoute('user', ['action' => 'signup']);
			}

			// Renders the address list used at the checkout page.
			$ShippingAddresses = $this->renderShippingAddresses($_SESSION['User']['UserID']);

            return (new ViewModel(['ShippingAddresses' => $ShippingAddresses]))->setTemplate('Mosaic/Checkout.phtml');
		}
		
		/** A page which finalizes the order and adds it to the database. */
		public function shipAction()
		{
			// Assert that an user is signed in.
			$this->assertSignedIn();

			// Assert that the user has anything in cart. If he doesn't redirect him to the cart.
			if(isset($_SESSION['Cart']) == false || $_SESSION['Cart'] == [])
			{
				return $this->redirect()->toRoute('mosaic', ['action' => 'cart']);
			}
			
        	// Get URL params.
            $AddressID = $this->params()->fromRoute('addressid');
			
			// Assert that the address being shipped to really belongs to the signed in user.
			$OwnsAddress = $this->getAddressTable()->select(['UserID' => $_SESSION['User']['UserID'], 'AddressID' => $AddressID]);
			
			// If the user does not own the address being shipped to, redirect the user to the checkout page.
			if($OwnsAddress == false)
			{
				return $this->redirect()->toRoute('mosaic', ['action' => 'checkout']);
			}
			else // Insert the order to the database, clear the cart and redirect the user to his orders page.
			{
				// Compute the order's grand total and add it to the session.
				$GrandTotal = $this->computeGrandTotal($_SESSION['Cart']);
				$_SESSION['GrandTotal'] = $GrandTotal;
				
				// Insert the order to the database and retrieve the order's id.
				$Order = new \Mosaic\Model\Order(
				[
					'UserID' => $_SESSION['User']['UserID'],
					'AddressID' => $AddressID,
					'Value' => $GrandTotal,
					'Status' => 'Placed'
				]);
				$OrderID = $this->getOrderTable()->insertOrder($Order);
				
				// Store the OrderID in the session to be accessed later.
				$_SESSION['OrderID'] = $OrderID;
				
				// Insert the ordered products to the database
				foreach($_SESSION['Cart'] as $ProductClass)
				{
					foreach($ProductClass as $OrderProductArray)
					{
						// Create an OrderProduct instance, set its OrderID and insert it to the database.
						$OrderProduct = new \Mosaic\Model\OrderProduct($OrderProductArray);
						$OrderProduct->setOrderID($OrderID);
						
						$this->getOrderProductTable()->insert($OrderProduct);
						/*$this->getOrderProductTable()->getTableGateway()->insert(
						[
							'OrderID' => $OrderID,
							'ProductID' => $OrderProduct['ProductID'],
							'ProductType' => $OrderProduct['DisplayType'],
							'Quantity' => $OrderProduct['Quantity'],
							'Price' => $OrderProduct['Price'],
						]);*/
					}
				}
				
				// Clear the cart.
				unset($_SESSION['Cart']);
				
				// Send an email to notify the shop owner that a purchase was made.
				$this->orderNotify();
				
				// Redirect the user to the payment page.
				return $this->redirect()->toRoute('mosaic', ['action' => 'payment']);
			}	
		}

		/** A page on which the user may pay for the order. */
		public function paymentAction()
		{
			// Assert that an user is signed in.
			$this->assertSignedIn();
			
			// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Payment | Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);

            return (new ViewModel(['OrderID' => $_SESSION['OrderID'], 'GrandTotal' => $this->computeGrandTotal($_SESSION['Cart'])]))->setTemplate('Mosaic/Payment.phtml');
		}
		
		/** Page that shows details of an order. */
		public function orderAction()
		{
			// Assert that an user is signed in.
			$this->assertSignedIn();
			
        	// Get URL params.
            $OrderID = $this->params()->fromRoute('orderid');
			
			// Fetch the Order and the associated Address from the database.
			$Order = $this->getOrderTable()->selectOrder($OrderID);
			$Address = $this->getAddressTable()->select(['AddressID' => $Order->getAddressID()])->buffer()->current();
			
			// Render the markups of the address and the cart.
			$AddressMarkup = $Address->render();
			$CartMarkup = '';
			foreach($Order->getOrderProducts() as $OrderProduct)
			{
				$CartMarkup .= $OrderProduct->render();
			}
			
			// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Order | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/mosaic/Order.css', '/css/pages/mosaic/Cart.css']
            ]);

            return (new ViewModel(['Address' => $AddressMarkup, 'Cart' => $CartMarkup]))->setTemplate('Mosaic/Order.phtml');			
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
			// Check whether $Category equals 'all'. If that's the case, the $Params array is empty so that all products are
			// selected. Otherwise it specifies which category of products to select.
			$Params = $Category == 'all' ? [] : ['Category' => $Category];
			
			// Fetch products of the desired category from the database.
			$Products = $this->getProductTable()->select($Params)->buffer();
			
			// Variable to hold the markup.
			$HTML = "";
			
			// Iterate over all products and build up the markup.
			foreach($Products as $Product)
			{
				// Save the product's attributes to make life easier.
				$Name = $Product->getProductName();
				$Path = $Product->getPath();
				//$Price = $Product->getPrice();
				
				$HTML .= "<div class='col-lg-3'>
							<span class='productName'>" . $Name . "</span>
							<a class='thumbnail' href='" . '/product/' . $Product->getProductID() . "' title='$Name'>
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
					$ProductID = $OrderProduct['ProductID'];
					$ProductName = $OrderProduct['ProductName'];
					$DisplayType = $OrderProduct['DisplayType'];
					$Quantity = $OrderProduct['Quantity'];
					$Price = $OrderProduct['Price'];
					$Path = $OrderProduct['Path'];
					$PriceType = $OrderProduct['PriceType'];
					$Subtotal = $Price * $Quantity;
					
					// Assemble the markup.
					$Markup .= 
					"<div class='cartProduct col-lg-7'>
						<div class='imgWrapper col-lg-5'>
							<a href='/product/$ProductID'><img src='$Path' alt='$ProductName'/></a>
						</div>
						<div class='infoWrapper col-lg-5'>
							<h1>$ProductName</h1>
							<h2>$DisplayType</h2>
							<p>Quantity: $Quantity</p>
							<p>Unit price: £$Price</p>
							<p>Subtotal: £$Subtotal</p>
							<a class='btn btn-primary col-lg-12' href='/cart/remove/$ProductID/$PriceType'>Remove from cart</a>
						</div>
						<div class='btnWrapper col-lg-0'>
							<!--<a class='btn btn-primary col-lg-12' href='/product/$ProductID'>Change</a>-->
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
					$GrandTotal += $OrderProduct['Quantity'] * $OrderProduct['Price'];
				}
			}
			
			return $GrandTotal;
		}
		
		/** Renders the html markup of the addresses associated with a user. */
		public function renderShippingAddresses($UserID)
		{
			// Fetch addresses from the database.
			$Addresses = $this->getAddressTable()->select(['UserID' => $UserID])->buffer();
			
			// Variable to hold the markup.
			$Markup = "";
			
			// Iterate over all the addresses and build up the markup.
			foreach($Addresses as $Address)
			{
				// Save the product's attributes to make life easier.
				$AddressID = $Address->getAddressID();
				$Name = $Address->getFullName();
				$Street = $Address->getStreet();
				$Locality = $Address->getLocality() == '' ? '&nbsp;' : $Address->getLocality();
				$PostTown = $Address->getPostTown();
				$Postcode = $Address->getPostcode();
				$PhoneNumber = $Address->getPhoneNumber() == '' ? '&nbsp;' : $Address->getPhoneNumber();
				
				$Markup .= "<div class='addressWrapper col-lg-4'>
						      <div class='address'>
						          <p>Name: $Name</p>
							      <p>Street: $Street</p>
							      <p>Locality: $Locality</p>
							      <p>Post town: $PostTown</p>
							      <p>Postcode: $Postcode</p>
							      <p>Phone: $PhoneNumber</p>
							      <div class='btnWrapper col-lg-6'>
								      <a id='shipButton' class='btn btn-primary' href='/ship/$AddressID'>Ship to this address</a>
							      </div>
							  </div>
						  </div>";
			}
			
			// Return the markup.
			return $Markup;
		}
		
		/** Notifies info@martinmosaic.com that a purchase was made. */
		public function orderNotify()
		{
			// Create an email that will be sent to the shop operator.
			$Recipient = 'info@martinmosaic.com';
            $Title = 'A purchase was made!';
            $Message = 'A new purchase was made. Check martinmosaic.com/admin/orders';
            $Headers = 'FROM: info@martinmosaic.com';
            
            // Send the mail and save the operation status in a variable. */
            mail($Recipient, $Title, $Message, $Headers);
		}
    }
?>