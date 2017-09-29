<?php 
	//Thử phần route
	class Home extends Controller
	{
		public function index()
		{
			$contents = array(
				'post_title' => 'BÀI VIẾT ĐẦU TIÊN',
				'post_date' => '20/10/2010',
				'post_author_link' => '#',
				'post_author_name' => 'dp0613',
				'post_contents' => 'Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus suscipit tortor eget felis porttitor volutpat.'
			);
			
			return $contents;
		}
		
	}
?>