<?php
require "vendor/autoload.php";

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("./tamplate.docx");

$id = $_GET['id'];
$sql = "select * from transaksi where id_transaksi=".$id." and deleted_at is null";

$hasil = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($hasil);

if($row['is_masuk'] == 1)
{
    $jenis = "Pemasukan";
}
else
{
    $jenis = "Pengeluaran";
}

$templateProcessor->setValue('uraian', $row['uraian']);
$templateProcessor->setValue('nominal', $row['nominal']);
$templateProcessor->setValue('jenis',$jenis);

$templateProcessor->saveAs("transaksi.docx");

?>