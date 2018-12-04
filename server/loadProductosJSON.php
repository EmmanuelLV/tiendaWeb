<?php

define('CONEXIONES', 'conexion.php');
require_once(CONEXIONES);
require_once('class.php');
mb_internal_encoding('UTF-8');
 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
$accion = $_GET["accion"];
$sentencia = "";
    if($accion == "*"){
        $sentencia = "Select".$accion."from medicamento limit 30";
    }else{    
        $sentencia = "SELECT * from medicamento where clasificacion like '%".$accion."%' OR descripcion like '%".$accion."%' OR SAL like '%".$accion."%' OR tipo like '%".$accion."%' OR fabricante like '%".$accion."%' OR familia like '%".$accion."%'  OR nom_comercial like '%".$accion."%' limit 25";
    }
    $s = $bd->prepare($sentencia);
    $s->execute();
    $medicamentos = array();
    $r = $s->fetchAll();

    foreach ($r as &$row) {
        $medicamento = new Medicamento();
        $medicamentos[] = $medicamento->parseRow($row);
    }
    $Articulos = '{"Medicamento":[';
    foreach ($medicamentos as &$row) {
        $Articulos.= '{"idMedicamento":"'.
            $row->idMedicamento.'","nom_comercial":"'.
            $row->nom_comercial.'","descripcion":"'.
            utf8_encode($row->descripcion).'","SAL":"'.
            utf8_encode($row->SAL).'","fabricante":"'.
            utf8_encode($row->fabricante).'","precio_compra":'.
            $row->precio_compra.',"precio_publico":'.
            $row->precio_publico.',"familia":"'.
            utf8_encode($row->familia).'","tipo":"'.
            utf8_encode($row->tipo).'","IVA_GRAVA":"'.
            $row->IVA_GRAVA.'","IVA_incluido":"'.
            $row->IVA_incluido.'","IVA_incluido_en":"'.
            $row->IVA_incluido_en.'","Caducidad":"'.
            $row->Caducidad.'","controlado":"'.
            $row->controlado.'","descuento":'.
            $row->descuento.',"comision":'.
            $row->comision.',"clasificacion":"'.
            utf8_encode($row->clasificacion).'"},';
    }
    $len = strlen($Articulos);
    if ($len > 16) {
        $Articulos = substr($Articulos,0,$len-1);
    }
    $Articulos.= "]}";
    echo $Articulos;
?>
