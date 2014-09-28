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
	use User\Form\ChangePasswordForm;
	use User\Form\RestorePasswordForm;

    /** This controller manages all pages and operations related to users. */
    class UserController extends BaseController
    {
    	// Properties.
        protected $UserTable;
		protected $AddressTable;
		protected $OrderTable;
        
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
		
        /** Retrieve the OrderTable instance. */
        public function getOrderTable()
        {
            /* If the UserTable is null, it gets loaded from the ServiceManager. */
            if($this->OrderTable == null)
            {
                $this->OrderTable = $this->getServiceLocator()->get('Mosaic\Model\OrderTable');
            }
            return $this->OrderTable;
        }
		
		/** A page on which the user may sign up. Also processes the form after it's submitted. */
		public function signupAction()
		{
			// Assert that the user is signed out.
			$this->assertSignedOut();
			
			// Create a SignupForm instance.
			$SignupForm = $this->getServiceLocator()->get('User\Form\SignupForm');
			
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
                'Title' => "Sign up | Martin's mosaics",
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
                'Title' => "Sign in | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/user/Signin.css']
            ]);
			
			return (new ViewModel(['SigninForm' => $SigninForm, ]))->setTemplate('User/Signin.phtml');
		}
		
		/** A page on which the user may restore his password */
		public function restorePasswordAction()
		{
			// Assert that the user is not signed in.
			$this->assertSignedOut();
			
			// Variable to be used later, exempli gratia in case when the code provided is incorrect.
			$CodeIncorrect = '';
			
			// Create a form instance.
			$RestorePasswordForm = $this->getServiceLocator()->get('User\Form\RestorePasswordForm');
			
			// Check if it's a POST request with the form submitted.
			if($this->getRequest()->isPost())
			{
				// Feed the data to the form.
				$Data = $this->getRequest()->getPost()->toArray();
				$RestorePasswordForm->setData($Data);
				
				// If the user provided correct credentials, sign him in.
				if($RestorePasswordForm->isValid())
				{
					$this->sendNewPassword($Data['email']);
				}
			}
			
			// Fetch the activation code from the URL param.
            $Code = isset($_GET['code']) ? $_GET['code'] : '';
			
            // Check if code is set.
            if($Code != '')
            {
                // Build up and execute the query.
                $Query = 'SELECT * FROM RestorePassword WHERE Code = ?';
                $Values = [$Code];
                $ResultSet = $this->getUserTable()->getDB()->query($Query, $Values);
                
                // Check whether the query was successful.
                if($ResultSet->count() == 1)
                {
                	// Fetch the result from the result set. Fetch the email, password and saltfrom the result.
                	$Result = $ResultSet->buffer()->current();
					$Email = $Result['Email'];
					$Password = $Result['NewPassword'];
					$Salt = $Result['NewSalt'];
					
					// Hash the salt with the password.
                    $PasswordHash = hash('sha512', $Salt . $Password);
                    
                   	// Create the set and where parts of the query and execute it.
                    $Set = new User(['PasswordHash' => $PasswordHash, 'Salt' => $Salt]);
                    $Where = new User(['Email' => $Email]);
                    $this->getUserTable()->update($Set, $Where);
					
					// Delete the entry from the RestorePassword table.
                	$Query = 'DELETE FROM RestorePassword WHERE Email = ?';
                	$Values = [$Email];
               		$this->getUserTable()->getDB()->query($Query, $Values);
					
					// Redirect the user to the sign in page.
					return $this->redirect()->toRoute('user', ['action' => 'signin']);
                }
            }
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Restore password | Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel(['RestorePasswordForm' => $RestorePasswordForm]))->setTemplate('User/RestorePassword.phtml');
		}

		/** A page on which the user can manage his account (change password). */
		public function accountAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
			
			// Create instances of the necessary forms.
			$ChangePasswordForm = new ChangePasswordForm();
			
			// Check whether this request is a POST request.
			if($this->getRequest()->isPost())
			{
				// Feed data to the form.
				$Data = $this->getRequest()->getPost()->toArray();
				$ChangePasswordForm->setData($Data);
				
				// Check whether the form is valid.
				if($ChangePasswordForm->isValid())
				{
					// Generate new salt and password hash for the user.
					$Salt = $this->getRandomString(128);
					$PasswordHash = hash('sha512', $Salt . $Data['newPassword']);
					
					// Create the SET and WHERE clauses of the query and update the user's password.
					$Set = new User(['PasswordHash' => $PasswordHash, 'Salt' => $Salt]);
					$Where = new User(['UserID' => $_SESSION['User']['UserID']]);
					$this->getUserTable()->update($Set, $Where);
					
					// Sign the user out so that he can sign in using his new password.
					$this->signout();
				}
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Manage account | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/user/Account.css']
            ]);
			
			return (new ViewModel(['ChangePasswordForm' => $ChangePasswordForm]))->setTemplate('User/Account.phtml');
		}
		
		/** A page on which the user can manage addresses associated with his account. */
		public function addressBookAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
						
			// Render the user's address book. The isset is there to guard against 'undefined index' error.
			$AddressBook = $this->renderAddressBook(isset($_SESSION['User']['UserID']) ? $_SESSION['User']['UserID'] : 0);
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Manage addresses | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/user/AddressBook.css']
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
                'Title' => "Manage orders | Martin's mosaics",
                'Scripts' => [],
                'Styles' => ['/css/pages/user/Orders.css']
            ]);
			
			$Orders = $this->renderOrders($_SESSION['User']['UserID']);

			return (new ViewModel(['Orders' => $Orders]))->setTemplate('User/Orders.phtml');			
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
                'Title' => "Add a new address | Martin's mosaics",
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
					'locality' => isset($Address['Locality']) ? $Address['Locality'] : '',
					'postTown' => $Address['PostTown'],
					'postcode' => $Address['Postcode']
				]);	
			}
			
            // Add metadata to the layout.
            $this->layout()->setVariables(
            [
                'Title' => "Edit address | Martin's mosaics",
                'Scripts' => [],
                'Styles' => []
            ]);
			
			return (new ViewModel(['EditAddressForm' => $EditAddressForm]))->setTemplate('User/EditAddress.phtml');	
		}
		
		/** Deletes the requested address from the user's address book. */
		public function deleteAddressAction()
		{
			// Check whether an user is signed in.
			$this->assertSignedIn();
			
			// Get the AddressID from the URL parameter and save user id in a variable.
			$AddressID = intval($this->params()->fromRoute('addressid'));
			$UserID = $_SESSION['User']['UserID'];
			
			// Fetch all addresses that have the requested id and the user id that's stored in the session variable.
			$Addresses = $this->getAddressTable()->select(['AddressID' => $AddressID, 'UserID' => $UserID]);
			
			// Check whether a unique address was selected.
			if($Addresses->count() == 1)
			{
				// Fetch the address from the result set.
				$Address = $Addresses->buffer()->current();
				
				// Create the SET and WHERE parts of the query and update the database.
				$Set = new Address(['UserID' => 0]);
				$Where = new Address(['AddressID' => $AddressID, 'UserID' => $UserID]);
				$this->getAddressTable()->update($Set, $Where);
			}
			
			// Redirect the user to the address book.
			return $this->redirect()->toRoute('user', ['action' => 'addressbook']);
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
			$_SESSION['User']['IsAdmin'] = $User->getIsAdmin() == '1';
			
			// Redirect the user to the account management page.
			return $this->redirect()->toRoute('mosaic', ['action' => 'home']);
		}
		
		/** A page which signs the user out. */
		public function signoutAction()
		{
			return $this->signout();
		}
		
		/** Signs the user out and redirects him to the sign in page. */
		public function signout()
		{
            session_destroy();
			return $this->redirect()->toRoute('mosaic', ['action' => 'home']);			
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
				$PhoneNumber = $Address->getPhoneNumber() == '' ? '&nbsp;' : $Address->getPhoneNumber();
				
				$HTML .= "<div class='addressWrapper col-lg-4'>
						      <div class='address'>
						          <p>Name: $Name</p>
							      <p>Street: $Street</p>
							      <p>Locality: $Locality</p>
							      <p>Post town: $PostTown</p>
							      <p>Postcode: $Postcode</p>
							      <p>Phone: $PhoneNumber</p>
							      <div class='btnWrapper col-lg-6'>
							          <a class='btn btn-primary btn-lg' role='button' href='/user/editaddress/$AddressID'>Edit</a>
							          <a class='btn btn-primary btn-lg' role='button' href='/user/deleteaddress/$AddressID'>Delete</a>
							      </div>
							  </div>
						  </div>";
			}
			
			// Return the markup.
			return $HTML;
		}
		
		/** Asserts that the user is signed out. If he's not, redirects him to the sign in page. */
		public function assertSignedOut()
		{
			// This hack works the same way that the hack in assertSignedIn() works. 
			$assertSignedOut = function($this)
			{
				if(isset($_SESSION['User']))
				{
					return $this->redirect()->toRoute('user', ['action' => 'account']);
				}
			};
			$assertSignedOut($this);
		}
		
		/** Send an email to the user with a new password and an activation code. */
		public function sendNewPassword($Email)
        {
            // Fetch the user id from session and generate new password, salt and activation code.
            $NewPassword = $this->getRandomString(9, 61);
            $NewSalt = $this->getRandomString(128);
            $Code = $this->getRandomString(128);
            
            // Build and execute a query that will insert a row into the RestorePassword table.
            $Query = 'REPLACE INTO RestorePassword VALUES(?, ?, ?, ?)';
            $Values = [$Email, $NewPassword, $NewSalt, $Code];
            $Result = $this->getUserTable()->getDB()->query($Query, $Values);
			
			// Check whether the query was performed successfully. The query affects one row if it's a new insert and two if
			// it replaces an old row in the database.
			$QuerySuccess = $Result->getAffectedRows() == 1 || $Result->getAffectedRows() == 2;
            
            // Create an email that will be sent to the user.
            $Title = 'Password reset request on martinmosaic.com';
            $Message = 'There was a request to reset your password on martinmosaic.com' .
                       'If you did not request to reset your password, you can ignore this email.\n' . 
                       "Your new password is: $NewPassword\n" . 
                       'You will be able to sign in using this password after clicking this link:\n' .
                       'martinmosaic.com/user/restorepassword?code=' . urlencode($Code) . '\n';
            $Headers = 'FROM: info@martinmosaic.com';
            
            // Send the mail and save the operation status in a variable. */
            $EmailSent = mail($Email, $Title, $Message, $Headers);
            
            // If the query failed or the mail could not be sent, throw an exception.
            if($QuerySuccess == false || $EmailSent == false)
            {
                throw new \Exception('There was a problem with restoring your password. Try again later or contact the support.');
            }
        }

		/** Renders the markup of all the orders every made by the user. */
		public function renderOrders($UserID)
		{
			// Fetch the orders from the database.
			$Orders = $this->getOrderTable()->select(['UserID' => $UserID])->buffer();
			
			// Variable to hold the markup.
			$Markup = "<div class='orderHeader'>
					       <div class='col-lg-2'>OrderID</div>
					       <div class='col-lg-2'>Value</div>
					       <div class='col-lg-2'>Status</div>
					       <div class='col-lg-3'>Placement date</div>
					       <div class='col-lg-2'>Details</div>
					   </div>";
			
			// Iterate over all orders and render them.
			foreach($Orders as $Order)
			{
				$OrderID = $Order->getOrderID();
				$Value = $Order->getValue();
				$Status = $Order->getStatus();
				$PlacementDate = $Order->getPlacementDate();
				$Details = "<a class='btn btn-primary' href='/order/$OrderID'>Details</a>";
				$Markup .= "<div class='order'>
					            <div class='col-lg-2'>$OrderID</div>
					            <div class='col-lg-2'>£$Value</div>
					            <div class='col-lg-2'>$Status</div>
					            <div class='col-lg-3'>$PlacementDate</div>
					            <div class='col-lg-2'>$Details</div>
							</div>";
			}
			
			return "<div class='orderWrapper col-lg-7'>" . $Markup . "</div>";
		}
    }
?>