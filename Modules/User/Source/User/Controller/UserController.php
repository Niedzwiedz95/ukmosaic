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
	use User\Form\AddAddressForm;
	use User\Form\EditAddressForm;

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
			// Assert that the user is signed out.
			$this->assertSignedOut();
			
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
					
					// Insert the user into the database and get his id back.
					$UserID = $this->getUserTable()->insertUser($User);
					
					// Create a new address instance.
					$Address = new Address(
					[
						'UserID' => $UserID,
						'FullName' => $_POST['fullName'],
						'Street' => $_POST['street'],
						'Locality' => $_POST['locality'],
						'PostTown' => $_POST['postTown'],
						'Postcode' => $_POST['postcode']
					]);
					
					// Insert the address into the database.
					$this->getAddressTable()->insertAddress($Address);
					
					// Sign in the user and redirect him to the main page.
					$this->signinUser($_POST['email'], $_POST['password']);
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
			// Assert that the user is not signed in.
			$this->assertSignedOut();
			
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

		/** A page on which the user can manage his account (change password). */
		public function accountAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Manage account - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel())->setTemplate('User/Account.phtml');
		}
		
		/** A page on which the user can manage addresses associated with his account. */
		public function addressBookAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
						
			// Render the user's address book.
			$AddressBook = $this->renderAddressBook($_SESSION['User']['UserID']);
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Manage addresses - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel(['AddressBook' => $AddressBook]))->setTemplate('User/AddressBook.phtml');			
		}
		
		/** A page on which the user can view his previous and current orders. */
		public function ordersAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Manage orders - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel())->setTemplate('User/Orders.phtml');			
		}

		/** A page on which the user can add a new address to his address book. */
		public function addAddressAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
			
			// Create a form instance.
			$AddAddressForm = new AddAddressForm();
			
			// Check whether this request is a POST request.
			if($this->getRequest()->isPost())
			{
				// Feed data to the form.
				$Data = $this->getRequest()->getPost()->toArray();
				$AddAddressForm->setData($Data);
				
				// Check whether the form is valid.
				if($AddAddressForm->isValid())
				{
					// Create an Address instance to be inserted and set it's UserID property.
					$Address = new Address(
					[
						'UserID' => $_SESSION['User']['UserID'],
						'FullName' => $Data['fullName'],
						'Street' => $Data['street'],
						'Locality' => $Data['locality'],
						'PostTown' => $Data['postTown'],
						'Postcode' => $Data['postcode']
					]);
										
					// Insert the address to the database.
					$this->getAddressTable()->insert($Address);
					
					// Redirect the user to the address book.
					return $this->redirect()->toRoute('user', ['action' => 'addressbook']);
				}
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Add a new address - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel(['AddAddressForm' => $AddAddressForm]))->setTemplate('User/AddAddress.phtml');	
		}

		/** A page on which the user can edit an address he has in his address book. */
		public function editAddressAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
			
			// Get the AddressID from the URL parameter.
			$AddressID = intval($this->params()->fromRoute('addressid'));
			
			// If the address's id is invalid, redirect the user to the address book.
			if($AddressID < 1)
			{		
				return $this->redirect()->toRoute('user', ['action' => 'addressbook']);
			}
			
			// Create a form instance.
			$EditAddressForm = new EditAddressForm($AddressID);
			
			// Check whether this request is a POST request.
			if($this->getRequest()->isPost())
			{
				// Feed data to the form.
				$Data = $this->getRequest()->getPost()->toArray();
				$EditAddressForm->setData($Data);
				
				// Check whether the form is valid.
				if($EditAddressForm->isValid())
				{
					// Create an Address instance to be inserted and set it's UserID property.
					$Address = new Address(
					[
						'UserID' => $_SESSION['User']['UserID'],
						'FullName' => $Data['fullName'],
						'Street' => $Data['street'],
						'Locality' => $Data['locality'],
						'PostTown' => $Data['postTown'],
						'Postcode' => $Data['postcode']
					]);
										
					// Insert the address to the database.
					$this->getAddressTable()->update($Address, new Address(['AddressID' => $AddressID]));
					
					// Redirect the user to the address book.
					return $this->redirect()->toRoute('user', ['action' => 'addressbook']);
				}
			}
			else
			{
				// Fetch the edited address from the database.
				$Address = $this->getAddressTable()->select(['AddressID' => $AddressID])->buffer()->current()->toArray();
				
				// Feed the address data to the form.
				$EditAddressForm->setData(
				[
					'fullName' => $Address['FullName'],
					'street' => $Address['Street'],
					'locality' => $Address['Locality'],
					'postTown' => $Address['PostTown'],
					'postcode' => $Address['Postcode']
				]);	
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Edit address - Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel(['EditAddressForm' => $EditAddressForm]))->setTemplate('User/EditAddress.phtml');	
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
			
			// Redirect the user to the account management page.
			return $this->redirect()->toRoute('user', ['action' => 'account']);
		}
		
		/** Signs the user out. */
		public function signoutAction()
		{
            session_destroy();
			$this->redirect()->toRoute('mosaic', ['action' => 'home']);//TODO
			return (new ViewModel())->setTemplate('User/Orders.phtml');		
		}
		
		/** Renders the html markup of the addresses associated with a user. */
		public function renderAddressBook($UserID)
		{
			// Fetch addresses from the database.
			$Addresses = $this->getAddressTable()->select(['UserID' => $UserID])->buffer();
			
			// Variable to hold the markup.
			$HTML = "";
			
			// Iterate over all the addresses and build up the markup.
			foreach($Addresses as $Address)
			{
				// Save the product's attributes to make life easier.
				$AddressID = $Address->getAddressID();
				$Name = $Address->getFullName();
				$Street = $Address->getStreet();
				$Locality = $Address->getLocality() == '' ? '&nbsp;' : $Address->getLocality();
				$PostTown = $Address->getPostTown();
				$Postcode = $Address->getPostcode();
				$PhoneNumber = $Address->getPhoneNumber();
				
				$HTML .= "<div class='address col-lg-4'>
						      <p>Full name: $Name</p>
							  <p>Number and street: $Street</p>
							  <p>$Locality</p>
							  <p>$PostTown</p>
							  <p>$Postcode</p>
							  <p>$PhoneNumber</p>
							  <a class='btn btn-primary btn-lg' role='button' href='/user/editaddress/$AddressID'>Edit</a>
							  <a class='btn btn-primary btn-lg' role='button' href='/user/deleteaddress/$AddressID'>Delete</a>
						  </div>";
			}
			
			// Return the markup.
			return $HTML;
		}

		/** Asserts that the user is signed in. If he's not, redirects him to the sign in page. */
		public function assertSignedIn()
		{
			if(isset($_SESSION['User']) == false)
			{
				return $this->redirect()->toRoute('user', ['action' => 'signin']);
			}
		}
		
		/** Asserts that the user is signed out. If he's not, redirects him to the sign in page. */
		public function assertSignedOut()
		{
			if(isset($_SESSION['User']))
			{
				return $this->redirect()->toRoute('user', ['action' => 'account']);
			}
		}	
    }
?>