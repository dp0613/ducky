<?php 
	class App
	{
		
		//Các biến lấy từ lớp Route
		static private $_router;
		static private $_shape;
		static private $_language;
		static private $_controller;
		static private $_controllerFunc;
		static private $_params;
		static private $_languageObject;
		
		//Các biến lấy từ lớp View
		static private $_viewObject;
		
		static public function _getRouter()
		{
			return self::$_router;
		}
		
		static public function _getShape()
		{
			return self::$_shape;
		}
	
		static public function _getLanguage()
		{
			return self::$_language;
		}
	
		static public function _getController()
		{
			return self::$_controller;
		}
	
		static public function _getControllerFunc()
		{
			return self::$_controllerFunc;
		}
	
		static public function _getParams()
		{
			return self::$_params;
		}
		
		static public function _getViewObject()
		{
			return self::$_viewObject;
		}
		
		static public function _getLanguageObject()
		{
			return self::$_languageObject;
		}
		
		public function run($url)
		{
			//Lấy uri
			$uri = Url::_getUri($url);
			
			//Nếu url chưa được cấu hình ở tệp url.conf.php, sử dụng uri
			$uri = empty($uri) ? $url : $uri;
			
			//Parse URI
			self::$_router = new Route();
			self::$_router -> parse($uri);
			
			//Gán các giá trị của Route vào App
			self::$_shape = self::$_router -> _getShape();
			self::$_language = self::$_router -> _getLanguage();
			self::$_controller = self::$_router -> _getController();
			self::$_controllerFunc = self::$_router -> _getControllerFunc();
			self::$_params = self::$_router -> _getParams();
			
			//Khởi tạo View để dùng trong controller
			self::$_viewObject = new View();
			
			//Chạy controller function
			$controllerName = self::$_controller;
			$controllerFuncName = self::$_controllerFunc;
			$controllerObj = new $controllerName();
			$controllerObj -> $controllerFuncName();
			
			//Render view lấy html
			$html = self::$_viewObject -> render(self::$_shape, self::$_controller, self::$_controllerFunc);
			
			//Load ngôn ngữ
			$language = new Language(self::$_language);
			
			//Gán html vào lớp Language
			$language -> setHtml($html);
			$language -> show();
			
		}
		
		public function __construct($url)
		{
			//Khởi chạy ứng dụng
			$this -> run($url);
		}
	}
?>