<?php

    function getConnection()
    {
        define("HOST", "localhost");
        define("USER", "root");
        define("PASSWORD", "");
        define("DBNAME","DB_School");

        $conn = mysqli_connect(HOST,USER,PASSWORD,DBNAME);
        mysqli_set_charset($conn,"utf8");
        return $conn;
    }

    function executeSQL($sql)
    {
        return mysqli_query(getConnection(), $sql);
    }

    function closeConnexion($connexion)
    {
        mysqli_close($connexion);
    }

    function beginTransaction(){
        mysqli_autocommit(getConnection(), false);
    }

    function endTransaction(){
        mysqli_autocommit(getConnection(), true);
    }

    function commit(){
        mysqli_commit(getConnection());
    }

    function roolback(){
        mysqli_rollback(getConnection());
    }

    function getAnneeEnCours() {
        $annee = date('Y');
    	$mois = date('n');
    	$anneeSuiv = $annee + 1;
    	$anneePrec = $annee - 1;

    	$an1 = ''.$annee."-".$anneeSuiv;
    	$an2 = ''.$anneePrec."-".$annee;

    	$anneeAcad = '';
    	switch($mois)
        {
            case 7:
                $anneeAcad = $an1;
                break;
            case 8:
                $anneeAcad = $an1;
                break;
            case 9:
                $anneeAcad = $an1;
                break;
            case 10:
                $anneeAcad = $an1;
                break;
            case 11:
                $anneeAcad = $an1;
                break;
            case 12:
                $anneeAcad = $an1;
                break;
            case 1:
                $anneeAcad = $an2;
                break;
            case 2:
                $anneeAcad = $an2;
                break;
            case 3:
                $anneeAcad = $an1;
                break;
            case 4:
                $anneeAcad = $an1;
                break;
            case 5:
                $anneeAcad = $an1;
                break;
            case 6:
                $anneeAcad = $an1;
                break;
            default :
                $anneeAcad = $an1;
        }
        return $anneeAcad;
    }