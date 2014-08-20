<?php
    namespace Core\Form\View\Helper;
    
    use Zend\Form\FieldsetInterface;
    use Zend\Form\ElementInterface;
    use Zend\Form\FormInterface;
    use Zend\Form\View\Helper\AbstractHelper;
    
    /** Custom view helper used to render all forms in the whole site. */
    class BootstrapForm extends AbstractHelper
    {
        /** The view helper can be invoked from the view using $this->myForm($Form). */
        public function __invoke(FormInterface $Form = null)
        {
            if(!$Form)
            {
                return $this;
            }
            return $this->render($Form);
        }
		
        /** Renders the form. */
        public function render(FormInterface $Form)
        {
            // If the form has a 'prepare' method, call it now.
            if(method_exists($Form, 'prepare'))
            {
                $Form->prepare();
            }
            
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
            $ID = $Attributes['id'];
            $Action = $Attributes['action'];
            $Method = $Attributes['method'];
            $Class = 'form-horizontal' . (isset($Attributes['class']) ? $Attributes['class'] : '');
            
            // The opening tag with an optional enctype attribute.
            $OpeningTag = "<form id='$ID' class='$Class' method='$Method' action='$Action'";
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
                $Input = "<input id='$ID' class='form-control btn btn-primary' name='$Name' type='$Type' value='$Value' $Required/>";
            }
            else if($Type == 'Zend\Form\Element\Csrf' || $Type == 'hidden')
            {
            	// If the element is a csrf, return immediately - this is to simplify the code.
                $Input = "<div class='form-group hidden'><input id='$ID' name='$Name' type='$Type' value='$Value' $Required/></div>";
                return $Input;
            }
            else if($Type == 'select')
            {				
                $Input = "<select id='$ID' class='form-control' name='$Name'>";
                foreach($Element->getAttribute('Options') as $Option)
                {
                   $Input .= "<option value='$Option'>$Option</option>";
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