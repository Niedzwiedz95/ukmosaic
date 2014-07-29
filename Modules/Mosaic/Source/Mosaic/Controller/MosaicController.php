<?php
    /** This namespace contains all the controllers used in the Mosaic module. */
    namespace Mosaic\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;
	
	use Mosaic\Form\ContactForm;
	use Mosaic\Form\SignupForm;

    class MosaicController extends BaseController
    {
    	private $ProductTable;
		
        /** Retrieves the PictureTable instance. */
        public function getProductTable()
        {
            /* If the PictureTable is null, it gets loaded from the ServiceManager. */
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
                "Title" => "Home - Martin's mosaics",
                'Scripts' => ["/js/Home.js"],
                'Styles' => ["/css/Home.css"]
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Home.phtml');
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
                'Scripts' => ['/js/Catalogue.js'],
                'Styles' => ['/css/Catalogue.css']
            ]);
			
            return (new ViewModel(['Products' => $Products]))->setTemplate('Mosaic/Catalogue.phtml');
        }
        public function technicalAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Technical - Martin's mosaics",
                'Scripts' => ["/js/Pullup.js"],
                'Styles' => ["/css/Technical.css"]
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
                "Title" => "Special offers - Martin's mosaics",
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Specialoffers.phtml');	
        }
		public function accessoriesAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Accessories - Martin's mosaics",
                'Scripts' => ["/js/Pullup.js"],
                'Styles' => ["/css/Accessories.css"]
            ]);
			
			// Get the URL param that determines which type of accessories to show.
			$Param = strtolower($this->params()->fromRoute('accessoriesparam') ? $this->params()->fromRoute('accessoriesparam') : 'decorative1');
			
            return (new ViewModel([]))->setTemplate("Mosaic/Accessories/$Param.phtml");		
        }
		public function informationAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Information - Martin's mosaics",
                'Styles' => ["/css/Information.css"],
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');	
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
					$Receiver = "info@martinmosaic.com";
				    $Subject = "martinmosaic";
				
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
                "Title" => "Contact - Martin's mosaics",
                'Styles' => ["/css/Contact.css"],
                'Scripts' => ["/js/Contact.js"]
            ]);
            
            return (new ViewModel(['ContactForm' => $ContactForm]))->setTemplate('Mosaic/Contact.phtml');
        }
        public function creatorAction()
        {
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Creator - Martin's mosaics",
                'Scripts' => ["/js/Creator.js"],
                'Styles' => ["/css/Creator.css"]
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Creator.phtml');
        }
		
		/** A page with a description of a particular product. */
		public function productAction()
		{
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Creator - Martin's mosaics",
                'Scripts' => [],
                'Styles' => ["/css/Product.css"]
            ]);
			
        	// Get URL params.
            $ProductID = $this->params()->fromRoute('productid') ? $this->params()->fromRoute('productid') : "";
			
			// Fetch the requested product.
			$Products = $this->getProductTable()->select(['ProductID' => $ProductID])->buffer();
						
            return (new ViewModel(['Product' => $Products->current()]))->setTemplate('Mosaic/Product.phtml');
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
		
		public function signupAction()
		{
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Sign up - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			$SignupForm = new SignupForm();
			
            return (new ViewModel(['SignupForm' => $SignupForm]))->setTemplate('Mosaic/Signup.phtml');
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
