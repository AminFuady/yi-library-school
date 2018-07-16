<?php

class SiteController extends MyController
{
	public $layout = '//layouts/main';
	public $menuNavigation = array();
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $pageTitle;
	
	public function init() {
		parent::init();
		$this->pageTitle = Yii::app()->name;
	}
	
	public function filters() {
		return array();
	}
	
	/**
	 * Displays the login page
	 */
	public function actionIndex(){
		if(Yii::app()->user->isLogin()){
			$this->layout = 'main';
			$this->redirect(array('dashboard/'));
		}else{
			$this->layout = 'login';
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if ($model->validate() && $model->login()) {
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			
			// display the login form
			$this->render('login',array('model'=>$model));
		}
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionPay() {
		if($this->isExpired==false) $this->redirect(Yii::app()->homeUrl);
		$this->layout = 'null';
		$this->render('pay');
	}
}