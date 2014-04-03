<?php

function varname($name)
{
	if(preg_match("/^[_a-zA-Z][_a-zA-Z0-9]*$/", $name))
		return true;
	return false;
}

?>