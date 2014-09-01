<?php
	namespace Mosaic\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	use Core\Model\BaseModel;
	
	/**	Product, that is a tile, mosaic, etc. */
    class Order extends BaseModel
    {
		// Properties the in the database.
		protected $OrderID;
		protected $UserID;
		protected $AddressID;
		protected $Value;
		protected $PlacementDate;
		protected $Status;
		
		// Properties not stored in the database.
		protected $OrderProducts;
		
		/** Renders the order. */
		/*public function render()
		{
			// Variable to hold the markup.
			$Markup = "";
				
			// Save the product's attributes to make life easier.
			$AddressID = $this->getAddressID();
			$Name = $this->getFullName();
			$Street = $this->getStreet();
			$Locality = $this->getLocality() == '' ? '&nbsp;' : $this->getLocality();
			$PostTown = $this->getPostTown();
			$Postcode = $this->getPostcode();
			$PhoneNumber = $this->getPhoneNumber() == '' ? '&nbsp;' : $this->getPhoneNumber();
				
			$Markup .= "<div class='addressWrapper col-lg-4'>
					      <div class='address'>
					          <p>Name: $Name</p>
						      <p>Street: $Street</p>
						      <p>Locality: $Locality</p>
						      <p>Post town: $PostTown</p>
						      <p>Postcode: $Postcode</p>
						      <p>Phone: $PhoneNumber</p>
						  </div>
					  </div>";
			
			// Return the markup.
			return $Markup;
			
		}*/
    }
?>