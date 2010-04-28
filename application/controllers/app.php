<?php
define('INDEX', $conf['index_page']);
class AppController extends Controller {

	public $_user = array();

	function __construct()
	{
		//self::session();
	}
	
	public function session()
	{
	}

	function __destruct()
	{
	}
}
?>