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
		// Properties.
		protected $OrderID;
		protected $UserID;
		protected $AddressID;
		protected $Value;
		protected $PlacementDate;
		protected $Status;
		protected $OrderProducts;
    }
?>