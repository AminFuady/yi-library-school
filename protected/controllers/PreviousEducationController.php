<?php

class PreviousEducationController extends MyController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PreviousEducation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['PreviousEducation'])) {
			$model->attributes=$_POST['PreviousEducation'];
			if ($model->save()) {
				Yii::app()->user->setFlash('success', "Data Successfully Saved..");
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['PreviousEducation'])) {
			$model->attributes=$_POST['PreviousEducation'];
			if ($model->save()) {
				Yii::app()->user->setFlash('success', "Data Successfully Updated..");
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		try{
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax']))
				Yii::app()->user->setFlash('success','Data has been deleted.');
			else
				echo "<div class='alert alert-success'>"
						. "<button type='button' class='close' data-dismiss='alert'>&times;</button>"
							. "Data has been deleted."
					. "</div>";
		}catch(CDbException $e){
			if(!isset($_GET['ajax']))
				Yii::app()->user->setFlash('error','Failed to delete the data.');
			else
				echo "<div class='alert alert-error'>"
						. "<button type='button' class='close' data-dismiss='alert'>&times;</button>"
							. "Failed to delete the data."
					. "</div>";
		}


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new PreviousEducation('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['PreviousEducation'])) {
			$model->attributes=$_GET['PreviousEducation'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	public function actionActived()
	{
		$model=new PreviousEducation('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['PreviousEducation'])) {
			$model->attributes=$_GET['PreviousEducation'];
		}
		$model->status = PreviousEducation::STATUS_ACTIVE;

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PreviousEducation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PreviousEducation::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PreviousEducation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='previous-education-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}