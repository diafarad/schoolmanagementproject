<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classe</title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/Semantic-UI-CSS-master/semantic.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/DataTables/DataTables-1.10.20/css/dataTables.semanticui.min.css"/>
    <script src="<?php echo base_url(); ?>public/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url(); ?>public/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>public/DataTables/DataTables-1.10.20/js/dataTables.semanticui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "language": {
                    "lengthMenu": "Afficher _MENU_ lignes",
                    "zeroRecords": "Pas de correspondance",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun enregistrement disponible",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Suiv.",
                        "previous":   "Préc."
                    },
                    "search":         "Rechercher:"
                },
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Tout"]]
            } );
        } );
    </script>
    <style>
        .ui.stackable.grid{
            margin-left: 15px !important;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 50px">
    <div class="panel panel-info ">
        <div class="panel-heading" align="center">Classes</div>
        <div class="panel-body">
            <table id="example" class="ui celled table" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Libellé</th>
                    <th style='text-align:center;'>Niveau</th>
                    <th style='text-align:center;'>Série</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </thead>
                <tbody>
                    <?php

                    if(isset($_GET['resultA']))
                    {
                        if($_GET['resultA'] == 1)
                        {
                            echo "<div class='alert alert-success'> Données ajoutées</div>";
                        }
                        else
                        {
                            echo "<div class='alert alert-warning'> Erreur de code</div>";
                        }
                    }

                    if(isset($_GET['resultE']))
                    {
                        if($_GET['resultE'] == 1)
                        {
                            echo "<div class='alert alert-success'> Données modifiées</div>";
                        }
                        else
                        {
                            echo "<div class='alert alert-warning'> Erreur de code</div>";
                        }
                    }

                    if(isset($_GET['resultS']))
                    {
                        if($_GET['resultS'] == 1)
                        {
                            echo "<div class='alert alert-success'> Données supprimées</div>";
                        }
                        else
                        {
                            echo "<div class='alert alert-warning'> Erreur de code</div>";
                        }
                    }

                    while($result=mysqli_fetch_row($classes))
                    {
                        echo "
                            <tr>
                                <td style='text-align:center;'>$result[1]</td>
                                <td style='text-align:center;'>$result[2]</td>
                                <td style='text-align:center;'>$result[4]</td>
                                <td><center><button type='button' class='btn btn-info btn-xs addeval_button' 
                                        data-toggle='modal' data-target='#myaddEvModal'
                                        data-anneeencours='$anneeencours'
                                        data-semestreencours='$semestreencours'
                                        data-id='$result[0]'>
                                        Ajouter évaluation
                                    </button>
                                    </center>
                                </td>
                                <td><center><a href='".base_url()."?page=evalclasse&idcl=".$result[0]."' class='btn btn-warning btn-xs'>
                                        Voir les évaluations
                                    </a></center>
                                </td>
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Libellé</th>
                    <th style='text-align:center;'>Niveau</th>
                    <th style='text-align:center;'>Série</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Edit button -->
<div class="modal fade" id="myaddEvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout Évalution</h4>
            </div>
            <form method="post" action="<?php echo base_url(); ?>controller/EvaluationController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Libellé</label>
                        <input class="form-control" name="libelleEval" placeholder="Entrer le libellé" required>
                        <input class="form-control classe_eval" type="hidden" name="idCl" required>
                        <input class="form-control annee_eval" type="hidden" name="anAc" required>
                        <input class="form-control sem_eval" type="hidden" name="semEnCours" required>
                    </div>
                    <div class="form-group">
                        <label for="heading">Matière</label>
                        <select class="form-control" id="matiereEval" name="matiereEval">
                            <option value="" > <?php echo "Sélectionner la matière";?> </option>
                            <?php
                            include_once "../../model/DB.php";
                            include_once "../../model/MatiereDB.php";
                            $list = listeMatiere();
                            while($row = mysqli_fetch_row($list)){
                                ?>
                                <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                            <?php } ?>
                        </select>
                        <span id="err_matiere" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Type Évaluation</label>
                        <select class='selectpicker show-menu-arrow form-control' type="text" name="typeEval" id="typeEval">
                            <option value="devoir" >Devoir</option>
                            <option value="examen" >Examen</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="valider">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal for Edit button -->


<script>

    $(document).on( "click", '.addeval_button',function(e) {
        var id = $(this).data('id');
        var anneeAc = $(this).data('anneeencours');
        var sem = $(this).data('semestreencours');

        $(".classe_eval").val(id);
        $(".annee_eval").val(anneeAc);
        $(".sem_eval").val(sem);
        //tinyMCE.get('business_skill_content').setContent(content);
    });

</script>


</body>
</html>
