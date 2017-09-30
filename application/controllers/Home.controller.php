<?php 
	//Thử phần route
	class Home extends Controller
	{
		public function index()
		{
			$contents = array(
				'post_title' => 'DUCKY <small>v0.1.1</small>',
				'post_date' => '30.09.2017',
				'post_author_link' => 'http://github.com/dp0613',
				'post_author_name' => 'dp0613',
				'post_contents' => '<p>Chào mừng đến với <b>Ducky Framework</b>!</p><p>Chúc mừng bạn đã cài đặt thành công Ducky Framework. Để tìm hiểu thêm, vui lòng đọc tài liệu của chúng tôi <a href="http://duckydocs.readthedocs.org">tại đây</a>.</p>'
			);
			
			App::_getViewObject() -> assignContents($contents);
		}
		
	}
?>