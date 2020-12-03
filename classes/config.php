<?php
class dbase
{
 public function connection()
 {
	$conn = new mysqli("localhost", "root", "", "cab");
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}
	else
 	{
 		return $conn;
 	}
 }
}
?>