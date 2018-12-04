<?php
define('CONEXIONES', 'conexion.php');
require_once(CONEXIONES);
require_once('class.php');


    $s = $bd->prepare("Select * from medicamento limit 30");
    $s->execute();

    $medicamento = new Medicamento();
    $medicamentos = array();
    $r = $s->fetchAll();

    foreach ($r as &$row) {
        $medicamento = new Medicamento();
        $medicamentos[] = $medicamento->parseRow($row);
    }
    
    echo $medicamentos[$i]->idMedicamento."<br>"
        
    
     
    

