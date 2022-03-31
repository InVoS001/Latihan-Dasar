<?php
if (defined("GELANG") === false) {
    die('Anda Tidak Memiliki Akses Ke Halaman Ini');
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Barang Chart</h1>
</div>

<?php 
    $sql = "SELECT nama_kelompok_transaksi,count(*) as num FROM `kelompok_transaksi` group by nama_kelompok_transaksi";
    $hasil = mysqli_query($connection, $sql);

    $labels = [];
    $data = [];

    if($hasil){
        while ($row = mysqli_fetch_assoc($hasil)) {
            $labels[] = $row['nama_kelompok_transaksi'];
            $data[] = $row['num'];        
        }
    }
?> 

<div class="row">
    <div class="col-6">
        <canvas id="myChart" width="200" height="200"></canvas>
    </div>
</div>

<script>
    
    const data = {
      labels:[<?php echo implode(',', $labels);?>],
      datasets: [{
        label:'Jumlah Transalso',
        data:[<?php echo implode(',', $data);?>],
        fill: false,
        borderColor:'rgb(75, 192, 192)',
        tension: 0.1
      }]
    };

    const config = {
      type: 'line',
      data: data,
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>