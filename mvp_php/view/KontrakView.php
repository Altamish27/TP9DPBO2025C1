<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

interface KontrakView{
    public function tampil();
    public function tampilForm($id = null);
    public function tambahData();
    public function ubahData($id);
    public function hapusData($id);
}
?>