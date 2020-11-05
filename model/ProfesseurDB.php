<?php

    function addProfesseur($mat,$nom,$prenom,$date,$lieu,$mail,$tel,$genre)
    {
        $sql = "INSERT INTO professeur VALUES ('$mat', '$nom' , '$prenom', '$date', '$lieu', '$mail', '$tel', '$genre')";
        return executeSQL($sql);
    }

    function listeProfesseur()
    {
        $sql = "SELECT * FROM professeur";
        return executeSQL($sql);
    }

    function updateProfesseur($mat,$nom,$prenom,$date,$lieu,$mail,$tel,$sexe)
    {
        $sql = "UPDATE professeur p SET p.nom = '$nom',
                                      p.prenom = '$prenom',
                                      p.date = '$date',
                                      p.lieu = '$lieu',
                                      p.mail = '$mail',
                                      p.tel = '$tel',
                                      p.genre = '$sexe'
                                      WHERE p.mat = '$mat'";
        return executeSQL($sql);
    }
