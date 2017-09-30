<?php 
	/**
	 * View Class
	 *
	 *  @author: dp0613
	 *  @last_editor: dp0613
	 *  @last_edit_date: 29/09/2017 8h34'
	 *  @docs: http://duckydocs.bitballoon.com/class/system/view/
	 *  @notes: 
	 *      - Chưa làm xong Template Engine
	 */

	class View
	{
		/**
		 * renderShape()
		 *
		 *  @author: dp0613
		 *  @last_editor: dp0613
		 *  @last_edit_date: 29/09/2017 8h34'
		 *  @params:
		 *      (string)        $shapeName           Tên shape
		 *  @return: 
		 *	   (string)		   $shapeHtml			Html của shape đã được nối lại
		 *  @docs: http://duckydocs.bitballoon.com/class/system/view#renderShape
		 *  @notes: 
		 *      - Hàm này sẽ đọc html từ các file nằm trong thư mục shape dựa theo
		 *		 tên của shape. Sau đó nối các html này lại theo đúng thứ tự được
		 *		 thiết lập ở file shape.conf.php.
		 */
		
		
		static private $_html;
		static private $_shapeHtml;
		static private $_placeholders;
		static private $_contents;
		static private $_viewHtml;

		public function renderShape($shapeName)
		{
			$shapeList = Config::_get('shapes');
			
			//Kiểm tra shape có tồn tại không
			if( ! in_array($shapeName, array_keys($shapeList)))
			{
				Debug::log("Không tồn tại shape: {$shapeName}");
				return;
			}
			
			//Lấy các thành phần của shape gộp vào biến $shapeHtml
			$shapeFolder = $shapeList[$shapeName];
			$shapeStructureList = Config::_get('shape_structures');
			$shapeStructure = $shapeStructureList[$shapeName];
			$shapeHtml = '';
			foreach($shapeStructure as $key => $fileName) 
			{
				$shapeFile = $shapeFolder.DS.$fileName.'.shape.php';
				if(file_exists($shapeFile))
				{
					$shapeHtml .= file_get_contents($shapeFile);
				} else
				{
					Debug::log("Shape {$shapeName} đã bị hỏng. Không tìm thấy file: {$fileName}");
				}
			}
			
			self::$_shapeHtml = $shapeHtml;
		}
		
		public function renderView($controller, $controllerFunc)
		{
			$viewPath = strtolower(APP_DIR.'views'.DS.$controller.DS.$controllerFunc.'.html');
			
			if( ! file_exists($viewPath))
			{
				Debug::log("Không tồn tại view: {$viewPath}");
				return;
			}
			
			$viewHtml = file_get_contents($viewPath);
			
			self::$_viewHtml = $viewHtml;
		}
		
		public function putViewIntoShape()
		{
			//Nếu trong shape không có chỗ mốc view (không có chữ {@view_contents})
			if(strpos(self::$_shapeHtml, '{@view_contents}') === FALSE)
			{
				Debug::log("Shape không có chỗ mốc view, vui lòng đặt cụm <b>{@view_contents}</b> vào chỗ nào bạn muốn nội dung của view hiện ra.");
				return;
			}
			
			self::$_html = str_replace('{@view_contents}', self::$_viewHtml, self::$_shapeHtml);
		}
		
		public function findAllPlaceholders()
		{
			$issetPlaceholder = preg_match_all('/{{(.+?)}}/', self::$_html, $placeholders);
			
			//Nếu không có placeholder nào
			if($issetPlaceholder === FALSE OR $issetPlaceholder === 0)
			{
				return;
			}
			
			//Chia placeholder ra 2 nhóm, 1 nhóm cho các tệp, 1 nhóm thông thường
			$needFileGroup = array();
			$casualGroup = array();
			
			foreach($placeholders[1] as $key => $placeholder)
			{
				if(strpos($placeholder, '.') !== FALSE)
				{
					$needFileGroup[] = $placeholder;
				} else
				{
					$casualGroup[] = $placeholder;
				}
			}
			
			$returnData = array(
				'file_group' => $needFileGroup,
				'casual_group' => $casualGroup
			);
			
			self::$_placeholders = $returnData;
		}
		
		public function assignContents($contents)
		{
			if( ! is_array($contents))
			{
				Debug::log("Hàm assignContents() cần tham số là mảng.");
				return;
			}
			
			self::$_contents = $contents;
		}
		
		public function getStaticFile($fileName)
		{
			//Nếu trường hợp file là css hoặc js thì sẽ lấy nội dung
			// còn là hình ảnh thì sẽ lấy link tuyệt đối
			
			$staticExtensions = array('js', 'css');
			$imageExtensions = array('png', 'jpg', 'jpeg');
			$extensionParts = explode('.', $fileName);
			$extension = $extensionParts[1];
			
			
			switch(true)
			{
				case in_array($extension, $staticExtensions):
					$filePath = APP_DIR.'assets'.DS.$extension.DS.$fileName;
					$returnData = file_get_contents($filePath);
					
					if($extension === 'js')
					{
						$returnData = "<script>{$returnData}</script>";
					} else if($extension === 'css')
					{
						$returnData = "<style>{$returnData}</style>";
					}
					
					break;
				case in_array($extension, $imageExtensions):
					$imagePath = APP_DIR.'assets'.DS.'images'.DS.$fileName;
					$returnData = "<img src='{$imagePath}' alt='{$fileName}' />";
					break;
				default:
					$returnData = NULL;
					Debug::log("Không tìm thấy tệp: {$fileName}");
					break;
			}
			
			return $returnData;
		}
		
		public function replacePlaceholders()
		{
			$placeholders = self::$_placeholders;
			$contents = self::$_contents;
			$html = self::$_html;
			
			//Nếu placeholder là dạng thường thì sẽ thay bằng dữ liệu của content
			// nếu là tệp thì sẽ nhúng tệp bằng hàm getStaticFile
			
			foreach($placeholders['casual_group'] as $key => $placeholder)
			{
				$html = str_replace('{{'.$placeholder.'}}', $contents[$placeholder], $html);
			}
			
			foreach($placeholders['file_group'] as $key => $placeholder)
			{
				$html = str_replace('{{'.$placeholder.'}}', $this -> getStaticFile($placeholder), $html);
			}
			
			self::$_html = $html;
		}
		
		public function render($shape, $controller, $controllerFunc)
		{
			//Render shape html
			$this -> renderShape($shape);
			
			//Render view html
			$this -> renderView($controller, $controllerFunc);
			
			//Ghép view vào shape
			$this -> putViewIntoShape();
			
			//Tìm tất cả các placeholder
			$this -> findAllPlaceholders();
			
			//Thay thế placeholder bằng nội dung trả về từ controller
			$this -> replacePlaceholders();
			
			//Trả về html
			return self::$_html;
		}
	}
?>