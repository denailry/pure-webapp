<?php
	require "configs/db.php"; 

	$clean_url = explode("?", $_SERVER['REQUEST_URI'])[0];
	$request_url = explode("/", $clean_url);

	$controller = $request_url[1];
	$_SERVER['REQUEST_URI'] = "/".implode("/", array_slice($request_url, 3));

	$available_urls = array(
        'book-detail',
        'edit-profile',
        'history',
        "login",
        "logout",
        'profile',
        "register",
        'review',
        'search-result',
        'search'
	);

	$url_matched = false;
	foreach ($available_urls as $url) {
		if ($url == $controller) {
			require "controllers/".$url.".php";
			$url_matched = true;
			break;
		}
	}
	if (strlen($controller) == 0) {
		require "controllers/home.php";
	} else if (!$url_matched) {
		echo "Nothing to see.";
	}
?>