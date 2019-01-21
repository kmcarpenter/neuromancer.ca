<?php
        require "defines.inc.php";

        function connectDB()
        {
                $link = mysql_connect(DB_HOST,DB_USER,DB_PASS);
                mysql_select_db(DB_NAME);
                return $link;
        }

        function closeDB($link)
        {
                if ($link)
                {
                        mysql_close($link);
                }
        }

	function makeZeroesAndOnes($count, $break=TRUE)
	{
		$str = "";
		srand( ((int)((double)microtime()*1000003)));
		for ($i = 0; $i < $count; $i++)
			$str .= ( rand(0,1) ? "1" : "0" );

		if ($break)
			$str .= "\n";

		return $str;
	}


	function makeMona()
	{
		srand( ((int)((double)microtime()*1000003)));

		$pic = rand(0,2);
		if ($pic == 0)
			$mona = file("./inc/mona.txt");
		else if ($pic == 1)
			$mona = file("./inc/zero.txt");
		else if ($pic == 2)
			$mona = file("./inc/neuro.txt");
		else
			$mona = file("./inc/mona.txt");

		for ($j = 0; $j < count($mona); $j++)
		{
			$span = "<span class='zeroes' id='row".$j."' onmouseover='headMouseOver(1);' onmouseout='headMouseOut(1);'>";
			$stop = "</span>";
			$spnd = FALSE;
			$stpd = FALSE;
			$line = $mona[$j];
			$len  = strlen($line);
			$str .= makeZeroesAndOnes(25, FALSE);
			for ($i=0;$i<$len;$i++)
			{
				if ($line[$i] == "\n")
				{
					$x = 0;
				} else if ($line[$i] == '#')
				{
					if ($spnd && !$stpd)
					{
						$str .= $stop;
						$stpd = TRUE;
					}				
					$str .= ( rand(0,1) ? "1" : "0" );
				} else
				{
					if (!$spnd)
					{
						$spnd = TRUE;
						$str .= $span;
					}
					$str .= $line[$i];
				}
			}
			$str .= makeZeroesAndOnes(25);
		} 
		return $str;
	}

	function doNeuroHead($showMona = TRUE)
	{
        	echo "<div id=\"header\">\n";
		echo "<pre><span class='zeroes'>";	
	
        	echo makeZeroesAndOnes(130);
        	echo makeZeroesAndOnes(47, FALSE);
		echo "<span class='zeroes' id='head_top' onmouseover='headMouseOver(".$showMona.");' onmouseout='headMouseOut(".$showMona.");'>";
		echo "._  _    .__ ._ _  _.._  _ _ ._ _ _.";
		echo "</span>";
        	echo makeZeroesAndOnes(47);
        	echo makeZeroesAndOnes(47, FALSE);
		echo "<span class='zeroes' id='head_bot' onmouseover='headMouseOver(".$showMona.");' onmouseout='headMouseOut(".$showMona.");'>";
		echo "| |(/_|_||(_)| | |(_|| |(_(/_|o(_(_|";
		echo "</span>";
        	echo makeZeroesAndOnes(47);
        	echo makeZeroesAndOnes(130);
		if ($showMona)
		{
        		echo makeZeroesAndOnes(130);
			echo makeMona();
        		echo makeZeroesAndOnes(130);
        		echo makeZeroesAndOnes(130);	
			$_SESSION['showed_mona'] = TRUE;
		}
		echo "</span></pre>\n";
	        echo "</div>\n";
	
		if ($showMona)
		{		
			echo "<div class=\"menu\">\n\t<a href='/neuromancer/port/21/'>ENTER THE MATRIX</a>\n</div>\n";
		}
	}

	function doNeuroFoot()
	{
		echo "<div id=\"footer\"><p class='footer'><a href=\"http://validator.w3.org/check?uri=referer\">Valid HTML</a>&copy; 2005 Michael Carpenter/Zenwerx Custom Programming unless otherwise stated.<br/>Neuromancer, Count Zero, and other books are property of William Gibson and Penguin Putnam.</p></div>";
	}

	function html_decode($html)
	{
		$escaped = array( "&gt;", "&lt;", "&nbsp;" );
		$tags 	 = array( ">", "<", " " );
		return str_replace( $escaped, $tags, $html);
	}


	function dir_contents($dir, $filters)
	{
	        $handle=opendir($dir);
	        $files=array();
       	 	if ($filters == "all"){while(($file = readdir($handle))!==false){$files[] = $file;}}
        	if ($filters != "all")
	        {
                	$filters=explode(",",$filters);
        	        while (($file = readdir($handle))!==false)
                	{
                        	for ($f=0;$f<sizeof($filters);$f++):
                        	       	$system=explode(".",$file);
                	        	if ($system[1] == $filters[$f]){$files[] = $file;}
	                        endfor;
        	        }
        	}
        	closedir($handle);
        	return $files;
	}

	function link_words($text)
	{
		return $text;
	}
?>
