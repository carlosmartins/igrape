<?php
/**
 * iGrape Framework
 *
 * @category	iGrape
 * @author		iGrape Dev Team
 * @copyright	Copyright (c) 2007-2010 iGrape Inc. (http://www.igrape.org)
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
 * @subpackage	SEARCEP
 * @category	SEARCEP
 * @author		iGrape Dev Team
 * @link		http://wiki.github.com/avelino/igrape/user-guide
 */
class SEARCEP {
	
	public $_cep = array();
	
	public function __set($name,$value)
	{
		$this->data[$name] = $value;
	}
	
	public function __construct()
	{
	}
	
	public function search()
	{
		$result = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($this->data['cep']).'&formato=query_string');  
		if(!$result){  
			$result = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
		}
		parse_str($result, $return);   
		return $return;
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