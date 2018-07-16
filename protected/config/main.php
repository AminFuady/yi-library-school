<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistem Perpustakaan SDN Carlir 03',

	// preloading 'log' component
	'preload'=>array('log'),
	'theme'=>'flat',
	'timeZone' => 'Asia/Jakarta',
	
	'aliases' => array(
		'bootstrap'=>realpath(__DIR__ . '/../extensions/bootstrap'),
		'yiiwheels'=>realpath(__DIR__ . '/../extensions/yiiwheels'),
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.widgets.*',
		'application.helpers.*',
		'application.validators.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'bootstrap.behaviors.TbWidget',
		'bootstrap.helpers.TbArray',
		'bootstrap.helpers.TbHtml',
		'bootstrap.widgets.*',
		'ext.phpexcel.PHPExcel',
		'ext.YiiMailer.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('bootstrap.gii'),
		),
		
		'rights'=>array(
			'superuserName'=>'Admin', // Name of the role with super user privileges.
			'authenticatedName'=>'Authenticated', // Name of the authenticated user role.
			'userIdColumn'=>'id', // Name of the user id column in the database.
			'userNameColumn'=>'email', // Name of the user name column in the database.
			'enableBizRule'=>true, // Whether to enable authorization item business rules.
			'enableBizRuleData'=>false, // Whether to enable data for business rules.
			'displayDescription'=>true, // Whether to use item description instead of name.
			'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
			'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
			//'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
			//'layout'=>'rights.views.layouts.main', // Layout to use for displaying Rights.
			//'appLayout'=>'application.views.layouts.main', // Application layout.
			//'cssFile'=>'rights.css', // Style sheet file to use for Rights.
			'install'=>false, // Whether to enable installer.
			'debug'=>false, // Whether to enable debug mode. 
		 ),
		
	),
		
	// application components
	'components'=>array(
		
		'bootstrap'=>array(
			'class'=>'bootstrap.components.TbApi',
		),
		'yiiwheels' => array(
			'class' => 'yiiwheels.YiiWheels',
		),

		'mail' => require(dirname(__FILE__).'/mail.php'),
		
		'user'=>array(
			'class' => 'MyWebUser',
			'loginUrl'=>array('/site/index'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'assignmentTable'=>'authassignment',
			'itemTable'=>'authitem',
			'itemChildTable'=>'authitemchild',
			'defaultRoles'=>array('Guest'),
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		
		'widgetFactory'=>array(
			'widgets'=>array(
				'TbGridView' => array(
					'itemsCssClass'=>'table-hover table-nomargin',
					'cssFile'=>false,
					'htmlOptions'=>array('class'=>'table-responsive', 'style'=>'padding:10px;'),
				),
				'CDetailView'=>array(
					'cssFile'=>false,
					'htmlOptions'=>array('class'=>'table table-hover table-striped table-responsive'),
				),
				'CActiveForm'=>array(
					'htmlOptions'=>array('class'=>'form-horizontal')
				),
				'WhDateRangePicker'=>array(
					'pluginOptions' => array(
						'format' => 'YYYY-MM-DD',
						'separator'=>' s/d '
					),
					'htmlOptions'=>array(
						'prepend'=>'<i class="icon-calendar"></i>',
						'addOnOptions'=>array('class'=>'input-group'),
						'prependOptions'=>array('addOnOptions'=>array('class'=>'input-group-addon')),
					),
				),
				'WhDateTimePicker'=>array(
					'pluginOptions' => array(
						'format' => 'YYYY-MM-DD hh:mm',
					),
					'htmlOptions'=>array(
						'prepend'=>'<i class="icon-calendar"></i>',
						'addOnOptions'=>array('class'=>'input-group'),
						'prependOptions'=>array('addOnOptions'=>array('class'=>'input-group-addon')),
					),
				),
				'WhDatePicker'=>array(
					'pluginOptions' => array(
						'format' => 'yyyy-mm-dd',
					),
				),
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
