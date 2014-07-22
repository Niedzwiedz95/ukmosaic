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
    class Product extends BaseModel implements InputFilterAwareInterface
    {
		// Properties.
		protected $ProductID;
		protected $ProductName;
		protected $Category;
		protected $Path;
		protected $Description;
		protected $Price;
		protected $PriceLoose1;
		protected $PriceAssembledTiles;
		protected $PriceLoose2;
		protected $PriceAssembledBorders;
		
		/** Returns the appropriate input filter. It's null, because there's no way to add products through the application itself. */
		public function getInputFilter()
		{
			return false;
		}
    }
?>