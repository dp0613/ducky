<?php 
	class Database
	{
		static public $_hostname;
		static public $_username;
		static public $_password;
		static public $_database;
		static public $_tablePrefix;
		static public $_charset;
		static public $_collate;
		static public $_port;
		static public $_protocol;
		static public $_socket;
		static public $_enableCache;
		static public $_driver;
		static public $_driverObject;
		
		public function open()
		{
			//Nhúng driver
			$driverName = ucfirst(self::$_driver) . 'Driver';
			self::$_driverObject = new $driverName();
			
			//Kết nối database
			self::$_driverObject -> connect();
			
			return self::$_driverObject;
		}
		
		public function __construct($configs = array())
		{
			//Nếu không truyền tham số, thì sẽ dùng các thiết lập trong tệp config
			if(empty($configs))
			{
				$configs = Config::_get('database');
			} else	//Nếu có truyền tham số, thì sẽ ghi đè
			{
				//Kiểm tra xem các tham số truyền vào có đúng không
				$defaultConfigs = Config::_get('database');
				$wrongKeys = array_diff(array_keys($configs), array_keys($defaultConfigs));
				
				if(count($wrongKeys) === 0)
				{
					//Ghi đè 
					$configs = array_merge($defaultConfigs, $configs);
				} else
				{
					$configs = $defaultConfigs;
					Debug::log('Tham số truyền vào Database chứa key không hợp lệ: <pre>'.print_r($wrongKeys).'</pre>');
				}
			}
			
			self::$_hostname = $configs['db_hostname'];
			self::$_username = $configs['db_username'];
			self::$_password = $configs['db_password'];
			self::$_database = $configs['db_database_name'];
			self::$_tablePrefix = $configs['db_table_prefix'];
			self::$_charset = $configs['db_charset'];
			self::$_collate = $configs['db_collate'];
			self::$_port = $configs['db_port'];
			self::$_protocol = $configs['db_protocol'];
			self::$_enableCache = $configs['db_enable_cache'];
			self::$_driver = $configs['db_driver'];
		}
	}
?>