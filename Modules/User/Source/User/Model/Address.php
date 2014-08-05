<?php
	namespace User\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	use Core\Model\BaseModel;
	
	/**	Product, that is a tile, mosaic, etc. */
    class Address extends BaseModel
    {
		// Properties.
		protected $AddressID;
		protected $FullName;
		protected $Street;
		protected $Locality;
		protected $PostTown;
		protected $Postcode;
    }
?>