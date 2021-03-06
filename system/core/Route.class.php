<?php 
	
	/**
	 * Route Class
	 *
	 *  @author: dp0613
	 *  @last_editor: dp0613
	 *  @last_edit_date: 29/09/2017 9h19'
	 *  @docs: http://duckydocs.bitballoon.com/class/system/route/
	 *  @notes: 
	 *      - Lớp này sẽ phân tích URI và giúp cho Ducky có URL đẹp hơn
	 */
	 
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
		
		
		/**
		 * parse()
		 *
		 *  @author: dp0613
		 *  @last_editor: dp0613
		 *  @last_edit_date: 29/09/2017 9h21'
		 *  @params:
		 *      (string)        $uri           URI hiện tại
		 *  @return: void
		 *  @docs: http://duckydocs.bitballoon.com/class/system/route#parse
		 *  @notes: 
		 *      - Hàm này sẽ phân tích URI ra thành nhiều thành phần
		 */
		 
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
				$controller = current($uriParts);
				//Kiểm tra sự tồn tại của controller
				if(file_exists(APP_DIR.'controllers'.DS.$controller.'.controller.php'))
				{
					$this -> _controller = $controller;
					array_shift($uriParts);
				} else
				{
					Debug::log("Không tồn tại controller: {$controller}");
				}
				
			}
			
			//Lấy controller_func từ URI
			if(current($uriParts))
			{
				$controllerObject = new $this -> _controller();
				$controllerFunc = current($uriParts);
				if(method_exists($controllerObject, $controllerFunc))
				{
					$this -> _controllerFunc = $controllerFunc;
					array_shift($uriParts);
				} else
				{
					Debug::log("Không tồn tại method: {$controllerFunc} trong class: {$this -> _controller}");
				}
				
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