<?php

class MyTbHtml extends TbHtml{
	/**
     * Generates an active form row.
     * @param string $type the input type.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated control group.
     */
    public static function activeControlGroup($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $color = TbArray::popValue('color', $htmlOptions);
        $groupOptions = TbArray::popValue('groupOptions', $htmlOptions, array());
        $controlOptions = TbArray::popValue('controlOptions', $htmlOptions, array());
        $label = TbArray::popValue('label', $htmlOptions);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
		$divInput = TbArray::popValue('divInput', $htmlOptions);
		$divError = TbArray::popValue('divError', $htmlOptions);

        if (in_array($type, array(self::INPUT_TYPE_CHECKBOX, self::INPUT_TYPE_RADIOBUTTON))) {
            $htmlOptions['label'] = isset($label) ? $label : $model->getAttributeLabel($attribute);
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }
        if (isset($label) && $label !== false) {
            $labelOptions['label'] = $label;
        }

        $help = TbArray::popValue('help', $htmlOptions, '');
        $helpOptions = TbArray::popValue('helpOptions', $htmlOptions, array());
        if (!empty($help)) {
            $help = self::inputHelp($help, $helpOptions);
        }
        $error = TbArray::popValue('error', $htmlOptions, '');
		if(self::INPUT_TYPE_DROPDOWNLIST){
			$htmlOptions	+= array('class'=>'form-control');
		}  else {
			$htmlOptions	+= array('class'=>'form-control','maxlength'=>100);
		}
			
        $input = isset($htmlOptions['input'])
            ? $htmlOptions['input']
            : self::createActiveInput($type, $model, $attribute, $htmlOptions, $data);
		
        self::addCssClass('row', $groupOptions);
        self::addCssClass('control-group', $groupOptions);
        self::addCssClass('form-group', $groupOptions);
		
        if (!empty($color)) {
            self::addCssClass($color, $groupOptions);
        }
        self::addCssClass('control-label', $labelOptions);
        $output = self::openTag('div', $groupOptions);
		$output	.= '<div class="'.$divInput.'">';
        if ($label !== false) {
            $output .= parent::activeLabelEx($model, $attribute, $labelOptions);
        }
		
		$output	.= $input . '</div>';
		$output	.= '<div class="'.$divError.'">';
		$output	.= $error . $help;
        $output .= '</div></div>';
		
        return $output;
    }
	
    public static function activeInlineGroup($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $color = TbArray::popValue('color', $htmlOptions);
        $groupOptions = TbArray::popValue('groupOptions', $htmlOptions, array());
        $controlOptions = TbArray::popValue('controlOptions', $htmlOptions, array());
        $label = TbArray::popValue('label', $htmlOptions);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
		$divInput = TbArray::popValue('divInput', $htmlOptions);
		$divLabel = TbArray::popValue('divLabel', $htmlOptions);
		
        if (in_array($type, array(self::INPUT_TYPE_CHECKBOX, self::INPUT_TYPE_RADIOBUTTON))) {
            $htmlOptions['label'] = isset($label) ? $label : $model->getAttributeLabel($attribute);
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }
        if (isset($label) && $label !== false) {
            $labelOptions['label'] = $label;
        }

        $help = TbArray::popValue('help', $htmlOptions, '');
        $helpOptions = TbArray::popValue('helpOptions', $htmlOptions, array());
        if (!empty($help)) {
            $help = self::inputHelp($help, $helpOptions);
        }
        $error = TbArray::popValue('error', $htmlOptions, '');
		if(self::INPUT_TYPE_DROPDOWNLIST){
			$htmlOptions	+= array('class'=>'form-control');
		}  else {
			$htmlOptions	+= array('class'=>'form-control','maxlength'=>100);
		}
			
        $input = isset($htmlOptions['input'])
            ? $htmlOptions['input']
            : self::createActiveInput($type, $model, $attribute, $htmlOptions, $data);
		
        self::addCssClass('form-group col-md-12 no-padding', $groupOptions);
		
        if (!empty($color)) {
            self::addCssClass($color, $groupOptions);
        }
		
        self::addCssClass($divLabel, $labelOptions);
        self::addCssClass('control-label no-padding margin-top-10', $labelOptions);
        $output = self::openTag('div', $groupOptions);
        if ($label !== false) {
            $output .= parent::activeLabelEx($model, $attribute, $labelOptions);
        }
		
		$output	.= self::tag('div',array('class'=>$divInput),$input . $error . $help);
        $output .= self::closeTag('div');
		
        return $output;
    }
	
	/**
     * Generates a control group with a text field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeTextFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_TEXT, $model, $attribute, $htmlOptions);
    }
	
	public static function activePasswordFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_PASSWORD, $model, $attribute, $htmlOptions);
    }
	
	public static function activeDropDownListControlGroup($model, $attribute, $data = array(), $htmlOptions = array())
    {
		return self::activeControlGroup(self::INPUT_TYPE_DROPDOWNLIST, $model, $attribute, $htmlOptions, $data);
    }
	
	public static function activeTextAreaControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_TEXTAREA, $model, $attribute, $htmlOptions);
    }
	
	public static function activeTextFieldInlineGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeInlineGroup(self::INPUT_TYPE_TEXT, $model, $attribute, $htmlOptions);
    }
	
	public static function activeTextAreaInlineGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeInlineGroup(self::INPUT_TYPE_TEXTAREA, $model, $attribute, $htmlOptions);
    }
	
	public static function customActiveInlineGroup($input, $model, $attribute, $data=array(), $htmlOptions = array())
    {
        $htmlOptions['input'] = $input;
        return self::activeInlineGroup(self::INPUT_TYPE_CUSTOM, $model, $attribute, $htmlOptions);
    }
	
	public static function activeFileFieldInlineGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeInlineGroup(self::INPUT_TYPE_FILE, $model, $attribute, $htmlOptions);
    }
	
	public static function activeDropDownListInlineGroup($model, $attribute, $data = array(), $htmlOptions = array())
    {
		return self::activeInlineGroup(self::INPUT_TYPE_DROPDOWNLIST, $model, $attribute, $htmlOptions, $data);
    }
	
	public static function activePlaceholderGroup($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $color			= TbArray::popValue('color', $htmlOptions);
        $groupOptions	= TbArray::popValue('groupOptions', $htmlOptions, array());
        $controlOptions = TbArray::popValue('controlOptions', $htmlOptions, array());
		$divInput		= TbArray::popValue('divInput', $htmlOptions);
		$iconOptions	= TbArray::popValue('icon', $htmlOptions);
		
        $help = TbArray::popValue('help', $htmlOptions, '');
        $helpOptions = TbArray::popValue('helpOptions', $htmlOptions);
        if (!empty($help)) {
            $help = self::inputHelp($help, $helpOptions);
        }
        $error	= TbArray::popValue('error', $htmlOptions, '');
        $icon	= TbArray::popValue('icon', $htmlOptions, '');
		
        $input = isset($htmlOptions['input'])
            ? $htmlOptions['input']
            : self::createActiveInput($type, $model, $attribute, $htmlOptions, $data);
		
        self::addCssClass('form-group has-feedback', $groupOptions);
		
        if (!empty($color)) {
            self::addCssClass($color, $groupOptions);
        }
		
		if (!empty($iconOptions)) {
			$iconClass	= (strpos($iconOptions, '-')==true)?"fa $iconOptions":"glyphicon glyphicon-$iconOptions";
            $icon = self::openTag('span', array('class'=>"$iconClass form-control-feedback"));
            $icon .= self::closeTag('span');
        }
		
        $output = self::openTag('div', $groupOptions);
		$output	.= $input . $icon . $error;
        $output .= self::closeTag('div');
		
        return $output;
    }
	
	/**
     * Generates a Placeholder group with a text field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeTextFieldPlaceholderGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activePlaceholderGroup(self::INPUT_TYPE_TEXT, $model, $attribute, $htmlOptions);
    }
	public static function activeDropDownListPlaceholderGroup($model,$attribute,$data = array(),$htmlOptions = array())
    {
        return self::activePlaceholderGroup(self::INPUT_TYPE_DROPDOWNLIST, $model, $attribute, $htmlOptions, $data);
    }
	public static function activeTextAreaPlaceholderGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activePlaceholderGroup(self::INPUT_TYPE_TEXTAREA, $model, $attribute, $htmlOptions);
    }
	public static function activePasswordFieldPlaceholderGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activePlaceholderGroup(self::INPUT_TYPE_PASSWORD, $model, $attribute, $htmlOptions);
    }
}
