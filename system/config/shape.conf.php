<?php
	/**
	 * shape.conf.php
	 * 
	 * @last_editor: dp0613
	 * @last_edit_date: 29/09/2017 8h00'
	 * @notes: 
	 *   - Đây là file config của hệ thống, chỉ sửa khi hiểu rõ
	 *   - Song song với file này ở thư mục application/config cũng có 1 file tương tự,
	 *     các shape được thêm vào trong quá trình dev app sẽ được cấu hình ở file đó.
	 */
 
	//Danh sách các shape được cài sẵn
	// shape_name => shape_folder
	Config::_set('shapes', array(
		'home' => APP_DIR.'shapes'.DS.'home',
		'admin' => APP_DIR.'shapes'.DS.'admin'
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