<?php 
	class MysqliDriver
	{
		
		protected static $_mysqli;
		
		
		public function connect($persistent = FALSE, $compress = FALSE)
		{
			
			//Kiểm tra xem có sử dụng socket hay không
			if(Database::$_protocol === 'SOCKET')
			{
				$hostname = NULL;
				$port = NULL;
				$socket = Database::$_hostname;
			} else if(Database::$_protocol === 'TCP')
			{
				$hostname = ($persistent === TRUE) ? 'p:' . Database::$_hostname : Database::$_hostname;
				$port = empty(Database::$_port) ? NULL : Database::$_port;
				$socket = NULL;
			}
			
			//Khởi tạo
			self::$_mysqli = mysqli_init();
			
			//Thiết lập thời gian hết hạn cho mỗi kết nối
			self::$_mysqli -> options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
			
			//Nén kết nối
			$compression = ($compress === TRUE) ? MYSQLI_CLIENT_COMPRESS : 0;
			
			//Kết nối và trả về mysqli
			if(self::$_mysqli -> real_connect($hostname, Database::$_username, Database::$_password, Database::$_database, $port, $socket, $compression))
			{
				return self::$_mysqli;
			}
			
			return FALSE;
		}
		
		public function reconnect()
		{
			return self::$_mysqli -> ping();
		}
		
		public function query($sql)
		{
			$sql = str_replace(['}', '{'], ['', Database::$_tablePrefix], $sql);
			return self::$_mysqli -> real_query($sql);
		}
		
		public function result()
		{
			return self::$_mysqli -> store_result();
		}
		
		public function error()
		{
			return self::$_mysqli -> error;
		}
		
		public function selectDatabase($databaseName)
		{
			return self::$_mysqli -> select_db($databaseName);
		}
		
		public function setCharset($charset)
		{
			return self::$_mysqli -> set_charset($charset);
		}
		
		public function close()
		{
			return self::$_mysqli -> close();
		}
		
	}
?>