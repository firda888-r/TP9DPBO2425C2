<?php

interface KontrakViewCircuit
{
    public function tampilCircuit($listCircuit): string;
    public function tampilFormCircuit($data = null): string;
}

?>