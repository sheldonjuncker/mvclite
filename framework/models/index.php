<?php

class Model_index extends Model
{
	public function getOwners()
	{
		$stmt = $this->db->prepare("SELECT * FROM owner;");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

?>