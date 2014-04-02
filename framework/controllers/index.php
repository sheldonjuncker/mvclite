<?php

class Controller_index extends Controller
{
	public function index()
	{
		print "Welcome to MVCLite!";
	}
	
	public function error($e = "?")
	{
		die("The page <b>$e</b> could not be found!");
	}
}

?>