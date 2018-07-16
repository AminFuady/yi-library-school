<?php

class AuthorBehavior extends CActiveRecordBehavior
{
	public $createAttribute = 'created_by';
	public $updateAttribute = 'updated_by';
	public $setUpdateOnCreate = false;

	/**
	 * @param CModelEvent $event
	 */
	public function beforeSave($event)
	{
		/** @var CActiveRecord $owner */
		$owner = $this->getOwner();

		if ($owner->getIsNewRecord() && ($this->createAttribute !== null) && $owner->hasAttribute($this->createAttribute)) {
			$owner->{$this->createAttribute} = $this->getAuthor();
		}
		if ((!$owner->getIsNewRecord() || $this->setUpdateOnCreate) && ($this->updateAttribute !== null) && $owner->hasAttribute($this->updateAttribute)) {
			$owner->{$this->updateAttribute} = $this->getAuthor();
		}
	}

	/**
	 * @return mixed
	 */
	protected function getAuthor()
	{
                if (Yii::app() instanceof CConsoleApplication) {
                    return 0; //0 adalah system. 
                }
                
		$user = Yii::app()->user;
		if ($user->isGuest) {
			return null;
		}
		return $user->id;
	}
}