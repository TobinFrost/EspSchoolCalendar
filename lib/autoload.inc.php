<?php 

function __autoload($classname)
{
	require 'modele/'.str_replace('\\', '/', $classname.'.class.php');
}

 spl_autoload_register('__autoload');

 