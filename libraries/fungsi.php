 <?php 
    function cek_akses($koneksi, $id_modul, $id_role, $action)
    {
        $sql = "select * from modul_role 
        where id_modul=$id_modul and id_role=$id_role and is_$action=1 and deleted_at is null";

        $result = mysqli_query($koneksi,$sql); 
        $num = mysqli_num_rows($result);

        if($num > 0)
        {
            return true; // berhak mengakses
        }
        return false; 
    }

    function insert_data($koneksi,$nama_tabel,$data) 
    {
        $col = [];
        $val = []; 
        foreach($data as $k => $v)
        {
                $col[] = $k; 
                $val[] = "'".$v."'"; 
        }

        $sql = "INSERT INTO ".$nama_tabel." (".implode(',',$col).") VALUES (".implode(',',$val).")";
        
        // fungsi pengecekkan masuk tidaknya data
        // echo $sql; 
        // die; 

        mysqli_query($koneksi,$sql); 



    }

    function update_data($koneksi, $nama_tabel, $data, $id, $pk)
    {
        // UPDATE [nama tabel] SET col1=val1, col2=val2,... WHERE [pk]=[id]
        $sql = "UPDATE $nama_tabel SET ";

        $update = [];
        foreach($data as $col => $val)
        {
            $update[] = "$col='$val'";
        }
            $sql .= implode(",", $update); 
            $sql .= " WHERE $pk=$id"; 

            mysqli_query($koneksi, $sql); 
    }

    function redirect($page){
        echo "<script>
            window.location.replace('$page');
        </script>";
    }

    