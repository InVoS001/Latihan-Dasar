<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Tambah Kelompok</h1>
</div>


<form action="?page=kelompok_transaksi_save" method="post">
    <table class="table">
        <tr>
            <td width="20%">Nama Kelompok</td>
            <td width="30px">:</td>
            <td><input type="text" name="nama_kelompok_transaksi" class="form-control"/></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Simpan" class="btn btn-primary"/></td>
            
        </tr>

    </table>


</form>
