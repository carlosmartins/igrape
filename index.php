<?php
/**
 * iGrape Framework
 *
 * @category	iGrape
 * @author		iGrape Dev Team
 * @copyright	Copyright (c) 2007-2010 Chierry Inc. (http://www.igrape.org)
 * @license		LICENSE New BSD License
 * @version		$Id: index.php 10096 2010-03-08 14:05:09Z $
 */


/*
|---------------------------------------------------------------
| PHP ERROR REPORTING LEVEL
|---------------------------------------------------------------
|
| For more info visit:  http://www.php.net/error_reporting
|
*/
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
set_time_limit(0);
ignore_user_abort();

/*
|-------------------------------------------------------------
| OS used
|-------------------------------------------------------------
|
| win = Windows
| lin = Linux
| bsd = BSD
| osx = Mac OS X
|
*/
define("OS",		"lin");

/*
|-------------------------------------------------------------
| iGrape folders 
|-------------------------------------------------------------
|
| win = Windows
| lin = Linux
| bsd = BSD
| osx = Mac OS X
|
*/
define("SYS",				"system");
define("APP",				"application");
define("CACHE",				"cache");
define("DS",				"/");

/*
|-------------------------------------------------------------
| In the system (CONSTANTS)
|-------------------------------------------------------------
|
| --
|
*/
define('EXT',				'.php');
define('EXTPL',				'.theme.php');
define('APPBASE',			is_dir(APP.DS)?APP.DS:"application"."/");
define('SYSBASE',			is_dir(SYS.DS)?SYS.DS:"system"."/");
define('CACHEBASE',			is_dir(CACHE.DS)?CACHE.DS:"cache"."/");	
define('CONFBASE',			APPBASE.'config'.DS);
define('MODELSBASE',		APPBASE.'models'.DS);
define('LIB',				SYSBASE.'libraries'.DS);
define('SELF',				pathinfo(__FILE__, PATHINFO_BASENAME));
define("PATH",				realpath(dirname(__FILE__)));
define('COREPATH',			LIB.'igrape'.DS);
define('COREFILE',			COREPATH.'core'.EXT);
define('SYSROOT',			PATH.SYSBASE);
define('APPROOT',			PATH.APPBASE);
define('CONFROOT',			APPROOT.'config'.DS);
define('COREROOT',			PATH.DS.COREPATH);
define('CGI',				1);

if(defined('CGI')) {
	$cmd = @substr($_SERVER['argv'][0],1);
	define('SCRIPT_NAME', '?');
}else{
	$cmd = @substr($_SERVER['PATH_INFO'],1);
	define('SCRIPT_NAME', '/');
}

$sn = dirname($_SERVER['SCRIPT_NAME']);
if($sn != "/") $sn .= '/';

define('WEBROOT',				$sn);
define('LOGOUT_TRIGGER',		"logout");



require_once COREFILE;

new iGrape($cmd);

ob_flush();
?>