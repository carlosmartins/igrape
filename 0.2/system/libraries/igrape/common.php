<?php
/**
 * iGrape Framework
 *
 * @category	iGrape
 * @author		iGrape Dev Team
 * @copyright	Copyright (c) 2007-2010 iGrape Inc. (http://www.igrape.org)
 * @license		/LICENSE.txt New BSD License
 * @version		$Id: common.php 10096 2010-03-08 14:05:09Z $
 *
 * ---------------------------------------------------------------
 *
 * System Front Controller
 *
 * Loads the base classes and executes the request.
 *
 * @package		iGrape
 * @subpackage	common
 * @category	Front-controller
 * @author		iGrape Dev Team
 */
function __autoload($class) {
	if(file_exists(LIB.$class.EXT))
	{
		require LIB.$class.EXT;
	}else
	{
		$dir = dir(LIB);
		while (false !== ($entry = $dir->read())) {
			if(($entry != "." && $entry != ".." && $entry != "igrape") && $entry == $class)
			{
				require LIB.$class.DS.$class.EXT;
			}
		}
		$dir->close();
	}
}

function load_class($class)
{
	static $objects = array();
	$objects[$class] = $class;
	
	if(isset($objects[$class]))
	{
		return $objects[$class];
	}
	
	if(file_exists(LIB.$class.EXT))
	{
		require LIB.$class.EXT;
		return $objects[$class];
	}else
	{
		$dir = dir(LIB);
		while (false !== ($entry = $dir->read()))
		{
			if(($entry != "." && $entry != ".." && $entry != "igrape") && $entry == $class)
			{
				require LIB.$class.DS.$class.EXT;
				return $objects[$class];
			}
		}
		$dir->close();
	}
	$objects['error'] = "Error load class [".$class."], please check documentation.";
	return $objects['error'];
}

function get_conf()
{
	//static $_conf = array();

	if (!isset($_conf))
	{
		if(!file_exists(CONFBASE.'_conf'.EXT))
		{
			exit("The _conf".EXT." file wasn't found.");
		}
		
		include CONFBASE.'_conf'.EXT;
		
		print_r($_conf);
		if (!isset($conf) OR !is_array($conf))
		{
			exit("You must configure the file _conf".EXT);
		}

		//$_conf[0] =& $config;
	}
	return $_conf;
}
?>