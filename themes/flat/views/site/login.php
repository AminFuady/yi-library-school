<?php
	$baseUrl = Yii::app()->request->baseUrl;
	$themeUrl = Yii::app()->theme->baseUrl;

	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery');
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/bootstrap.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/themes.css">

	<!-- icheck -->
	<script src="<?php echo $themeUrl; ?>/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $themeUrl; ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo $themeUrl; ?>/js/eakroko.js"></script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo $themeUrl; ?>/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $themeUrl; ?>/img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<h1>
			<a href="javascript::;">
				<img src="<?php echo $themeUrl; ?>/img/logo_admin.png" alt="" class='retina-ready img-responsive'>
			</a>
		</h1>
		<div class="login-body">
			<h2>SIGN <span class="color-green-qq">IN</span></h2>
			<?php $form = $this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
					'htmlOptions'=> array(
						'class'=>'form-validate'	
					),
				)); ?>
				<div class="form-group">
					<div class="email controls">
						<?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>CHtml::encode($model->getAttributeLabel('username')))); ?>
						<?php echo $form->error($model,'username'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="pw controls">
						<?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>CHtml::encode($model->getAttributeLabel('password')))); ?>
						<?php echo $form->error($model,'password'); ?>
					</div>
				</div>
				<div class="submit">
					<div class="remember">
						<?php echo $form->checkBox($model,'rememberMe', array('class'=>'icheck-me', 'data-skin'=>'square', 'data-color'=>'blue')); ?>
						<?php echo $form->label($model,'rememberMe'); ?>
						<?php echo $form->error($model,'rememberMe'); ?>
					</div>
					<input type="submit" value="Sign In" class='btn btn-lg btn-login'>
				</div>
			<?php $this->endWidget(); ?>
			<br/><br/>
		</div>
		<div class="login-footer">
			<div class="left">
				<i class="fa fa-map-marker fa-4x"></i>
			</div>
			<div class="right">
				<?php echo SchoolInfo::getByField('name'); ?><br>	 
				<?php echo SchoolInfo::getByField('address'); ?><br>
				<?php echo Yii::app()->params['copyright']; ?>
			</div>
		</div>
	</div>
</body>
</html>
