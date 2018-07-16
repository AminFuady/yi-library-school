<?php

class DurationController extends MyController
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
		$model=new Duration;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Duration'])) {
			$model->attributes=$_POST['Duration'];
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

		if (isset($_POST['Duration'])) {
			$model->attributes=$_POST['Duration'];
			if ($model->save()) {
				Yii::app()->user->setFlash('success', "Data Successfully Saved..");
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
		$model=new Duration('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Duration'])) {
			$model->attributes=$_GET['Duration'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Duration the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Duration::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Duration $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='duration-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}