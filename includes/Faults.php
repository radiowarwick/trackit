<?php
class Faults {

	public function get($id = NULL, $author = NULL, $assignedto = NULL) { 
		if(isset($id)) return self::get_by_id($id);

		$sql = "* FROM faults WHERE id IS NOT NULL";
		if(isset($author)) $sql .= " AND author = ".$author;
		if(isset($assignedto)) $sql .= " AND assignedto = '".$assignedto."'";
		$sql .= " ORDER BY postdate DESC";

		return DB::select($sql,"Fault",true);
	}

	public function get_by_id($id) { return DB::select("* FROM faults WHERE id = ".$id, "Fault"); }

	public function get_total_faults() { return DB::select("COUNT(*) FROM faults"); }

	public function get_open_faults() { return DB::select("COUNT(*) FROM faults WHERE status <> '4'"); }

	public function get_closed_faults() { return DB::select("COUNT(*) FROM faults WHERE status = '4'"); }

}
?>
