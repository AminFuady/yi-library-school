<?php

class LoaningBookController extends MyController
{
	public function actionReport() {
		$model = new LoaningBook('search');
		$model->unsetAttributes();
		if(isset($_GET['LoaningBook'])){
			$model->attributes = $_GET['LoaningBook'];
		}
		
		$this->render('report', array(
			'model' => $model,
		));
	}
	
	public function actionReportDenda() {
		$model = new LoaningBook('search');
		$model->unsetAttributes();
		if(isset($_GET['LoaningBook'])){
			$model->attributes = $_GET['LoaningBook'];
		}
		
		$this->render('report-denda', array(
			'model' => $model,
		));
	}
	
	public function actionReportNotYetBack() {
		throw new CHttpException(400,'Belum dibuat fungsinya...');
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
        $details=new LoaningBookDetail('search');
		$details->unsetAttributes();  // clear any default values
		if (isset($_GET['LoaningBookDetail'])) {
			$details->attributes=$_GET['LoaningBookDetail'];
		}
        $details->loaning_book_id = $id;
        
        $this->render('view',array(
			'model'=>$model,
            'details'=>$details,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new LoaningBook;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['LoaningBook'])) {
			$model->attributes=$_POST['LoaningBook'];
          
			if (isset($_POST['LoaningBookDetail'])){
				$model->loaningBookDetails = $_POST['LoaningBookDetail'];
            }
            
			if ($model->saveWithRelated(array('loaningBookDetails'))){
				if($model->loaningBookDetails):
					foreach($model->loaningBookDetails as $detail){
						$detail->saveMinQuantityBook();
					}
				endif;
				
				Yii::app()->user->setFlash('success', "Data Successfully Saved..");
				$this->redirect(array('view','id'=>$model->id));
			}else{
                $model->addError('loaningBookDetails', 'errors. ');
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

		if (isset($_POST['LoaningBook'])) {
			$model->attributes=$_POST['LoaningBook'];
            
            if (isset($_POST['LoaningBookDetail'])){
				$model->loaningBookDetails = $_POST['LoaningBookDetail'];
            }
            
			if ($model->saveWithRelated(array('loaningBookDetails'))){
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
        return;
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
		$model=new LoaningBook('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['LoaningBook'])) {
			$model->attributes=$_GET['LoaningBook'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionDenda()
	{
		$model=new LoaningBook('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['LoaningBook'])) {
			$model->attributes=$_GET['LoaningBook'];
		}
		$model->filterReimbursementDate = true;

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LoaningBook the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LoaningBook::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LoaningBook $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='loaning-book-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionAutocomplete() {
		$arr = array();
		
		if(isset($_GET['term'])){
			$term = $_GET['term'];
			$data = LoaningBook::model()->getMemberIdentityByName($term);
			if($data):
				$term = $data->member_code;
			endif;
		
			$crit = new CDbCriteria;
			$crit->addSearchCondition('member_code', $term, true, 'AND', 'LIKE' );
			$crit->order = "member_code ASC";
			$models = LoaningBook::model()->findAll($crit);
			foreach($models as $model)
			{
                if($model->status==LoaningBook::STATUS_LOAN):
					$identity = new LoaningBook();
					$member = $identity->getMemberIdentity($model->initial_member, $model->member_code);
                    $arr[] = array(
                          'label'=>$model->member_code . ' - ' . $member->name,
                          'value'=>$model->member_code,
                          'id'=>$model->id,
                    );
                endif;
			}
		}
		echo CJSON::encode($arr);
		Yii::app()->end();
	}
	
	/*
	 * Fungsi untuk menampilkan form Detail Daily
	 */
	public function actionAjaxFormLoanDetail($index){
		
		$model = new LoaningBookDetail;

		$this->renderPartial('detail/_form-detail',
				array(
					'model'		=> $model,
					'index'		=>$index
				), false, true
			);
	}
	
	public function actionAjaxListMember() {
		$array = array();
		$id = $_GET['id'];
		if($id == ''){ echo json_encode ($array);return;}
		
		$models = LoaningBook::model()->listMember($id);
		$duration = Duration::model()->getValueById($id);
		$arrayDuration = array('duration'=>$duration);
		
		if($models) {
			$no = 0;
			foreach($models as $model) {
				$array['select'][$no]['id']	= $model->member_code;
				$array['select'][$no]['text'] = $model->getCodeWithName();
				$no++;
			}
			$array = CMap::mergeArray($array, $arrayDuration);
			echo json_encode($array);
			return;
		}
		
		echo json_decode($array);
	}
	
	public function actionAjaxGetReimbursementDate() {
		$date = $_GET['date'];
		$duration = $_GET['duration'];
		echo LoaningBook::model()->getReimbursementDate($date, $duration);
	}
    
    public function actionAjaxGetLoaningBookWithDendaByMember() {
        $memberCode = $_GET['memberCode'];
        $model = LoaningBook::model()->findByMemberCode($memberCode);
		$denda = LoaningBook::model()->getDendaWithTotal($memberCode);
		if(!$model || !$denda){ echo "";return;}
        $array = array(
			'loaning_book_id' => $model->id,
            'loaning_code' => $model->loaning_code,
			'loaning_date' => Lib::date($model->loaning_date),
			'reimbursement_date' => Lib::date($model->reimbursement_date),
			'status' => $model->statusLabel(),
			'qtyBook' => $model->getLoanQuantity(),
			'bookDetails' => $model->getBooksHtml(),
			'denda' => $denda['denda'],
			'totalDenda' => $denda['total'],
        );
		echo json_encode($array);
    }

}