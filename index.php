<?php
	$url = explode("/", $_SERVER['REQUEST_URI']);
	$controller = $url[2];
	$_SERVER['REQUEST_URI'] = "/".implode("/", array_slice($url, 3));
	set_include_path($_SERVER["DOCUMENT_ROOT"]."/tugasbesar1_2018/");

	switch ($controller) {
		case 'login':
			require "controllers/login.php";
			break;
		case 'register':
			require "controllers/register.php";
			break;
		default:
			echo "Nothing to see.";
			break;
	}
?>