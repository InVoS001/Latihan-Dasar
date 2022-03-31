<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }

    $id = $_GET['id']; 

    // siapkan data tambahan
    $now = date("Y-m-d H:i:s"); 

    // data yang akan disimpan 
    $data =  [
        'deleted_at' => $now, 
        'updated_at' => $now
    ];

    // rangkai SQL untuk update
    update_data($connection, "transaksi", $data, $id, "id_transaksi"); 

    redirect('?page=transaksi'); 