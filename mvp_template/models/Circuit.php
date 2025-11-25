<?php

class Circuit{

    private $id_circuit;
    private $nama_circuit;
    private $location;
    private $length_km;
    

    public function __construct($id_circuit, $nama_circuit, $location, $length_km){
        $this->id_circuit = $id_circuit;
        $this->nama_circuit = $nama_circuit;
        $this->location = $location;
        $this->length_km = $length_km;
    }

    public function getId(){
        return $this->id_circuit;
    }
    public function getNamaCircuit(){
        return $this->nama_circuit;
    }
    public function getlocation(){
        return $this->location;
    }
    public function getlength_km(){
        return $this->length_km;
    }

    public function setNamaCircuit($nama_circuit){
        $this->nama_circuit = $nama_circuit;
    }
    public function setlocation($location){
        $this->location = $location;
    }
    public function setlength_km($length_km){
        $this->length_km = $length_km;
    }
}
?>