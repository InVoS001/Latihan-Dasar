<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }



    // query database 
    $nama_kelompok_transaksi = $_POST['nama_kelompok_transaksi'];

    // siapkan data tambahan
    $now = date("Y-m-d H:i:s"); 

    // data yang akan disimpan 
    $data =  [
        'nama_kelompok_transaksi' => $nama_kelompok_transaksi, 
        'created_at' => $now, 
        'updated_at' => $now
    ];

    // rangkai SQL 
    // INSERT INTO <nama_tabel> (col1,col2,col3,...) VALUES (val1, val2,val3,..)

    insert_data($connection, "kelompok_transaksi", $data); 

    redirect('?page=kelompok_transaksi'); 

