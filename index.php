<?php 
	/**
	 * index.php
	 * 
	 * @last_editor: dp0613
	 * @last_edit_date: 27/09/2017 16h00
	 * @notes:
	 *	
	 *
	*/
	
	define('ROOT_DIR', __dir__); //Thư mục chứa Ducky
	define('DOMAIN', $_SERVER['HTTP_HOST']); //Tên miền
	define('DS', DIRECTORY_SEPARATOR); //Ký tự ngăn cách thư mục
	
	
	define('ABS_HOST', 'http://'.DOMAIN.'/'); //Đường dẫn tuyệt đối
	define('SYS_DIR', ROOT_DIR.DS.'system'.DS); //Thư mục /system
	define('APP_DIR', ROOT_DIR.DS.'application'.DS); //Thư mục /application
	
	//Nhúng tệp autoload.php
	require_once(ROOT_DIR.DS.'autoload.php');
	
	//Khởi chạy ứng dụng
	$app = new App($_SERVER['REQUEST_URI']);
?>