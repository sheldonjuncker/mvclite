<?php

class Post
{
	public $num = 0;
	public $conflicts = 0;
	public $badnames = 0;
	private $all = array();
	
	public function __construct()
	{
		foreach($_POST as $key => $value)
		{
			if(!isset($this->$key))
			{
				if($this->varname($key))
				{
					$this->set($key, sanitize($value));
					$this->num++;
				}
				
				else
				{
					$this->badnames++;
				}
			}
			
			else
			{
				$this->conflicts++;
			}
		}
		
		unset($_POST);
	}
	
	public function varname($name)
	{
		if(preg_match("/^[_a-zA-Z][_a-zA-Z0-9]*$/", $name))
			return true;
		return false;
	}
	
	public function sanitize($value)
	{
		#Add Necessary Sanitization Here
		return $value;
	}
	
	public function set($key, $value = false)
	{
		if($this->varname($key))
		{
			$this->$key = $value;
			$this->all[$key] = $value;
		}
		
		else
		{
			$this->badnames++;
		}
	}
	
	public function get($set = false)
	{
		if($set)
		{
			$set = array();
			foreach($this->all as $key => $value)
			{
				if($value)
					$set[$key] = $value;
			}
			return $set;
		}
		
		else
			return $this->all;
	}
	
	public function __get($name)
	{
		return false;
	}
}

$GLOBALS["p"] = new Post();

?>