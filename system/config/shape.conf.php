<?php 
	//Danh sách các shape được cài sẵn
	// shape_name => shape_folder
	Config::_set('shapes', array(
		'home' => APP_DIR.'views'.DS.'home',
		'admin' => APP_DIR.'views'.DS.'admin'
	));
	
	//Cấu trúc của shape
	// shape_name => order_of_file_of_shape (từ trên xuống)
	Config::_set('shape_structures', array(
		'home' => array(
			'head',
			'header',
			'main',
			'footer',
			'foot'
		),
		'admin' => array(
		
		)
	));
?>