<?php

class ReimbursementBookController extends MyController
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
	public function actionCreate($id=null)
	{
		$model=new ReimbursementBook;
        if($id!=null):
            $loaning = LoaningBook::model()->findByPk($id);
            if($loaning):
                $model->loaning_book_id = ($loaning->status==LoaningBook::STATUS_LOAN) ? $id : null;
                if($model->loaning_book_id==null) $this->redirect(Yii::app()->user->returnUrl);
                $model->member_code = $loaning->member_code;
           else:
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            endif;
        endif;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ReimbursementBook'])) {
			$model->attributes=$_POST['ReimbursementBook'];
			if ($model->save()) {
				
				$loaning = LoaningBook::model()->findByPk($model->loaning_book_id);
				if($model->total_denda > 0) : $loaning->saveStatusDenda();
				else: $loaning->saveStatusBack(); endif;
				
				$this->redirect(Yii::app()->createUrl('loaningBook/view', array('id'=>$model->loaning_book_id)));
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

		if (isset($_POST['ReimbursementBook'])) {
			$model->attributes=$_POST['ReimbursementBook'];
			if ($model->save()) {
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
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ReimbursementBook');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ReimbursementBook('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ReimbursementBook'])) {
			$model->attributes=$_GET['ReimbursementBook'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ReimbursementBook the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ReimbursementBook::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ReimbursementBook $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='reimbursement-book-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}