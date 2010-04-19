<?php
class RunController extends AppController {

	private $sql = array();
	public $run = array();
	public $render = array();
	private $i = array();
	
	public $_db = array();
	public $_ORM = array();

    function __construct()
	{
		if(is_file(CONFBASE."database".EXT)) include CONFBASE."database".EXT;
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

	function index()
	{
		$this->layout = 'igrape';
	}
}
?>