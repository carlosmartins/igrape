<?php
/**
 * iGrape
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		iGrape
 * @author		Group developer iGrape.
 * @copyright	Copyright (c) 2007, iGrape Project.
 * @license		http://code.google.com/p/igrape/wiki/License
 * @link 		http://code.google.com/p/igrape
 * @since		Version 0.1.6
 * @package		iGrape Alpha 0.1
 * @version		0.1.6
 */

/* Let the carnage begin */
session_start();

// bootstrapping...
define('VERSION', "0.1.6");

date_default_timezone_set('UTC');

define("NOW",date("Y-m-d H:i:s"));

define("TIME",date("H:i:s"));

define("TODAY",date("Y-m-d"));

define('DS', DIRECTORY_SEPARATOR);

define('ROOT', dirname(__FILE__).DS);

if(file_exists(ROOT.'_config.php'))
	include(ROOT.'_config.php');

if(!defined('APP'))
	define('APP', 'app');

define('APP_ROOT', ROOT.APP.DS);

if(!defined('LIB'))
	define('LIB', 'app/lib');
	
define('LIB_ROOT', ROOT.LIB.DS);

if(!defined('_IMAGENS'))
	define('_IMAGENS', 'app/html/_imagens');
	
define('ROOT_IMAGENS', ROOT._IMAGENS.DS);

if(!defined('_CSS'))
	define('_CSS', 'app/html/_css');
	
define('ROOT_CSS', ROOT._CSS.DS);

if(!defined('_JS'))
	define('_JS', 'app/html/_js');
	
define('ROOT_JS', ROOT._JS.DS);

$sn = dirname($_SERVER['SCRIPT_NAME']);
if($sn != "/") $sn .= '/';
define('WEBROOT', $sn);

if(file_exists(APP_ROOT.'_config.php'))
	include(APP_ROOT.'_config.php');

if(!defined('CGI'))
	define('CGI', 1);

if(!defined('LOGOUT_TRIGGER'))
	define('LOGOUT_TRIGGER', "logout"); // there's LOGOUT_CALLBACK too

if(defined('CGI')) {
	$cmd = @substr($_SERVER['argv'][0],1);
	define('SCRIPT_NAME', '?');
}else{
	$cmd = @substr($_SERVER['PATH_INFO'],1);
	define('SCRIPT_NAME', '/');
}

// and then, we run
new iGrape($cmd);

// classes and functions (in this order, and then hopefully in alphabetical order too)
class Controller {
	var $autoRender = true;
	var $description = "";
	var $argv = array();
	var $data = array();
	var $layout = 'default';
	var $action = '';
	var $name = '';

	/**
	 * Occurs after the action has been processed (and before autorendering)
	 * @return
	 */
	function after() {

	}

	/**
	 * Occurs before processing the desired action
	 * @return
	 */
	function before() {

	}

	/**
	 * Called when a method is missing (not callable)
	 * It's important to notice that all the controller parameters (form, action, argv) are already set at this point
	 *
	 */
	function missing() {
		echo "missing {$this->action} on controller {$this->name}";
		exit(); // TODO render página de erro (layout)
	}

	function render($_action = null) {

		if(!$_action)
			$_action = $this->action;

		$_view = APP_ROOT.'views'.DS.$this->name.DS.$_action.'.php';

		if(!is_readable($_view)) {
			$this->action = $_action;
			iGrape::missingView($this);
		}else{
			iGrape::renderFile($_view, $this->layout, $this->data);
		}
	}

	function set($name, $value) {
		$this->data[$name] = $value;
	}

}

class iGrape {
	var $templates = array(
		'default'   => "<html></html>",
		'ajax'      => "<html></html>",
		'flash'     => "<html></html>"
	);

	/**
	 * Lists all controllers
	 * @return
	 */
	function index() {
		// TODO list all controllers
		echo "This is the mech index";
		exit;
	}

	function invalidAction() {
		echo "Invalid action specified";
		exit;
	}

	function missingController($name = "") {
		echo "Missing controller $name";
		exit;
	}

	function missingView(&$controller) {
		echo "Missing view ".APP_ROOT.'views/'.$controller->name.'/'.$controller->action.'.php';
	}

	function className($_name) {

		$_name[0] = strtoupper($_name[0]);

		$name = "";

		// Check for underscores _
		for($i = 0; $i < strlen($_name); $i++) {
			if($_name[$i] == '_')
				$_name[$i + 1] = strtoupper($_name[$i+1]);
			else
				$name .= $_name[$i];
		}

		return($name.'Controller');
	}

	function iGrape($cmd) {
		$args = split('/', $cmd);
		if(empty($args[0])) {
			if(defined('INDEX'))
				$args = split('/', INDEX);
			else {
				iGrape::index();
			}
		}

		if($args[0] == LOGOUT_TRIGGER) {
			if(defined("LOGOUT_CALLBACK")) {
				call_user_func(LOGOUT_CALLBACK);
			}
			else {
				session_destroy();
			}
			redirect('/');
		}

		// Instantiate the controller
		$_controller = iGrape::loadController($args[0]);
		$_controller->action = (empty($args[1]) ? 'index' : $args[1]);
		// set up the parameters
		for($i = 2; $i < count($args); $i++) {
			$_controller->argv[] = $args[$i];
		}

		// check if data was submitted, populate the $data field
		if(isset($_POST)) {
			$_controller->set('form', $_POST);
			unset($_POST);
		}

		// Security-paranoia
		if($_controller->action[0] == "_" || is_callable(array('Controller', $_controller->action))) {
			iGrape::invalidAction();
		}

		$_controller->before();

		if(is_callable(array(&$_controller, $_controller->action)))
			call_user_func_array(array(&$_controller, $_controller->action), $_controller->argv);
		else
			$_controller->missing();

		$_controller->after();
		if($_controller->autoRender) {
			$_controller->render();
		}
	}

	function loadController($name) {
		if(is_readable(APP_ROOT.$name.'.php')) {
			include(APP_ROOT.$name.'.php');

			$className = iGrape::className($name);

			if(class_exists($className)) {
				$controller = new $className();
				$controller->name = $name;
				return $controller;
			}
		}

		// If we got here, there's an error!
		iGrape::missingController($name);
	}


	function renderFile($__view, $__layout, $__data) {

		foreach($__data as $__name => $__value) {
			$$__name = $__value;
		}

		unset($__data);
		unset($__name);
		unset($__value);

		ob_start();
		include($__view);
		$_content = ob_get_clean();

		$_layout = APP_ROOT.'views'.DS.$__layout.'.php';

		if(!is_readable($_layout)) {
			// TODO use default layout (hardcoded) _ URGENT FOR RELEASE
		}else{
			include($_layout);
		}

	}
}

/**
 * Inserts a link to a css file
 * @return
 * @param $file Object
 */
function css($file) {
	return "<link rel=\"stylesheet\" href=\"".WEBROOT.APP."/html/_css/".$file."\"/>\n";
}

/**
 * Display error
 * @param $text The error display
**/
function error($text){
	$_SESSION["iGrape"]["error"]=NULL;
	echo "<pre style='color: #FFF; background: #C00'> <b>ERROR</b> :: ".$text."</pre>";
	$_SESSION["iGrape"]["error"] = 1;
}

/**
 * Debug is array
 * @param $array The array for debug
 * @param $type The type for debug
**/
function debug($array, $type){
	switch($type) {
		case "array":
			echo "<pre>";
				print_r($array);
			echo "</pre>";
			break;
	}
}

/**
 * Inserts an table tab (<table></table>)
**/
function table($array,$style=NULL){
	if($style){
		foreach($style AS $attr=>$value){
			echo $attr." - ".$value."<br />";
		}
	}
	$c = 1;
	foreach($array AS $__colum => $__values){
		
		if(!is_array($__values))
			error("Values not is array!");
		else
			$_SESSION["iGrape"]["error"]=NULL;
		
		if($_SESSION["iGrape"]["error"] == 1)
			break;
			
		$__tr = count($__values);
		$__th[$c] = $__colum;
			$v = 1;
			foreach($__values AS $_values){
				$var[$c][$v] = $_values;
				$v++;
			}
		$c++;
	}
	$__td = @count($var);
	
	## CREATE TABLE
	$return = "<table>\n";
		## TITLE TABLE
		$return .= "<tr>";
		for($y=1;$y<=$__td;$y++){
			$return .= "<th>";
				$return .= @$__th[$y];
			$return .= "</th>\n";
		}
		$return .= "</tr>\n";
		## TITLE TABLE
		for($i=1;$i<=@$__tr;$i++){
			$return .= "<tr>\n";
				for($y=1;$y<=$__td;$y++){
					$return .= "<td>";
						$return .= @$var[$y][$i];
					$return .= "</td>\n";
				}
			$return .= "</tr>\n";
		}
	$return .= "</table>\n";
	## CREATE TABLE
	
	return $return;
}

/**
 * Inserts an image tag (<img>)
 * @return
 * @param $file The image file name
 */
function img($file, $attrs ='') {
	return "<img src=\"".WEBROOT.APP."/html/_imagens/".$file."\" $attrs/>";
}

/**
 * Returns TRUE if this in an AJAX request
 * @return
 */
function isAjax() {
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
}

/**
 * Inserts a script tag
 * @return
 * @param $file The script file name
 */
function js($file) {
	return "<script type=\"text/javascript\" src=\"".WEBROOT.APP."/html/_js/".$file."\"></script>\n";
}

/**
 * Loads a file from APP/lib
 * @return
 * @param $lib The file name to include
 */
function load($__lib, $__params = array()) {
	$__libfile = APP_ROOT.'lib'.DS.$__lib;
	unset($__lib);

	if(!is_readable($__libfile)) {
		echo "Error importing $__libfile (can't read!)";
	}else{
		foreach($__params as $__name => $__value)
			$$__name = $__value;
		unset($__name);
		unset($__value);
		unset($__params);

 		include($__libfile);
	}
}

/**
 * Redirects the user to another controller/action
 * @return
 * @param $to URL to go to, in the "controller/action/parameters" form
 */
function redirect($to) {
	header('Location: '.url($to));
	exit;
}

/**
 * Return the right url for the controller/action passed
 * @return
 * @param $to URL to go to, in the "controller/action/parameters" form
 */
function url($to) {
	if($to == '/') $to = '';
	return WEBROOT.SCRIPT_NAME.$to;
}

/**
 * Reads or writes to the session
 * @return
 * @param $name The name of the variable
 * @param $value [optional] Value for the variable, if empty returns the variable's value
 */
function session($name, $value = null) {
	if($value === null) {
		if(isset($_SESSION[$name]))
			return $_SESSION[$name];
		else
			return null;
	}else{
		$_SESSION[$name] = $value;
	}
}

/**
 * Return the right json
 * @return
 * @param $type The type json (encode/decode)
 * @param $json The json for process
 */
function json($type,$json){
	switch($type){
		case "encode":
			$_json = json_encode($json);
			break;
		case "decode":
			$_json = json_decode($json);
			break;
		case "error":
			foreach($json as $string){
		    	$_json = 'Decoding: ' . $string;
		    	json_decode($string);

		    	switch(json_last_error()){
		        	case JSON_ERROR_DEPTH:
						$_json .= ' - Maximum stack depth exceeded';
		        		break;
		        	case JSON_ERROR_CTRL_CHAR:
						$_json .= ' - Unexpected control character found';
		        		break;
		        	case JSON_ERROR_SYNTAX:
 						$_json .= ' - Syntax error, malformed JSON';
		        		break;
		        	case JSON_ERROR_NONE:
 						$_json .= ' - No errors';
						break;
		    	}

		    	$_json .= PHP_EOL;
			}
			break;
	}
	return @$_json;
}
?>