<?php 
	
	/**
	 * Config Class
	 *
	 *  @author: dp0613
	 *  @last_editor: dp0613
	 *  @last_edit_date: 29/09/2017 9h27'
	 *  @docs: http://duckydocs.bitballoon.com/class/system/config
	 *  @notes: 
	 *      - Lớp này sẽ lưu trữ các thiết lập từ các file trong thư mục /config
	 */
	
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