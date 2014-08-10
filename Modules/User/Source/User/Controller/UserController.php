<?php
    namespace User\Controller;
    
    use Zend\Db\ResultSet\ResultSet;
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    use Zend\View\Helper\Url;
    
    use Core\Controller\BaseController;
    
    use User\Model\User;
	use User\Model\Address;
    
    use User\Form\SignupForm;
    use User\Form\SigninForm;

    /** This controller manages all pages and operations related to users. */
    class UserController extends BaseController
    {
    	// Properties.
        protected $UserTable;
		protected $AddressTable;
        
        /** Retrieve the UserTable instance. */
        public function getUserTable()
        {
            /* If the UserTable is null, it gets loaded from the ServiceManager. */
            if($this->UserTable == null)
            {
                $this->UserTable = $this->getServiceLocator()->get('User\Model\UserTable');
            }
            return $this->UserTable;
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
		
		/** A page on which the user may sign up. Also processes the form after it's submitted. */
		public function signupAction()
		{			
			// Create a form SignupForm instance.
			$SignupForm = new SignupForm();
			
			// Check if it's a POST request with the form submitted.
			if($this->getRequest()->isPost())
			{
				// Feed the data into the form.
				$SignupForm->setData($this->getRequest()->getPost()->toArray());
				
				if($SignupForm->isValid())
				{
					// Generate a salt for the user.
					$Salt = $this->getRandomString(128);
					
					// Create a new user instance.
					$User = new User(
					[
						'Email' => $_POST['email'],
						'PasswordHash' => hash('sha512', $Salt . $_POST['password']),
						'Salt' => $Salt
					]);
					
					// Create a new address instance.
					$Address = new Address(
					[
						'FullName' => $_POST['fullName'],
						'Street' => $_POST['street'],
						'Locality' => $_POST['locality'],
						'PostTown' => $_POST['postTown'],
						'Postcode' => $_POST['postcode']
					]);
					
					// Insert the user and his address into the database and get the id's back.
					$UserID = $this->getUserTable()->insertUser($User);
					$AddressID = $this->getAddressTable()->insertAddress($Address);
					
					// Insert the link between the user and the address into the database.
					$this->getUserTable()->insertLink($UserID, $AddressID);
					
					// TODO
				}
			}

            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Sign up - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
            return (new ViewModel(['SignupForm' => $SignupForm]))->setTemplate('User/Signup.phtml');
		}

		/** A page on which the user may sign in. */
		public function signinAction()
		{
			// Create a form instance.
			$SigninForm = $this->getServiceLocator()->get('User\Form\SigninForm');
			
			// Check if it's a POST request with the form submitted.
			if($this->getRequest()->isPost())
			{
				// Feed the data to the form.
				$SigninForm->setData($this->getRequest()->getPost()->toArray());
				
				// If the user provided correct credentials, sign him in.
				if($SigninForm->isValid())
				{
					$this->signinUser($_POST['email'], $_POST['password']);
				}
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Sign in - Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/Signin.css']
            ]);
			
			return (new ViewModel(['SigninForm' => $SigninForm, ]))->setTemplate('User/Signin.phtml');
		}

		/** Sign in an user with the provided email and set the necessary session data. */
		public function signinUser($Email, $Password)
		{
			// Fetch all the user data.
			$User = $this->getUserTable()->select(['Email' => $Email])->buffer()->current();
			
			// Set the necessary session data.
			$_SESSION['User'] = [];
			$_SESSION['User']['UserID'] = $User->getUserID();
			$_SESSION['User']['Email'] = $User->getEmail();
		}
    }
?>