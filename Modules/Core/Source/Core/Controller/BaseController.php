<?php
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
        /** Returns a random string of requested length. */ 
        public function getRandomString($Length, $Range = null)
        {
            // List of all character permitted in the random string.
            $Chars = "acbdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789~!@#$%^&*()_+[]\;',./{}|:<>?";
            
            // Check if range is specified. 
            if($Range == null)
            {
                $Range = strlen($Chars) - 1;
            }
            // Generate and return the string.
            $String = '';
            for($i = 0; $i < $Length; ++$i)
            {
                $String .= $Chars[rand(0, $Range)];
            }
            return $String;
		}
    }
?>