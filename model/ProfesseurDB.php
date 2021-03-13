<?php

    function addProfesseur($mat,$nom,$date,$lieu,$genre)
    {
        $sql = "INSERT INTO professeur VALUES ('$mat', '$nom' , '$date', '$lieu', '$genre')";
        return executeSQL($sql);
    }

    function listeProfesseur()
    {
        $sql = "SELECT * FROM professeur";
        return executeSQL($sql);
    }

    function updateProfesseur($mat,$nom,$date,$lieu,$sexe)
    {
        $sql = "UPDATE professeur p SET p.nom = '$nom',
                                      p.date = '$date',
                                      p.lieu = '$lieu',
                                      p.genre = '$sexe'
                                      WHERE p.mat = '$mat'";
        return executeSQL($sql);
    }
