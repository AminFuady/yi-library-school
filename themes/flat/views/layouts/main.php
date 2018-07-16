<?php
/* @var $this Controller */
/* @var $content string */

//Yii::app()->bootstrap->register();
$baseUrl = Yii::app()->request->baseUrl;
$themeUrl = Yii::app()->theme->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
    <!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
    <!-- Datepicker -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/datepicker/datepicker.css">
	<!-- Daterangepicker -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/datetimepicker/bootstrap-datetimepicker.css">
	<!-- dataTables -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/datatable/TableTools.css">
    <!-- Chosen CSS -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/chosen/chosen.css">
	<!-- Select2 CSS -->
	<link href="<?php echo $themeUrl; ?>/css/plugins/select2/select2.css" rel="stylesheet" />
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/themes.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Nice Scroll -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $themeUrl; ?>/js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/form/jquery.form.min.js"></script>
    <!-- Datepicker -->
    <script src="<?php echo $themeUrl; ?>/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	
	<!-- Datetimepicker --> 
	<script src="<?php echo $themeUrl; ?>/js/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>
	
	<!-- Daterangepicker -->
    <script src="<?php echo $themeUrl; ?>/js/plugins/daterangepicker/moment.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Validation -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/validation/additional-methods.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/plugins/jquery-ui/jquery.ui.datepicker.min.js"></script>
	<!-- Chosen -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/select2/select2.min.js"></script>
	<!-- InputMask -->
    <script src="<?php echo $themeUrl; ?>/js/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo $themeUrl; ?>/js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo $themeUrl; ?>/js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- Theme framework -->
	<script src="<?php echo $themeUrl; ?>/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo $themeUrl; ?>/js/application.min.js"></script>

	<!--[if lte IE 9]>
	<script src="<?php echo $themeUrl; ?>/js/plugins/placeholder/jquery.placeholder.min.js"></script>
	<script>
		$(document).ready(function() {
			$('input, textarea').placeholder();
		});
	</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo $themeUrl; ?>/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $themeUrl; ?>/img/apple-touch-icon-precomposed.png" />

</head>

<body class="theme-sunrise-a" data-layout-sidebar="fixed">
	<div id="navigation">
		<div class="container-fluid">
			<a href="<?php echo $baseUrl.'/default'; ?>" id="brand">
<!--                <img src="<?php echo $baseUrl; ?>/themes/flat/img/logo-putih.png" alt="logo" width="150"/> logo image -->
				<?php echo SchoolInfo::getByField(); ?>
                
            </a>
            <?php if(Yii::app()->user->getId()){?>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
				<i class="fa fa-bars"></i>
			</a>
                        
                        
			<?php $this->beginContent('//layouts/menu'); ?>
            <?php $this->endContent(); ?>
			
			<?php
			?>
			
			<div class="user">
				<ul class="icon-nav">
					<li class='dropdown sett'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown">
							<span>Hi, <?php echo User::model()->findByPk(Yii::app()->user->id)->name; ?></span> &nbsp; <i class="fa fa-user"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<?php echo CHtml::link('<i class="fa fa-user"></i>&nbsp;&nbsp; Edit Profile', Yii::app()->createUrl('dashboard/editProfile'));?>
							</li>
							<li>
								<?php echo CHtml::link('<i class="fa fa-sign-out"></i> Sign out', array('/site/logout'),array('class'=>'btn-signout'));?>
							</li>
						</ul>
					</li>
				</ul>
			</div><!--user-->
                            
			<?php }else{$this->redirect(Yii::app()->homeUrl);} ?>
		</div><!--container fluid-->
	</div><!--navigation-->

	<div class="container-fluid" id="content">
		<div id="left">
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Calendar</span>
					</a>
				</div>
				<div class="subnav-content less">
					<div class="jq-datepicker"></div>
				</div>
			</div>
			<div class="subnav">
			<?php if(empty($this->menu)): ?>
				<div class="subnav-content">
					<h4>There is no operation in this page</h4>
				</div>
			<?php else: ?>
				<div class="subnav-title">
					<a href="#" class="toggle-subnav">
						<i class="fa fa-angle-down"></i>
						<span>Operation</span>
					</a>
				</div>
				<?php $this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array(
						'class'=>'subnav-menu',
					)
				)); ?>
			<?php endif; ?>
			</div>
		</div>

		<div id="main">
			<div class="container-fluid">
				<br/>
				<?php if($this->isExpired==true): echo TbHtml::alert('warning', $this->expireLabel);endif;?>
				<div class="breadcrumbs">
				<?php if(isset($this->breadcrumbs)):
					$this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
						'homeLink'=>CHtml::tag('li',array(),CHtml::link('Home', array('/dashboard/')).'<i class="fa fa-angle-right"></i>'),
						'tagName'=>'ul',
						'separator'=>'',
						'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <i class="fa fa-angle-right"></i></li>',
						'inactiveLinkTemplate'=>'<li><a href="#">{label}</a></li>',
						'htmlOptions'=>array('class'=>''),
					)); ?><!-- breadcrumbs -->
					<?php endif; ?>
					<div class="close-bread">
						<a href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div id="statusMsg">
				<?php
                    if(Yii::app()->user->hasFlash('info')):
                        echo "<br/>";
                        echo MyTbHtml::alert('info', Yii::app()->user->getFlash('info'));
                        Yii::app()->clientScript->registerScript(
                            'myHideEffect',
                            '$(".alert-info").animate({opacity: 1.0}, 10000).fadeOut("slow");',
                            CClientScript::POS_READY
                        );
                    endif;
                    if(Yii::app()->user->hasFlash('error')):
                        echo "<br/>";
                        echo MyTbHtml::alert('danger', Yii::app()->user->getFlash('error'));
                        Yii::app()->clientScript->registerScript(
                           'myHideEffect',
                           '$(".alert-danger").animate({opacity: 1.0}, 10000).fadeOut("slow");',
                           CClientScript::POS_READY
                        );
                    endif;
                    if(Yii::app()->user->hasFlash('success')):
                        echo "<br/>";
                        echo MyTbHtml::alert('success', Yii::app()->user->getFlash('success'));
                        Yii::app()->clientScript->registerScript(
                            'myHideEffect',
                            '$(".alert-success").animate({opacity: 1.0}, 10000).fadeOut("slow");',
                            CClientScript::POS_READY
                        );
                    endif;
                ?>
				</div>
				
				<?php echo $content; ?>
				
			</div>
			
		</div>
<!--		<div id="footer" style="padding-bottom:10px;">
			<p>
				<?php echo Yii::app()->params['copyright']; ?>
				<span class="font-grey-4">|</span>
				<a href="#">Contact</a>
				<span class="font-grey-4">|</span>
				<a href="#">Imprint</a>
			</p>
			<a href="#" class="gototop">
				<i class="fa fa-arrow-up"></i>
			</a>
		</div>-->
	</div>
	<script type="text/javascript">
		//select2
		$('.select2-me').select2();
		if ($(".jq-datepicker").length > 0) {
			$(".jq-datepicker").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				prevText: "",
				nextText: ""
			});
		}
	</script>
	<style>
		#sidebar {display:none;}
	</style>
</body>
</html>



