<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }

    $id = $_GET['id']; 

    // query database 
    $uraian = $_POST['uraian'];
    $nominal = $_POST['nominal'];
    $is_masuk = $_POST['is_masuk'];

    // siapkan data tambahan
    $now = date("Y-m-d H:i:s"); 

    // data yang akan disimpan 
    $data =  [
        'uraian' => $uraian,
        'nominal' => $nominal,
        'is_masuk' => $is_masuk, 
        'updated_at' => $now
    ];

    // rangkai SQL untuk update

    update_data($connection, "transaksi", $data, $id, "id_transaksi"); 

    redirect('?page=transaksi'); 

