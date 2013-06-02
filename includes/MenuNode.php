<?php
class MenuNode{
	private $url;
	private $label;
	private $icon;
	private $menu;
	private $active;

	public function __construct($url,$label,$icon) {
		$this->url		= $url;
		$this->label	= $label;
		$this->icon 	= $icon;
	}

	public function new_menu() {
		$this->menu = new Menu;
		return $this->menu;
	}

	public function set_active() {
		$this->active = true;
	}

	public function output($path,$tabs) {
		$out = "\n".str_repeat("\t",$tabs);
		if(strlen($this->url) > 0) {
		 	$out .= '<li'.($this->active?' class="active"':'').'>';
		 	$out .= '<a href="'.$this->url($path).'">';
		 	if(strlen($this->icon) > 0) $out .= '<span class="glyphicon icon-'.$this->icon.'"></span> ';
		 	$out .= $this->label.'</a>';
		} else {
			$out .= '<li class="nav-header">'.$this->label;
			if(strlen($this->icon) > 0) $out .= '<span class="glyphicon icon-'.$this->icon.'"></span> ';
		}
		if(isset($this->menu)) $out .= $this->menu->output($path.$this->url.'/',$tabs+1);
		$out  .= '</li>';
		return $out;
	}

	private function url($path){
		if(substr($this->url,0,7) == "http://")
			return $this->url;
		else
			return $path.$this->url;
	}
}
?>