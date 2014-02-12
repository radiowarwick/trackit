<?php
Class Fault {
	protected $id;
	protected $author;
	protected $status;
	protected $assignedto;
	protected $content;
	protected $postdate;
	protected $item;

	public function get_id() { return $this->id; }
	public function get_author() { return $this->author; }
	public function get_status() { return $this->status; }
	public function get_assignedto() { return $this->assignedto; }
	public function get_content() { return $this->content; }
	public function get_postdate() { return date('jS F Y, g:ia', $this->postdate); }
	public function get_item() { return $this->item; }

	public function set_author($author) { $this->author = $author; }
	public function set_content($content) { $this->content = $content; }
	public function set_status($status) { $this->status = $status; }
	public function set_postdate($postdate) { $this->postdate = $postdate; }
	public function set_assignedto($assignedto) { $this->assignedto = $assignedto; }
	public function set_item($item) { $this->item = $item; }	

	public function save() {
		if(!$this->content) return false;
		if($this->id) DB::update("faults", get_object_vars($this), "id = ".$this->id);
		else $this->id = DB::insert("faults", get_object_vars($this), "id");
		return $this->id;
	}

	public function get_real_status() {
		if ($this->status == 1) return "Not yet read";
		if ($this->status == 2) return "On hold";
		if ($this->status == 3) return "Work in progress";
		if ($this->status == 4) return "Fault complete";
		return "NULL";
	}

	public function get_real_author($id) {
		/*$user = Users::get_by_id($id);
		$user_information = $user->get_ldap_attributes();
		$user_fullname = $user_information['first_name']." ".$user_information['surname'];
		return $user_fullname;*/
		return "Nobody!";
	}

	public function get_real_assignedto($id) {
		/*if ($id == NULL) return "Nobody!";
		$user = Users::get_by_id($id);
		$user_information = $user->get_ldap_attributes();
		$user_fullname = $user_information['first_name']." ".$user_information['surname'];
		return $user_fullname;*/
		return "Nobody!";
	}

	public function get_panel_class() {
		if ($this->status == 1) return "default";
		if ($this->status == 2) return "danger";
		if ($this->status == 3) return "warning";
		if ($this->status == 4) return "success";
		return "default";
	}

	public function delete() { return DB::delete("faults", "id = ".$this->id); }

	/*public function set_location($location) { 
		$result = DigiplayDB::update("configuration", array("location" => $location->get_id()), "id = ".$this->id);
		if($result) return ($this->location = $location->get_id());
	}

	public function set_parameter($parameter) {
		$result = DigiplayDB::update("configuration", array("parameter" => $parameter), "id = ".$this->id);
		if($result) return ($this->parameter = $parameter);
	}

	public function set_val($val) {
		$result = DigiplayDB::update("configuration", array("val" => $val), "id = ".$this->id);
		if($result) return ($this->val = $val);
	}*/

}
?>
