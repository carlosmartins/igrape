<?php
/**
 * http://php.net/manual/en/install.pecl.phpize.php
 */
class iZip{
	public static function unzip($file, $dir){
        $zip = new ZipArchive();
		$zip->open($file);
		$files = array(substr($file,0,-4), $dir);

		if ( ! $zip->extractTo($dir) ){
			echo "Error!\n";
			echo $zip->status . "\n";
			echo $zip->statusSys . "\n";
		}
		
		$zip->close();
	}
}
?>