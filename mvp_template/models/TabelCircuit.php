<?php

include_once("models/DB.php");
include_once("KontrakModelCircuit.php");

class TabelCircuit extends DB implements KontrakModelCircuit
{
    // Konstruktor
    public function __construct($host, $db_name, $username, $password)
    {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Ambil semua circuit
    public function getAllCircuit(): array
    {
        $query = "SELECT * FROM circuit";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // Ambil circuit berdasarkan ID
    public function getCircuitById($id): ?array
    {
        $this->executeQuery(
            "SELECT * FROM circuit WHERE id_circuit = :id_circuit",
            ['id_circuit' => $id]
        );

        $results = $this->getAllResult();
        return $results[0] ?? null;
    }

    // Tambah circuit
    public function addCircuit($nama_circuit, $location, $length_km): void
    {
        $query = "INSERT INTO circuit (nama_circuit, location, length_km)
                  VALUES (:nama_circuit, :location, :length_km)";

        $params = [
            'nama_circuit' => $nama_circuit,
            'location'     => $location,
            'length_km'    => $length_km
        ];

        $this->executeAffectedQuery($query, $params);
    }

    // Update circuit
    public function updateCircuit($id_circuit, $nama_circuit, $location, $length_km): void
    {
        $query = "UPDATE circuit SET
                    nama_circuit = :nama_circuit,
                    location     = :location,
                    length_km    = :length_km
                  WHERE id_circuit = :id_circuit";

        $params = [
            'id_circuit'   => $id_circuit,
            'nama_circuit' => $nama_circuit,
            'location'     => $location,
            'length_km'    => $length_km
        ];

        $this->executeAffectedQuery($query, $params);
    }

    // Hapus circuit
    public function deleteCircuit($id_circuit): void
    {
        $query = "DELETE FROM circuit WHERE id_circuit = :id_circuit";

        $params = [
            'id_circuit' => $id_circuit
        ];

        $this->executeAffectedQuery($query, $params);
    }
}

?>
