<?php

function is_assoc($array)
{
	return (bool)count(array_filter(array_keys($array), 'is_string'));
}

?>