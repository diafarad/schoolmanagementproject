<?php

require_once '../model/DB.php';
require_once '../model/MatiereDB.php';


    $ok = 0;
    if(isset($_POST['validerm'])){
        $lib = $_POST['libm'];

        $ok = addMatiere($lib);
        header("location:..?page=matiere&resultA=$ok");
    }

    if(isset($_POST['enregistrerm']))
    {
        $ok = updateMatiere($_POST['matiere_id'],$_POST['libellem']);
        header("location:..?page=matiere&resultE=$ok");
    }

    if(isset($_POST['supprimerm']))
    {
        $ok = deleteMatiere($_POST['idm_del']);
        header("location:..?page=matiere&resultS=$ok");
    }
