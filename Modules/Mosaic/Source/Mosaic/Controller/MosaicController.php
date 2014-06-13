<?php
    /** This namespace contains all the controllers used in the Mosaic module. */
    namespace Mosaic\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;
	
	use Mosaic\Form\ContactForm;

    class MosaicController extends BaseController
    {
        public function homeAction()
        {
            /* Add metadata to the layout. */
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
            /* Add metadata to the layout. */
            $this->layout()->setVariables(
            [
                "Title" => "Catalogue - Martin's mosaics",
                'Scripts' => ["/js/Catalogue.js"],
                'Styles' => ["/css/Catalogue.css"]
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Catalogue.phtml');
        }
        public function technicalAction()
        {
        	/* Add metadata to the layout. */
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
        	/* Add metadata to the layout. */
            $this->layout()->setVariables(
            [
                "Title" => "Special offers - Martin's mosaics",
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Specialoffers.phtml');	
        }
		public function accessoriesAction()
        {
        	/* Add metadata to the layout. */
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
        	/* Add metadata to the layout. */
            $this->layout()->setVariables(
            [
                "Title" => "Information - Martin's mosaics"
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');	
        }
        public function contactAction()
        {
            /* Add metadata to the layout. */
            $this->layout()->setVariables(
            [
                "Title" => "Contact - Martin's mosaics",
                'Styles' => ["/css/Contact.css", "/css/validate.css"],
                'Scripts' => ["/js/validate.js"]
            ]);
			
			$ContactForm = new ContactForm();
        	
            return (new ViewModel(['ContactForm' => $ContactForm]))->setTemplate('Mosaic/Contact.phtml');
        }
        public function creatorAction()
        {
        	exit;
            /* Add metadata to the layout. */
            $this->layout()->setVariables(
            [
                "Title" => "Creator - Martin's mosaics",
                'Scripts' => ["/js/Creator.js"],
                'Styles' => ["/css/Creator.css"]
            ]);
			
            return (new ViewModel([]))->setTemplate('Mosaic/Creator.phtml');
        }
		
		/** Return the list of thumbnail paths in JSON format. */
		public function tilesAction()
		{
			// Assert that this route is accessed via a POST-AJAX request.
			$this->assertPostAjax();
			
			// Retrieve the type parameter from the $_POST array.
			$Category = $_POST['category'];
			
			// Read the list of tiles to display.
			$Tiles = file("public_html/img/catalogue/$Category.txt");
			
			// Return the list encoded as JSON.
			return new JsonModel(["tiles" => $Tiles]);
		}
    }
?>
