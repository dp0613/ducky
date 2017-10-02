<?php 
	class Controller 
	{
		
		static protected $_viewObject;
		static protected $_params;
		
		public function __construct()
		{
			self::$_viewObject = App::_getViewObject();
			self::$_params = App::_getParams();
		}
	}
?>