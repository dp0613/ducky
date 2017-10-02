<?php 
	//Thiết lập các url mặc của hệ thống
	Url::_addUrl(array(
		'/^$/' => 'home/home/index',
		'/^\/error\/(.+)$/' => 'home/error/index/$1'
		
		
		
	));
?>