<?php
    /** This namespace contains all the controllers used in the Mosaic module. */
    namespace Mosaic\Controller;
    
    use Zend\View\Model\ViewModel;
    
    use Core\Controller\BaseController;

    class MosaicController extends BaseController
    {
        public function homeAction()
        {
            return (new ViewModel([]))->setTemplate('Mosaic/Home.phtml');
        }
        public function catalogueAction()
        {
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
            return (new ViewModel([]))->setTemplate('Mosaic/Creator.phtml');
        }
    }
?>