<?php
    namespace Core\Form\View\Helper;
    
    use Zend\Form\FieldsetInterface;
    use Zend\Form\ElementInterface;
    use Zend\Form\FormInterface;
    use Zend\Form\View\Helper\AbstractHelper;
    
    /** Custom view helper used to render all forms in the whole site. */
    class ProductFormRenderer extends AbstractHelper
    {
        /** The view helper can be invoked from the view using $this->bootstrapForm($Form). */
        public function __invoke(FormInterface $Form = null, $WrapperWidth = 4)
        {
            if(!$Form)
            {
                return $this;
            }
            return $this->render($Form, $WrapperWidth);
        }
		
        /** Renders the form. */
        public function render(FormInterface $Form, $WrapperWidth)
        {
            // Render each element and append its HTML to the variable.
            $FormContent = "<h2 class='formHeader'>" . $Form->getAttribute('header') . '</h2>';
            foreach($Form->getElements() as $Element)
            {
                $FormContent .= $this->renderElement($Element);
            }
            
            // Open the form tag, append the form content and close the form tag.
            return $this->openTag($Form, $WrapperWidth) . $FormContent . $this->closeTag();
        }
        /** Generates the opening tag for the form. */
        public function openTag(FormInterface $Form, $WrapperWidth)
        {
            // Variables to make the rendering easier.
            $Attributes = $Form->getAttributes();
            $ID = $Attributes['id'];
            $Action = $Attributes['action'];
            $Method = $Attributes['method'];
            $Class = 'form-horizontal' . (isset($Attributes['class']) ? $Attributes['class'] : '');
            
            // The opening tag with an optional enctype attribute.
            $OpeningTag = "<div class='formWrapper col-lg-$WrapperWidth'><form id='$ID' class='$Class' method='$Method' action='$Action'";
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
            // Close the ul and form tags.
            return '</form></div>';
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
            $Label = "<label class='control-label col-lg-4' for='$ID'>" . $Element->getLabel() . "</label>";
            
            // Render each element differently depending on its type attribute.
            if($Type == 'submit')
            {
            	//$Label = "<label class='control-label col-lg-2' for='$ID'>" . $Element->getLabel() . "</label>";
                $Input = "<input id='$ID' class='form-control btn btn-primary' name='$Name' type='$Type' value='$Value' $Required/>";
            }
            else if($Type == 'Zend\Form\Element\Csrf' || $Type == 'hidden')
            {
            	// If the element is a csrf, return immediately - this is to simplify the code.
                $Input = "<div class='form-group hidden'><input id='$ID' name='$Name' type='$Type' value='$Value' $Required/></div>";
                return $Input;
            }
            else if($Type == 'Zend\Form\Element\Select' || $Type == 'select')
            {
            	// The label is there so that no CSS is needed.
         	   $Label = "<label class='control-label col-lg-4' for='$ID'>" . $Element->getLabel() . "</label>";
				
				// Assembled the whole select input.
				$Input = "<select id='$ID' class='form-control' name='$Name'>";
                foreach($Element->getOptions()['value_options'] as $Type => $Name)
                {
                   $Input .= "<option value='$Type'>$Name</option>";
                }
				$Input .= '</select>';
            }
			else if($Type == "textarea")
			{
				$Input = "<textarea id='$ID' class='$Class' name='$Name' type='$Type' placeholder='$Placeholder' $Required></textarea>";
			}
			else if($Type == 'checkbox')
			{
				$Input = "<input id='$ID' class='$Class' name='$Name' type='$Type' $Required></input>";
			}
			else if($Type == 'number')
			{
            	// The label is there so that no CSS is needed.
            	$Label = "<label class='control-label col-lg-4' for='$ID'>" . $Element->getLabel() . "</label>";
				$Input = "<input id='$ID' class='$Class' name='$Name' type='$Type' value='$Value' $Required/>";	
			}
			else
			{
				// This is the default and the most used case.
				$Input = "<input id='$ID' class='$Class' name='$Name' type='$Type' placeholder='$Placeholder' value='$Value' $Required/>";	
			}
			
            // Create the class variables.
            $Errors = '';
            
            // Check if there are errors.
            foreach($Element->getMessages() as $Message)
            {
                $Errors .= "<div class='col-lg-4'></div><label for='$ID' class='error col-lg-8'>$Message</label>";
            }
            
            // Assemble and return the final markup.
			$Markup = "<div class='form-group'>" . $Label . "<div class='col-lg-8'>" . $Input . '</div>' . $Errors . '</div>';
            return $Markup;
        }
    }
?>