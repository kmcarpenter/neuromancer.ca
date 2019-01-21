<?php

  // for sanity's sake... redefine these variables, just in case they got overwritten

  $cachedir = '/home/ahsile/www/zenwerx.com/neuromancer/cache/'; // Directory to cache files in (keep outside web root)
  $cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
  $page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // Requested page
  $cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
  if ($caching)
  {

	  // Now the script has run, generate a new cache file
	  $fp = @fopen($cachefile, 'w');

	  // save the contents of output buffer to the file
	  @fwrite($fp, ob_get_contents());
	  @fclose($fp);

	  ob_end_flush(); 
  }

?>
