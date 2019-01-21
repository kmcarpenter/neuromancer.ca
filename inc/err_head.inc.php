<?php

	$error = TRUE;

	require_once( "functions.inc.php" );
	require_once( "header.inc.php" );

        $url= "http://www.williamgibsonbooks.com/blog/blogger_rss.xml";

        echo "\n\n<!-- Left Box: Undecided -->\n";
        echo "<div id=\"leftfill\">";

        require_once('news.inc.php');

        $theNews = new News();

        echo "\n<!-- News Section -->\n";
        echo "<div id=\"news\">\n";
        $theNews->printNewsAuto();
        echo "</div>";
        echo "</div>\n";

        require_once('lastRSS.inc.php');

        $rss = new lastRSS;
        $rss->cache_dir = "./cache";
        $rss->cach_time = 300;

        echo "\n\n<!-- Right Box: Gibson Blog RSS -->\n";
        echo "<div class=\"rightfill\">";
        echo "<div id='gibson_blog' class=\"Box RHS\">\n";
        if ($rs = $rss->get($url))
        {
                echo "\t<p><a href=\"".$rs["link"]."\">".$rs["title"]."</a></p>\n";
                foreach ($rs["items"] as $item)
                {
                        echo "\t\t<p><a href=\"" . $item["link"] . "\">" . $item["title"]." - " . $item["date"] . "</a></p>\n";
                        echo "\t\t<p>" . html_decode($item["description"]) . "</p>\n";

                }
        } else
        {
                echo "\t<p>William Gibson's Blog seems to be broken...</p>\n";
        }
        echo "</div>";
        echo "</div>\n";

        echo "<!-- Random Picture -->";
        require_once( "rand_thumb.inc.php" );

        echo "<div class=\"rightfill\">\n";
        echo "<div class=\"Box RHS\">\n";
        echo "<div class=\"menu\">\n";
        echo "<p>Random Image</p>";
        echo "\t<div class=\"inline thumb\">". getRandThumb() . "</div>\n";
	echo "</div>\n";
        echo "</div>\n";
        echo "</div>\n";
        echo "<div id=\"mainbody\">";
?>
