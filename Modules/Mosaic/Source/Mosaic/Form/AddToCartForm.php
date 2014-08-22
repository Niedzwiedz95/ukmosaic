<?php
    namespace Mosaic\Form;
    
    use Zend\Form\Form;
    use Zend\Validator;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\Validator\File;

    use Core\Form\BaseForm;
	
	use Mosaic\Model\Product;
    
    class AddToCartForm extends BaseForm
    {
    	// Properties.
    	protected $Product;
		
        /** Construct the form. */
        public function __construct(Product $Product)
        {
            // Set all the necessary attributes.
            parent::__construct('AddToCartForm');
            $this->setAttribute('id', 'addToCartForm');
            $this->setAttribute('action', '/addtocart/');
			//$this->setAttribute('header', 'Contact us');
			
			// Set the product instance.
			$this->Product = $Product;
            
            // Create the necessary elements.
            if(array_key_exists('Normal', $this->getProduct()->buildValueOptions()))
			{
				$this->add(
	            [
	                'name' => 'typeNormal',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeNormal',
	                   'required' => 'required',
	                ],
	                'options' =>
	                [
	                	'header' => 'Tu musi być  jakiś header',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Normal']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'normalAmount',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'normalAmount',
	                   'min' => 0
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
	            ]);
			}
            if(array_key_exists('Field per square metre', $this->getProduct()->buildValueOptions()))
			{
	            $this->add(
	            [
	                'name' => 'typeSquare',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeSquare',
	                   'required' => 'required',
	                ],
	                'options' =>
	                [
	                	'header' => 'Field per square metre',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Field per square metre']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'squareAmount',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'squareAmount',
	                   'min' => 0
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
            	]);
			}
            if(array_key_exists('Border per linear metre', $this->getProduct()->buildValueOptions()))
			{
	            $this->add(
	            [
	                'name' => 'typeLinear',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeLinear',
	                   'required' => 'required',
	                ],
	                'options' =>
	                [
	                	'header' => 'Border per linear metre',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Border per linear metre']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'linearAmount',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'linearAmount',
	                   'min' => 0
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
	            ]);
            }
            if(array_key_exists('Mosaic Designs', $this->getProduct()->buildValueOptions()))
			{
	            $this->add(
	            [
	                'name' => 'typeMosaicDesigns',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeMosaicDesigns',
	                   'required' => 'required',
	                ],
	                'options' =>
	                [
	                	'header' => 'Mosaic Designs',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Mosaic Designs']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'mosaicDesignsAmount',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'mosaicDesignsAmount',
	                   'min' => 0
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
	            ]);
            }
            $this->add(
            [
                'name' => 'submitAddToCartForm',
                'attributes' =>
                [
                    'type'  => 'submit',
                    'id' => 'submitAddToCartForm',
                    'required' => 'required',
                    'value' => 'Add to cart',
                ]
            ]);
        }

        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            // Create new InputFilter instance.
            $InputFilter = new InputFilter();
            
            // Create a factory instance used to add more validators to the filter.
            $Factory = new InputFactory();
			
			// Add the necessary validators.
            
            return $InputFilter;
        }
    }
?>