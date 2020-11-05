<?php

require_once '../model/DB.php';
require_once '../model/MatiereDB.php';


    $ok = 0;
    if(isset($_POST['libm'])){
        $lib = $_POST['libm'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $ok = addMatiere($lib);
        return $ok;
    }
