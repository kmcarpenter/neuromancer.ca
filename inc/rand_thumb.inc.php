<?php
	function getRandThumb()
	{

		$dir   = THUMBS_DIR;
		$gal   = GALLERY_DIR;
		$patht = substr($dir, 28);
		$files = dir_contents($dir, "jpg");
		$count = count($files);
		srand( ((int)((double)microtime()*1000003)));
		$i = rand(0, ($count - 1));	
	
		$f = $files[$i];
		
		$str .= "<a href=\"/neuromancer/port/8080/". decbin( $i ) . "/\" title=\"Click for full sized image\"><img src=\"". $patht .$f . "\" alt=\"".$f."\" /></a>";

		return $str;

	}
?>
