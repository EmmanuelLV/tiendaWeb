<?php
try
{
	$myhost='localhost';
	$myuser='root';
	$mypass='';
    $dbname='aliverstore';
    
	$bd = new PDO("mysql:host=$myhost;dbname=$dbname", $myuser, $mypass);
	//$bd = new PDO("pgsql:host='localhost'; port='5432'; dbname='docp'; user='php'; password='aaa'");
	
	if(!$bd)
	{
		die("Error de conexion a la base de datos: ");
    }
}catch (PDOExeption $e)
    {
        throw new Exception('Error de coexion '.$e->getMessage());
    }
    
    
?>