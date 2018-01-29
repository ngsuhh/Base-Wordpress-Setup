<?php
	
	////////////////////////////////////////////////
	// Numberic Pagination Function
	// https://www.evan-herman.com/how-to-add-numeric-wordpress-pagination/
	////////////////////////////////////////////////
	function pagination($pages = '', $range = 5) {
		$showitems = ($range * 2)+1;

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;

			if(!$pages) {
				$pages = 1;
			}
		}

		if(1 != $pages) {

			// Previous Arrow
			if ($paged == 1) {
				echo '<a> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve" class="faded prev"> <path d="M22.6,11.8l-5.4,5.4c-0.4,0.4-1,0.4-1.4,0c-0.4-0.4-0.4-1,0-1.4l3.7-3.7L1,12.2c-0.3,0-0.5-0.1-0.7-0.3 C0.1,11.7,0,11.5,0,11.2c0-0.5,0.5-1,1-1l18.6,0l-3.7-3.7c-0.4-0.4-0.4-1,0-1.4c0.4-0.4,1-0.4,1.4,0l5.4,5.4 C23.2,10.8,23,11.5,22.6,11.8z" class="st0"></path> </svg> </a>';
			}
			else {
				echo '<a href="' . get_pagenum_link(1) . '"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve" class="prev"> <path d="M22.6,11.8l-5.4,5.4c-0.4,0.4-1,0.4-1.4,0c-0.4-0.4-0.4-1,0-1.4l3.7-3.7L1,12.2c-0.3,0-0.5-0.1-0.7-0.3 C0.1,11.7,0,11.5,0,11.2c0-0.5,0.5-1,1-1l18.6,0l-3.7-3.7c-0.4-0.4-0.4-1,0-1.4c0.4-0.4,1-0.4,1.4,0l5.4,5.4 C23.2,10.8,23,11.5,22.6,11.8z" class="st0"></path> </svg> </a>';
			}

			// Numbers
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {

					if ($paged == $i) {
						echo "<a class=\"current\">".$i."</a>";
					}
					else {
						echo "<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
					}
				}
			}

			// Next Arrow
			if ($paged == $pages) {
				echo '<a> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve" class="faded"> <path d="M22.6,11.8l-5.4,5.4c-0.4,0.4-1,0.4-1.4,0c-0.4-0.4-0.4-1,0-1.4l3.7-3.7L1,12.2c-0.3,0-0.5-0.1-0.7-0.3 C0.1,11.7,0,11.5,0,11.2c0-0.5,0.5-1,1-1l18.6,0l-3.7-3.7c-0.4-0.4-0.4-1,0-1.4c0.4-0.4,1-0.4,1.4,0l5.4,5.4 C23.2,10.8,23,11.5,22.6,11.8z" class="st0"></path> </svg> </a>';
			}
			else {
				echo '<a href="' . get_pagenum_link($paged + 1) . '"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve"> <path d="M22.6,11.8l-5.4,5.4c-0.4,0.4-1,0.4-1.4,0c-0.4-0.4-0.4-1,0-1.4l3.7-3.7L1,12.2c-0.3,0-0.5-0.1-0.7-0.3 C0.1,11.7,0,11.5,0,11.2c0-0.5,0.5-1,1-1l18.6,0l-3.7-3.7c-0.4-0.4-0.4-1,0-1.4c0.4-0.4,1-0.4,1.4,0l5.4,5.4 C23.2,10.8,23,11.5,22.6,11.8z" class="st0"></path> </svg> </a>';
			}


		}
	}
