<?php
$serverName='localhost';
$userName='root';
$password='';
$databaseName='facebook';
$connection = new mysqli($serverName,$userName,$password,$databaseName);
if($connection->connect_error)
{
	die ("connection failed:".$connection->connect_error);
}

?>