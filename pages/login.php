<?php
if (defined("GELANG") === false) {
    // tidak punya gelang
    die("Anda tidak berhak membuka file ini");
}
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Login Form</h1>
</div>

<?php
    if(isset($_GET['err']))
    {
        $err = $_GET['err'];
        if($err==1)
        {
            // untuk mengetahui kesalahan memasukkan data 
            echo "<div class='alert alert-danger'>Username atau password Anda salah!</div>"; 
        }
        elseif($err == 2){
            echo "<div class='alert alert-danger'>Anda harus login terlebih dahulu!</div>"; 
        }
    }

    if(isset($_GET['msg']))
    {
        $msg=$_GET['msg'];

        if($msg==1)
        {
            echo "<div class='alert alert-success'>Logout sukses dilakukan</div>"; 
        }
    }
?>

<form action="?page=login_proses" method="post">
    <div class="row mb-3">
        <label class="form-label">Username</label>
        <div class="col-5">
            <input type="text" name="username" class="form-control"/>
        </div>
    </div>

    <div class="row mb-3">
        <label class="form-label">Password</label>
        <div class="col-4">
            <input type="password" name="password" class="form-control"/>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Log In"/>
</form>