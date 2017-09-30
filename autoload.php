<?php 
	//Nhúng tất cả tệp config của system và application
	// vì các thiết lập của app được ưu tiên nên phải nhúng sau 
	$fileInSystemConfigFolder = array_diff(scandir(SYS_DIR.'config'), array('.', '..'));
	$fileInApplicationConfigFolder = array_diff(scandir(APP_DIR.'config'), array('.', '..'));
	
	//Nhúng tệp của hệ thống trước
	foreach($fileInSystemConfigFolder as $key => $file)
	{
		require_once(SYS_DIR.'config'.DS.$file);
	}
	
	//Nhúng tệp của app sau
	foreach($fileInApplicationConfigFolder as $key => $file)
	{
		require_once(APP_DIR.'config'.DS.$file);
	}
	
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