<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }



    // query database 
    $uraian = $_POST['uraian'];
    $nominal = $_POST['nominal'];
    $is_masuk = $_POST['is_masuk'];
    $kelompok = $_POST['kelompok'];

    // siapkan data tambahan
    $now = date("Y-m-d H:i:s"); 

    // data yang akan disimpan 
    $data =  [
        'uraian' => $uraian, 
        'nominal' => $nominal, 
        'is_masuk' => $is_masuk,
        'created_at' => $now,
        'updated_at' => $now
        

    ];

    // rangkai SQL 
    // INSERT INTO <nama_tabel> (col1,col2,col3,...) VALUES (val1, val2,val3,..)

    insert_data($connection, "transaksi", $data); 

    // cari id transaksi
    $sql = "select last_insert_id() as last_id";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);

    $id_transaksi = $row['last_id'];

    // looping
    foreach($kelompok as $id_kelompok)
    {
        $data = [
            'id_transaksi' => $id_transaksi,
            'id_kelompok_transaksi' => $id_kelompok,
            'created_at' => $now,
            'updated_at' => $now
        ];
        insert_data($connection, "transaksi_kelompok", $data);
    }

    redirect('?page=transaksi'); 

