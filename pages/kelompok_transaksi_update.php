<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }

    $id = $_GET['id']; 

    // query database 
    $nama_kelompok_transaksi = $_POST['nama_kelompok_transaksi'];

    // siapkan data tambahan
    $now = date("Y-m-d H:i:s"); 

    // data yang akan disimpan 
    $data =  [
        'nama_kelompok_transaksi' => $nama_kelompok_transaksi, 
        'updated_at' => $now
    ];

    // rangkai SQL untuk update

    update_data($connection, "kelompok_transaksi", $data, $id, "id_kelompok_transaksi"); 

    redirect('?page=kelompok_transaksi'); 

