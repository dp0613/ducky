<?php 
	class Error extends Controller
	{
		public function index()
		{
			$errorType = Controller::$_params[0];
			
			//Link redirect đến trang báo lỗi: home/error/404 | home/error/403
			$contents = array(
				'error_text' => "__(text{$errorType})"
			);
			Controller::$_viewObject -> assignContents($contents);
		}
	}
?>