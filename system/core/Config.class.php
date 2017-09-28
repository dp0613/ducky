<?php 
	class Config 
	{
		static private $settings;
		
		static public function _get($key) 
		{
			return isset(self::$settings[$key]) ? self::$settings[$key] : NULL;
		}
		
		static public function _set($key, $value)
		{
			self::$settings[$key] = $value;
		}
	}
?>