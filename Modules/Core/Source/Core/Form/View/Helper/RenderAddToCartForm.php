<?php
    namespace Core\Form\View\Helper;
    
    use Zend\Form\FieldsetInterface;
    use Zend\Form\ElementInterface;
    use Zend\Form\FormInterface;
    use Zend\Form\View\Helper\AbstractHelper;
    
    /** Custom view helper used to render all forms in the whole site. */
    class RenderAddToCartForm extends AbstractHelper
    {
        /** The view helper can be invoked from the view using $this->bootstrapForm($Form). */
        public function __invoke(FormInterface $Form = null)
        {
            return $this->render($Form);
        }
		
        /** Renders the form. */
        public function render(FormInterface $Form)
        {
            // Render each element and append its HTML to the variable.
            $FormContent = '';
            foreach($Form->getElements() as $Element)
            {
                $FormContent .= $this->renderElement($Element);
            }
            
            // Open the form tag, append the form content and close the form tag.
            return $this->openTag($Form) . $FormContent . $this->closeTag();
        }
		
        /** Generates the opening tag for the form. */
        public function openTag(FormInterface $Form)
        {
            // Variables to make the rendering easier.
            $Attributes = $Form->getAttributes();
            $ID = "id='" . $Attributes['id'] . "'";
            $Action = "action='" . $Attributes['action'] . "'";
            $Method = "method='" . $Attributes['method'] . "'";
            $Class = 'form-horizontal' . (isset($Attributes['class']) ? $Attributes['class'] : '');
			$Enctype = isset($Attributes['enctype']) ? "enctype='" . $Attributes['enctype'] . "'" : '';
            
            // Assembled and return the opening tag.
            $OpeningTag = "<form $ID class='$Class' $Method $Action $Enctype>";
            return $OpeningTag;
        }
        /** Returns closing tag for the form. */
        public function closeTag()
        {
            // Close the <form> and <div> tags.
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
            $Label = "<label class='control-label col-lg-4' for='$ID'>" . $Element->getLabel() . "</label>";
            
            // Render each element differently depending on its type attribute.
            if($Type == 'submit')
            {
            	$Label = "<div class='col-lg-2'></div>";
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
            	$Label = "<div class='col-lg-2'></div>";
				
				// Assembled the whole select input.
				$Input = "<select id='$ID' class='form-control' name='$Name'>";
                foreach($Element->getOptions()['value_options'] as $GroupLabel => $Group)
                {
                	// Assemble the <optgroup>s.
                	$Input .= "<optgroup label='$GroupLabel'>";
					foreach($Group as $Value => $Name)
					{
						$Input .= "<option value='$Value'>$Name</option>";
					}
                	$Input .= "</optgroup>";
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
				$Min = $Element->getAttribute('min');
            	$Label = "<label class='control-label col-lg-2' for='$ID'>" . $Element->getLabel() . "</label>";
				$Input = "<input id='$ID' class='$Class' name='$Name' type='$Type' value='$Value' min='$Min' $Required/>";	
	            // Assemble and return the final markup.
				$Markup = "<div class='form-group'>
							<div class='col-lg-2'></div>
							<div class='col-lg-4'>" . $Input . "</div> 
							<div class='col-lg-2'>" . $Label . "</div>
							<div id='totalPrice' class='col-lg-4'></div>
							</div>";
	            return $Markup;
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