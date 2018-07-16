<?php

class MyActiveRecord extends CActiveRecord
{
	const STATUS_ACTIVE = 10;
	const STATUS_INACTIVE = 0;
	
	/**
	 * @return array
	 */
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'TimestampBehavior' => array(
				'class' => 'application.behaviors.TimestampBehavior',
				'createAttribute' => 'created_at',
				'updateAttribute' => 'updated_at',
			),
			'AuthorBehavior' => array(
				'class' => 'application.behaviors.AuthorBehavior',
			),
			'ESaveRelatedBehavior' => array(
				'class' => 'application.components.ESaveRelatedBehavior'),
		));
	}
    
	public function getCodeWithName() {
		return $this->member_code .' - '. $this->name;
	}
	
	public static function genderLabels() {
		return array(
			'Laki-laki' =>'Laki-laki',
			'Perempuan' =>'Perempuan'
		);
	}
	
	public static function statusLabels() {
		return array(
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_INACTIVE => 'Inactive',
		);
	}
	
	public function statusLabel() {
		$labels = self::statusLabels();
		return $labels[$this->status];
	}
	
	public function getStatusWithStyle($status=null) {
		if($status==null) $status = $this->status;
		$labels = self::statusLabels();
		switch($status) {
			case self::STATUS_ACTIVE: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::STATUS_INACTIVE: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-primary">Not Known ('.$status.')</label>';
		}
	}
	
	public function getCreatedBy() {
		if(isset($this->createdBy)) {
			return $this->createdBy->name;
		}
		return $this->created_by;
	}
	
	public function getUpdatedBy() {
		if(isset($this->updatedBy)) {
			return $this->updatedBy->name;
		}
		return $this->updated_by;
	}
	
	public function scopes() {
		return array(
			'actived'=>array(
				'condition' => 'status = '.self::STATUS_ACTIVE,
			),
		);
	}
	
	/**
	 * fungsi mengambil duration berdasarkan 2 tanggal
	 * @param type $start
	 * @param type $until
	 * @return type
	 */
	public static function getDuration($start, $until) {
		$startDate = strtotime($start);
		$untilDate = strtotime($until);

		$timeDiff = abs($untilDate - $startDate);

		$numberDays = $timeDiff/86400;  // 86400 seconds in one day

		// and you might want to convert to integer
		return intval($numberDays);
	}
}