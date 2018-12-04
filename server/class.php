<?php

class Medicamento
{
    var $idMedicamento;
    var $nom_comercial;
    var $descripcion;
    var $SAL;
    var $fabricante;
    var $precio_compra;
    var $precio_publico;
    var $familia;
    var $tipo;
    var $IVA_GRAVA;
    var $IVA_incluido;
    var $IVA_incluido_en;
    var $Caducidad;
    var $controlado;
    var $descuento;
    var $comision;
    var $clasificacion;
    
    
    function _construct()
    {

    }

    function parseRow($row){
             $this->idMedicamento=$row[0];
             $this->nom_comercial=$row[1];
             $this->descripcion=$row[2];
             $this->SAL=$row[3];
             $this->fabricante=$row[4];
             $this->precio_compra=$row[5];
             $this->precio_publico=$row[6];
             $this->familia=$row[7];
             $this->tipo=$row[8];
             $this->IVA_GRAVA=$row[9];
             $this->IVA_incluido=$row[10];
             $this->IVA_incluido_en=$row[11];
             $this->Caducidad=$row[12];
             $this->controlado=$row[13];
             $this->descuento=$row[14];
             $this->comision=$row[15];
             $this->clasificacion=$row[16];
             return $this;
        
    
    }
}

?>