<?php
class Model {

	public $data = array();
	
	public $model = '';
	public $name = '';

	public function __construct()
	{
	}

	public function missing()
	{
		exit("missing ".$this->model." on model ".$this->name);
	}

	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}
	
	public function __isset($name)
	{
		return isset($this->data[$name]);
	}
	
	public function __unset($name)
	{
		unset($this->data[$name]);
	}
	
	public function __destruct()
	{
	}

}
?>