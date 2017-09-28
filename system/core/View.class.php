<?php 
	class View
	{
		
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
			foreach( $shapeStructure as $key => $fileName ) 
			{
				$shapeFile = $shapeFolder.DS.$fileName.'.view.php';
				if(file_exists($shapeFile))
				{
					$shapeHtml .= file_get_contents($shapeFile);
				} else
				{
					Debug::log("Shape {$shapeName} đã bị hỏng. Không tìm thấy file: {$fileName}");
				}
			}
			
			return $shapeHtml;
		}
		
		public function load($shape, $contents)
		{
			$shapeHtml = $this -> renderShape($shape);
			
			$cssFile = ABS_HOST.'application'.DS.'assets'.DS.'css'.DS.'home.css';
			$jsFile = ABS_HOST.'application'.DS.'assets'.DS.'js'.DS.'home.js';
			$html = str_replace('{{contents}}', $contents, $shapeHtml);
			$html = str_replace('{{home.css}}', '<style>' . file_get_contents($cssFile) . '</style>', $html);
			$html = str_replace('{{home.js}}', '<script>' . file_get_contents($jsFile) . '</script>', $html);
			echo $html;
		}
	}
?>