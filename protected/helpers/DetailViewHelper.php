<?php

class DetailViewHelper
{
	/**
	 * @param CActiveRecord $model
	 * @param string $attribute
	 * @return array
	 */
	public static function author($model, $attribute)
	{
		$name = null;
		if ($model->$attribute != null) {
			$user = User::model()->findByPk($model->$attribute);
			if ($user !== null) {
				$name = $user->name;
			}
		}

		return array(
			'name' => $attribute,
			'value' => $name,
		);
	}

	/**
	 * @param CActiveRecord $model
	 * @param string $attribute
	 * @return array
	 */
	public static function timestamp($model, $attribute)
	{
		$date = null;
		if ($model->$attribute != null) {
			$date = date('Y-m-d H:i:s', $model->$attribute);
		}

		return array(
			'name' => $attribute,
			'value' => $date,
		);
	}
	
	public static function date($model, $attribute)
	{
		$date = null;
		if($model->$attribute != null) {
			$date = date('d M Y', strtotime($model->$attribute));
		}
		
		return array(
			'name'=>$attribute,
			'value'=>$date,
		);
	}
	
	public static function shortDate($model, $attribute)
	{
		$date = null;
		if ($model->$attribute != null) {
			$date = date('d M Y H:i:s', strtotime($model->$attribute));
		}

		return array(
			'name' => $attribute,
			'value' => $date,
		);
	}
	
	public static function longDate($model, $attribute)
	{
		$date = null;
		if ($model->$attribute != null) {
			$date = date('d F Y H:i:s', strtotime($model->$attribute));
		}

		return array(
			'name' => $attribute,
			'value' => $date,
		);
	}
	
	public static function other($model, $attribute, $attributeOther=null)
	{
		$otherLabel = Yii::app()->params['otherField'];
		
		if($attributeOther==null){
			$attributeOther = $attribute . '_' . $otherLabel;
		}
		$name = null;
		
		if($model->$attribute != null) {
			if($model->$attribute == $otherLabel) {
				$name = $model->$attributeOther . ' [' . $model->$attribute . ']';
			}else{
				$name = $model->$attribute;
			}
		}
		
		return array(
			'name'=>$attribute,
			'value'=>$name,
		);
	}
}