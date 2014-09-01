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
		// Properties stored in the database.
		protected $OrderID;
		protected $ProductID;
		protected $ProductName;
		protected $DisplayType;
		protected $Amount;
		protected $Price;
		protected $Path;
		protected $PriceType;
		protected $Description;
		
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
				throw new Exception("Incorrect 'price type' as an argument to OrderProduct->setDisplayTypeFromPriceType");	
			}
		}

		/** Renders the markup of this OrderProduct instance. This is the version used in the order details, without the
		 *  remove from cart button. */
		public function render()
		{
			// Fetch the properties of the OrderProduct instance for easy interpolation.
			$ProductID = $this->getProductID();
			$ProductName = $this->getProductName();
			$DisplayType = $this->getDisplayType();
			$Amount = $this->getAmount();
			$Price = $this->getPrice();
			$Path = $this->getPath();
			$PriceType = $this->getPriceType();
			$Subtotal = $Price * $Amount;
					
			// Return the assembled markup.
			return "<div class='cartProduct col-lg-7'>
						<div class='imgWrapper col-lg-5'>
							<a href='/product/$ProductID'><img src='$Path' alt='$ProductName'/></a>
						</div>
						<div class='infoWrapper col-lg-5'>
							<h1>$ProductName</h1>
							<h2>$DisplayType</h2>
							<p>Amount: $Amount</p>
							<p>Unit price: £$Price</p>
							<p>Subtotal: £$Subtotal</p>
						</div>
					</div>";
		}
    }
?>