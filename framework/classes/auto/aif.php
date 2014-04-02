<?php

#Auto Including Functions

class AIF
{
	public static function __callStatic($name, $args)
	{
		if(!function_exists($name))
			require_once("framework/functions/manual/$name.php");
		call_user_func_array($name, $args);
	}
}

?>