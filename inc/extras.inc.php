<?php

        if (isset($_GET['arg']))
                $arg = bindec( $_GET['arg'] );
        else
                $arg = 0;

        connectDB();


        $suffix = "";

        if ($arg)
        {
		$extra = mysql_query("SELECT * FROM nw_extra WHERE extraID=" . $arg);
		$b = mysql_fetch_array($extra);

                $suffix    = "<a href=\"/neuromancer/port/443/\">extras</a> :: " . $b['extraName'];
		//$extra_str  = "\t\t<h2>" . $b['extraName'] . "</h2>";
		$extra_str = "\t\t<br/>" . link_words( $b['writeup'] ) . "\n"; 
	
        } else
        {
                $suffix = "extras";
        }

        echo "<h1><a href=\"/neuromancer/port/21/\">root</a> :: ". $suffix  ."</h1>";

	if (!isset($_GET['arg']))
	{

		$series = mysql_query("SELECT DISTINCT seriesName FROM nw_extra");
		$sc = mysql_num_rows($series);
	
		for( $i=0;$i<$sc;$i++)
		{
	
			$s 	= mysql_fetch_array($series);
			$extra 	= mysql_query("SELECT * FROM nw_extra WHERE seriesName=\"".$s['seriesName'] ."\" ORDER BY extraID ASC");
			$bc 	= mysql_num_rows($extra); 
			echo "\t\t<h2>" . $s['seriesName'] . "</h2>\n";

			for ($j=0;$j<$bc;$j++)
			{
				$b = mysql_fetch_array($extra);
				echo "\t\t<a href=\"/neuromancer/port/443/".decbin($b['extraID'])."/\">" .$b['extraName'] ."</a><br />\n";
			}
		}
	} else
	{
		echo $extra_str;
	}	

?>
