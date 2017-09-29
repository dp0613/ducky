<?php
	/**
	 * language.conf.php
	 * 
	 * @last_editor: dp0613
	 * @last_edit_date: 29/09/2017 8h00'
	 * @notes: 
	 *   - Đây là file config của hệ thống, chỉ sửa khi hiểu rõ
	 *   - Song song với file này ở thư mục application/config cũng có 1 file tương tự,
	 *     các ngôn ngữ được thêm vào trong quá trình dev app sẽ được cấu hình ở file đó.
	 */
 
	//Danh sách các ngôn ngữ
	Config::_set('languages', array(
		'vi' => APP_DIR.'languages'.DS.'vi.language.php',
		'en' => APP_DIR.'languages'.DS.'en.language.php'
	));
?>