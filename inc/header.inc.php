<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>synaptic response :: neuromancer.ca</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="/neuro_icon.png" />
<style type="text/css" media="screen">
       	@import "/neuromancer/neuro.css";
</style>
<script type="text/javascript" src="/neuromancer/functions.js"></script>
</head>
<body>
<!-- Header/Intro Section -->
<?php
	if (!isset($_GET['port']) && !$error)
		doNeuroHead();
	else
	{
		doNeuroHead(FALSE);
		require_once("menu.inc.php");
	}
?>
