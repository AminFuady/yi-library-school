<?php
class MyController extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	
	public $menuNavigation=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $headerMenu=array();
	public $expired = '2017-12-31';
	public $isExpired = false;
	public $expireLabel;
		
	public function init() {
		$this->expireLabel = "Sistem ini akan expire besok.. Silahkan hubungi ".Yii::app()->params['adminTelp']." untuk perpanjang.. (Mohon maaf perpanjangan masa aktif terkait dengan harga).";
		if($this->expired < date('Y-m-d')){
			$this->isExpired = true;
			if(Yii::app()->request->url != Yii::app()->createUrl('site/pay')):
				$url = Yii::app()->createAbsoluteUrl('site/pay');
				$this->redirectAfterSeconds($url);
				return;
			endif;
		}elseif($this->expired == date('Y-m-d')){
			$this->isExpired = true;
		}
		$this->menuNavigation = array(
			//dashboard
			array(
				'label' => '<i class="fa fa-dashboard"></i>&nbsp;&nbsp;Dashboard',
				'url' => array('/dashboard/index'),
			),
			array(
				'label' => '<i class="fa fa-bars"></i>&nbsp;&nbsp;Master Data <b class="caret"></b>',
				'url' => '#',
				//'visible'=>(Yii::app()->user->checkAccess(Rights::module()->userStaf) || Yii::app()->user->checkAccess(Rights::module()->userInvestor)),
				'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				'submenuOptions' => array('class' => 'dropdown-menu'),
				'items' => array(
					array(
						'label' => 'Master Buku',
						'url' => '#',
						'itemOptions' => array('class' => 'dropdown-submenu'),
						'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
						'submenuOptions' => array('class' => 'dropdown-menu'),
						'items'=>array(
							array('label'=>'Data Buku', 'url'=>array('book/index')),
							array('label'=>'Kategori Buku', 'url'=>array('categoryBook/index')),
							array('label'=>'Rak Buku', 'url'=>array('rackBook/index')),
						),
					),
					array(
						'label' => 'Pengaturan',
						'url' => '#',
						'itemOptions' => array('class' => 'dropdown-submenu'),
						'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
						'submenuOptions' => array('class' => 'dropdown-menu'),
						'items'=>array(
							array('label'=>'Informasi Sekolah', 'url'=>array('schoolInfo/index')),
							array('label'=>'Durasi Peminjaman dan Denda', 'url'=>array('duration/index')),
						),
					),
					array(
						'label' => 'Import Data',
						'url' => '#',
						'itemOptions' => array('class' => 'dropdown-submenu'),
						'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
						'submenuOptions' => array('class' => 'dropdown-menu'),
						'items'=>array(
							array('label'=>'Buku', 'url'=>array('book/import')),
							array('label'=>'Siswa', 'url'=>array('student/import')),
							array('label'=>'Guru', 'url'=>array('teacher/import')),
							array('label'=>'Karyawan / Staff', 'url'=>array('employee/import')),
						),
					),
					array(
						'label' => 'Data Umum',
						'url' => '#',
						'itemOptions' => array('class' => 'dropdown-submenu'),
						'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
						'submenuOptions' => array('class' => 'dropdown-menu'),
						'items'=>array(
							array('label'=>'Jurusan', 'url'=>array('departement/index')),
							array('label'=>'Kelas', 'url'=>array('grade/index')),
							array('label'=>'Posisi / Jabatan', 'url'=>array('position/index')),
							array('label'=>'Agama', 'url'=>array('religion/index')),
							array('label'=>'Penddikan Terakhir', 'url'=>array('previousEducation/index')),
						),
					),
				),
			),
			//member
			array(
				'label' => '<i class="fa fa-group"></i>&nbsp;&nbsp;Data Anggota <b class="caret"></b>',
				'url' => '#',
				//'visible'=>(Yii::app()->user->checkAccess(Rights::module()->userStaf) || Yii::app()->user->checkAccess(Rights::module()->userInvestor)),
				'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				'submenuOptions' => array('class' => 'dropdown-menu'),
				'items' => array(
					array(
						'label' => 'Siswa',
						'url' => array('student/index'),
					),
					array(
						'label' => 'Guru',
						'url' => array('teacher/index'),
					),
					array(
						'label' => 'Karyawan / Staff',
						'url' => array('employee/index'),
					),
				),
			),
			array(
				'label' => '<i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Transaksi <b class="caret"></b>',
				'url' => '#',
				//'visible'=>(Yii::app()->user->checkAccess(Rights::module()->userStaf) || Yii::app()->user->checkAccess(Rights::module()->userInvestor)),
				'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				'submenuOptions' => array('class' => 'dropdown-menu'),
				'items' => array(
					array(
						'label' => 'Form Peminjaman',
						'url' => array('loaningBook/create'),
					),
					array(
						'label' => 'Form Pengembalian',
						'url' => array('reimbursementBook/create'),
					),
					array(
						'label' => 'Data Pinjam',
						'url' => array('loaningBook/index'),
					),
					array(
						'label' => 'Katalog',
						'url' => '#',
					),
					array(
						'label' => 'Presensi',
						'url' => '#',
					),
					array(
						'label' => 'Data Kas',
						'url' => '#',
					),
				),
			),
			array(
				'label' => '<i class="fa fa-book"></i>&nbsp;&nbsp;Laporan <b class="caret"></b>',
				'url' => '#',
				//'visible'=>(Yii::app()->user->checkAccess(Rights::module()->userStaf) || Yii::app()->user->checkAccess(Rights::module()->userInvestor)),
				'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
				'submenuOptions' => array('class' => 'dropdown-menu'),
				'items' => array(
					array(
						'label' => 'Data Buku',
						'url' => array('book/report'),
					),
					array(
						'label' => 'Data Anggota',
						'url' => '#',
						'itemOptions' => array('class' => 'dropdown-submenu'),
						'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
						'submenuOptions' => array('class' => 'dropdown-menu'),
						'items'=>array(
							array('label' => 'Siswa','url' => array('student/report')),
							array('label' => 'Guru','url' => array('teacher/report')),
							array('label' => 'Karyawan / Staff','url' => array('employee/report')),
						),
					),
					array(
						'label' => 'Pendapatan Denda',
						'url' => array('loaningBook/reportDenda'),
					),
					array(
						'label' => 'Peminjaman',
						'url' => array('loaningBook/report'),
					),
					array(
						'label' => 'Belum dikembalikan + Denda',
						'url' => array('loaningBook/reportNotYetBack'),
					),
				),
			),
			//user
			array(
				'label' => '<i class="fa fa-group"></i>&nbsp;&nbsp;Users',
				'url' => array('/user'),
				//'visible'=>Yii::app()->user->checkAccess(Rights::module()->superuserName),
			),
		);
	}
	
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
			'rights'
		));
	}
	
	protected function setEmailSubject($title) {
		$preSubject	= Yii::app()->params['preEmailSubject'];
		return (!empty($preSubject)) ? $preSubject.' '.$title : $title;
	}
	
	protected function sendEmail($emailAddress,$subject,$content,$view,$data){
        $mail = new YiiMailer();
        
        $emailAdmin = Yii::app()->params['adminEmail'];
        $emailName = Yii::app()->name;
		
		$mail->setFrom($emailAdmin, $emailName);
		$mail->setTo($emailAddress);
		$mail->setSubject($subject);
		$mail->setBody($content);
		$mail->setLayout('mail');
		$mail->setView($view);
		$mail->setData($data);
		$mail->send();
    }
	
	public function redirectAfterSeconds($url) {
		Yii::app()->clientScript->registerMetaTag(1 . ';url=' . $url, null, 'refresh');
	}
}