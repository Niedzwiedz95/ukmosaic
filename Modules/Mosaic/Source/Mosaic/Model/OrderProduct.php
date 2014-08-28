<?php
	namespace Mosaic\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	use Core\Model\BaseModel;
	
	/**	A product that was added to cart or ordered. */
    class OrderProduct extends BaseModel
    {
		// Properties.
		protected $ProductID;
		protected $ProductName;
		protected $DisplayType;
		protected $Type;
		protected $Price;
		protected $Amount;
		protected $Path;
		
		/** Sets the type basing on the "price type" assigned to the product. */
		public function setDisplayTypeFromPriceType($PriceType)
		{
			if($PriceType == 'Price')
			{
				$this->setDisplayType('Standard');
			}
			else if($PriceType == 'PriceSquareLoose')
			{
				$this->setDisplayType('Field per square meter: Loose Tiles');
			}
			else if($PriceType == 'PriceSquareAssembled')
			{
				$this->setDisplayType('Field per square meter: Assembled Tiles');
			}
			else if($PriceType == 'PriceLinearLoose')
			{
				$this->setDisplayType('Border per linear metre: Loose Tiles');
			}
			else if($PriceType == 'PriceLinearAssembled')
			{
				$this->setDisplayType('Border per linear metre: Assembled Borders');
			}
			else if($PriceType == 'Price1x1')
			{
				$this->setDisplayType('Mosaic Designs: Size 1x1');
			}
			else if($PriceType == 'Price2x2')
			{
				$this->setDisplayType('Mosaic Designs: Size 2x2');
			}
			else if($PriceType == 'Price2.5x2.5' || $PriceType == 'Price25x25')
			{
				$this->setDisplayType('Mosaic Designs: Size 2.5x2.5');
			}
			else
			{
				throw new Exception("Incorrect 'price type' as an argument to OrderProduct->setTypeFromPriceType");	
			}
		}
    }
?>