<?php

/*

    Interface ini mendefinisikan struktur dasar yang harus dimiliki oleh setiap Model 
    dalam arsitektur MVP (Model–View–Presenter).

    Interface ini berfungsi sebagai kontrak antara Presenter dan Model, 
    yang menentukan metode-metode CRUD (Create, Read, Update, Delete) 
    yang wajib diimplementasikan oleh Model.

    Dengan adanya kontrak ini, setiap anggota tim dapat 
    bekerja dengan pola yang sama, menjaga konsistensi struktur kode,  
    dan memungkinkan dikerjakan secara paralel 
    tanpa saling mengganggu bagian kode lainnya.

*/

interface KontrakModelCircuit
{
    public function getAllCircuit(): array;
    public function getCircuitById($id_circuit): ?array;

    
    // method crud Circuit
    public function addCircuit($nama_circuit, $location, $length_km): void;
    public function updateCircuit($id_circuit, $nama_circuit, $location, $length_km): void;
    public function deleteCircuit($id_circuit): void;
}

?>
