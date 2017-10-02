<?php 
	class Error extends Controller
	{
		public function index()
		{
			$errorType = Controller::$_params[0];
			
			//Chỉ mới handle cho lỗi 404
			$contents = array(
				'error_text' => "__(text{$errorType})"
			);
			Controller::$_viewObject -> assignContents($contents);
		}
	}
?>