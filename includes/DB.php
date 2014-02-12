<?php
class DB{
	protected static $pgresource;

	public static function connect(){;
		self::$pgresource = pg_connect('host='. DATABASE_HOST .' port='. DATABASE_PORT .' dbname='. DATABASE_NAME);
		self::is_connected();
		return self::$pgresource;
	}

	public static function resource(){
		return self::$pgresource;
	}

	protected static function is_connected(){
		if(!self::$pgresource){
			trigger_error('No Connection to database', E_USER_ERROR);
			return false;
		}else if (pg_connection_status(self::$pgresource)==PGSQL_CONNECTION_BAD){
			trigger_error('Database connection bad',E_USER_ERROR);
			return false;
		}
		return true;
	}

	public static function query($query){
		if(self::is_connected()){
			return pg_query(self::$pgresource,$query);
		}
		
	}

	public static function select($query, $return_class = NULL, $as_array = false) {
		$results = self::query("SELECT ".$query);
		if(pg_num_rows($results) == 0) return NULL;
		if(pg_num_rows($results) == 1 && $as_array == false) {
			if($return_class == NULL) {
				if(pg_num_fields($results) == 1) return pg_fetch_result($results,0,0);
				else return pg_fetch_assoc($results,0);
			}
			else return pg_fetch_object($results,0,$return_class);
		}

		$return = array();
		while ($item = ($return_class? pg_fetch_object($results,NULL,$return_class) : pg_fetch_assoc($results,NULL))) $return[] = $item;
		return $return;
	}

	public static function insert($table, $data, $return_field = NULL) {
		foreach($data as $key => $val) {
			if($key == "id" && $val == NULL) continue;
			$fields .= "\"".$key."\", ";
			if(isset($val) && (is_bool($val) || (strlen($val) > 0))) {
				if(is_bool($val)) $vars .= "'".($val? "t" : "f")."', ";
				else $vars .= "'".pg_escape_string($val)."', ";
			} else {
				$vars .= "NULL, ";
			}
		}

		$sql = "INSERT INTO \"".$table."\" (".rtrim($fields,", ").") VALUES(".rtrim($vars,", ").")".(isset($return_field)? " RETURNING \"".$return_field."\"" : "");
		$result = self::query($sql);
		if(isset($return_field)) return pg_fetch_result($result, 0, 0);
		else return (bool) $result;
	}

	public function delete($table, $where) {
		$query = self::query("DELETE FROM \"".$table."\" WHERE ".$where);
		return ($query? true : false);
	}

}
DB::connect();
?>
