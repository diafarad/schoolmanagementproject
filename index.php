<?php

require_once "public/web/rooting.php";
require_once "public/web/menu.php";

require_once "model/DB.php";
require_once "model/ClasseDB.php";
require_once "model/ProfesseurDB.php";
require_once "model/MatiereDB.php";
require_once "model/StatsDB.php";


if(isset($_GET['page']))
{
    switch ($_GET['page'])
    {
        case 'accueil':
            $nbreClasses = getNombreClasse();
            $nbreClasses = mysqli_fetch_row($nbreClasses);
            require_once "view/accueil/index.php";
            break;
        case 'classe':
            $classes = listeClasse();
            require_once "view/classe/index.php";
            break;
        case 'inscription':
            require_once "view/inscription/index.php";
            break;
        case 'reinscription':
            require_once "view/inscription/reinscription.php";
            break;
        case 'eleve':
            require_once "view/eleve/index.php";
            break;
        case 'professeur':
            $professeurs = listeProfesseur();
            require_once "view/professeur/index.php";
            break;
        case 'cours':
            $classes = listeClasse();
            require_once "view/cours/index.php";
            break;
        case 'matiere':
            $matieres = listeMatiere();
            require_once "view/matiere/index.php";
            break;
        default:
            header("location:".base_url());
            break;
    }
}
?>
