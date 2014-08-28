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
		
		/* Build up the product details that is displayed on the product page. */
		public function getProductDetails()
		{
			$Details = '<h1>' . $this->getProductName() . '</h1>';
			$Details .= '<h2>' . $this->getDescription() . '</h2>';
			
			// Build up the array.
			if($this->getPrice() != null)
			{
				$Standard = '<h3>Standard</h3>';
				$Standard .= "<p>Standard - £<span class='pricePrice'>" . $this->getPrice() . '</span></p>';
				$Details .= "<div class='col-lg-12'>$Standard</div>";
			}
			if($this->getPriceSquareLoose() != null)
			{
				$Square = '<h3>Field per square metre</h3>';
				$Square .= "<p>Loose Tiles - £<span class='pricePriceSquareLoose'>" . $this->getPriceSquareLoose() . '</span></p>';
				$Square .= $this->getPriceSquareAssembled() != null ? "<p>Assembled Tiles - £<span class='pricePriceSquareAssembled'>" . $this->getPriceSquareAssembled() . '</span></p>' : '';
				$Details .= "<div class='col-lg-12'>$Square</div>";
			}
			if($this->getPriceLinearLoose() != null)
			{
				$Linear = '<h3>Border per linear metre</h3>';
				$Linear .= "<p>Loose Tiles - £<span class='pricePriceLinearLoose'>" . $this->getPriceLinearLoose() . '</span></p>';
				$Linear .= $this->getPriceLinearAssembled() != null ? "<p>Assembled Borders - £<span class='pricePriceLinearAssembled'>" . $this->getPriceLinearAssembled() . '</span></p>' : '';
				$Details .= "<div class='col-lg-12'>$Linear</div>";
			}
			if($this->getPrice1x1() != null)
			{
				$MosaicDesigns = '<h3>Mosaic Designs</h3>';
				$MosaicDesigns .= "<p>Size 1x1 - £<span class='pricePrice1x1'>" . $this->getPrice1x1() . '</span></p>';
				$MosaicDesigns .= $this->getPrice2x2() != null ? "<p>Size 2x2 - £<span class='pricePrice2x2'>" . $this->getPrice2x2() . '</span></p>' : '';
				$MosaicDesigns .= $this->getPrice25x25() != null ? "<p>Size 2.5x2.5 - £<span class='pricePrice25x25'>" . $this->getPrice25x25() . '</span></p>' : '';
				$Details .= "<div class='col-lg-12'>$MosaicDesigns</div>";
			}
			
			return $Details;
		}
		
		/* Builds up a value_options array used in constructing the AddToCartForm instance. */
		public function getValueOptions()
		{
			// Create an empty array to store the options.
			$ValueOptions = [];
			
			// Build up the array.
			if($this->getPrice() != null)
			{
				$ValueOptions['Standard']['Price'] = 'Standard';
			}
			if($this->getPriceSquareLoose() != null)
			{
				$ValueOptions['Field per square metre']['PriceSquareLoose'] = 'Loose Tiles';
			}
			if($this->getPriceSquareAssembled() != null)
			{
				$ValueOptions['Field per square metre']['PriceSquareAssembled'] = 'Assembled Tiles';
			}
			if($this->getPriceLinearLoose() != null)
			{
				$ValueOptions['Border per linear metre']['PriceLinearLoose'] = 'Loose Tiles';
			}
			if($this->getPriceLinearAssembled() != null)
			{
				$ValueOptions['Border per linear metre']['PriceLinearAssembled'] = 'Assembled Borders';
			}
			if($this->getPrice1x1() != null)
			{
				$ValueOptions['Mosaic Designs']['Price1x1'] = 'Size 1x1';
			}
			if($this->getPrice2x2() != null)
			{
				$ValueOptions['Mosaic Designs']['Price2x2'] = 'Size 2x2';
			}
			if($this->getPrice25x25() != null)
			{
				$ValueOptions['Mosaic Designs']['Price2.5x2.5'] = 'Size 2.5x2.5';
			}
			
			// Return the options array.
			return $ValueOptions;
		}
    }
?>