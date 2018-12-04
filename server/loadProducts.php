<?php
define('CONEXIONES', 'conexion.php');
require_once(CONEXIONES);
require_once('class.php');
mb_internal_encoding('UTF-8');
 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');

    $s = $bd->prepare("Select * from medicamento limit 30");
    $s->execute();

    $medicamento = new Medicamento();
    $medicamentos = array();
    $r = $s->fetchAll();

    foreach ($r as &$row) {
        $medicamento = new Medicamento();
        $medicamentos[] = $medicamento->parseRow($row);
    }

    $articulos = '';
    for ($i=0; $i < 30; $i++) { 
        $articulos .= "<article class='box2'><img src='./img/".$medicamentos[$i]->idMedicamento.".jpg'><h1>".$medicamentos[$i]->nom_comercial."</h1><p><precio>".$medicamentos[$i]->precio_publico."</precio><br>".$medicamentos[$i]->descripcion."</p><button class='today'>Comprar ahora</button><button class='tomorrow'>Ordena para mañana</button></article>" ;
    }
   echo $articulos ;

    
?>