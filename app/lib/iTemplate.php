<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
class iTemplate {
	protected $file;
	protected $_controller;
	protected $_action;
	protected $values = array();

	public function __construct($_controller,$_action) {
		$this->file = APP_ROOT.'views'.DS.$_controller.DS.$_action.".php";
	}

	public function set($key, $value) {
		$this->values[$key] = $value;
	}

	public function output() {
		if(!file_exists($this->file)){
			echo "Error loading template file ($this->file).<br />";
		}
		$output = file_get_contents($this->file);
		
		foreach ($this->values as $key => $value) {
			$tagToReplace = "{" .$key. "}";
			$output = str_replace($tagToReplace, $value, $output);
		}
		echo $output;
	}
}
?>