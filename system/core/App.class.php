<?php 
	class App
	{
		
		static private $_router;
		static private $_shape;
		static private $_language;
		static private $_controller;
		static private $_controllerFunc;
		static private $_params;
		
		public function _getRouter()
		{
			return self::$_router;
		}
		
		public function _getShape()
		{
			return self::$_shape;
		}
	
		public function _getLanguage()
		{
			return self::$_language;
		}
	
		public function _getController()
		{
			return self::$_controller;
		}
	
		public function _getControllerFunc()
		{
			return self::$_controllerFunc;
		}
	
		public function _getParams()
		{
			return self::$_params;
		}
		
		
		public function run($uri)
		{
			//Lấy các biến để điều khiển app
			$router = self::$_router;
			$shape = self::$_shape;
			$language = self::$_language;
			$controller = self::$_controller;
			$controllerFunc = self::$_controllerFunc;
			$params = self::$_params;
			
			//Parse URI
			$router -> parse($uri);
			
			//Lấy nội dung tương ứng với request
			$controllerObj = new $controller();
			$contents = $controllerObj -> $controllerFunc();
			
			//Load view
			$view = new View();
			$shapeHtml = $view -> load($shape, $contents);
			
		}
		
		public function __construct()
		{
			//Gán các giá trị cho vào đối tượng App
			self::$_router = new Route();
			self::$_shape = self::$_router -> _getShape();
			self::$_language = self::$_router -> _getLanguage();
			self::$_controller = self::$_router -> _getController();
			self::$_controllerFunc = self::$_router -> _getControllerFunc();
			self::$_params = self::$_router -> _getParams();
			
		}
	}
?>