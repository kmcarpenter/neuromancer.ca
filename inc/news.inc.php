<?php

	class News
	{
		var $curResult;
		var $curItem;
		var $connected;
		var $lastArchiveNum;
		function News() 
		{
			$this->curResult = NULL;
			$this->curItem   = NULL;
			connectDB();

			$this->connected = true;

			$cnt = mysql_query("SELECT COUNT(*) FROM nw_news");
			$cnt = mysql_fetch_row($cnt);
			$this->lastArchiveNum = $cnt[0];


	 	}

		function GetNews()
		{
			if (!$this->connected)
			{
				connectDB();
			}

			$query 	 = "SELECT * FROM nw_news ORDER BY NewsDate DESC LIMIT " . MAX_NEWS;
			$this->curResult = mysql_query($query);
			$this->lastArchiveNum = 0;
	
			return ($this->curResult!=false);		
		}

		function GetArchivedNews($Start)
		{
			if (!$this->connected)
			{
				connectDB();
			}
			if (!$Start)
				$Start = 0;

			$query = "SELECT * FROM nw_news WHERE NewsID<=". $Start . " ORDER BY NewsDate DESC LIMIT " . MAX_NEWS;

			$this->curResult = mysql_query($query);

			return ($this->curResult!=false);
		}
		
		function PrintNews()
		{
			if (!$this->curResult) return false;

			if (!($this->curItem = mysql_fetch_array($this->curResult)))
			{
				return false;
			}
			echo "\t<tr><td><br />\n";
			echo "\t\t<div class=\"newsheader\"><h1>" . $this->curItem['HeadLine'] . "<br />".$this->curItem['NewsDate']."</h1></div>\n";
			echo "\t\t<div><p class=\"author\"> - " . $this->curItem['Author'] . "</p>";
			echo "\t\t<p class='newsbody'>" . $this->curItem['Body'] . "</p></div>\n";
			echo "\t</td></tr>\n";

			return true;
		}
	
		function PrintNewsHeader()
		{
			$str = "<table>";
			echo $str;
		}
		function PrintNewsFooter()
		{
			$str  = "\t<tr><td><br /><p class='footer'>News Generated: " . date("G:i:s T")."</p></td></tr>\n</table>\n";
			echo $str;
		}

		function PrintArchiveLink()
		{
			$str = "<tr><td><br /><a href='/port/999/'>Older News</a></td></tr>";
			echo $str;
		}

		function PrintNewsAuto()
		{
			$this->PrintNewsHeader();
			if ($this->GetNews())
			{	
				while ($this->PrintNews());
				$cnt = mysql_query("SELECT COUNT(*) FROM nw_news");
				if ($cnt)
				{
					$cnt = mysql_fetch_row($cnt);
					/*if ($cnt[0] > MAX_NEWS)
						$this->PrintArchiveLink();*/
				}
			}
			else
			{
				echo "\t<tr><td>No News!</td></tr>\n";
			}
			$this->PrintNewsFooter();
		}

		function PrintArchiveAuto($start)
		{
			if ($start)
			{
				if ($start > 0)
					$this->lastArchiveNum=$start;
				else
				{
					$cnt = mysql_query("SELECT COUNT(*) FROM nw_news");
					$cnt = mysql_fetch_row($cnt);
					$cnt = $cnt[0];
					$this->lastArchiveNum=$cnt;
				}
			}

			$this->GetArchivedNews($this->lastArchiveNum);

			while($this->PrintNews());
			$this->PrintPageCount();
			$this->PrintNewsFooter();
		}

		function PrintPageCount()
		{
			$query = "SELECT COUNT(*) AS Cnt FROM nw_news";
			$result = mysql_query($query);
			if ($result)
			{
				$cnt = mysql_fetch_row($result);
				$cnt = $cnt[0];
				$pages = (int)($cnt / MAX_NEWS) + 1;
				$curPage = (int)(($cnt-$this->lastArchiveNum)/MAX_NEWS);
				echo "\t<tr><td>\n\t\t<br />Choose a Page:<br />";
				for ($i = 0; $i < $pages; $i++)
				{
					if (($i) != $curPage) 
						echo "\t\t<a href='./port/7/999/".($cnt-(MAX_NEWS*($i))) ."/'>" .($i + 1)."</a>\n";
					else
						echo ($i+1);
				} 
				echo "<br /></td></tr>\n";
			}
		}
	}	
?>
