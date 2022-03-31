<?php
if (defined("GELANG") === false) {
    // tidak punya gelang
    die("Anda tidak berhak membuka file ini");
}
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Transaksi</h1>
</div>
<?php
    $is_allow_hapus = cek_akses($connection,2,$_SESSION['id_role'],"delete"); 
    $is_allow_edit = cek_akses($connection,2,$_SESSION['id_role'],"update"); 
    $is_allow_add = cek_akses($connection,2,$_SESSION['id_role'],"create"); 

?>

<?php if($is_allow_add):?>
</p>
    <a href="?page=transaksi_create" class="btn btn-success">Tambah Baru</a>
    <a href="?page=transaksi_excel" class="btn btn-info">Export Excel</a>
    <a href="?page=transaksi_chart" class="btn btn-warning">Chart</a>

</p>
<?php endif; ?> 


<?php 
$sql = "SELECT t.*, group_concat(kt.nama_kelompok_transaksi separator '#') as kelompok
FROM transaksi_kelompok as tk
JOIN transaksi as t ON t.id_transaksi=tk.id_transaksi
JOIN kelompok_transaksi as kt ON kt.id_kelompok_transaksi=tk.id_kelompok_transaksi
WHERE tk.deleted_at IS NULL AND t.deleted_at is NULL
GROUP BY t.id_transaksi";

$hasil = mysqli_query($connection, $sql);

echo "<table class='table table-striped'>";
echo "<tr>
    <th>No.</th>
    <th>Uraian</th>
    <th>Nominal</th>
    <th>Pemasukan?</th> 
    <th>Action</th>
    </tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($hasil)) 
{

    $arr_button =[];


    $arr_button[] ="<a href='?page=transaksi_word&id=".$row['id_transaksi']."'class='btn btn-sm btn-primary'>Cetak</a>";

    if($is_allow_edit)
        $arr_button[] ="<a href='?page=transaksi_edit&id=".$row['id_transaksi']."'class='btn btn-sm btn-info'>Edit</a>";
    if($is_allow_hapus)
        $arr_button[] ="<a href='?page=transaksi_delete&id=".$row['id_transaksi']."'class='btn btn-sm btn-danger'>Hapus</a>";
    
    if($row['is_masuk'] == 1)
    {
        $jenis = "Ya";
    }
    else
    {
        $jenis = "Tidak";
    }

    $kel=explode("#",$row['kelompok']);
    $txt_kel="";
    foreach($kel as $k )
    {
        $txt_kel .= "<span class='badge rounded-pill bg-primary'>$k</span>";
    }

    echo "<tr>
            <td>" . $no . "</td>
            <td>" . $row['uraian']." <br/>" .$txt_kel."</td>
            <td>" . $row['nominal'] . "</td>
            <td>" . $jenis . "</td>
            <td>
                 ".implode(" ",$arr_button)."
            </td> 
        </tr>";

    $no++;
}

echo "</table>";
?>