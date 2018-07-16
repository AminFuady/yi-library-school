<?php

class BookController extends MyController
{
	public function actionReport() {
		$model = new Book('filterBetweenDate');
		$model->unsetAttributes();
		if(isset($_GET['Book'])){
			$model->attributes = $_GET['Book'];
		}
		
		$this->render('report', array(
			'model' => $model,
		));
	}
	
	public function actionImport() {
		$model = new ImportBookForm();
		
		if(isset($_FILES['ImportBookForm'])) {
			$model->attributes = $_FILES['ImportBookForm'];
			$file = ($_FILES['ImportBookForm']['error']['file'] === 0) ? true : false;
			if (!empty($_FILES['ImportBookForm']['name']['file']) && $file){
				$model->file = CUploadedFile::getInstance($model,'file');
				if($model->validate() && ($model->file->name==$model->fileName)){
					if($model->save()):
						Yii::app()->user->setFlash('success', "Data Saved... Success (".$model->success."), Error (".$model->error.", ".json_encode($model->errors).")");
						$this->redirect(array('import'));
					endif;
				}else{
					Yii::app()->user->setFlash('error', "Nama file harus '".$model->fileName."'");
				}
			}
		}
		
		$this->render('import', array(
			'model' => $model,
		));
	}
	
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
		$model=new Book;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Book'])) {
			$model->attributes=$_POST['Book'];
			
			$photo = ($_FILES['Book']['error']['photo'] === 0) ? true : false;
			if (!empty($_FILES['Book']['name']['photo']) && $photo){
				$model->photo   = CUploadedFile::getInstance($model,'photo');
			}
			
			if($model->validate()) {
				if($photo) {
					$uploadedPhoto = $model->photoPath.$model->photoName();
					$model->photo->saveAs($uploadedPhoto);
					
					$model->photo = $model->photoName();
					if ($model->save()) {
						Yii::app()->user->setFlash('success', "Data Successfully Created..");
						$this->redirect(array('view','id'=>$model->id));
					}
				}
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

		if (isset($_POST['Book'])) {
			$model->attributes=$_POST['Book'];
			$updatePhoto = false;
			
			$photo = ($_FILES['Book']['error']['photo'] === 0) ? true : false;
			if (!empty($_FILES['Book']['name']['photo']) && $photo){
				$oldPhoto       = $model->photo;
				$model->photo   = CUploadedFile::getInstance($model,'photo');
				$updatePhoto = true;
			}
			
			if($model->validate()) {
				if($updatePhoto) {
					$uploadedPhoto = $model->photoPath.$oldPhoto;
					$model->photo->saveAs($uploadedPhoto);
					$model->photo = $oldPhoto;
				}
				if ($model->save()) {
					Yii::app()->user->setFlash('success', "Data Successfully Updated..");
					$this->redirect(array('view','id'=>$model->id));
				}
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
			$model = $this->loadModel($id);
			if(isset($model->photo))
				@unlink($model->photoPath.$model->photo);
			$model->delete();
			
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
		$model=new Book('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Book'])) {
			$model->attributes=$_GET['Book'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Book the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Book::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Book $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='book-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAjaxBookDetail() {
		if(Yii::app()->request->isAjaxRequest){
			$id = $_GET['id'];
			$model = Book::model()->findByCode($id);
			if(!$model) return;
			echo json_encode($model->attributes);
		}
	}
}