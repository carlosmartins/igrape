<?php
class pgs {
	
	function date_text($timestamp)
	{
		$timestamp= str_replace(" ","",str_replace("-","",str_replace(":","",str_replace("/", "",$timestamp))));
		$text = date("d/m/Y G:i A", $timestamp);
		return $text;
	}
	
	function normaliza($string)
	{
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b);
		str_replace(" ","",$string);
		return utf8_encode($string);
	}
  
	function cep($cep)
	{  
	    $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
	    if(!$resultado){  
	        $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
    	}  
    	parse_str($resultado, $retorno);   
    	return $retorno;  
	}
	
	function log($_ORM,$array)
	{
		$new = pgs::issetARRAY($array);
		$json = array(
			"ds_user"		=>$this->_user['ds_user'],
			"id_perfil"		=>$this->_user['id_perfil'],
			"id_visita"		=>$new['id_visita'],
			"ds_page"		=>$new['ds_page'],
			"dt_now"		=>date("d/m/Y H:m:s"),
			"ds_table"		=>$new['ds_table'],
			"ds_field"		=>pgs::normaliza($new['ds_field']),
			"ds_value_now"	=>pgs::normaliza($new['ds_value_now']),
			"ds_value_old"	=>pgs::normaliza($new['ds_value_old'])
		);
		$sql  = "INSERT INTO tb_log ";
		$sql .= "(id_user,id_type,ds_json) ";
		$sql .= "VALUES ";
		$sql .= "(".$this->_user['id_user'].",".$new['id_type'].",'".json_encode($json)."')";
		//$_ORM->exec($sql);
	}
	
	function issetARRAY($array)
	{
		if(!isset($array['ds_page']))
			return false;
		$array['id_visita'] 		= isset($array['id_visita'])?$array['id_visita']:NULL;
		$array['ds_table'] 			= isset($array['ds_table'])?$array['ds_table']:NULL;
		$array['ds_field'] 			= isset($array['ds_field'])?$array['ds_field']:NULL;
		$array['ds_value_now'] 		= isset($array['ds_value_now'])?$array['ds_value_now']:NULL;
		$array['ds_value_old'] 		= isset($array['ds_value_old'])?$array['ds_value_old']:NULL;
		foreach($array AS $id=>$value)
		{
			$value					=$value==NULL?"":$value;
			$new[$id]				=$value?$value:"";
		}
		
		return $new;
	}
}
?>