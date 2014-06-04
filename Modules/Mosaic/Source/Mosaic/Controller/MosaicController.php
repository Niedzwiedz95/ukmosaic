<?php
    /** This namespace contains all the controllers used in the Mosaic module. */
    namespace Mosaic\Controller;
    
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
    use Core\Controller\BaseController;

    class MosaicController extends BaseController
    {
        public function homeAction()
        {
            /* Add metadata to the layout. */
            $this->layout()->setVariables(
            [
                "Title" => "Home - Martin's mosaics",
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
        public function informationAction()
        {
            return (new ViewModel([]))->setTemplate('Mosaic/Information.phtml');
        }
        public function contactAction()
        {
            return (new ViewModel([]))->setTemplate('Mosaic/Contact.phtml');
        }
        public function creatorAction()
        {
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
		public function thumbnailsAction()
		{
			// Assert that this route is accessed via a POST-AJAX request.
			$this->assertPostAjax();
			
			// Read the list of thumbnail paths.
			$Thumbnails = file("public_html/img/Thumbnails.txt");
			
			// Return the list encoded as JSON.
			return new JsonModel(["thumbnails" => $Thumbnails]);
		}
    }
?>