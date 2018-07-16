<?php
class MyWebUser extends RWebUser{
	
	private $_model;
		
	public function isSuAdmin(){
		return $this->checkAccess('Admin');
	}
	
	public function isLogin(){
		//if(isset(Yii::app()->user->id)) return true;
		if($this->isSuAdmin()){ return true; }
		return false;
	}
	
	// Load user model.
	protected function loadUser($id=null)
	{
		if($this->_model===null){
			if ($id !== null) {
				$this->_model = User::model()->findByPk($id);
			}
		}
		return $this->_model;
	}
	
	function getDataByField($field){
		$user = $this->loadUser(Yii::app()->user->id);
		if($user){
			$data	= (!empty($user->staff)) ? $user->staff[0]->attributes:array();
			$data	+= $user->attributes;
			
			if(array_key_exists($field, $data)){
				return $data[$field];
			}
		}
		return false;
	}
	
	public function getUsername(){
		return $this->getDataByField("name");
	}
	
	public function getUserPhoto(){
		return $this->getDataByField("photo");
	}
	
	public function getUserPosition(){
		return $this->getDataByField("position");
	}
	
	public function getUserJoin(){
		$date = $this->getDataByField("created_at");
		return date("M, Y", strtotime($date));
	}
	
	public function getUserType() {
		return $this->getDataByField('type');
	}
}