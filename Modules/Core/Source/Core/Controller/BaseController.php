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
		
		/** Asserts that the user is signed in. If he's not, redirects him to the sign in page. */
		public function assertSignedIn()
		{
			// This little hack makes sure that the redirect works as expected. This is because the redirect() method only
			// works after using return. This makes it hard to use, because one needs either to call it like
			// 'return $this->redirect()...' or paste paste the body of this method directl. Rather than paste, it would be
			// way better to have an inline function, and this hack does just this: it makes this function work like an
			// inline function in, exempli gratia, C++. 
			$assertSignedIn = function($this)
			{
				if(isset($_SESSION['User']) == false)
				{
					return $this->redirect()->toRoute('user', ['action' => 'signin']);
				}
			};
			$assertSignedIn($this);
		}
    }
?>