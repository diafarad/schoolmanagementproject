<?php

require_once '../model/DB.php';
require_once '../model/EleveDB.php';


    if(isset($_GET['mat']))
    {
        $ok = getEleveByMat($_GET['mat']);
        $ok = mysqli_fetch_row($ok);
        echo json_encode($ok);
    }

    if(isset($_POST['annee']) && isset($_POST['classe'])){
        $data= array();
        $conn = getConnection();
        $an = $_POST['annee'];
        $cl = $_POST['classe'];

        $query ="SELECT * FROM eleve e, inscription i, classe c 
                    WHERE e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$an' AND c.id='$cl' 
                    ORDER BY e.nom ASC";

        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($result)){
            $mat = $row[0];
            $nom = $row[1];
            $prenom = $row[2];
            $date = $row[3];
            $lieu = $row[4];
            $mail = $row[5];
            $tel = $row[6];
            $genre = $row[7];

            $data[] = array("mat" => $mat,
                            "nom" => $nom,
                            "prenom" => $prenom,
                            "date" => $date,
                            "lieu" => $lieu,
                            "mail" => $mail,
                            "tel" => $tel,
                            "genre" => $genre);
        }

        echo json_encode($data);
    }

    $ok = 0;
    if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['mail']) && isset($_POST['tel']) && isset($_POST['sexe']) && isset($_POST['mat'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['date'];
        $lieu = $_POST['lieu'];
        $mail = $_POST['mail'];
        $tel = $_POST['tel'];
        $sexe = $_POST['sexe'];
        $mat = $_POST['mat'];

        $con = getConnection();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $ok = updateEleve($mat,$nom,$prenom,$dateNaiss,$lieu,$mail,$tel,$sexe);
        return $ok;
    }

    if(isset($_POST['anNote']) && isset($_POST['clNote']) && isset($_POST['semNote']) && isset($_POST['matNote'])){
        $data= array();
        $conn = getConnection();
        $an = $_POST['anNote'];
        $cl = $_POST['clNote'];
        $sem = $_POST['semNote'];
        $mat = $_POST['matNote'];



        $query ="SELECT m.libelle AS matiere , CAST(CAST(SUM(nd.valeur) AS DECIMAL(18,2))/CAST(COUNT(nd.evaluation) AS DECIMAL(18,2)) AS DECIMAL(18,2)) AS noteDevoir, ne.valeur AS noteExamen, cr.coef AS 'Coef.' 
                    FROM note nd, evaluation ed, note ne, evaluation ee, matiere m, classe c, cours cr
                    WHERE ed.idEv=nd.evaluation AND ee.idEv=ne.evaluation 
                    AND c.id=ed.classe AND c.id=ee.classe AND c.id='$cl'
                    AND cr.classe=c.id AND cr.matiere=ee.idMatiere AND cr.matiere=ed.idMatiere
                    AND m.id=ed.idMatiere AND m.id=ee.idMatiere 
                    AND nd.evaluation=ed.idEv AND ne.evaluation=ee.idEv 
                    AND nd.semestre='$sem' AND ne.semestre='$sem' 
                    AND nd.eleve='$mat' AND ne.eleve='$mat' 
                    AND nd.anneeAcad='$an' AND ne.anneeAcad='$an' 
                    AND ed.typeEv='devoir' AND ee.typeEv='examen' 
                  GROUP BY m.libelle
                  ORDER BY m.libelle ASC";

        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($result)){
            $matiere = $row['matiere'];
            $devoir = $row['noteDevoir'];
            $examen = $row['noteExamen'];
            $coef = $row['Coef.'];

            $data[] = array("matiere" => $matiere,
                "devoir" => $devoir,
                "examen" => $examen,
                "coef" => $coef);
        }

        echo json_encode($data);
    }