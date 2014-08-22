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
                'Styles' => ['/css/pages/Home.css'],
                'Scripts' => ['/js/Home.js']
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
                'Styles' => ['/css/pages/Catalogue.css'],
                'Scripts' => ['/js/Catalogue.js']
            ]);
			
            return (new ViewModel(['Products' => $Products]))->setTemplate('Mosaic/Catalogue.phtml');
        }
        public function technicalAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Technical - Martin's mosaics",
                'Styles' => ['/css/pages/Technical.css'],
                'Scripts' => ['/js/Pullup.js']
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
                'Styles' => ['/css/pages/Information.css'],
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');	
        }
		public function accessoriesAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Accessories - Martin's mosaics",
                'Styles' => ['/css/pages/Accessories.css'],
                'Scripts' => ['/js/Pullup.js']
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
                'Scripts' => ['/js/Contact.js']
            ]);
            
            return (new ViewModel(['ContactForm' => $ContactForm]))->setTemplate('Mosaic/Contact.phtml');
        }
		
		/** A page with a description of a particular product. */
		public function productAction()
		{
        	// Get URL params.
            $ProductID = $this->params()->fromRoute('productid') ? $this->params()->fromRoute('productid') : "";
			
			// Fetch the requested product.
			$Product = $this->getProductTable()->select(['ProductID' => $ProductID])->buffer()->current();
			
			// Create a form that allows adding the product to cart.
			$AddToCartForm = new \Mosaic\Form\AddToCartForm($Product);
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Creator - Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/Product.css']
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
    }
?>