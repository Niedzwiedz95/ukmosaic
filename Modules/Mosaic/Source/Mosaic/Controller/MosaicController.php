<?php
    /** This namespace contains all the controllers used in the Mosaic module. */
    namespace Mosaic\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;
	
	use Mosaic\Form\ContactForm;

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
                'Scripts' => ['/js/Click.js'],
                'Styles' => ['/css/Catalogue.css']
            ]);
			
			
            return (new ViewModel(['Products' => $Products]))->setTemplate('Mosaic/Catalogue.phtml');
        }
        public function technicalAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Technical - Martin's mosaics",
                'Scripts' => ["/js/Technical.js"],
                'Styles' => ["/css/Technical.css"]
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Technical.phtml');	
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
                'Scripts' => ["/js/Accessories.js"],
                'Styles' => ["/css/Accessories.css"]
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Accessories.phtml');	
        }
		public function informationAction()
        {
        	// Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Information - Martin's mosaics"
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');	
        }
        public function contactAction()
        {
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                "Title" => "Contact - Martin's mosaics",
                'Styles' => ["/css/Contact.css", "/css/validate.css"],
                'Scripts' => ["/js/Contact.js"]
            ]);
			
			$ContactForm = new ContactForm();
        	
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
		
		/** Return the list of thumbnail paths in JSON format. */
		public function productsAction()
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
				$HTML .= "<div class='col-lg-3'>
							<span class=''>" . $Product->getProductName() . "</span>
							<a class='thumbnail' href='#'>
								<img class='' src='" . $Product->getPath() . "' alt='" . $Product->getProductName() . "'>
							</a>
						  </div>";
			}
			
			// Return the markup.
			return $HTML;
		}
    }
?>
