<?php

class Model
{
	public function __construct($db = false)
	{
		if($db === true)
		{
			$this->database();
		}
		
		else if($db == true)
		{
			$this->database($db);
		}
	}
	
	public function database($name = "default", $alias = "db")
	{
		$db_path = MVC::getPath('databases') . "/$name.php";
		if(file_exists($db_path))
		{
			require($db_path);

			try {
				$db = new PDO("{$db_settings['type']}:dbname={$db_settings['name']};host={$db_settings['host']}", "{$db_settings['user']}", "{$db_settings['pass']}");
			} catch (PDOException $e) {
			die("I died. " . $e->getMessage());
			}
			$this->$alias = $db;
		}
		
		else
		{
			die("Database $name does not exist.");
		}
	}
}

?>