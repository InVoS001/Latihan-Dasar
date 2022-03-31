<?php
    if(defined("GELANG") === false)
    {
        //tidak punya gelang
        die("Anda tidak berhak membuka file ini secara langsung");
    }

    // ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // buat sql
    $password = sha1($password); // mengenkripsi password 
    $sql = "select * from user where user_username='$username' and user_password='$password' and deleted_at is null";

    // execute the query -> menjalankan 
    $result = mysqli_query($connection, $sql);

    $num = mysqli_num_rows($result);

    if($num > 0)
    {
        // ditemukan data user
        // jika berhasil maka.. 
        // menyimpan sesuatu di session -> untuk bisa diakses 
        // menggunakan session lebih aman 
        $row = mysqli_fetch_assoc($result); 
        // didapatkan dari hasil query 
        $_SESSION['username'] = $username; 
        $_SESSION['nama'] = $row['nm_user']; 

        // jalankan query 
        $sql = "select * from role where id_role=".$row['id_role']." and deleted_at is null"; 
        $result_role = mysqli_query($connection, $sql); 

        $role = mysqli_fetch_assoc($result_role); 
        $_SESSION['nama_role']= $role['nm_role'];
        $_SESSION['id_role'] = $role['id_role']; 

        // memanggil 
        redirect("?page=main"); 
    } else {
        // tidak ditemukan
        // untuk memberitahu bahwa gagal login 
        // dua variabel page dan err 
        redirect("?page=login&err=1");
    }