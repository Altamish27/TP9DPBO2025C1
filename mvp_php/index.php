<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("view/TampilMahasiswa.php");

$tp = new TampilMahasiswa();

// Handle CRUD actions
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        // Show add form
        $tp->tampilForm();
        break;
        
    case 'add_process':
        // Process form submission for add
        $tp->tambahData();
        break;
        
    case 'edit':
        // Show edit form
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $tp->tampilForm($id);
        break;
        
    case 'edit_process':
        // Process form submission for edit
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $tp->ubahData($id);
        break;
        
    case 'delete':
        // Process delete
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $tp->hapusData($id);
        break;
        
    default:
        // Show all data
        $tp->tampil();
}
