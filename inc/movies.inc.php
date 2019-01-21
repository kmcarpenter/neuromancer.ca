<?php
	
	if (isset($_GET['arg']))
		$arg = bindec( $_GET['arg'] );
	else
		$arg = 0;

	connectDB();


	$suffix = "";

	if ($arg)
	{
		$mov = mysql_query("SELECT * FROM nw_movies WHERE movieID=" . $arg);
		$m = mysql_fetch_array($mov);

		$suffix   = "<a href=\"/neuromancer/port/22/\">movies</a> :: " . $m['title'] . " (" . $m['year'] .")\n";
		//$mov_str  = "\t\t<h2>" . $m['title'] . " (" . $m['year'] . ")</h2>\n";
		$mov_str = "\t\t<p style=\"font-weight:bold;\">Status: " . ( $m['filmed'] ? "filmed" : "failed" ) . "</p>";
		$mov_str .= "\t\t" . link_words( $m['details'] ) . "\n"; 
	} else
	{
		$suffix = "movies";
	}

	echo "<h1><a href=\"/neuromancer/port/21/\">root</a> :: ". $suffix  ."</h1>";
	
	if (!$arg)
	{
		echo "\t\t<h2>Filmed</h2>\n";
		$movs = mysql_query("SELECT * FROM nw_movies WHERE filmed=1");
		$mc   = mysql_num_rows($movs);
		for ($j=0;$j<$mc;$j++)
		{
			$m = mysql_fetch_array($movs);
			echo "\t\t<a href=\"/neuromancer/port/22/".decbin($m['movieID'])."/\">" . $m['title'] ." (".$m['year'] . ")</a><br />\n";
		}

		echo "\t\t<h2>Failed</h2>\n";
		$movs = mysql_query("SELECT * FROM nw_movies WHERE filmed=0");
		$mc   = mysql_num_rows($movs);
		for ($j=0;$j<$mc;$j++)
		{
			$m = mysql_fetch_array($movs);
			echo "\t\t<a href=\"/neuromancer/port/22/".decbin($m['movieID'])."/\">" . $m['title'] ." (".$m['year'] . ")</a><br />\n";
		}		

	} else
	{
		echo $mov_str;
	}	

?>
