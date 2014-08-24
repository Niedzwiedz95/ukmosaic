<?php
    namespace Core\Form\View\Helper;
    
    use Zend\Form\FieldsetInterface;
    use Zend\Form\ElementInterface;
    use Zend\Form\FormInterface;
    use Zend\Form\View\Helper\AbstractHelper;
	
	use Mosaic\Model\Product;
	use Mosaic\Form\AddToCartForm;
    
    /** Custom view helper used to render all forms in the whole site. */
    class RenderAddToCartForm extends AbstractHelper
    {
        /** The view helper can be invoked from the view using $this->bootstrapForm($Form). */
        public function __invoke(Product $Product)
        {
            return $this->render(new AddToCartForm($Product));
        }
		
        /** Renders the form. */
        public function render(FormInterface $Form)
        {
            // If the form has a 'prepare' method, call it now.
            /*if(method_exists($Form, 'prepare'))
            {
                $Form->prepare();
            }*/
            
			$Markup = '<h1>' . $Form->getProduct()->getProductName() . '</h1>';
			$Markup .= '<h2>' . $Form->getProduct()->getDescription() . '</h2>';
			
            // Render each element and append its HTML to the variable.
            $FormContent = $Form->getAttribute('header') != '' ? "<h2 class='formHeader'>" . $Form->getAttribute('header') . '</h2>' : '';
            foreach($Form->getElements() as $Element)
            {
                $FormContent .= $this->renderElement($Element);
            }
            
            // Open the form tag, append the form content and close the form tag.
            return $Markup . $this->openTag($Form) . $FormContent . $this->closeTag();
        }
        /** Generates the opening tag for the form. */
        public function openTag(FormInterface $Form)
        {
            // Variables to make the rendering easier.
            $Attributes = $Form->getAttributes();
            $ID = $Attributes['id'];
            $Action = $Attributes['action'];
            $Method = $Attributes['method'];
            $Class = 'form-horizontal' . (isset($Attributes['class']) ? $Attributes['class'] : '');
            
            // The opening tag with an optional enctype attribute.
            $OpeningTag = "<form id='$ID' class='$Class col-lg-12' method='$Method' action='$Action'";
            if(isset($Attributes['enctype']))
            {
                $Enctype = $Attributes['enctype'];
                $OpeningTag .= " enctype='$Enctype'";
            }
            
            // Close the opening tag and start an <ul> tag. Then return the opening tag.
            $OpeningTag .= '>';    
            return $OpeningTag;
        }
        /** Returns closing tag for the form. */
        public function closeTag()
        {
            return '</form>';
        }
        /** Renders an element. */
        public function renderElement(ElementInterface $Element)
        {
            // Variables to make the templating easier.
            $ID = $Element->getAttribute('id');
            $Name = $Element->getName();
            $Type = $Element->getAttribute('type');
            $Value = $Type == 'password' ? '' : $Element->getValue();
            $Required = $Element->getAttribute('required');
            $Placeholder = $Element->getAttribute('placeholder');
            
            // Initialize the variables that store markup, input class, label and the input element itself.
			$Markup = '';
            $Class = 'form-control';
            $Label = '';
			
            // Create the class variables.
            $Errors = '';

            // Check if there are errors.
            foreach($Element->getMessages() as $Message)
            {
                $Errors .= "<div class='col-lg-4'></div><label for='$ID' class='error col-lg-8'>$Message</label>";
            }
            
            // Render each element differently depending on its type attribute.
            if($Type == 'submit')
            {
                $Input = "<input id='$ID' class='form-control btn btn-primary' name='$Name' type='$Type' value='$Value' $Required/>";
				$Markup = "<div class='form-group'><div class='col-lg-12'>" . $Errors . $Input . '</div></div>';
            }
            else if($Type == 'Zend\Form\Element\Csrf' || $Type == 'hidden')
            {
            	// If the element is a csrf, return immediately - this is to simplify the code.
                $Input = "<div class='form-group hidden'><input id='$ID' name='$Name' type='$Type' value='$Value' $Required/></div>";
                return $Input;
            }
            else if($Type == 'Zend\Form\Element\Radio')
            {
                $Input = '<h3>' . $Element->getOptions()['header'] . '</h3>';
                foreach($Element->getOptions()['value_options'] as $Value => $Display)
                {
                   $Input .= "<input class='col-lg-1' type='radio' name='$Name' value='$Value'/><p class='col-lg-11'>$Display</p>";
                }
				$Markup = "<div class='form-group'>" . $Errors . "<div class='col-lg-12'>" . $Input . '</div></div>';
            }
			else
			{
				// Attributes of number inputs.
				$Min = $Element->getAttribute('min');
				// This is the default and the most used case.
				$Label = "<label class='control-label' for='$ID'>" . $Element->getLabel() . "</label>";
				$Input = "<input id='$ID' class='$Class' name='$Name' type='$Type' placeholder='$Placeholder' value='$Value' $Required min='$Min'/>";
				$Markup = "<div class='form-group'><div class='col-lg-10'>" . $Input . '</div>' . $Label . '</div>';
			}
			
			
			// Return the assembled markup.
            return $Markup;
        }
    }
?>