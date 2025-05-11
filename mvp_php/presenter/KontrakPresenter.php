<?php

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Mahasiswa.class.php");
include("model/TabelMahasiswa.class.php");

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

// Interface atau gambaran dari presenter akan seperti apa
interface KontrakPresenter
{
    public function prosesDataMahasiswa();
    public function getId($i);
    public function getNim($i);
    public function getNama($i);
    public function getTempat($i);
    public function getTl($i);
    public function getGender($i);
    public function getEmail($i);
    public function getTelp($i);
    public function getSize();
    
    // CRUD methods
    public function prosesTambahData($data);
    public function prosesAmbilData($id);
    public function prosesUbahData($data);
    public function prosesHapusData($id);
}