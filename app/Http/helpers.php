<?php


/**
 * Convert a string into a from ready statement adding % to the string
 * 
 * @param  string $value The value to apply the format
 * @return string
 */
if (! function_exists('allQueryFormat')) {
	function allQueryFormat($string){
		return isset( $string ) ? '%' . $string . '%' : '%';
	}
}