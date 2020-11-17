<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 11/11/2020
 * Time: 14:39
 */

require_once '../model/DB.php';
require_once '../model/CoursDB.php';

if(isset($_POST['mat']) && isset($_POST['coef']) && isset($_POST['prof']) && isset($_POST['classe'])){
    $ok = addCours($_POST['coef'],$_POST['mat'],$_POST['prof'],$_POST['classe']);
    return $ok;
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

if (isset($_GET['idp']) && isset($_GET['an'])){
    $conn = getConnection();
    $prof = $_GET['idp'];
    $an = $_GET['an'];

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