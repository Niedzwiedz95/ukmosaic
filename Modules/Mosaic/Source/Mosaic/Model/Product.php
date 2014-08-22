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
		protected $PriceSquareLoose;
		protected $PriceSquareAssembled;
		protected $PriceLinearLoose;
		protected $PriceLinearAssembled;
		protected $Price1x1;
		protected $Price2x2;
		protected $Price25x25;
		
		/** Returns the appropriate input filter. It's null, because there's no way to add products through the application itself. */
		/*public function getInputFilter()
		{
			return false;
		}*/
		
		/* Builds up a value_options array used in constructing the AddToCartForm instance. */
		public function buildValueOptions()
		{
			// Create an empty array to store the options.
			$ValueOptions = [];
			
			// Build up the array.
			if($this->getPrice() != null)
			{
				$ValueOptions['Normal'] =
				[
					'Price' => 'Price - £' . $this->getPrice()
				];
			}
			if($this->getPriceSquareLoose() != null)
			{
				$ValueOptions['Field per square metre'] = 
				[
					'PriceSquareLoose' => 'Loose Tiles - £' . $this->getPriceSquareLoose(),
					'PriceSquareAssembled' => 'Assembled Tiles - £' . $this->getPriceSquareAssembled() 
				];
				/*if($this->getPriceSquareAssembled() != null)
				{
					$ValueOptions['PriceSquareAssembled'] = $this->getPriceSquareAssembled();
				}*/
			}
			if($this->getPriceLinearLoose() != null)
			{
				$ValueOptions['Border per linear metre'] =
				[
					'PriceLinearLoose' => 'Loose Tiles - £' . $this->getPriceLinearLoose(),
					'PriceLinearAssembled' => 'Assembled Borders - £' . $this->getPriceLinearAssembled()
				];
				/*if($this->getPriceLinearAssembled() != null)
				{
					$ValueOptions['PriceLinearAssembled'] = $this->getPriceLinearAssembled();
				}*/
			}
			if($this->getPrice1x1() != null)
			{
				$ValueOptions['MosaicDesign'] =
				[
					'Price1x1' => 'Size 1x1 - £' . $this->getPrice1x1(),
					'Price2x2' => 'Size 2x2 - £' . $this->getPrice2x2(),
					'Price25x25' => 'Size 2.5x2.5 - £' . $this->getPrice25x25(),
				];
				/*if($this->getPrice2x2() != null)
				{
					$ValueOptions['Price2x2'] = $this->getPrice2x2();
				}
				if($this->getPrice25x25() != null)
				{
					$ValueOptions['Price25x25'] = $this->getPrice25x25();
				}*/
			}
			
			// Return the options array.
			return $ValueOptions;
		}
    }
?>