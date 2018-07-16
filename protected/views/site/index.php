<?php
/* @var $this SiteController */
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Manage',
);

$this->headerMenu= array(
	'messages'=>array(
		'headerMenu'=>'',
		'contentMenu'=>array(
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 1',
				'time'=>'today',
				'content'=>'isi content Message 1'
			),
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 2',
				'time'=>'2 mins',
				'content'=>'isi content Message 2'
			),
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 3',
				'time'=>'2 days',
				'content'=>'isi content Message 3'
			),
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 4',
				'time'=>'yesterday',
				'content'=>'isi content Message 4'
			),
		),
		'linkAll'=>'#'
	),
	'notifications'=>array(
		'headerMenu'=>'',
		'contentMenu'=>array(
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 1',
				'time'=>'today',
				'content'=>'isi content Message 1'
			),
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 2',
				'time'=>'2 mins',
				'content'=>'isi content Message 2'
			),
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 3',
				'time'=>'2 days',
				'content'=>'isi content Message 3'
			),
			array(
				'link'=>'#',
				'img'=>'',
				'title'=>'Message 4',
				'time'=>'yesterday',
				'content'=>'isi content Message 4'
			),
		),
		'linkAll'=>'#'
	),
);

$this->pageTitle="Index";
?>

<div class="box box-primary">
	<div class="box-body">
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
	</div>
</div>