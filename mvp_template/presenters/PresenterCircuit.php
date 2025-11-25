<?php

include_once(__DIR__. "/KontrakPresenterCircuit.php");
include_once(__DIR__. "/../models/TabelCircuit.php");
include_once(__DIR__. "/../models/Circuit.php");
include_once(__DIR__. "/../views/ViewCircuit.php");

class PresenterCircuit implements KontrakPresenterCircuit
{
    // Model CircuitQuery untuk operasi database
    private $tabelCircuit; // Instance dari TabelCircuit (Model)
    private $viewCircuit; // Instance dari ViewCircuit (View)

    // Data list Circuit
    private $listCircuit = []; // Menyimpan array objek Circuit

    public function __construct($tabelCircuit, $viewCircuit)
    {
        $this->tabelCircuit = $tabelCircuit;
        $this->viewCircuit = $viewCircuit;
        $this->initListCircuit();
    }

    // Method untuk initialisasi list Circuit dari database
    public function initListCircuit()
    {
        // Dapatkan data Circuit dari database
        $data = $this->tabelCircuit->getAllCircuit();

        // Buat objek Circuit dan simpan di listCircuit
        $this->listCircuit = [];
        foreach ($data as $item) {
            $Circuit = new Circuit(
                $item['id_circuit'],
                $item['nama_circuit'],
                $item['location'],
                $item['length_km']
            );
            $this->listCircuit[] = $Circuit;
        }    
    }

    // Method untuk menampilkan daftar Circuit menggunakan View
    // Method untuk menampilkan daftar Circuit menggunakan View
    public function tampilkanCircuit(): string
    {
     return $this->viewCircuit->tampilCircuit($this->listCircuit);
    }  

    // Method untuk menampilkan form
    public function tampilkanFormCircuit($id_circuit = null): string
    {
        $data = null;
        if ($id_circuit !== null) {
            $data = $this->tabelCircuit->getCircuitById($id_circuit);
        }
        return $this->viewCircuit->tampilFormCircuit($data);
    }

    public function getTotal(): int
    {
        // Asumsi TabelCircuit memiliki method getTotalCircuit()
        return $this->tabelCircuit->getTotalCircuit();
    }

    // implementasikan metode
    public function tambahCircuit($nama_circuit, $location, $length_km): void {
        $this->tabelCircuit->addCircuit($nama_circuit, $location, $length_km);
        $this->initListCircuit();
    }
    public function ubahCircuit($id_circuit, $nama_circuit, $location, $length_km): void {
        $this->tabelCircuit->updateCircuit($id_circuit, $nama_circuit, $location, $length_km);
        $this->initListCircuit();
    }
    public function hapusCircuit($id_circuit): void {
        $this->tabelCircuit->hapusCircuit($id_circuit);

        $this->initListCircuit();
    }
}        
