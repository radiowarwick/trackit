<?php
class Item {
	protected $id;
	protected $manufacturer;
	protected $model;
	protected $patDate;
	protected $patExpiry;
	protected $serial;
	protected $purchaseCost;
	protected $replacementCost;
	protected $referenceId;
	protected $description;
	protected $quantity;
	protected $parentItem;
	protected $allowChildren;
	protected $hireable;
	protected $bookable;
	protected $friendlyName;
	protected $purchaseDate;
	protected $endDate;

	/*public function __construct(){
		$this->allowChildren		= ($this->allowChildren == 't');
		$this->hireable		= ($this->hireable == 't');
		$this->bookable		= ($this->bookable == 't');
	}*/
	
	public function getId(){
		return $this->id;
	}
	public function getManufacturer(){
		if(is_null($this->manufacturer)){
			return FALSE;
		} else {
			return Manufacturer::getById($this->manufacturer);
		}
	}
	public function getModel(){
		return $this->model;
	}
	public function getReferenceId(){
		return $this->referenceId;
	}
	public function getFriendlyName(){
		return $this->friendlyName;
	}

	public function getParent(){
		if(is_null($this->parent)){
			return FALSE;
		} else {
			return Item::getById($this->parent);
		}
	}
	public function getChildren($container = NULL){
		$sql = "SELECT * FROM items WHERE \"parentItem\" = ".$this->id;
		if (!is_null($container)){
			if($container == TRUE){
				$sql .= " AND container = TRUE";
			} else {
				$sql .= " AND container = FALSE";
			}
		}
		$sql .= " ORDER BY description ASC, \"referenceId\" ASC;";
		$result = DB::query($sql);
		$return = array();
		while ($item = pg_fetch_object($result,null,'Item')) {
			$return[] = $item;
		}
		return $return;
	}	
	
	public function getItems($parent = NULL, $location = NULL, $children = NULL) {
		$sql = "SELECT * FROM items";
		if (!is_null($parent)){
			$sql .= " WHERE \"parentItem\" = ".$parent;
		} else if (!is_null($location)){
			if($location == TRUE){
				$sql .= " WHERE \"parentItem\" IS NULL";
			} else {
				$sql .= " WHERE \"parentItem\" IS NOT NULL";
			}
		} else if (!is_null($children)){
			if($children == TRUE){
				$sql .= " WHERE \"allowChildren\" = TRUE";
			} else {
				$sql .= " WHERE \"allowChildren\" = FALSE";
			}

		}
		$sql .= " ORDER BY description ASC, \"referenceId\" ASC;";
		$result = DB::query($sql);
		$return = array();
		while ($item = pg_fetch_object($result,null,'Item')) {
			$return[] = $item;
		}
		return $return;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM items WHERE id = ".$id.";";
		$result = DB::query($sql);
		return pg_fetch_object($result,null,'Item');
	}
}	
?>
