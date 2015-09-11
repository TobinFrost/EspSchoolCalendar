<?php 

function __autoload($classname)
{
	require '../vue/'.str_replace('\\', '/', $classname.'.class.php');
}

 spl_autoload_register('__autoload');

 