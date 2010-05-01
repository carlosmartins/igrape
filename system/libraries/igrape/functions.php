<?php
/**
 * Inserts a link to a css file
 * @return
 * @param $file Object
 */
function css($file) {
	return "<link rel=\"stylesheet\" href=\"".APPBASE."html/_css/".$file."\" type=\"text/css\" media=\"screen\" />\n";
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
	return "<img src=\"".APPBASE."html/_imagens/".$file."\" ".$attrs." />\n";
}
function imgW($file, $attrs ='') {
	return "<img src=\"".$file."\" ".$attrs." />\n";
}

function pathinfo$file) {
	return APPBASE."html/_imagens/".$file;
}


function favicon($file=NULL, $attrs ='') {
	if(!$file)
		return "<link href=\"".APPBASE."html/_imagens/favicon.ico\" rel=\"icon\" />\n";
	return "<link href=\"".APPBASE."html/_imagens/".$file."\" rel=\"icon\" ".$attrs." />\n";
}

function input($type, $id, $attrs ='', $file='')
{
	if($file !="")
		return "<input id='".$id."' name='".$id."' type='".$type."' src=\"".APPBASE."html/_imagens/".$file."\" ".$attrs." />";
	return "<input id='".$id."' name='".$id."' type='".$type."' ".$attrs." />";
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
	return "<script type=\"text/javascript\" src=\"".APPBASE."html/_js/".$file."\"></script>\n";
}

function load_element($file,$_this=NULL,$path=NULL)
{
	if(is_file(APPBASE."views".DS."_elements".DS.$path.DS.$file.EXT))
	{
		include APPBASE."views".DS."_elements".DS.$path.DS.$file.EXT;
	}else
	{
		include APPBASE."views".DS."_elements".DS.$file.EXT;
	}
	
	return false;
}

/**
 * Loads a file from APP/lib
 * @return
 * @param $lib The file name to include
 */
function load($__lib, $__params = array()) {
	$__libfile = LIB.$__lib.DS.$__lib.EXT;
	unset($__lib);

	if(!is_file($__libfile)) {
		echo "Error importing $__libfile (can't read!)";
	}else{
		foreach($__params as $__name => $__value)
			$$__name = $__value;
		unset($__name);
		unset($__value);
		unset($__params);

 		include $__libfile;
	}
}

function load_conf($__conf)
{
	if(is_file($__conf))
	{
		//include "".$__conf;
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

function reload($to)
{
	echo "<meta http-equiv=\"refresh\" content=\"0;url=".url($to)."\">";
	exit;
}

/**
 * Return the right url for the controller/action passed
 * @return
 * @param $to URL to go to, in the "controller/action/parameters" form
 */
function url($to)
{
	if($to == '/') $to = '';
	return WEBROOT.SCRIPT_NAME.$to;
}

/**
 * Reads or writes to the session
 * @return
 * @param $name The name of the variable
 * @param $value [optional] Value for the variable, if empty returns the variable's value
 */
function session($name, $value = null, $id = null)
{
	if($value === null)
	{
		if(isset($_SESSION[$name]))
			return $_SESSION[$name];
		else
			return null;
	}else
	{
		if($id === null)
			$_SESSION[$name] = $value;
		else
			$_SESSION[$name][$id] = $value;
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

function brouser(){ 
	$nav = $_SERVER["HTTP_USER_AGENT"];
	if(ereg("Mozilla", $nav))
	{
		$navegador = "ff";
	}elseif(ereg("Opera", $nav))
	{
		$navegador = "op";
	}elseif(ereg("MSIE", $nav))
	{
		$navegador = "ie";
	}else{
		$navegador = NULL;
	}
	return $navegador;
}
function nocache()
{
	@header("Pragma: no-cache");
	@header("Cache: no-cahce");
	@header("Cache-Control: no-cache, must-revalidate");
	@header("Expires: Mon, 23 Jul 1989 00:00:00 GMT");
}
?>