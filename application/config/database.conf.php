<?php 
	
	//Thiết lập các thông số cho database
	Config::_set('database', array(
		'db_hostname' => 'localhost', //Nếu sử dụng socket thì phải cấu hình db_protocol thành SOCKET
		'db_username' => 'root',
		'db_password' => '',
		'db_database_name' => 'test_ducky',
		'db_table_prefix' => 'df_',
		'db_collate' => 'utf8_general_ci',
		'db_charset' => 'utf8',
		'db_protocol' => 'TCP', //SOCKET | TCP
		'db_port' => '',
		'db_enable_cache' => FALSE,
		'db_driver' => 'pdo' //pdo hoặc mysqli
	));
?>