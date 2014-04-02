<?php

class Controller_test extends Controller
{
	public function index()
	{
		$this->model("test", false, true);	
		$data = array();
		$data["owners"] = $this->test->getOwners();
		$data["table_name"] = "Alexamara Owners";
		
		$this->view("test/header");
		$this->view("test/content", $data, true);
		$this->view("test/footer");
		$this->css("test");
	}
	
	public function query($where = "")
	{
		$this->database();
		$this->model("test", "", $this->db);
		
		$data = array();
		$data["owners"] = $this->test->getOwners($where);
		
		$this->view("test/header");
		$this->view("test/content", $data);
		$this->view("test/footer");
	}
}

?>