<?php

Yii::import('zii.behaviors.CTimestampBehavior');

class TimestampBehavior extends CTimestampBehavior
{
	/**
	 * Responds to {@link CModel::onBeforeSave} event.
	 * Sets the values of the creation or modified attributes as configured
	 *
	 * @param CModelEvent $event event parameter
	 */
	public function beforeSave($event) {
		/** @var CActiveRecord $owner */
		$owner = $this->getOwner();

		if ($owner->getIsNewRecord() && ($this->createAttribute !== null) && $owner->hasAttribute($this->createAttribute)) {
			$this->getOwner()->{$this->createAttribute} = $this->getTimestampByAttribute($this->createAttribute);
		}
		if ((!$owner->getIsNewRecord() || $this->setUpdateOnCreate) && ($this->updateAttribute !== null) && $owner->hasAttribute($this->updateAttribute)) {
			$this->getOwner()->{$this->updateAttribute} = $this->getTimestampByAttribute($this->updateAttribute);
		}
	}
}