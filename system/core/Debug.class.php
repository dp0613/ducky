<?php 
	class Debug 
	{
		
		static public function log($str)
		{
			$callerInfos = debug_backtrace(); //Thông tin file đã gọi lệnh log()
			$callerInfos = $callerInfos[0]; //Lấy file gần nhất
			echo "<b>Ducky báo lỗi</b><i> ({$callerInfos['file']}#{$callerInfos['line']})</i>: ".(string)$str.'<br />';
		}
	}
?>