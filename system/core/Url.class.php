<?php 
	class Url
	{
		static protected $_urls = array();
		
		static public function _addUrl($urlData)
		{
			$duplicatedRegexes = array_intersect(array_keys(self::$_urls), array_keys($urlData));
			
			//Nếu các url trong tham số chưa có trong danh sách url
			if(0 === $amount = count($duplicatedRegexes))
			{
				self::$_urls = array_merge(self::$_urls, $urlData);
			} else if($amount > 0) //Nếu có ít nhất 1 url trong tham số đã có trong danh sách url
			{
				foreach($duplicatedRegexes as $key => $regex)
				{
					//Ghi đè 
					self::$_urls[$regex] = $urlData[$regex];
				}
			}
		}
		
		static public function _getUri($url)
		{
			foreach(self::$_urls as $regex => $uri)
			{
				if(preg_match($regex, $url, $params) === 1)
				{
					//Bỏ item đầu: Là scope trùng khớp
					array_shift($params);
					foreach($params as $key => $param)
					{
						$number = $key + 1;
						$uri = str_replace("\${$number}", $param, $uri);
					}
					
					return $uri;
				}
			}
			return '';
		}
	}
?>