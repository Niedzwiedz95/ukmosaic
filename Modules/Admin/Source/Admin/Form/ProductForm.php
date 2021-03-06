<?php
	namespace Admin\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
    
	abstract class ProductForm extends BaseForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct($FormName)
	    {
	    	// Call parent's constructor with the form name so nothing breaks down.
	    	parent::__construct($FormName);
			
            // Address elements.
			$this->add(
			[
	            'name' => 'productName',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'productName',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Product name']
	        ]);
			$this->add(
			[
                'name' => 'category',
                'attributes' =>
                [
                   'type'  => 'select',
                   'id' => 'category',
                   'required' => 'required'
                ],
                'options' =>
                [
                	'label' => 'Category',
                	'value_options' =>
                	[
                		'unglazed_tiles15x15-9mm' => 'unglazed_tiles15x15-9mm',
                		'unglazed_octagon10x10-9mm' => 'unglazed_octagon10x10-9mm',
                		'unglazed_tiles5x5-9mm' => 'unglazed_tiles5x5-9mm',
                		'unglazed_tiles2x2-3.8mm' => 'unglazed_tiles2x2-3.8mm',
                		'unglazed_tiles10x10-9mm' => 'unglazed_tiles10x10-9mm',
                		'unglazed_victorian-9mm' => 'unglazed_victorian-9mm',
                		'unglazed_basket' => 'unglazed_basket',
                		'unglazed_tiles7x7-9mm' => 'unglazed_tiles7x7-9mm',
                		'unglazed_tiles3.5x3.5-9mm' => 'unglazed_tiles3.5x3.5-9mm',
                		'unglazed_octagon15x15-9mm' => 'unglazed_octagon15x15-9mm',
                		'unglazed_tiles5x5-5mm' => 'unglazed_tiles5x5-5mm',
                		'satin&matt_tiles2.5x2.5-cmm' => 'satin&matt_tiles2.5x2.5-cmm',
                		'glazed_tiles2.5x2.5-cmm' => 'glazed_tiles2.5x2.5-cmm',
                		'mosaicdesigns_mosaicdesigns' => 'mosaicdesigns_mosaicdesigns',
                		'specialoffers_specialoffers' => 'specialoffers_specialoffers'
                	]
            	]
	        ]);
			$this->add(
			[
	            'name' => 'description',
	            'attributes' =>
	            [
	                'type'  => 'textarea',
	                'id' => 'description',
	        	],
	            'options' => ['label' => 'Description']
	        ]);
			// Prices.
			$this->add(
			[
	            'name' => 'price',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'price',
	        	],
	            'options' => ['label' => 'Standard, Price']
	        ]);
			$this->add(
			[
	            'name' => 'priceSquareLoose',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'priceSquareLoose',
	        	],
	            'options' => ['label' => 'Field per square metre: Loose Tiles, Price']
	        ]);
			$this->add(
			[
	            'name' => 'priceSquareAssembled',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'priceSquareAssembled',
	        	],
	            'options' => ['label' => 'Field per square metre: Assembled Tiles, Price']
	        ]);
			$this->add(
			[
	            'name' => 'priceLinearLoose',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'priceLinearLoose',
	        	],
	            'options' => ['label' => 'Border per linear metre: Loose Tiles, Price']
	        ]);
			$this->add(
			[
	            'name' => 'priceLinearAssembled',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'priceLinearAssembled',
	        	],
	            'options' => ['label' => 'Border per linear metre: Assembled Borders, Price']
	        ]);
			$this->add(
			[
	            'name' => 'price1x1',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'price1x1',
	        	],
	            'options' => ['label' => 'Mosaic Designs: Price 1x1']
	        ]);
			$this->add(
			[
	            'name' => 'price2x2',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'price2x2',
	        	],
	            'options' => ['label' => 'Mosaic Designs: Price 2x2']
	        ]);
			$this->add(
			[
	            'name' => 'price25x25',
	            'attributes' =>
	            [
	                'type'  => 'number',
	                'id' => 'price25x25',
	        	],
	            'options' => ['label' => 'Mosaic Designs: Price 2.5x2.5']
	        ]);
	    }
    }