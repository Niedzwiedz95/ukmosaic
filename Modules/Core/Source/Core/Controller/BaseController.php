<?php
    /** This namespace contains all the controllers in the Core module. */
    namespace Core\Controller;
    
    use Zend\Mvc\Controller\AbstractActionController;
    
    /** The base of all controllers in the whole application. */
    class BaseController extends AbstractActionController
    {
        /** Check if an action is a POST AJAX request. */
        public function assertPostAjax()
        {
            if($this->getRequest()->isXmlHttpRequest() == false || $this->getRequest()->isPost() == false)
            {
                return $this->redirect()->toRoute('mosaic', ['action' => 'home']);
            }
        }

    }
?>