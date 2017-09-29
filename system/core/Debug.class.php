<?php 

	/**
	 * Debug Class
	 *
	 *  @author: dp0613
	 *  @last_editor: dp0613
	 *  @last_edit_date: 29/09/2017 9h23'
	 *  @docs: http://duckydocs.bitballoon.com/class/system/debug
	 *  @notes: 
	 *      - Lớp này chứa các hàm phục vụ debug
	 */
	
	class Debug 
	{
		
		/**
		 * log()
		 *
		 *  @author: dp0613
		 *  @last_editor: dp0613
		 *  @last_edit_date: 29/09/2017 9h25'
		 *  @params:
		 *      (string)        $str           Chuỗi để in ra
		 *  @return: void
		 *  @docs: http://duckydocs.bitballoon.com/class/system/debug#log
		 */
		 
		static public function log($str)
		{
			$callerInfos = debug_backtrace(); //Thông tin file đã gọi lệnh log()
			$callerInfos = $callerInfos[0]; //Lấy file gần nhất
			echo "<b>Ducky báo lỗi</b><i> ({$callerInfos['file']}#{$callerInfos['line']})</i>: ".(string)$str.'<br />';
		}
	}
?>