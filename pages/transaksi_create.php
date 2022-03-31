<?php 
    if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Transaksi</h1>
</div>

<?php
    $sql = "select * from kelompok_transaksi where deleted_at is null";
    $kelompok = mysqli_query($connection,$sql);
?>


<form action="?page=transaksi_save" method="post">
    <table class="table">
        <tr>
            <td width="20%">Uraian Transaksi</td>
            <td width="30px">:</td>
            <td><input type="text" name="uraian" class="form-control"/></td>
        </tr>

         <tr>
            <td>Nominal</td>
            <td>:</td>
            <td>
                <input type="number" name="nominal" class="form-control"/>
            </td>
            
        </tr>
         <tr>
            <td>Jenis Transaksi</td>
            <td>:</td>
            <td>
                <input type="radio" name="is_masuk" value="1"/> Pemasukan  <input type="radio" name="is_masuk" value="0"/> Pengeluaran
            </td>
            
        </tr>
         <tr>
            <td>Kelompok Transaksi</td>
            <td>:</td>
            <td>
                <?php 
                    while($row = mysqli_fetch_assoc($kelompok))
                    {
                        $k = $row['id_kelompok_transaksi'];
                        echo "<input type='checkbox' name='kelompok[]' value='$k'/> ".$row['nama_kelompok_transaksi']."<br />";
                    }
                ?>
            </td>
            
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" value="Simpan" class="btn btn-primary"/>
                <a href="?page=transaksi" class="btn btn-light">Batalkan</a>
            </td>
            
        </tr>

    </table>


</form>
