<?php 

$host = "localhost"; #127.0.0.1 
# default instalasi XAMPP = root
$username = "root";
$password = "";
$database = "finance"; 

// jika port diubah, maka ditulisa setelah $database, 
$connection = mysqli_connect($host, $username, $password, $database);

// apakah ada error?
if($connection == false) 
{
    die("Error connecting to MySQL:".mysqli_connect_error()); 
}

// echo "Connection success!"; 