<?php 
	
	//Các thiết lập ở đây sẽ được ưu tiên hơn
	// so với các thiết lập ở system/config/shape.conf.php
	
	//Mở rộng cấu trúc shape 'home': thêm sidebar
	Config::_set('shape_structures', array(
		'home' => array(
			'head',
			'header',
			'sidebar',
			'main',
			'footer',
			'foot'
		),
		'admin' => array(
		
		)
	));
?>