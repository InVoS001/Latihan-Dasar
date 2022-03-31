<?php

 if(defined("GELANG") === false){
        // tidak punya gelang
        die("Anda tidak berhak membuka file ini");
    }
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sql = "SELECT t.*, group_concat(kt.nama_kelompok_transaksi separator ',') as kelompok
FROM transaksi_kelompok as tk
JOIN transaksi as t ON t.id_transaksi=tk.id_transaksi
JOIN kelompok_transaksi as kt ON kt.id_kelompok_transaksi=tk.id_kelompok_transaksi
WHERE tk.deleted_at IS NULL AND t.deleted_at is NULL
GROUP BY t.id_transaksi";

$hasil = mysqli_query($connection, $sql);

$sheet->setCellValue("A1","No.");
$sheet->setCellValue("B1","Uraian");
$sheet->setCellValue("C1","Nominal");
$sheet->setCellValue("D1","Jenis Transaksi");
$sheet->setCellValue("C1","Kelompok Transaksi");

$no = 1;
$baris=2;
while ($row = mysqli_fetch_assoc($hasil)) 
{
    if($row['is_masuk'] == 1)
    {
        $jenis = "Pemasukan";
    }
    else
    {
        $jenis = "Pengeluaran";
    }

    $sheet->setCellValue("A".$baris,$no);
    $sheet->setCellValue("B".$baris,$row['uraian']);
    $sheet->setCellValue("C".$baris,$row['nominal']);
    $sheet->setCellValue("D".$baris,$jenis);
    $sheet->setCellValue("E".$baris,$row['kelompok']);
   
    $no++;
    $baris++;
}

$writer = new Xlsx($spreadsheet);

# header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
# header('Content-Disposition: attachment;filename="transaksi.xlsx"');
# header('Cache-Control: max-age=0');

# $writer->save('php://output');

$writer->save("transaksi.xlsx");
