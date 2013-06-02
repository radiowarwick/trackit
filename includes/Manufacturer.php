<?php
class Manufacturer {
	protected $id;
	protected $name;
	
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM \"itemManufacturers\" WHERE id = ".$id.";";
		$result = DB::query($sql);
		return pg_fetch_object($result,null,'Manufacturer');
	}

	public function getAll(){
		$sql = "SELECT * FROM \"itemManufacturers\" ORDER BY name ASC;";
		$result = DB::query($sql);
		$return = array();
		while ($manufacturer = pg_fetch_object($result,null,'Manufacturer')) {
			$return[] = $manufacturer;
		}
		return $return;
	}
}	
?>
