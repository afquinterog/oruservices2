<?php

function addQueryToString($string){
	return isset( $string ) ? '%' . $string . '%' : '%';
}