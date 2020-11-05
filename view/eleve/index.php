<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classe</title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.css"/>
    <script src="<?php echo base_url(); ?>public/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url(); ?>public/js/bootstrap-3.4.0.min.js"></script>
    <script src="<?php echo base_url(); ?>public/jquery-ui-1.12.1/jquery-ui-1.12.1/jquery-ui.js"></script>
</head>
<body>

<div class="container" style="margin-top: 50px">
    <div id="action_alert" title="Message"></div>
    <form class="form-inline" style="margin-top: 15px; margin-bottom: 15px">
        <center>
            <div class="form-group">
                <input type="text" class="form-control" id="annee" placeholder="Entrer l'année académique">
            </div>
            <div class="form-group">
                <select class="form-control" id="classe" name="classe">
                    <option value="" > <?php echo "Sélectionner la classe";?> </option>
                    <?php
                    include_once "../../model/DB.php";
                    include_once "../../model/ClasseDB.php";
                    $list = listeClasse();
                    while($row = mysqli_fetch_row($list)){
                        ?>
                        <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                    <?php } ?>
                </select>
            </div>
        </center>
    </form>
    <div class="panel panel-info ">
        <div class="panel-heading" align="center">Listes des élèves</div>
        <div class="panel-body">
            <table id="result" class="table table-bordered table-striped" style="width:100%; padding-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Matricule</th>
                    <th style='text-align:center;'>Nom</th>
                    <th style='text-align:center;'>Prénom-s</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                    <th style="text-align: center">Téléphone </th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="8" style='text-align:center; font-weight: normal;'>Pas de correspondance</th>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Matricule</th>
                    <th style='text-align:center;'>Nom</th>
                    <th style='text-align:center;'>Prénom-s</th>
                    <th style='text-align:center;'>Date de Naiss</th>
                    <th style="text-align: center">Lieu de Naiss</th>
                    <th style="text-align: center">Genre</th>
                    <th style="text-align: center">Téléphone </th>
                    <th style="text-align: center">Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Modal for Edit button -->
<div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" align="center">Édition élève</h4>
            </div>
                <div class="modal-body">
                    <form method="post" id="form_editioneleve">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input class="form-control eleve_mat" type="hidden" id="mat" name="mat" required>
                                <label class="control-label">Prénom-s</label>
                                <input class="form-control eleve_prenom" id="prenom" name="prenom" placeholder="Entrer le-s prénom-s" >
                                <span id="err_prenom" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="heading">Nom</label>
                                <input class="form-control eleve_nom" type="text" id="nom" name="nom">
                                <span id="err_nom" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Date Naiss</label>
                                <input class="form-control eleve_date" type="date" id="date" name="date" placeholder="Sélectionner la date de naiss" >
                                <span id="err_date" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Lieu de Naiss</label>
                                <input class="form-control eleve_lieu" type="text" id="lieu" name="lieu" placeholder="Entrer le lieu de naiss" >
                                <span id="err_lieu" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                            <label class="control-label">Mail</label>
                            <input class="form-control eleve_mail" type="text" id="mail" name="mail" placeholder="Entrer le mail" >
                            <span id="err_mail" class="text-danger"></span>
                        </div>
                        <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                            <label class="control-label">Téléphone</label>
                            <input class="form-control eleve_tel" type="text" id="tel" name="tel" placeholder="Entrer le téléphone" >
                            <span id="err_tel" class="text-danger"></span>
                        </div>
                        <div class="form-group" style="margin-right: 15px; margin-left: 15px">
                            <div class="form-check form-check-inline">
                                <label class="control-label">Sexe :</label>
                                <input class="form-check-input" style="margin-left: 30px" type="radio" name="sexe" id="sexem" value="m">
                                <label class="form-check-label" for="sexem">Masculin</label>
                                <input class="form-check-input" style="margin-left: 80px" type="radio" name="sexe" id="sexef" value="f">
                                <label class="form-check-label" for="sexef">Féminin</label>
                            </div>
                            <span id="err_sexe" class="text-danger"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="enregistrer" name="enregistrer">Enregistrer</button>
                            <button type="reset" class="btn btn-danger">Annuler</button>

                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<!-- End of Modal for Edit button -->

<script>
    $(document).on( "click", '.edit_button',function(e) {
        var mat = $(this).data('mat');
        var nom = $(this).data('nom');
        var prenom = $(this).data('prenom');
        var date = $(this).data('date');
        var lieu = $(this).data('lieu');
        var mail = $(this).data('mail');
        var tel = $(this).data('tel');
        var genre = $(this).data('genre');

        $(".eleve_mat").val(mat);
        $(".eleve_nom").val(nom);
        $(".eleve_prenom").val(prenom);
        $(".eleve_date").val(date);
        $(".eleve_lieu").val(lieu);
        $(".eleve_mail").val(mail);
        $(".eleve_tel").val(tel);
        if(genre == 'm'){
            $( "#sexem" ).prop( "checked", true );
        }
        if(genre == 'f'){
            $( "#sexef" ).prop( "checked", true );
        }
    });


    $(document).ready(function () {
        $('#classe').change(function () {
            $('#result > tbody').empty();
            $.ajax({
                url: "<?php echo base_url(); ?>controller/EleveController.php",
                method: "POST",
                data: {
                    annee : $('#annee').val(),
                    classe : $('#classe').val()
                },
                dataType: "json",
                success: function(data) {
                    //alert(data);
                   if(data.length > 0){
                       var len = data.length;
                       for(var i=0; i<len; i++){
                           var mat = data[i].mat;
                           var nom = data[i].nom;
                           var prenom = data[i].prenom;
                           var date = data[i].date;
                           var lieu = data[i].lieu;
                           var mail = data[i].mail;
                           var tel = data[i].tel;
                           var genre = data[i].genre;

                           var tr_str = "<tr>" +
                               "<td align='center'>" + mat + "</td>" +
                               "<td align='center'>" + nom + "</td>" +
                               "<td align='center'>" + prenom + "</td>" +
                               "<td align='center'>" + date + "</td>" +
                               "<td align='center'>" + lieu + "</td>" +
                               "<td align='center'>" + genre + "</td>" +
                               "<td align='center'>" + tel + "</td>" +
                               "<td align='center'><button type='button' class='btn btn-warning btn-xs edit_button'" +
                               "data-toggle='modal' data-target='#myeditModal'" +
                               "data-nom='"+nom+"'" +
                               "data-prenom='"+prenom+"'" +
                               "data-date='"+date+"'" +
                               "data-lieu='"+lieu+"'" +
                               "data-mail='"+mail+"'" +
                               "data-tel='"+tel+"'" +
                               "data-genre='"+genre+"'" +
                               "data-mat='"+mat+"'>Éditer</button></td>" +
                               "</tr>";

                           $("#result tbody").append(tr_str);
                        }
                   }
                    else {
                        $('#result').append("<tr><td colspan='8'><center>Pas de résultat disponible !</center></td></tr>");
                    }
                },
                error: function () {
                    alert("Pas bon");
                }
            });
        });
    });

    $('#enregistrer').click(function () {
        //event.preventDefault();
        var err_prenom = '';
        var err_nom = '';
        var err_date  = '';
        var err_lieu = '';
        var err_sexe = '';
        var prenom = '';
        var nom = '';
        var date = '';
        var lieu = '';
        var sexe = '';
        var mail = $('#mail').val();
        var tel = $('#tel').val();
        var mat = $('#mat').val();

        if($('#prenom').val() == ''){
            err_prenom = 'Saisir le prénom';
            $('#err_prenom').text(err_prenom);
            $('#prenom').css('border-color', '#cc0000');
            prenom = '';
        }else {
            err_prenom = '';
            $('#err_prenom').text(err_prenom);
            $('#prenom').css('border-color', '');
            prenom = $('#prenom').val();
        }
        if($('#nom').val() == ''){
            err_nom = 'Saisir le nom';
            $('#err_nom').text(err_nom);
            $('#nom').css('border-color', '#cc0000');
            nom = '';
        }else {
            err_nom = '';
            $('#err_nom').text(err_nom);
            $('#nom').css('border-color', '');
            nom = $('#nom').val();
        }
        if($('#date').val() == ''){
            err_date = 'Renseigner la date de naissance';
            $('#err_date').text(err_date);
            $('#date').css('border-color', '#cc0000');
            date = '';
        }else {
            err_date = '';
            $('#err_date').text(err_date);
            $('#date').css('border-color', '');
            date = $('#date').val();
        }
        if($('#lieu').val() == ''){
            err_lieu = 'Saisir le lieu de naissance';
            $('#err_lieu').text(err_lieu);
            $('#lieu').css('border-color', '#cc0000');
            lieu = '';
        }else {
            err_lieu = '';
            $('#err_lieu').text(err_lieu);
            $('#lieu').css('border-color', '');
            lieu = $('#lieu').val();
        }
        if (!$("input[name='sexe']:checked").val()) {
            err_sexe = 'Sélectionner le genre';
            $('#err_sexe').text(err_sexe);
            $('#sexef').css('outline', '1px solid red');
            $('#sexem').css('outline', '1px solid red');
            sexe = '';
        }else {
            err_sexe = '';
            $('#err_sexe').text(err_sexe);
            $('#sexef').css('outline', '');
            $('#sexem').css('outline', '');
            if($('#sexef').val() != '' && $('#sexem').val() == ''){
                sexe = $('#sexef').val();
            }
            if($('#sexem').val() != '' && $('#sexef').val() == ''){
                sexe = $('#sexem').val();
            }
        }

        if(err_prenom != '' || err_nom != '' || err_date != '' || err_lieu != '' || err_sexe != ''){
            return false;
        }else {
            var form_data = $('#form_editioneleve').serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>controller/EleveController.php",
                method: "POST",
                data: form_data,
                dataType: "text",
                success: function(data) {
                    //alert(data);
                    $('#myeditModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#action_alert').html('<center><div class="alert alert-success"> Donnée-s modifiée-s</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
                },
                error: function (e) {
                    $('#action_alert').html('<center><div class="alert alert-danger"> Une petite erreur est survenue</div></center>');
                    $("#action_alert").dialog({
                        modal: true,
                        open: function(event, ui){
                            setTimeout("$('#action_alert').dialog('close')",3000);
                        }
                    });
                }
            });
        }

    });

</script>


</body>
</html>
