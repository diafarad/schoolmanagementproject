<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 13/06/2020
 * Time: 00:42
 */
    function addMatiere($libelle)
    {
        $sql = "INSERT INTO matiere VALUES (NULL, '$libelle')";
        return executeSQL($sql);
    }

    function listeMatiere()
    {
        $sql = "SELECT * FROM matiere";
        return executeSQL($sql);
    }