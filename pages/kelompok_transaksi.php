<?php
if (defined("GELANG") === false) {
    // tidak punya gelang
    die("Anda tidak berhak membuka file ini");
}
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Kelompok Transaksi</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
        </button>
    </div>
</div>
<?php
    $is_allow_hapus = cek_akses($connection,1,$_SESSION['id_role'],"delete"); 
    $is_allow_edit = cek_akses($connection,1,$_SESSION['id_role'],"update"); 
    $is_allow_add = cek_akses($connection,1,$_SESSION['id_role'],"create"); 

?>

<?php if($is_allow_add):?>
</p>
    <a href="?page=kelompok_transaksi_create" class="btn btn-success">Tambah Baru</a>
</p>
<?php endif; ?> 


<?php 

$sql = "SELECT * FROM kelompok_transaksi WHERE deleted_at IS NULL";

$hasil = mysqli_query($connection, $sql);



echo "<table class='table table-striped'>";
echo "<tr>
    <th>No.</th>
    <th>Nama Kelompok Transaksi</th>
    <th>Dibuat Pada</th>
    <th>Waktu Update</th> 
    <th>Action</th>
    </tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($hasil)) 
{

    $arr_button =[];
    if($is_allow_edit)
        $arr_button[] ="<a href='?page=kelompok_transaksi_edit&id=".$row['id_kelompok_transaksi']."'class='btn btn-sm btn-info'>Edit</a>";
    if($is_allow_hapus)
        $arr_button[] ="<a href='?page=kelompok_transaksi_delete&id=".$row['id_kelompok_transaksi']."'class='btn btn-sm btn-danger'>Hapus</a>";
   
    echo "<tr>
            <td>" . $no . "</td>
            <td>" . $row['nama_kelompok_transaksi'] . "</td>
            <td>" . $row['created_at'] . "</td>
            <td>" . $row['updated_at'] . "</td>
            <td>
                 ".implode(" ",$arr_button)."
            </td> 
        </tr>";

    $no++;
}

echo "</table>";
?>