<?php
class LDAP{
	private $link_identifier;
	private $result_identifier;
	private $result_entry_identifier;
	private $bind_rdn;
	private $username;
	private $member;
	
	private $connection = false;
	private $login = false;
	
	function __construct(){
		$this->link_identifier=@ldap_connect('ldap://'. LDAP_HOST);
		if(!$this->link_identifier) trigger_error('LDAP Connection failure', E_USER_ERROR);
		
		ldap_set_option($this->link_identifier, LDAP_OPT_PROTOCOL_VERSION, 3);
		$this->connection = true;
	}
	function __destruct(){
		if($this->connection) ldap_unbind($this->link_identifier);
	}

	function getMembers(){
		$result = ldap_search($this->link_identifier,LDAP_DN,NULL,array('universityNumber','givenName','cn','uid','uidNumber','mail'));
		$array = array();
		for ($i = ldap_first_entry($this->link_identifier,$result);	$i!=false; $i = ldap_next_entry($this->link_identifier,$i)){
			$j = ldap_get_attributes($this->link_identifier,$i);
			
			$k = array();
			$k['username']		= $j['uid'][0];
			$k['id']			= $j['universityNumber'][0];
			$k['name'] 			= ucwords(strtolower($j['cn'][0]));
			$k['nick'] 			= ucwords(strtolower($j['givenName'][0]));
			$k['email'] 		= $j['mail'];
			$array[] = $k;
		}
		return $array;
	}

	function getMember($username){
		$result = ldap_search($this->link_identifier,LDAP_DN,'(uid='.$username.')',array('universityNumber','givenName','uid'));
		$array = array();
		for ($i = ldap_first_entry($this->link_identifier,$result);	$i!=false; $i = ldap_next_entry($this->link_identifier,$i)){
			$j = ldap_get_attributes($this->link_identifier,$i);
			
			$k = array();
			$k['username']		= $j['uid'][0];
			$k['id']			= $j['universityNumber'][0];
			$k['nick'] 			= ucwords(strtolower($j['givenName'][0]));
		}
		if(isset($k))
			return $k;
		else
			return FALSE;
	}
}
?>
