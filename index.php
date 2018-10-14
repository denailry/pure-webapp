<?php
	$request_url = explode("/", $_SERVER['REQUEST_URI']);
	$controller = $request_url[2];
	$_SERVER['REQUEST_URI'] = "/".implode("/", array_slice($request_url, 3));
	set_include_path($_SERVER["DOCUMENT_ROOT"]."/tugasbesar1_2018/");

	$available_urls = array(
		"login",
		"register"
	);
	
	$url_matched = false;
	foreach ($available_urls as $url) {
		if ($url == $controller) {
			require "controllers/".$url.".php";
			$url_matched = true;
			break;
		}
	}
	if (!$url_matched) {
		echo "Nothing to see.";
	}
?>