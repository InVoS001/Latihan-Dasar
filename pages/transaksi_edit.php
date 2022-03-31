<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Edit Transaksi</h1>
</div>

<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM transaksi WHERE id_transaksi=$id"; 
    $result = mysqli_query($connection, $sql); 

    $row = mysqli_fetch_assoc($result); 
?>

<form action="?page=transaksi_update&id=<?php echo $id;?>" method="post">
    <table class="table">
        <tr>
            <td width="20%">Uraian</td>
            <td width="30px">:</td>
            <td><input type="text" name="uraian" value="<?php echo $row['uraian'];?>" class="form-control"/></td>
        </tr>
        <tr>
            <td width="20%">Nominal</td>
            <td width="30px">:</td>
            <td><input type="text" name="nominal" value="<?php echo $row['nominal'];?>" class="form-control"/></td>
        </tr>
        <tr>
            <td width="20%">Jenis Transaksi</td>
            <td width="30px">:</td>
            <td><input type="text" name="is_masuk" value="<?php echo $row['is_masuk'];?>" class="form-control"/></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Update" class="btn btn-primary"/>
            <a href="?page=transaksi" class="btn btn-light">Batalkan</a>
        </td>
            
        </tr>

    </table>


</form>
