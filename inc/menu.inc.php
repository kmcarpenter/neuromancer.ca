<?php
	$menu = array( 
			array( "ROOT"		, "/neuromancer/port/21/"	)
			,array( "BOOKS"		, "/neuromancer/port/80/"	)
			,array( "MOVIES"	, "/neuromancer/port/22/"	)
			,array( "EXTRAS"	, "/neuromancer/port/443/"	) 
			,array( "GIBSON"	, "/neuromancer/port/666/"	) 
			,array( "FAQ"		, "/neuromancer/port/5800/"	)
			,array( "GALLERY"	, "/neuromancer/port/8080/"	)
			,array( "INTRO"		, "/neuromancer/"		)
		);

	$max = count($menu);

	shuffle($menu);

	echo "\n\n<!-- Menu Section -->\n";	
	echo "<div class=\"menu\" id='menu_row_top'>\n";
	for ($i = 0; $i < ($max/2); $i++)
	{
		echo "\t<a href=\"" . $menu[$i][1] . "\">". $menu[$i][0] . "</a>\n";
		if ($i != ($max/2 -1))
			echo "    ";
	}
	echo "</div>\n<div class=\"menu\" id='menu_row_bot'>\n";
	for (; $i <  $max; $i++)
	{
		echo "\t<a href=\"" . $menu[$i][1] . "\">". $menu[$i][0] . "</a>\n";
		if ($i != ($max -1))
			echo "    ";
	}
	echo "</div>\n\n";

?>
