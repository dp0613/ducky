<?php 
	//Nhúng tất cả tệp config của system và application
	require_once(SYS_DIR.'config'.DS.'default.conf.php');
	require_once(SYS_DIR.'config'.DS.'shape.conf.php');
	require_once(SYS_DIR.'config'.DS.'language.conf.php');
	
	function __autoload($className) 
	{
		//Chỉ cho phép autoload các file trong thư mục core
		$fileNameOfCore = SYS_DIR.'core'.DS.$className.'.class.php';
		$fileNameOfController = APP_DIR.'controllers'.DS.$className.'.controller.php';
		$fileNameOfModel = APP_DIR.'models'.DS.$className.'.model.php';
		
		if(file_exists($fileNameOfCore)) 
		{
			require_once($fileNameOfCore);
		} else if(file_exists($fileNameOfController)) 
		{
			require_once($fileNameOfController);
		} else if(file_exists($fileNameOfModel)) 
		{
			require_once($fileNameOfModel);
		} else
		{
			Debug::log("Không tồn tại lớp: {$className}");
		}
	}
?>