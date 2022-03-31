<?php 
    if(defined("GELANG") === false) 
    {
        // tidak punya gelang 
        die("Anda tidak berhak membuka file ini secara langsung");
    }
    // fungsi 
    session_destroy();
    // variabel lain msg=1
    redirect('?page=login&msg=1'); 