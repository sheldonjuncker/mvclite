<?php

class Mvclite
{
	#Base Path
	public static $base_path;

	#Construct
	function __construct($base_path = "framework", $load = false)
	{
		#Post Variable
		$GLOBALS["p"] = false;
	
		#Set Base Path
		self::$base_path = $base_path;

		#Load Classes
		$this->loadClasses();
		
		#Load Functions
		$this->loadFunctions();
		
		#Route Connection
		$this->routeConnection();
	}
	
	public static function getPath($of = "base")
	{
		$bp = self::$base_path;
		if($of == "base")
			return $bp;
		else
			return $bp . "/" . $of;
	}
	
	private function loadClasses()
	{
		if(!empty($_POST))
			require_once(self::getPath("classes/manual/post.php"));
		$class_path = self::getPath("classes/auto");
		foreach(glob($class_path . "/*.php") as $class)
		{
			require_once($class);
		}
	}
	
	private function loadFunctions()
	{
		$func_path = self::getPath("functions");
		foreach(glob($func_path . "/auto/*.php") as $func)
		{
			require_once($func);
		}
	}
	
	private function loadController($name)
	{
		$name = strtolower($name);
		$cpath = self::getPath("controllers") . "/$name.php";
		if(file_exists($cpath))
		{
			require_once($cpath);
			return true;
		}
		
		else
		{
			if($name == "index")
				die("Fatal Error: Could not find the index controller.");
			return false;
		}
	}
	
	private function routeConnection()
	{
		#Parse Request
		$uri = $_SERVER["REQUEST_URI"];
		$uri = sanitize($uri);
		$uri = uri2array($uri);
		
		#Load Index Controller
		$this->loadController("index");
		$index = new Controller_index();
		
		#Default Controller (index page)
		if(count($uri) == 0)
		{
			$index->index();
		}
		
		else
		{
			$com = array_shift($uri);
			if($this->loadController($com))
			{
				$cn = "Controller_$com";
				$c = new $cn;
				
				//Controller
				if(count($uri) == 0)
				{
					$c->index();
				}
				
				else
				{
					$m = array_shift($uri);
					if(method_exists($c, $m))
					{
						call_user_func_array(array($c, $m), $uri);
					}
					
					else
					{
						$i = new ReflectionMethod($c, "index");
						$pnum = $i->getNumberOfParameters();
						if($pnum > 0)
						{
							array_unshift($uri, $m);
							call_user_func_array(array($c, "index"), $uri);
						}
						
						else
						{
							//No Method
							if(method_exists($c, "error"))
								call_user_func_array(array($c, "error"), $uri);
							else
								$index->error($m);
						}
					}
				}
			}
			
			else if(method_exists($index, $com))
			{
				//Method of Index
				call_user_func_array(array($index, $com), $uri);
			}
			
			else
			{
				//No Controller or Method
				$index->error($com);
			}
		}
	}
}

?>
