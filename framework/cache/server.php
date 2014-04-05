<?php

error_reporting(E_ALL);

$host = "127.0.0.1";
$port = 1994;
$cache = array();

set_time_limit(0);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");

$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");

$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

while($spawn = socket_accept($socket))
{
	$input = socket_read($spawn, 1024) or die("Could not read input\n");
	$input = trim($input);
	$command = explode(" ", $input);

	$output = "no";
	$action = $command[0];
	$name = $command[1];
	$file = $command[2];
	$expires = $command[3];
	
	//Get a File from Memory
	if($action == "get")
	{
		//Chache Entry Exists
		if(isset($cache[$name]))
		{
			$expires = $cache[$name]["expires"];
			if($expires < time())
			{
				$file = $cache[$name]["file"];
				if(file_exists($file))
				{
					$created = $cache[$name]["created"];
					$contents = file_get_contents($file);
					$cache[$name]["contents"] = $contents;
					$cache[$name]["expires"] = time() + ($ed - $created);
					$cache[$name]["created"] = time();
					$output = $contents;
				}
				
				else
				{
					unset($cache[$name]);
				}
			}
			
			else
			{
				$output = $cache[$name]["contents"];
			}
		}
	}
	
	else if($action == "add")
	{
		if(file_exists($file))
		{
			$contents = file_get_contents($file);
			$cache[$name] = array();
			$cache[$name]["contents"] = $contents;
			$cache[$name]["file"] = $file;
			$cache[$name]["created"] = time();
			$cache[$name]["expires"] = $expires;
			$output = "ok";
		}
	}
	
	else if($action == "update")
	{
		if(isset($cache[$name]))
		{
			$file = $cache[$name]["file"];
			if(file_exists($file))
			{
				$created = $cache[$name]["created"];
				$contents = file_get_contents($file);
				$cache[$name]["contents"] = $contents;
				$cache[$name]["expires"] = time() + ($ed - $created);
				$cache[$name]["created"] = time();
				$output = "ok";
			}
			
			else
			{
				unset($cache[$name]);
			}
		}
	}
	
	else if($action == "delete")
	{
		if(isset($cache[$name]))
		{
			unset($cache[$name]);
			$output =  "ok";
		}
	}

	if($output == "")
		$output = "0";
	
	socket_write($spawn, $output, strlen($output)) or die("Could not write output\n");
	// close sockets
	socket_close($spawn);
}
socket_close($socket);

?>