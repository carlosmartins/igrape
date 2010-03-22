<?php
/**
 * @package iGrape
 * @subpackage iConnect
 * @version 0.1.2
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
class iConnect {
	private $type;
	private $host;
	private $dbname;
	private $user;
	private $password;
	private $port;
	public $sql;
	public $error = "Error class :: ";
	function _connect($type,$host,$dbname,$user,$password,$port=NULL){
		array("type"=>$type,);
		$this->type 		= base64_decode($type);
		$this->host 		= base64_decode($host);
		$this->port 		= base64_decode($port);
		$this->dbname 		= base64_decode($dbname);
		$this->user 		= base64_decode($user);
		$this->password 	= base64_decode($password);
		switch($this->type) {
			case "postgres":
				$this->conn = pg_connect("host=".$this->host." port=".$this->port." dbname=".$this->dbname." user=".$this->user." password=".$this->password."")
				or die($this->error."Function: connect; pg_connect; ".pg_last_error());
				break;
			case "mysql":
				$this->conn = mysql_connect($this->host,$this->user,$this->password)
				or die($this->error."Function: connect; mysql_connect; ".mysql_error());
				if(!mysql_select_db($this->db,$this->conn))
				return false;
				break;
			case "sqlserver":
				$this->conn = mssql_connect($this->user,$this->password,$this->dbname);
				break;
		}
		return true;
	}
	function _query($sql,$type=NULL){
		$this->type 		= empty($type) ? $this->type : $type;
		$this->sql			= $sql;
		switch($this->type){
			case "postgres":
				$this->query = pg_query($this->conn, $this->sql);
				break;
			case "mysql":
				$this->query = mysql_query($this->sql,$this->conn);
				break;
			case "sqlserver":
				$this->query = mssql_query($this->sql,$this->conn);
				break;
			
		}
		return $this->query;
	}
	function _fetch_array($query=NULL,$type=NULL){
		$this->type 		= empty($type) ? $this->type : $type;
		$this->query		= empty($query) ? $this->query : $query;
		switch($this->type) {
			case "postgres":
				return pg_fetch_array($this->query);
				break;
			case "mysql":
				return mysql_fetch_array($this->query);
				break;
			case "sqlserver":
				return mssql_fetch_array($this->query);
				break;
		}
	}
	function _fetch_row($query=NULL,$type=NULL){
		$this->type 		= empty($type) ? $this->type : $type;
		$this->query 		= empty($query) ? $this->query : $query;
		switch($this->type) {
			case "postgres":
				return pg_fetch_row($this->query);
				break;
			case "mysql":
				return mysql_fetch_row();
				break;
			case "mssql":
				return mssql_fetch_row();
				break;
		}
	}
	
	function _update($table, $array, $where, $type=NULL){
		$this->type 		= empty($type) ? $this->type : $type;
		$this->table		= $table;
		if($where){
			$this->where 	= "WHERE ";
		}
		$this->where		.= $where;
		$this->values		= "";
		$i=0;
		foreach($array as $column=>$values){
			$i++;
			$cont = $i!=count($array) ? ',' : '';
			$this->values .= $column."='".$values."'$cont ";
		}
		switch($this->type){
			case "postgres":
				$this->sql	= pg_query($this->conn,"UPDATE  ".$this->table." SET ".$this->values." ".$this->where." ");
				break;
			case "mysql":
				break;
		}
	}
	function _insert($table, $array, $type=NULL, $where=NULL){
		$this->type 		= empty($type) ? $this->type : $type;
		$this->table		= $table;
		$this->where		= $where;
		$this->column		= "";
		$this->values		= "";
		$i=0;
		foreach($array as $column=>$values){
			$i++;
			$cont = $i!=count($array) ? ',' : '';
			$this->column .= $column.$cont;
			$this->values .= " '".$values."'$cont ";
		}
		switch($this->type){
			case "postgres":
				$this->sql	= pg_query($this->conn,"INSERT INTO ".$this->table." (".$this->column.") VALUES (".$this->values.") ".$this->where."");
				break;
			case "mysql":
				$this->sql	= mysql_query("INSERT INTO ".$this->table." (".$this->column.") VALUES (".$this->values.") ".$this->where."",$this->conn);
				break;
		}
	}
}
?>