<?php

        if (isset($_GET['arg']))
                $arg = bindec( $_GET['arg'] );
        else
                $arg = 0;

        connectDB();


        $suffix = "";

        if ($arg)
        {
		$book = mysql_query("SELECT * FROM nw_books WHERE bookID=" . $arg);
		$b = mysql_fetch_array($book);

                $suffix    = "<a href=\"/neuromancer/port/80/\">books</a> :: " . $b['bookName']. " (" . $b['published']. ")";
		//$book_str  = "\t\t<h2>" . $b['bookName'] . " (" .  $b['published'] . ")</h2>";
		$book_str = "\t\t<br />" . link_words($b['writeup']) . "\n"; 
	
        } else
        {
                $suffix = "books";
        }

        echo "<h1><a href=\"/neuromancer/port/21/\">root</a> :: ". $suffix  ."</h1>";

	if (!isset($_GET['arg']))
	{

		$series = mysql_query("SELECT DISTINCT seriesName FROM nw_books");
		$sc = mysql_num_rows($series);
	
		for( $i=0;$i<$sc;$i++)
		{
	
			$s 	= mysql_fetch_array($series);
			$books 	= mysql_query("SELECT * FROM nw_books WHERE seriesName=\"".$s['seriesName'] ."\" ORDER BY bookID ASC");
			$bc 	= mysql_num_rows($books); 
			echo "\t\t<h2>" . $s['seriesName'] . "</h2>\n";

			for ($j=0;$j<$bc;$j++)
			{
				$b = mysql_fetch_array($books);
				echo "\t\t<a href=\"/neuromancer/port/80/".decbin($b['bookID'])."/\">" . $b['bookName']. " (" . $b['published'] .")</a><br />\n";
			}
		}
	} else
	{
		echo $book_str;
	}	

?>
