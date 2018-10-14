<?php
	$url = explode("/", $_SERVER['REQUEST_URI']);
	$controller = $url[2];
	$_SERVER['REQUEST_URI'] = "/".implode("/", array_slice($url, 3));

	switch ($controller) {
		default:
			echo "Nothing to see.";
			break;
	}
?>