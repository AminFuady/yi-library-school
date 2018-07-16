<?php

class UserController extends MyController
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
		$model=new User;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			
			// generate password
			$password = User::generatePassword();
			if(!empty($_POST['User']['password'])){
				$password = $model->password;
			}
//			var_dump($password);die;
			$model->password = User::hashPassword($password);
			
			if ($model->save()) {
				/* @var $authorizer RAuthorizer */

				$authorizer = Yii::app()->getModule('rights')->getAuthorizer();
				$role = User::getTypeLabel('Super Admin');

				// create role if not exist
				$roles = array_keys($authorizer->getRoles());
				if (!in_array($role, $roles)) {
					$authorizer->createAuthItem($role, 2, $role);
				}

				// assign role based on user type
				$authorizer->getAuthManager()->assign($role, $model->id);

				// send email
//				User::sendPasswordToUserEmail($model, $password);
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
        $oldType = $model->type;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
				
			if ($model->save()) {
				if($oldType != $model->type){
					/* @var $authorizer RAuthorizer */
					$authorizer = Yii::app()->getModule('rights')->getAuthorizer();
					$oldRole	= User::getTypeLabel($oldType);
					$role		= User::getTypeLabel($model->type);
					$authorizer->getAuthManager()->revoke($oldRole, $model->id);
					$authorizer->getAuthManager()->assign($role, $model->id);
				}
					
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
			$model = $this->loadModel($id);
			$detail = UserDetail::model()->findByUserId($model->id);
			if($detail) {
				$detail->delete();
			}
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(array('index'));
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
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['User'])) {
			$model->attributes=$_GET['User'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionVendorUsers(){
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['User'])) {
			$model->attributes=$_GET['User'];
		}
		
		$model->status	= User::STATUS_ACTIVATION;
		$model->type	= User::TYPE_VENDOR;
		
		$this->render('vendor-users',array(
			'model'=>$model,
		));
	}
	
	public function actionVendorActivation($id) {
		$model = User::model()->findByPk($id);
		if($model->isNeedActivated()){
			$model->saveStatusActive();

			$data = array('model'=>$model);
			$emailAddress = $model->email;
			//kirim email ke dealer yang bersangkutan
			$this->sendEmail($emailAddress, '[Fuji Xerox Pipeline System] Account has been Enabled', '', 'activation-notification', $data);
			
			Yii::app()->user->setFlash('success', 'Activation Success..');
			$this->redirect(array('/user/vendorUsers'));
		}else{
			Yii::app()->user->setFlash('success', 'Activation has been enabled..');
			$this->redirect(array('/user/vendorUsers'));
		}
	}
	
	public function actionCreateDealer() {
		$type = 'dealer';
		
		//Kemudian kita buatkan model form untuk register
		$model	= new RegisterForm();
			
			
		//Kemudian kita lanjut dengan set scenario. 
		//Scenario berdasarkan tipenya (Dealer, atau Vendor)
		$model->setScenario($type);

		//Kalau ini diakses via ajax, maka kita balikkan hasil validasi saja
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//Jika ada yang submit post
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes	= $_POST['RegisterForm'];

			// Menjalankan validasi... $model->register() itu 
			// sebetulnya menjalankan validasi sekaligus create user
			if($model->register()) {
				Yii::app()->user->setFlash('success', 'Create New Dealer Successfully saved...');
				$model->getModel()->status = User::STATUS_ENABLE;
				$model->getModel()->saveAttributes(array('status'));
				$this->redirect(array('/dashboard'));
			}
		}

		$this->render('create-dealer', array('model'=>$model));
	}

}
