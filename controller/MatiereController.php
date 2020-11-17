<?php

require_once '../model/DB.php';
require_once '../model/MatiereDB.php';


    $ok = 0;
    if(isset($_POST['libm'])){
        $lib = $_POST['libm'];

        $ok = addMatiere($lib);
        if ($ok == 1)
            echo "<div class='alert alert-success'><center>Matière ajoutée avec succès.</center></div>";
        else
            echo "<div class='alert alert-danger'><center>Une petite erreur est survenue.</br>Réessayer plutard.</center></div>";
    }

    if(isset($_POST['matiere_id']) && isset($_POST['libellem']))
    {
        $ok = updateMatiere($_POST['matiere_id'],$_POST['libellem']);
        if ($ok == 1)
            echo "<div class='alert alert-success'><center>Donnée(s) modifiée(s) avec succès.</center></div>";
        else
            echo "<div class='alert alert-danger'><center>Une petite erreur est survenue.</br>Réessayer plutard.</center></div>";
    }
