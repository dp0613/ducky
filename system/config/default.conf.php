<?php 
	
	/**
	 * default.conf.php
	 * 
	 * @last_editor: dp0613
	 * @last_edit_date: 29/09/2017 8h00'
	 * @notes: 
	 *   - Đây là file config của hệ thống, chỉ sửa khi hiểu rõ
	 *   - File này chứa các thiết lập mặc định của Ducky
	 */
	
	//Ngôn ngữ mặc định
	Config::_set('default_language', 'vi');
	
	//Shape mặc định
	Config::_set('default_shape', 'home');
	
	//Controller mặc định
	Config::_set('default_controller', 'home');
	
	//Controller Function mặc định
	Config::_set('default_controller_func', 'index');
?>