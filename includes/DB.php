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

}
DB::connect();
?>
