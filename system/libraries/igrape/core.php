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
 * @subpackage	core
 * @category	Front-controller
 * @author		iGrape Dev Team
 * @link		http://wiki.github.com/avelino/igrape/user-guide
 */

// iGrape Framework Version
define('VERSION', '1.0.2');

/**
 * ---------------------------------------------------------------
 *	Load the global functions
 * ---------------------------------------------------------------
 */
require COREROOT."common".EXT;

/**
 * ---------------------------------------------------------------
 *	Load the global config
 * ---------------------------------------------------------------
 */
include CONFBASE.'_conf'.EXT;

if(!isset($conf)) exit("<pre>You must configure the file _conf".EXT);

if(file_exists(COREROOT.'model'.EXT)) include COREROOT.'model'.EXT;
if(file_exists(COREROOT.'controller'.EXT)) include COREROOT.'controller'.EXT;

if($conf['ig_functions']) include COREROOT."functions".EXT;

if(file_exists(APPBASE."controllers".DS."app".EXT)) include APPBASE."controllers".DS."app".EXT;

class iGrape {
	function index()
	{
		exit("This is the mech index");
	}

	function invalidAction() {
		exit("Invalid action specified");
	}
	
	function invalidModel() {
		exit("Invalid model specified");
	}

	function missingModel($name = "")
	{
		exit("Missing model ".$name);
	}
	
		function missingController($name = "")
	{
		exit("Missing controller ".$name);
	}

	function missingView(&$controller)
	{
		exit("Missing view ".APPBASE.'views/'.$controller->name.'/'.$controller->action.'.php');
	}

	function className($_name,$type)
	{
		$_name[0] = strtoupper($_name[0]);

		$name = "";

		for($i = 0; $i < strlen($_name); $i++)
		{
			if($_name[$i] == '_')
				$_name[$i + 1] = strtoupper($_name[$i+1]);
			else
				$name .= $_name[$i];
		}

		return($name.$type);
	}

	function iGrape($cmd)
	{
		$args = split('/', $cmd);
		if(empty($args[0]))
		{
			if(!defined('INDEX'))
				define('INDEX', $conf['index_page']);
			
			$args = split('/', INDEX);
		//}elseif($args[0] == LOGOUT_TRIGGER)
		}elseif($args[0] == LOGOUT_TRIGGER)
		{
			unset($this);
			session_destroy();
			reload('/');
		}
		
		// Instantiate the model
		$_model = iGrape::loadModel($args[0]);
		$_model->model = empty($args[1]) ? 'index' : $args[1];
		
		if($_model->model[0] == "_" || is_callable(array('Model', $_model->model)))
		{
			iGrape::invalidModel();
		}
		
		// Instantiate the controller
		$_controller = iGrape::loadController($args[0]);
		$_controller->action = empty($args[1]) ? 'index' : $args[1];
		
		// set up the parameters
		for($i = 2; $i < count($args); $i++)
		{
			$_controller->argv[] = $args[$i];
		}

		// check if data was submitted, populate the $data field
		if(isset($_POST))
		{
			$_controller->form = $_POST;
			unset($_POST);
		}

		// Security-paranoia
		if($_controller->action[0] == "_" || is_callable(array('Controller', $_controller->action)))
		{
			iGrape::invalidAction();
		}
		if(is_callable(array(&$_controller, $_controller->action)))
			call_user_func_array(array(&$_controller, $_controller->action), $_controller->argv);
		else
			$_controller->missing();
		
		$_controller->render();
	}
	
	function loadModel($name)
	{
		if(is_file(APPBASE.'models'.DS.$name.EXT))
		{
			include APPBASE.'models'.DS.$name.EXT;

			$className = iGrape::className($name,'Model');
			if(class_exists($className))
			{
				$model = new $className();
				$model->name = $className;
				return $model;
			}
		}
	}

	function loadController($name)
	{
		if(is_file(APPBASE.'controllers'.DS.$name.EXT))
		{
			include APPBASE.'controllers'.DS.$name.EXT;

			$className = iGrape::className($name,'Controller');
			

			if(class_exists($className))
			{
				$controller = new $className();
				$controller->name = $name;
				return $controller;
			}
		}

		// If we got here, there's an error!
		iGrape::missingController($name);
	}


	function renderFile($__view, $__layout, $__data)
	{
		foreach($__data as $__name => $__value)
		{
			$$__name = $__value;
		}

		unset($__data);
		unset($__name);
		unset($__value);

		ob_start();
		include($__view);
		$_content = ob_get_clean();

		$_layout = APPBASE.'views'.DS.$__layout.'.php';

		if(is_file($_layout))
		{
			include $_layout;
		}else
		{
			
		}

	}
}
?>