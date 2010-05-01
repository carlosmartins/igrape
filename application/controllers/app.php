<?php
define('INDEX', $conf['index_page']);
class AppController extends Controller {
	
	public $_db = array();
	public $_ORM = array();
	public $_conf = array();
	
	function __construct()
	{
	}
	
	function before()
	{
		if(is_file(CONFBASE."_conf".EXT)) include CONFBASE."_conf".EXT;
		if(is_array($conf)) $this->_conf = $conf;
		if(is_array($db)) $this->_db = $db;
		
		$this->_ORM = new orm();
		foreach($this->_db AS $database => $info)
		{
			$this->_ORM->database = $database;
			foreach($info AS $_info => $conn)
			{
				$this->_ORM->$_info = $conn;
			}
		}
	}
	
	function after()
	{
	}
	
	function __destruct()
	{
	}
}
?>