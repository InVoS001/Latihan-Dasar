<?php
// fungsi
// syarat untuk memanfaatkan session  
session_start();
?>

<!doctype html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Finance Application</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <?php
                if(isset($_SESSION['nama'])) 
                {
                    //sudah login
                    echo '<a class="nav-link px-3" href="?page=logout">Sign Out</a>';
                } 
                else 
                {
                    // belum login 
                    echo '<a class="nav-link px-3" href="?page=login">Log In</a>';
                }
                ?>
            </div>
        </div>
    </header>

    <?php
        // koneksi ke database
        require_once "libraries/connect.php";
        require_once "libraries/fungsi.php";
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php 
            if(isset($_SESSION['nama'])):
                $sql = "select *from modul_role as mr
                inner join modul as m on mr.id_modul=m.id_modul
                where mr.id_role= ".$_SESSION['id_role']."
                and mr.deleted_at is null and mr.is_read=1";
                 $menu = mysqli_query($connection, $sql);
            ?>
             <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">

                            <?php
                            while($row = mysqli_fetch_assoc($menu)) 
                            {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="?page=<?php echo $row['nm_modul'];?>">
                                        <span data-feather="<?php echo $row['icon_modul'];?>"></span>
                                        <?php echo $row['judul_modul'];?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            <?php endif; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php
                ini_set("display_errors", 1);

                define("GELANG", true);

                // ?page=daftar

                // jika index "page" tidak ditemukan
                if (isset($_GET['page']) == false) 
                {
                    //tidak ditemukan
                    $halaman = "pages/main";
                    $page_to_open = "main"; 
                }
                else 
                {
                    $page_to_open = $_GET['page']; 
                    $halaman = "pages/".$_GET['page'];

                    //cek apakah ada atau tidak
                    if(file_exists($halaman . ".php") == false) 
                    {
                        //tidak ditemukan file ini
                        $halaman = "pages/404";
                    }
                }

                // mengakses web
                $unprotected_page = ['login', 'login_proses', 'logout', 'main', '404', '403'];
                // yang tidak ada di halaman 
                if(in_array($page_to_open, $unprotected_page) == false)
                {
                    // apakah sudah login?
                    if(isset($_SESSION['nama']) == false) 
                    {
                        // belum login
                        redirect('?page=login&err=2');
                        exit;
                    }

                    // cek authorization
                    $id_role = $_SESSION['id_role']; 

                    // modul yang mana? 
                    $split_page = explode("_",$page_to_open); 
                    // print_r($splite_page);
                    // die;

                    $mapping_action = [
                        'create' => 'create',
                        'delete' => 'delete',
                        'edit'=> 'update',
                        'save'=> 'save',
                        'update' => 'update',
                        'list' => 'read',
                        'pdf' => 'read',
                        'excel' => 'read',
                        'word' => 'read',
                        'chart' => 'read'
                    ];
                    $action = array_pop($split_page); 

                    if(isset($mapping_action[$action]) == false)
                    {
                        $action_db = "read";
                        $nama_modul = $page_to_open;
                    }
                    else 
                    {
                        $action_db = $mapping_action[$action]; 
                        $nama_modul = implode("_",$split_page);
                    }
                    // cari ID MODUL dari nama modulnya 
                    $sql = "select * from modul where nm_modul='$nama_modul' and deleted_at is null";
                    $modul = mysqli_query($connection,$sql);
                    $row_modul = mysqli_fetch_assoc($modul);

                    $id_modul = $row_modul['id_modul']; 

                    // cek kewenangan 
                    $cek_akses = cek_akses($connection,$id_modul,$id_role,$action_db);
                    
                    if($cek_akses == false)
                    {
                        redirect("?page=403");
                        exit; 
                    }
                }

                include $halaman.".php"; //include ada untuk mengambil data profil.php lalu dimasukkan ke data php
                ?>
            </main>
        </div>
    </div>


    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> -->
    <script src="dashboard.js"></script>
   <!-- <script scr="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js" ></script> -->
    <script src="assets/js/dashboard.js"></script>
</body>

</html>