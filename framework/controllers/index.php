<?php

class Controller_index extends Controller
{
	public function index()
	{
		$this->model("index", false, true);
		$data = array(
			"msg" => "<p>Welcome to MVClite!</p>"
		);
		$this->view("index", $data, true);
		$this->view("content", $this->index->getOwners());
	}
	
	public function error($e = "?")
	{
		die("The page <b>$e</b> could not be found!");
	}
}

?>