<?php

//URI Handling Functions
function sanitize($uri)
{
	$uri = preg_replace("/[^a-zA-Z0-9_\-\/\.\=\?\+\:\#]/", "", $uri);
	return $uri;
}

function uri2array($uri)
{
	$uri_array = explode("/", $uri);
	$uri_array = array_filter($uri_array);
	$uri_array = array_values($uri_array);
	array_shift($uri_array);
	return $uri_array;
}

function not_found($page, $type)
{
	die("The $type $page could not be found.");
}

?>