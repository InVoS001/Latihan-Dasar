<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Edit Kelompok</h1>
</div>

<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM kelompok_transaksi WHERE id_kelompok_transaksi=$id"; 
    $result = mysqli_query($connection, $sql); 

    $row = mysqli_fetch_assoc($result); 
?>

<form action="?page=kelompok_transaksi_update&id=<?php echo $id;?>" method="post">
    <table class="table">
        <tr>
            <td width="20%">Nama Kelompok</td>
            <td width="30px">:</td>
            <td><input type="text" name="nama_kelompok_transaksi" value="<?php echo $row['nama_kelompok_transaksi'];?>" class="form-control"/></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Update" class="btn btn-primary"/>
            <a href="?page=kelompok_transaksi" class="btn btn-light">Batalkan</a>
        </td>
            
        </tr>

    </table>


</form>
