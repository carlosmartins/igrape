<?php
/**
 * iGrape Framework
 *
 * @category	iGrape
 * @author		iGrape Dev Team
 * @copyright	Copyright (c) 2007-2010 Chierry Inc. (http://www.igrape.org)
 * @license		/LICENSE.txt New BSD License
 * @version		$Id: core.php 10096 2010-03-08 14:05:09Z $
 *
 * ---------------------------------------------------------------
 *
 * System Front Controller
 *
 * Loads the base classes and executes the request.
 *
 * @package		iGrape
 * @subpackage	orm
 * @category	ORM
 * @author		iGrape Dev Team
 * @link		http://wiki.github.com/avelino/igrape/user-guide
 */

class ORM {
    
    private static $i = NULL;
	public $data = array();
	public $conn = array();
	
	/**
	 * driver
	 * host
	 * name
	 * user
	 * pass
	 * encode
	 */
	public function __set($name, $value)
	{
		if($name == 'database')
		{
			unset($data);
			$this->data[$name] = $value;
			$data = $name;
		}else
		{
			$this->conn[$this->data["database"]][$name] = $value;
		}
    }
    
    public function __construct()
    {
    }
    
    public function PDO($d)
    {
		self::$i = new PDO($this->conn[$d]['driver'].":host=".$this->conn[$d]['host'].";dbname=".$this->conn[$d]['name']."",$this->conn[$d]['user'],$this->conn[$d]['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$this->conn[$d]['encode']));
		self::$i->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$i;
    }
	
    public function __get($name)
	{
		if (array_key_exists($name, $this->data))
		{
			return $this->data[$name];
		}
		return null;
	}
	
	public function __isset($name)
	{
		return isset($this->data[$name]);
    }
	
	public function __unset($name)
	{
		unset($this->data[$name]);
    }
    
    private function __clone()
    {
    }
    
    public function __destruct()
    {
    }
}
?>