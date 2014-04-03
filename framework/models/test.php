<?php

class Model_test extends Model
{
	public function getSlips()
	{
		$owners = array();
		foreach($this->db->query("SELECT * FROM marina_slip;") as $owner)
		{
			$owners[] = $owner[2];
		}
		return $owners;
	}
}

?>