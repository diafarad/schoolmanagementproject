<?php

    function addClasse($libelle,$niveau,$montantIns,$serie,$mensualite)
    {
        $sql = "INSERT INTO classe VALUES (NULL, '$libelle' , '$niveau', '$montantIns', '$serie','$mensualite')";
        return executeSQL($sql);
    }

    function listeClasse()
    {
        $sql = "SELECT * FROM classe";
        return executeSQL($sql);
    }

    function updateClasse($id,$libelle,$niveau,$montantIns,$serie,$montantMens)
    {
        $sql = "UPDATE classe SET libelle = '$libelle',
                                  niveau = '$niveau',
                                  montantInscription = '$montantIns',
                                  serie = '$serie',
                                  mensualite = '$montantMens'
                                  WHERE id = $id";
        return executeSQL($sql);
    }

    function deleteClasse($id)
    {
        $sql = "DELETE FROM classe WHERE id = $id";
        return executeSQL($sql);
    }

    function getClasseById($id)
    {
        $sql = "SELECT * FROM classe WHERE id= '$id'";
        return executeSQL($sql);
    }