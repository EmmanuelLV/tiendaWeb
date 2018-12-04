<?php

define('CONEXIONES', 'conexion.php');
require_once(CONEXIONES);
require_once('class.php');
mb_internal_encoding('UTF-8');

class Fecha{
    var $id;
    var $fecha;
    var $hora;

    function parseFecha($row)
    {
        $this->id = $row[0];
        $this->fecha = $row[1];
        $this->hora= $row[2];
        return $this;
    }
}

mb_http_output('UTF-8');
$date = $_GET["fecha"];
$sentencia = "SELECT * FROM cosultas WHERE  fecha = $date";
$s = $bd->prepare($sentencia);
$s->execute();
$r = $s->fetchAll();

$fechas = array();

foreach ($r as &$row) {
    $fecha = new Fecha();
    $fechas[] = $fecha->parseFecha($row);
}

echo json_encode($fechas,false);

?>