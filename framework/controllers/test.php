<?php

class Controller_test extends Controller
{
	public function index()
	{
		$this->model("test", false, true);
		$this->view("content", $this->test->getSlips(), true);
	}
	
	public function error($e = "?")
	{
		die("The page <b>$e</b> could not be found!");
	}
}

?>