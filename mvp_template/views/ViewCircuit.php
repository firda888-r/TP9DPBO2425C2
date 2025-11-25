<?php

include_once("KontrakView.php");
include_once("models/Circuit.php");
include_once("KontrakViewCircuit.php");

class ViewCircuit implements KontrakViewCircuit
{
    public function __construct(){}

    // ============================
    // TAMPIL TABEL CIRCUIT
    // ============================
    public function tampilCircuit($listCircuit): string 
    {
        $tbody = '';
        $no = 1;

        foreach ($listCircuit as $Circuit) {
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($Circuit->getNamaCircuit()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($Circuit->getlocation()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($Circuit->getlength_km()) .'</td>';

            $tbody .= '<td class="col-actions">
                        <a href="index.php?screen=edit_circuit&id='. $Circuit->getId() .'" class="btn btn-edit">Edit</a>
                        <button data-id="'. $Circuit->getId() .'" class="btn btn-delete">Hapus</button>
                       </td>';

            $tbody .= '</tr>';
            $no++;
        }

        // Ambil template
        $templatePath = __DIR__ . '/../template/skincircuit.html';

        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            $template = str_replace('Total:', 'Total: ' . count($listCircuit), $template);
            return $template;
        }

        return $tbody;
    }


    // ============================
    // TAMPIL FORM ADD / EDIT CIRCUIT
    // ============================
    public function tampilFormCircuit($data = null): string
    {
        $template = file_get_contents(__DIR__ . '/../template/formcircuit.html');

        if ($data) {

            // AMAN dari undefined index dan null
            $id         = htmlspecialchars($data['id_circuit']   ?? '');
            $nama       = htmlspecialchars($data['nama_circuit'] ?? '');
            $location   = htmlspecialchars($data['location']     ?? '');
            $length_km  = htmlspecialchars($data['length_km']    ?? '');

            // Set mode edit
            $template = str_replace('value="add" id="Circuit-action"', 'value="edit" id="Circuit-action"', $template);

            // Isi form
            $template = str_replace('value="" id="Circuit-id"', 'value="'.$id.'" id="Circuit-id"', $template);

            $template = str_replace(
                'id="nama" name="nama" type="text" placeholder="Nama Circuit"',
                'id="nama" name="nama" type="text" placeholder="Nama Circuit" value="'.$nama.'"',
                $template
            );

            $template = str_replace(
                'id="location" name="location" type="text" placeholder="Nama location"',
                'id="location" name="location" type="text" placeholder="Nama location" value="'.$location.'"',
                $template
            );

            $template = str_replace(
                'id="length_km" name="length_km" type="text" placeholder="length_km (mis. Indonesia)"',
                'id="length_km" name="length_km" type="text" placeholder="length_km (mis. Indonesia)" value="'.$length_km.'"',
                $template
            );
        }

        return $template;
    }
}

?>
