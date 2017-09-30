<?php 
	class Language
	{
		
		static private $_currentLanguage;
		static private $_html;
		static private $_data;
		static private $_scopes;
		
		public function setHtml($html) {
			self::$_html = $html;
		}
		
		public function getLanguageStringData()
		{
			$languageFile = APP_DIR.'languages'.DS.self::$_currentLanguage.'.xml';
			
			//Nếu không có tệp ngôn ngữ, thì sử dụng ngôn ngữ mặc định
			if( ! file_exists($languageFile))
			{
				Debug::log("Không tìm thấy tệp ngôn ngữ: {$languageFile}");
				$languageFile = APP_DIR.'languages'.DS.Config::_get('default_language').'.xml';
			}
			
			$languageStringData = simplexml_load_file($languageFile);
			
			if($languageStringData === FALSE)
			{
				Debug::log("Tệp ngôn ngữ bị hỏng: {$languageFile}");
				return;
			}
			
			self::$_data = (array)$languageStringData;
		}
		
		public function findAllLanguageScopes()
		{
			$issetScope = preg_match_all('/__\((.+?)\)/', self::$_html, $scopes);
			
			//Không tìm thấy scope thì giữ nguyên chuỗi html
			if($issetScope === FALSE OR $issetScope === 0)
			{
				return;
			}
			
			self::$_scopes = $scopes[1];
		}
		
		public function replaceAllLanguageScopes()
		{
			foreach(self::$_scopes as $key => $scope)
			{
				self::$_html = str_replace('__(' . $scope . ')', self::$_data[$scope], self::$_html); 
			}
		}
		
		public function show() {
			
			//Lấy dữ liệu từ tệp ngôn ngữ
			$this -> getLanguageStringData();
			
			//Tìm tất cả các scope
			$this -> findAllLanguageScopes();
			
			//Thay thế tất cả scope thành chuỗi ngôn ngữ tương ứng
			$this -> replaceAllLanguageScopes();
			
			return print(self::$_html);
		}
		
		public function __construct($language)
		{
			self::$_currentLanguage = $language;
		}
	}
?>