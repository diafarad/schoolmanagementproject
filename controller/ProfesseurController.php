<?php

require_once '../model/DB.php';
require_once '../model/ProfesseurDB.php';

    $ok = 0;
    if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['mail']) && isset($_POST['tel']) && isset($_POST['sexe'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['date'];
        $lieu = $_POST['lieu'];
        $mail = $_POST['mail'];
        $tel = $_POST['tel'];
        $sexe = $_POST['sexe'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $nb = "SELECT COUNT(*) FROM professeur";
        $res = mysqli_fetch_row(mysqli_query($con, $nb));
        $increment = $res[0]+1;
        $year=substr($dateNaiss,0,4);
        $mat = 'pf_'.$year.$increment; // pf_19865

        $ok = addProfesseur($mat,$nom,$prenom,$dateNaiss,$lieu,$mail,$tel,$sexe);
        return $ok;
    }

    $oki = 0;
    if(isset($_POST['prenomp']) && isset($_POST['nomp']) && isset($_POST['datep']) && isset($_POST['lieup']) && isset($_POST['mailp']) && isset($_POST['telp']) && isset($_POST['sexep']) && isset($_POST['matp'])){
        $nom = $_POST['nomp'];
        $prenom = $_POST['prenomp'];
        $dateNaiss = $_POST['datep'];
        $lieu = $_POST['lieup'];
        $mail = $_POST['mailp'];
        $tel = $_POST['telp'];
        $sexe = $_POST['sexep'];
        $mat = $_POST['matp'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $oki = updateProfesseur($mat,$nom,$prenom,$dateNaiss,$lieu,$mail,$tel,$sexe);
        return $oki;
    }