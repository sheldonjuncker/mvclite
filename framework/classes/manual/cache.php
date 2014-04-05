<?php

error_reporting(E_ALL);

class Cache
{
	#State
	public $state = "no";
	
	#Errors
	public $errors = array();
	
	#Socket
	private $socket = null;
	
	#Maxlength to Read
	private $max = 1000000;
	
	#Connect To Server
	public function connect($host = "127.0.0.1", $port = 1994)
	{
		@$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) 
			OR
		$this->errors[] = "Could not create socket on $host:$port.";
		
		@socket_connect($this->socket, $host, $port)
			OR
		$this->errors[] = "Could not connect to socket on $host:$port";
		
		if(count($this->errors) == 0 AND $this->socket != NULL)
			$this->state = "ok";
			
		print $this->state;
	}
	
	#Server Action
	public function action($action, $alias, $path = 0, $expires = 0)
	{
		if($this->state == "ok")
		{
			$message = "$action $alias $path $expires";
		
			socket_write($this->socket, $message, strlen($message))
				OR
			$this->errors[] = "Could not write to the socket.";

			$result = socket_read($this->socket, $this->max)
				OR
			$this->errors[] = "Could not read response from server.";
			
			if(count($this->errors) == 0)
				return $result;
			else
				return "no";
		}
		
		else
		{
			return "no";
		}
	}
	
	#Add a File
	public function add($alias, $path, $expires)
	{
		return $this->action("add", $alias, $path, $expires);
	}
	
	#Get a File
	public function get($alias)
	{
		return $this->action("get", $alias);
	}
	
	#Upadate a File
	public function update($alias)
	{
		return $this->action("update", $alias);
	}
	
	#Delete a File
	public function delete($alias)
	{
		return $this->action("update", $alias);
	}
}

?>