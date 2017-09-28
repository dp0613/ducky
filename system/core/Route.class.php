<?php 
	class Route 
	{
		private $_shape;
		private $_language;
		private $_controller;
		private $_controllerFunc;
		private $_params;
		
		public function _getShape()
		{
			return $this -> _shape;
		}
	
		public function _getLanguage()
		{
			return $this -> _language;
		}
	
		public function _getController()
		{
			return $this -> _controller;
		}
	
		public function _getControllerFunc()
		{
			return $this -> _controllerFunc;
		}
	
		public function _getParams()
		{
			return $this -> _params;
		}
		
		public function parse($uri)
		{
			//Cắt bỏ phần phía sau dấu ? trong URI
			$uriPartsByQuestionMark = explode('?', $uri);
			$uri = $uriPartsByQuestionMark[0];
			
			//Tách URI ra thành từng phần dựa theo dấu /
			$uriParts = array_filter(explode('/', $uri), 'strlen');
			
			//Kiểm tra xem $uriParts có rỗng không
			if( ! count($uriParts))
			{
				return;
			}
			
			//Đưa con trỏ về vị trí số 0
			reset($uriParts);
			
			//Lấy shape từ URI
			if(in_array(current($uriParts),array_keys(Config::_get('shapes'))))
			{
				$this -> _shape = current($uriParts);
				array_shift($uriParts);
			}
			
			//Lấy ngôn ngữ từ URI
			if(in_array(current($uriParts), array_keys(Config::_get('languages'))))
			{
				$this -> _language = current($uriParts);
				array_shift($uriParts);
			}
			
			//Lấy controller từ URI
			if(current($uriParts))
			{
				//Kiểm tra sự tồn tại của controller
				if( ! file_exists(APP_DIR.'controllers'.DS.$this -> _controller.'.controller.php'))
				{
					Debug::log("Không tồn tại controller: {$this -> _controller}");
				}
				$this -> _controller = current($uriParts);
				array_shift($uriParts);
			}
			
			//Lấy controller_func từ URI
			if(current($uriParts))
			{
				$controllerObject = new $this -> _controller();
				if( ! method_exists($controllerObject, current($uriParts)))
				{
					Debug::log('Không tồn tại method: '.current($uriParts).' trong class: '.$this -> _controller);
				}
				$this -> _controllerFunc = current($uriParts);
				array_shift($uriParts);
			}
			
			//Lấy tất cả param từ URI
			$this -> _params = $uriParts;
		}
		
		public function __construct()
		{
			//Gán các giá trị mặc định cho route
			$this -> _language = Config::_get('default_language');
			$this -> _shape = Config::_get('default_shape');
			$this -> _controller = Config::_get('default_controller');
			$this -> _controllerFunc = Config::_get('default_controller_func');
			$this -> _params = array();
		}
	}
?>