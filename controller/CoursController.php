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