<?php

// ====================================================================
// SETUP UMUM
// ====================================================================

// Menggunakan DB.php
include_once("models/DB.php");

// Konfigurasi Database (Ganti sesuai dengan konfigurasi Anda)
$host = 'localhost';
$db_name = 'mvp_db';
$username = 'root';
$password = '';

// ====================================================================
// SETUP UNTUK PEMBALAP
// ====================================================================
include("models/TabelPembalap.php");
include("views/ViewPembalap.php");
include("presenters/PresenterPembalap.php");

$tabelPembalap = new TabelPembalap($host, $db_name, $username, $password);
$viewPembalap = new ViewPembalap();
$presenterPembalap = new PresenterPembalap($tabelPembalap, $viewPembalap);


// ====================================================================
// SETUP UNTUK CIRCUIT
// ====================================================================
// Tambahkan include file Circuit
include("models/TabelCircuit.php");
include("views/ViewCircuit.php");
include("presenters/PresenterCircuit.php");

$tabelCircuit = new TabelCircuit($host, $db_name, $username, $password);
$viewCircuit = new ViewCircuit();
$presenterCircuit = new PresenterCircuit($tabelCircuit, $viewCircuit);


// ====================================================================
// ROUTING GET (Tampilan/Screen)
// ====================================================================

if(isset($_GET['screen'])){
    $screen = $_GET['screen'];
    $id = $_GET['id'] ?? null; // Ambil ID jika ada

    // --- Rute Pembalap ---
    if($screen == 'add_pembalap'){
        echo $presenterPembalap->tampilkanFormPembalap();
    }
    else if($screen == 'edit_pembalap' && $id){ 
        echo $presenterPembalap->tampilkanFormPembalap($id); 
    }
    
    // --- Rute Circuit ---
    else if($screen == 'list_circuit'){
        echo $presenterCircuit->tampilkanCircuit();
    }
    else if($screen == 'add_circuit'){
        echo $presenterCircuit->tampilkanFormCircuit();
    }
    else if($screen == 'edit_circuit' && $id){ 
        echo $presenterCircuit->tampilkanFormCircuit($id); 
    }
    else {
        // Default: Tampilkan Pembalap jika screen tidak dikenali
        echo $presenterPembalap->tampilkanPembalap();
    }
} 
// ====================================================================
// ROUTING POST (Aksi CRUD)
// ====================================================================
else if(isset($_POST['action'])){ 
    $action = $_POST['action'];

    // --- Aksi Pembalap ---
    if ($action == 'add_pembalap') {
        $presenterPembalap->tambahPembalap( 
            $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang'] 
        ); 
    }else if ($action == 'edit_pembalap') {
        $presenterPembalap->ubahPembalap( 
            $_POST['id'], 
            $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang'] 
        ); 
    }
    
    // --- Aksi Circuit ---
    else if ($action == 'add_circuit') {
        $presenterCircuit->tambahCircuit( 
            $_POST['nama_circuit'], $_POST['location'], $_POST['length_km']
        );
    }
    else if ($action == 'edit_circuit') {
        $presenterCircuit->ubahCircuit( 
            $_POST['id_circuit'], 
            $_POST['nama_circuit'], $_POST['location'], $_POST['length_km']
        );
    }
    
    header("Location: index.php"); 
    exit(); 
}
// ====================================================================
// ROUTING DEFAULT (Tidak ada GET/POST)
// ====================================================================
else{
    // Default: Tampilkan daftar Pembalap saat pertama kali diakses
    $html = $presenterPembalap->tampilkanPembalap();
    echo $html;
}

?>