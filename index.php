<?php
require_once( "functions.inc.php" );
require_once( "header.inc.php" );

if (isset($_GET['port']))
{
	$url= "http://www.williamgibsonbooks.com/blog/blogger_rss.xml";

	echo "\n\n<!-- Left Box: Undecided -->\n";
	echo "<div id=\"leftfill\">\n";

	require_once('news.inc.php');

        $theNews = new News();

        echo "\n<!-- News Section -->\n";
        echo "<div id=\"news\">\n";
        $theNews->printNewsAuto();
        echo "</div>";
        echo "</div>\n";

	echo "<div id=\"rigtfill-ads\" class=\"Box RHS\">\n";
	require_once('google_ad.inc.php');
	echo "</div>";

	echo "<!-- Random Picture -->\n";
	require_once( "rand_thumb.inc.php" );

	echo "<div class=\"Box RHS\">\n";
	echo "<div class=\"menu\">\n";
	echo "<p>Random Image</p>\n";
	echo "\t<div class=\"inline thumb\">\n\t". getRandThumb() . "</div>\n";
	echo "</div>\n";
	echo "</div>\n";


	require_once('lastRSS.inc.php');

        $rss = new lastRSS;
        $rss->cache_dir = "./cache";
        $rss->cach_time = 300;
	$rs = $rss->get($url);

	echo "\n\n<!-- Right Box: Gibson Blog RSS -->\n";
	echo "<div id=\"rightfill\">\n";
        echo "<div id='gibson_blog' class=\"Box RHS\">\n";
        if ($rs)
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
        echo "</div>\n";

	echo "</div>\n";

	echo "<div id=\"mainbody\">";

	if (ENABLE_CACHE)
	{
		// Start Caching
		require "cache.inc.php";
	}
	if ($caching)
	{

	switch ($_GET['port'])
	{
		default:
		case 21:
			mainBody();
			break;
		case 80:
			showBooks();
			break;
		case 22:
			showMovies();
			break;
		case 666:
			showGibson();
			break;
		case 5800:
			showFAQ();
			break;
		case 443:
			showExtras();
			break;
		case 8080:
			showGallery();
			break;
	}

	}

	if (ENABLE_CACHE)
	{
		// End caching
		require "endcache.inc.php";
	}
	
	echo "</div>";
}

function mainBody()
{
	require( "mainbody.inc.php" );
}

function showBooks()
{
	require( "books.inc.php" );
}

function showMovies()
{
	require( "movies.inc.php" );
}

function showGibson()
{
	require( "gibson.inc.php" );
}

function showFAQ()
{
	require( "faq.inc.php" );
}

function showExtras()
{
	require( "extras.inc.php" );
}

function showGallery()
{
	require( "gallery.inc.php" );
}

require_once( "footer.inc.php" );
?>
