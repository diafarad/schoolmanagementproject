<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 31/03/2020
 * Time: 23:35
 */

    function getNombreClasse()
    {
        $sql = "SELECT count(*) FROM classe";
        return executeSQL($sql);
    }