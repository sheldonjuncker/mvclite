<?php

class Model_test extends Model
{
	public function getOwners($where = "")
	{
		$query = "SELECT * FROM owner WHERE 1";
		if($where != "")
		{
			$query .= " AND city = '$where'";
		}
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	}
}

?>