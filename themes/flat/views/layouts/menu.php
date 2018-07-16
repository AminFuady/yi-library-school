<?php
	$this->widget('zii.widgets.CMenu', array(
		'encodeLabel' => false,
		'htmlOptions' => array('class' => 'main-nav'),
		'items' => $this->menuNavigation,
	));
?>