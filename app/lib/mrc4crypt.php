<?php
// Adapted from Javascript code at http://shop-js.sourceforge.net
// Created On: June 20, 2003
class Crypt{
	/**
	* @param $key (tipo) desc
	* @param $text (tipo) desc
	* @returns (tipo) desc
	*/
	function rc4($key, $text){
		$s = array();
		
		for ($i = 0; $i < 256; $i++){
			$s[$i] = $i;
		}

		$key_length = strlen($key);
		$y = 0;

		for ($x = 0; $x < 256; $x++){
			$c = ord(substr($key, ($x % $key_length), 1));
			$y = ($c + $s[$x] + $y) % 256;
			$temp_swap = $s[$x];
			$s[$x] = $s[$y];
			$s[$y] = $temp_swap;
		}

		$cipher = "";
		$x = 0;
		$y = 0;
		$z = "";

		for ($x = 0; $x < strlen($text); $x++){
			$x2 = $x % 256;
			$y = ($s[$x2] + $y) % 256;
			$temp = $s[$x2];
			$s[$x2] = $s[$y];
			$s[$y] = $temp;
			$z = $s[(($s[$x2] + $s[$y]) % 256)];
			$cipherby = ord(substr($text, $x, 1)) ^ $z;
			$cipher .= chr($cipherby);
		}

		return $cipher;
	}
}
?>