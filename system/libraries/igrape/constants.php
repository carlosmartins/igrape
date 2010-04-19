<?php
	define('EXT',				'.php');
	define('EXTPL',				'.theme.php');
	define('APPBASE',			is_dir(APP.DS)?APP.DS:"application"."/");
	define('SYSBASE',			is_dir(SYS.DS)?SYS.DS:"system"."/");
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

	define('WEBROOT',			$sn);
	define('LOGOUT_TRIGGER',	"logout");
?>