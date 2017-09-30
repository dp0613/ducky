<?php 
	class Controller 
	{
		
		static protected $_viewObject;
		
		public function __construct()
		{
			self::$_viewObject = App::_getViewObject();
		}
	}
?>