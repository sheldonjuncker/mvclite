<?php

class Controller
{
	protected $cache = null;
	
	protected function view($name, $data = array(), $template = false)
	{
		$view_path = MVC::getPath("views") . "/$name.php";
		if(file_exists($view_path))
		{
			if(is_array($data))
			{
				foreach($data as $key => $value)
				{
					if(is_string($key) AND varname($key) AND !isset(${$key}))
						${$key} = $value;
				}
			}
			
			if($template)
			{
				$view = file_get_contents($view_path);
				preg_match_all("/\{[a-zA-Z0-9_]+\}/", $view, $matches);
				$matches = $matches[0];
				foreach($matches as $m)
				{
					$ms = substr($m, 1, -1);
					if(isset(${$ms}))
					{
						$view = str_replace($m, ${$ms}, $view);
					}
				}
				eval('?>' . $view);
			}
			
			else
			{
				require($view_path);
			}
		}
		
		else
		{
			die("View $name does not exist.");
		}
	}
	
	protected function model($name, $alias=false, $db=false)
	{
		$model_path = MVC::getPath("models") . "/$name.php";
		if(file_exists($model_path))
		{
			require($model_path);
			$class = "Model_" . $name;
			if($alias)
			{
				$this->$alias = new $class($db);
			}
			
			else
			{
				$this->$name = new $class($db);
			}
		}
		
		else
		{
			die("Model $name does not exist.");
		}
	}
	
	protected function css($name, $data = array())
	{
		$css_path = MVC::getPath('css') . "/$name.css";
		if(file_exists($css_path))
		{
			$css = file_get_contents($css_path);
			
			foreach($data as $var => $val)
			{
				$css = str_replace("@$var", $val, $css);
			}
			
			$css = "<style type='text/css'>" . $css . "</style>";
			print $css;
		}
	}
	
	protected function js($name)
	{
		$js_path = MVC::getPath("js") . "/$name.js";
		if(file_exists($js_path))
		{
			$js = file_get_contents($js_path);
			
			$js = "<script>" . $js . "</script>";
			print $js;
		}
	}
}

?>