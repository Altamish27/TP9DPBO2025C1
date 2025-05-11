<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
    private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
    private $tpl;

    function __construct()
    {
        //konstruktor
        $this->prosesmahasiswa = new ProsesMahasiswa();
    }

    function tampil()
    {
        $this->prosesmahasiswa->prosesDataMahasiswa();
        $data = null;

        //semua terkait tampilan adalah tanggung jawab view
        for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
            $no = $i + 1;
            $id = $this->prosesmahasiswa->getId($i);
            $data .= "<tr>
            <td>" . $no . "</td>
            <td>" . $this->prosesmahasiswa->getNim($i) . "</td>
            <td>" . $this->prosesmahasiswa->getNama($i) . "</td>
            <td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
            <td>" . $this->prosesmahasiswa->getTl($i) . "</td>
            <td>" . $this->prosesmahasiswa->getGender($i) . "</td>
            <td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
            <td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
            <td>
                <a href='index.php?action=edit&id=" . $id . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='index.php?action=delete&id=" . $id . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
            </td>
            </tr>";
        }
        // Membaca template skin.html
        $this->tpl = new Template("templates/skin.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        $this->tpl->replace("DATA_TABEL", $data);
        
        // Menambahkan tombol Add Data
        $this->tpl->replace("FORM_BUTTON", "<a href='index.php?action=add' class='btn btn-primary mb-2'>Tambah Data</a>");

        // Menampilkan ke layar
        $this->tpl->write();
    }
    
    function tampilForm($id = null)
    {
        $title = "Tambah Data Mahasiswa";
        $action = "index.php?action=add_process";
        $data = [
            'id' => '',
            'nim' => '',
            'nama' => '',
            'tempat' => '',
            'tl' => '',
            'gender' => '',
            'email' => '',
            'telp' => ''
        ];
        $selected_laki = '';
        $selected_perempuan = '';

        // Jika mode edit
        if ($id !== null) {
            $title = "Edit Data Mahasiswa";
            $action = "index.php?action=edit_process";
            $data = $this->prosesmahasiswa->prosesAmbilData($id);
            
            if ($data['gender'] == 'Laki-laki') {
                $selected_laki = 'selected';
            } else {
                $selected_perempuan = 'selected';
            }
        }

        // Menggunakan skin.html sebagai template
        $this->tpl = new Template("templates/skin.html");
        
        // Membuat form HTML
        $form = '
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            ' . $title . '
                        </div>
                        <div class="card-body">
                            <form action="' . $action . '" method="POST">
                                <input type="hidden" name="id" value="' . $data['id'] . '">
                                
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nim" name="nim" value="' . $data['nim'] . '" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" value="' . $data['nama'] . '" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="tempat" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tempat" name="tempat" value="' . $data['tempat'] . '" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="tl" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tl" name="tl" value="' . $data['tl'] . '" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="">Pilih Gender</option>
                                            <option value="Laki-laki" ' . $selected_laki . '>Laki-laki</option>
                                            <option value="Perempuan" ' . $selected_perempuan . '>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="' . $data['email'] . '" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="telp" name="telp" value="' . $data['telp'] . '" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        // Mengganti kode Data_Tabel dengan form
        $this->tpl->replace("DATA_TABEL", $form);
        
        // Tombol add di hide ketika sedang dalam form
        $this->tpl->replace("FORM_BUTTON", "");
        
        // Menampilkan ke layar
        $this->tpl->write();
    }
    
    function tambahData()
    {
        // Mengambil data dari form
        $data = [
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'tempat' => $_POST['tempat'],
            'tl' => $_POST['tl'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'telp' => $_POST['telp']
        ];
        
        // Proses tambah data melalui presenter
        $result = $this->prosesmahasiswa->prosesTambahData($data);
        
        // Redirect ke halaman utama
        header("Location: index.php");
    }
    
    function ubahData($id)
    {
        // Mengambil data dari form
        $data = [
            'id' => $id,
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'tempat' => $_POST['tempat'],
            'tl' => $_POST['tl'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'telp' => $_POST['telp']
        ];
        
        // Proses ubah data melalui presenter
        $result = $this->prosesmahasiswa->prosesUbahData($data);
        
        // Redirect ke halaman utama
        header("Location: index.php");
    }
    
    function hapusData($id)
    {
        // Proses hapus data melalui presenter
        $result = $this->prosesmahasiswa->prosesHapusData($id);
        
        // Redirect ke halaman utama
        header("Location: index.php");
    }
}
