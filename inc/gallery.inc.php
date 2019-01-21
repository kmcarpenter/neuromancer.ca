<?php

	$files = dir_contents(THUMBS_DIR, "jpg");
	$count = count($files);
	$patht = substr(THUMBS_DIR,28);
	$pathg = substr(GALLERY_DIR, 28);

	echo "<h1><a href=\"/neuromancer/port/21/\">root</a> :: gallery</h1>\n";

	if (!isset($_GET['arg']))
	{
		$cur  = 0;
	} else
	{
		$cur  = bindec( $_GET['arg'] );
	}

	if ($cur < 0)
		$cur = 0;
	if ($cur > ($count - 1))
		$cur = $count -1;

	$prev = max($cur-1, 0);
	$next = min($cur+1, $count-1);

	echo "\t<div class=\"inline thumb\" style=\"float: left;\">\n";
	if ($cur)
	{
		echo "\t\t<a href=\"/neuromancer/port/8080/".decbin( $prev )."/\" title=\"[Previous] ".substr($files[$prev],6)."\">";
		echo "<img src=\"".$patht.$files[$prev]."\" alt=\"".substr($files[$prev],6)."\" />";
		echo "<br />&lt; Previous</a>\n";
		
	} else
	{
		echo "Nowhere to Go!";
	}
	echo "\t</div>\n";
	
	echo "\t<div class=\"inline thumb\" style=\"float: right;\">\n";
	if ($cur < ($count -1))
	{
		echo "\t\t<a href=\"/neuromancer/port/8080/".decbin( $next )."/\" title=\"[Next] ".substr($files[$next],6)."\"><img src=\"".$patht .$files[$next]."\" alt=\"".substr($files[$next],6)."\" /><br/>Next &gt;</a>\n";
	} else
	{
		echo "Nowhere to Go!";
	}
	echo "\t</div>\n";

	echo "\t<br />\n";
	echo "\t<div class=\"thumb\" style=\"text-align: center;\">\n";
	echo "\t\t<img class=\"inline\" style=\"border-width: 1px; border-style: solid\" src=\"" . $pathg.substr($files[$cur],6) . "\" alt=\"".substr($files[$cur],6)."\" />\n"; 
	echo "\t</div>\n";

	echo "\t<br /><div style=\"text-align: center;\">\n";
	echo "\t\t<p>".substr($files[$cur],6)."</p>\n";	
	echo "\t\t<p>Image " . ($cur+1) . " of " . $count . "</p>\n";
	echo "\t</div>\n";
?>
