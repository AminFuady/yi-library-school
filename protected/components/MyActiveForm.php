<?php

class MyActiveForm extends TbActiveForm{
	
	public $clientOptions=array('validateOnSubmit'=>true);
	public $enableAjaxValidation=false;
	public $enableClientValidation=true;
			
	 /**
     * Generates a control group with a text field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated row.
     * @see MyTbHtml::activeTextFieldControlGroup
     */
    public function textFieldCustomGroup($model, $attribute, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-6');
		$htmlOptions+= array('divError'=>'col-xs-12 col-md-6');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return MyTbHtml::activeTextFieldControlGroup($model, $attribute, $htmlOptions);
    }
	
    public function passwordFieldCustomGroup($model, $attribute, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-4');
		$htmlOptions+= array('divError'=>'col-xs-12 col-md-4');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return MyTbHtml::activePasswordFieldControlGroup($model, $attribute, $htmlOptions);
    }
	
	public function dropDownListCustomGroup($model, $attribute, $data, $htmlOptions = array())
    {
		
		$htmlOptions+= array('errorOptions'=>array('class'=>'error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-6');
		$htmlOptions+= array('divError'=>'col-xs-12 col-md-6');		
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
		return MyTbHtml::activeDropDownListControlGroup($model, $attribute, $data, $htmlOptions);
    }
	
	public function textAreaCustomGroup($model, $attribute, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-6');
		$htmlOptions+= array('divError'=>'col-xs-12 col-md-6');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return MyTbHtml::activeTextAreaControlGroup($model, $attribute, $htmlOptions);
    }
	
	public function textFieldInlineGroup($model, $attribute, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'inline-error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-9');
		$htmlOptions+= array('divLabel'=>'col-xs-12 col-md-3');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return MyTbHtml::activeTextFieldInlineGroup($model, $attribute, $htmlOptions);
    }
	
	public function activeCustomGroup($input, $model, $attribute, $data=array(), $htmlOptions=array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'inline-error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-9');
		$htmlOptions+= array('divError'=>'col-xs-12 col-md-3');
		$htmlOptions+= array('labelOptions'=>array('class'=>'col-xs-12 col-md-3 control-label no-padding margin-top-10 required'));
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
		return MyTbHtml::customActiveInlineGroup($input, $model, $attribute, $data, $htmlOptions);
    }
	
	public function textAreaInlineGroup($model, $attribute, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'inline-error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-9');
		$htmlOptions+= array('divLabel'=>'col-xs-12 col-md-3');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return MyTbHtml::activeTextAreaInlineGroup($model, $attribute, $htmlOptions);
    }
	
	public function fileFieldInlineGroup($model, $attribute, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'inline-error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-9');
		$htmlOptions+= array('divLabel'=>'col-xs-12 col-md-3');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
        return MyTbHtml::activeFileFieldInlineGroup($model, $attribute, $htmlOptions);
    }
	
	public function dropDownListInlineGroup($model, $attribute, $data, $htmlOptions = array())
    {
		$htmlOptions+= array('errorOptions'=>array('class'=>'inline-error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-9');
		$htmlOptions+= array('divLabel'=>'col-xs-12 col-md-3');
        $htmlOptions = $this->processRowOptions($model, $attribute, $htmlOptions);
		return MyTbHtml::activeDropDownListInlineGroup($model, $attribute, $data, $htmlOptions);
    }
	
	/**
	 * Placeholder input pre load
	 * @param type $model
	 * @param type $attribute
	 * @param type $htmlOptions
	 * @return type
	 */
	public function inputOptions($model,$attribute,$htmlOptions=array()) {
		$last	= '';
		if(preg_match('/\[\d\][a-z,A-Z]*$/',$attribute)){
			preg_match("/\[(?P<index>\d+)\](?P<attr>[a-z,A-Z]+)/",$attribute, $found);
			$attribute	= $found['attr'];
			$index		= (int)$found['index']+1;
			$last		= " $index";
		}

		$placeholder	= $model->getAttributeLabel($attribute);
		$options		= array('class'=>'form-control','placeholder'=>$placeholder.$last);
		return array_merge($htmlOptions, $options);
	}
	
	public function inputOptionsGroup($model,$attribute,$htmlOptions=array()) {
		$htmlOptions	= $this->inputOptions($model,$attribute,$htmlOptions);
		$errorOptions	= array('errorOptions'=>array('class'=>'error'));
		$htmlOptions	= array_merge($htmlOptions, $errorOptions);
		return $this->processRowOptions($model, $attribute, $htmlOptions);
	}
	
	public function dropDownOptions($model,$attribute,$htmlOptions=array()) {
		$placeholder= '- Select One '.$model->getAttributeLabel($attribute).' -';
		$options	= array('class'=>'form-control select2 col-xs-12','empty'=>$placeholder,"style"=>"width: 100%;");
		return array_merge($htmlOptions, $options);
	}
	
	public function dropDownOptionsGroup($model,$attribute,$htmlOptions=array()) {
		$htmlOptions	= $this->dropDownOptions($model,$attribute,$htmlOptions);
		$errorOptions	= array('errorOptions'=>array('class'=>'error'));
		$htmlOptions	= array_merge($htmlOptions, $errorOptions);
		return $this->processRowOptions($model, $attribute, $htmlOptions);
	}
	
	/**
	 * Renders a text field has placeholder for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextField}.
	 * Please check {@link CHtml::activeTextField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function textFieldPlaceholder($model,$attribute,$htmlOptions=array())
	{
		$htmlOptions	= $this->inputOptions($model, $attribute, $htmlOptions);
		return CHtml::activeTextField($model,$attribute,$htmlOptions);
	}
	public function textFieldPlaceholderGroup($model,$attribute,$htmlOptions=array())
	{
		$htmlOptions	= $this->inputOptionsGroup($model, $attribute, $htmlOptions);
		return MyTbHtml::activeTextFieldPlaceholderGroup($model,$attribute,$htmlOptions);
	}
	
	/**
	 * Renders a dropdown list has placeholder for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeDropDownList}.
	 * Please check {@link CHtml::activeDropDownList} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated drop down list
	 */
	public function dropDownListPlaceholder($model,$attribute,$data,$htmlOptions=array())
	{
		$htmlOptions	= $this->dropDownOptions($model, $attribute, $htmlOptions);
		return CHtml::activeDropDownList($model,$attribute,$data,$htmlOptions);
	}
	public function dropDownListPlaceholderGroup($model,$attribute,$data,$htmlOptions=array())
	{
		$htmlOptions	= $this->dropDownOptionsGroup($model, $attribute, $htmlOptions);
		return MyTbHtml::activeDropDownListPlaceholderGroup($model,$attribute,$data,$htmlOptions);
	}
	
	/**
	 * Renders a text area has placeholder for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextArea}.
	 * Please check {@link CHtml::activeTextArea} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text area
	 */
	public function textAreaPlaceholder($model,$attribute,$htmlOptions=array())
	{
		$htmlOptions	= $this->inputOptions($model, $attribute, $htmlOptions);
		return CHtml::activeTextArea($model,$attribute,$htmlOptions);
	}
	public function textAreaPlaceholderGroup($model,$attribute,$htmlOptions=array())
	{
		$htmlOptions	= $this->inputOptionsGroup($model, $attribute, $htmlOptions);
		return MyTbHtml::activeTextAreaPlaceholderGroup($model,$attribute,$htmlOptions);
	}
	
	/**
	 * Renders a password field has placeholder for a model attribute.
	 * This method is a wrapper of {@link CHtml::activePasswordField}.
	 * Please check {@link CHtml::activePasswordField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function passwordFieldPlaceholder($model,$attribute,$htmlOptions=array())
	{
		$htmlOptions	= $this->inputOptions($model, $attribute, $htmlOptions);
		return CHtml::activePasswordField($model,$attribute,$htmlOptions);
	}
	public function passwordFieldPlaceholderGroup($model,$attribute,$htmlOptions=array())
	{
		$htmlOptions	= $this->inputOptionsGroup($model, $attribute, $htmlOptions);
		return MyTbHtml::activePasswordFieldPlaceholderGroup($model,$attribute,$htmlOptions);
	}
}
