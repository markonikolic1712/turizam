<?php
class Config {
	const DBHOST 	= "localhost";
	const DBNAME 	= "turizam1";
	const DBUSER	= "marko";
	const DBPASS	= "markoni"; 
}

function classloader($c){
	require_once "classes/{$c}.php";
}
spl_autoload_register('classloader');