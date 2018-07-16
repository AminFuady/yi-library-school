<?php
class DashboardController extends MyController
{
	public function actionIndex() {
		$this->render('index');
	}
	
	public function actionEditProfile() {
		throw new CHttpException(400,'Belum dibuat fungsinya...');
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Contact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
