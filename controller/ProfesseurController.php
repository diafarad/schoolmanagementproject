<?php

require_once '../model/DB.php';
require_once '../model/ProfesseurDB.php';

    $ok = 0;
    if(isset($_POST['validerp'])){
        $nom = $_POST['nomp'];
        $dateNaiss = $_POST['datep'];
        $lieu = $_POST['lieup'];
        $sexe = $_POST['sexep'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $nb = "SELECT COUNT(*) FROM professeur";
        $res = mysqli_fetch_row(mysqli_query($con, $nb));
        $increment = $res[0]+1;
        $year=substr($dateNaiss,0,4);
        $mat = 'pf_'.$year.$increment; // pf_19865

        $ok = addProfesseur($mat,$nom,$dateNaiss,$lieu,$sexe);
        header("location:..?page=professeur&resultA=$ok");
    }

    $oki = 0;
    if(isset($_POST['enregistrerp'])){
        $nom = $_POST['nomp'];
        $dateNaiss = $_POST['datep'];
        $lieu = $_POST['lieup'];
        $sexe = $_POST['sexep'];
        $mat = $_POST['matp'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $oki = updateProfesseur($mat,$nom,$dateNaiss,$lieu,$sexe);
        header("location:..?page=professeur&resultE=$ok");
    }

    if(isset($_POST['supprimerp']))
    {
        $ok = deleteClasse($_POST['idp_del']);
        header("location:..?page=professeur&resultS=$ok");
    }

    if (isset($_GET['profid'])){
        $conn = getConnection();
        $an = getAnneeEnCours();
        $prof = $_GET['profid'];

        $query ="SELECT m.libelle,c.coef,cl.libelle FROM cours c, matiere m, classe cl
                        WHERE c.matiere=m.id AND c.classe=cl.id AND c.anneeAcad='$an' AND c.professeur='$prof'";

        $result = mysqli_query($conn,$query);
        $output = '';
        while($res = mysqli_fetch_array($result)){
            $output .= '<tr>';
            $output .= '<td style="text-align:center;">'.$res[0].'</td>';
            $output .= '<td style="text-align:center;">'.$res[1].'</td>';
            $output .= '<td style="text-align:center;">'.$res[2].'</td>';
            $output .= '</tr>';
        }

        echo $output;
    }