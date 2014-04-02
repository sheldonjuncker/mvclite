<?php

class Controller_index extends Controller
{
	public function index()
	{
		$data = array(
			"msg" => "<p>Welcome to MVClite!</p>"
		);
		$this->view("index", $data, true);
	}
	
	public function error($e = "?")
	{
		die("The page <b>$e</b> could not be found!");
	}
}

?>