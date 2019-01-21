<?php

	echo "<h1><a href=\"/neuromancer/port/21/\">root</a> :: faq</h1>";

	connectDB();
	if(($result=mysql_query("SELECT * FROM nw_faq")))
	{
		$a = array();
		$c = mysql_num_rows($result);
		for ($i=0;$i<$c;$i++)
		{
			$row = mysql_fetch_array($result);
			$a[$i] = array( $row['question'], $row['answer'] );

			echo "<p><a href=\"#answer".$i."\">".$row['question']."</a></p>";
		}

		echo "<br /><br />";

		for ($i=0;$i<$c;$i++)
		{
			echo "<div class=\"pic\" style=\"padding: 5px; background-color: #EEE;\">";
			echo "<a name=\"answer".$i ."\"></a>";
			echo "<p>Question:<br />" . link_words( $a[$i][0] ) . "</p>"; 
			echo "<p>Answer:<br />" . link_words( $a[$i][1] ) . "</p>"; 
			echo "</div><br />";
		}
	} else
	{
		echo "<p>The FAQ is unavailable at the moment...</p>";
	}
?>
