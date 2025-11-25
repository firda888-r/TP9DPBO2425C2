<?php

/*

    Interface ini mendefinisikan struktur dasar yang harus dimiliki oleh setiap Circuit 
    dalam arsitektur MVP (Model–View–Presenter).

    Interface ini berfungsi sebagai kontrak antara View dan Presenter, 
    yang menentukan metode-metode CRUD (Create, Read, Update, Delete) 
    yang wajib diimplementasikan oleh Presenter .

    Dengan adanya kontrak ini, setiap anggota tim dapat 
    bekerja dengan pola yang sama, menjaga konsistensi struktur kode,  
    dan memungkinkan dikerjakan secara paralel 
    tanpa saling mengganggu bagian kode lainnya.

*/
require_once __DIR__ . '/../models/DB.php';

interface KontrakPresenterCircuit
{
// method untuk tampilkan Circuit public function tampilkanCircuit(): string;

// method untuk tampilkan form Circuit
public function tampilkanFormCircuit($id_circuit = null): string;

//method untuk mendapatkan total Circuit
public function getTotal(): int;


// method untuk CRUD Circuit
public function tambahCircuit(string $nama_circuit, string $location, string $length_km): void;
public function ubahCircuit(int $id_circuit, string $nama_circuit, string $location, string $length_km): void; public function hapusCircuit(int $id_circuit): void;
}