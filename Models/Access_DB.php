<?php
//----------------------------------------------------
// DB connection function
// Can be modified to use CONSTANTS defined in config.inc
//----------------------------------------------------


function ConnectDB()
{
    $mysqli = new mysqli("localhost", 'MYDAL', 'mydal19' , 'MYDAL');
    	
	if ($mysqli->connect_errno) {
		/*
		include './MESSAGE_View.php';
		new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, './index.php');*/
		return false;
	}
	else{
		return $mysqli;
	}
}

?>
