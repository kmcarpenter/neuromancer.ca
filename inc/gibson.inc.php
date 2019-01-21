<?php
	
        if (isset($_GET['arg']))
                $arg = bindec( $_GET['arg'] );
        else
                $arg = 0;

        connectDB();


        $suffix = "";

        if ($arg)
        {
		$gib = mysql_query("SELECT * FROM nw_gibson WHERE gibsonID=" . $arg);
		$g = mysql_fetch_array($gib);

		//$gib_str  = "\t\t<h2>" . $g['title'] . "</h2>\n";
		$gib_str = "\t\t<br />" . link_words( $g['details'] ) . "\n"; 

                $suffix   = "<a href=\"/neuromancer/port/666/\">gibson</a> :: " . $g['title'];
        } else
        {
                $suffix = "gibson";
        }

        echo "<h1><a href=\"/neuromancer/port/21/\">root</a> :: ". $suffix  ."</h1>";
	
	connectDB();

	if (!isset($_GET['arg']))
	{
		echo "\t\t<br />\n";
		$gibs = mysql_query("SELECT * FROM nw_gibson");
		$gc   = mysql_num_rows($gibs);
		for ($j=0;$j<$gc;$j++)
		{
			$g = mysql_fetch_array($gibs);
			echo "\t\t<a href=\"/neuromancer/port/666/".decbin( $g['gibsonID'] )."/\">" . $g['title'] ."</a><br />\n";
		}
	} else
	{
		echo $gib_str;
	}	

?>
