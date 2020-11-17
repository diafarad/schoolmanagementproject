<?php

$dataRes= array();
$conn = getConnection();

$sql = "SELECT COUNT(id), anneeAcad  FROM inscription GROUP BY anneeAcad LIMIT 10";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){
    $nbre = $row[0];
    $annee = $row[1];
    //var_dump($row);
    $dataRes[] = array("y" => $nbre, "label" => $annee);
}

/********************************************************/
$dataRes1= array();
$anneeEncours = getAnneeEnCours();
$sql2 = "SELECT COUNT(i.id), c.niveau FROM inscription i, classe c WHERE i.classe=c.id AND i.anneeAcad='$anneeEncours' GROUP BY c.niveau";
$result1 = mysqli_query($conn,$sql2);

while($row = mysqli_fetch_array($result1)){
    $nbre = $row[0];
    $niveau = $row[1];
    //var_dump($row);
    $dataRes1[] = array("label" => $niveau, "y" => $nbre);
}

/********************************************************/
$dataRes2= array();
$sql3 = "SELECT COUNT(i.id), c.serie FROM inscription i, classe c WHERE i.classe=c.id AND i.anneeAcad='$anneeEncours' GROUP BY c.serie";
$result2 = mysqli_query($conn,$sql3);

while($row = mysqli_fetch_array($result2)){
    $nbre = $row[0];
    $serie = $row[1];
    //var_dump($row);
    $dataRes2[] = array("y" => $nbre, "label" => $serie);
}

/********************************************************/
$dataRes3= array();
$sql4 = "SELECT COUNT(i.id) ok, c.libelle
          FROM inscription i, classe c, eleve e 
          WHERE e.genre='m' AND e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$anneeEncours'
        
           GROUP BY c.libelle,c.id
           LIMIT 10";
$result3 = mysqli_query($conn,$sql4);

while($row = mysqli_fetch_array($result3)){
    $nbre = $row[0];
    $classe = $row[1];
    //var_dump($row);
    $dataRes3[] = array("label" => $classe,"y" => $nbre);
}

$dataRes4= array();
$sql5 = "SELECT COUNT(i.id) ok, c.libelle 
          FROM inscription i, classe c, eleve e 
          WHERE e.genre='f' AND e.mat=i.eleve AND i.classe=c.id AND i.anneeAcad='$anneeEncours' 
           GROUP BY c.libelle, c.id
           LIMIT 10";
$result4 = mysqli_query($conn,$sql5);

while($row = mysqli_fetch_array($result4)){
    $nbre = $row[0];
    $classe = $row[1];
    //var_dump($row);
    $dataRes4[] = array("label" => $classe,"y" => $nbre);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stats</title>
    <script src="<?php echo base_url(); ?>public/js/jquery-3.3.1.js"></script>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light4",
                title:{
                    text: "Nombre d'Inscriptions par Année Académique",
                    fontSize : 15
                },
                axisY: {
                    title: "Inscriptions"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataRes, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            var chart1 = new CanvasJS.Chart("chartContainer1", {
                theme: "light4",
                animationEnabled: true,
                title: {
                    text: "Inscriptions par Niveau",
                    fontSize : 15
                },
                data: [{
                    type: "pie",
                    indexLabel: "{y}",
                    yValueFormatString: "#,##0",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "#36454F",
                    indexLabelFontSize: 18,
                    indexLabelFontWeight: "bolder",
                    showInLegend: true,
                    legendText: "{label}",
                    dataPoints: <?php echo json_encode($dataRes1, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                title:{
                    text: "Inscriptions par Serie",
                    fontSize : 15
                },
                axisY: {
                    title: "Nombre d'inscrits",
                    includeZero: true
                },
                data: [{
                    type: "bar",
                    yValueFormatString: "#,##0",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataRes2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();

            var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,
                theme: "light4",
                title:{
                    text: "Effectifs Gar/Fil par Classe",
                    fontSize : 15
                },
                axisY:{
                    includeZero: true
                },
                legend:{
                    cursor: "pointer",
                    verticalAlign: "center",
                    horizontalAlign: "right",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "Garçons",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataRes3, JSON_NUMERIC_CHECK); ?>
                },{
                    type: "column",
                    name: "Filles",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataRes4, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart3.render();

            function toggleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else{
                    e.dataSeries.visible = true;
                }
                chart3.render();
            }

        }

        $(document).on( "click", '#lancer',function(event) {
            event.preventDefault();
            var an = $('#ann').val();
            //alert(an);
            //var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>controller/StatsController.php",
                method: "POST",
                data: {ann : an},
                dataType: "json",
                success: function(dataRes) {
                    //alert('YES');
                    var chart1 = new CanvasJS.Chart("chartContainer1", {
                        theme: "light4",
                        animationEnabled: true,
                        title: {
                            text: "Inscriptions par Niveau",
                            fontSize : 15
                        },
                        data: [{
                            type: "pie",
                            indexLabel: "{y}",
                            yValueFormatString: "#,##0",
                            indexLabelPlacement: "inside",
                            indexLabelFontColor: "#36454F",
                            indexLabelFontSize: 18,
                            indexLabelFontWeight: "bolder",
                            showInLegend: true,
                            legendText: "{label}",
                            dataPoints: dataRes
                        }]
                    });
                    chart1.render();
                },
                error: function(data){
                    console.log('ERREUR : ' + data);
                }
            });
        });

        $(document).on( "click", '#lancerSer',function(event) {
            event.preventDefault();
            var an = $('#annSer').val();
            //alert(an);
            //var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>controller/StatsController.php",
                method: "POST",
                data: {annSer : an},
                dataType: "json",
                success: function(dataRes) {
                    //alert('YES');
                    var chart2 = new CanvasJS.Chart("chartContainer2", {
                        animationEnabled: true,
                        title:{
                            text: "Inscriptions par Serie",
                            fontSize : 15
                        },
                        axisY: {
                            title: "Nombre d'inscrits",
                            includeZero: true
                        },
                        data: [{
                            type: "bar",
                            yValueFormatString: "#,##0",
                            indexLabel: "{y}",
                            indexLabelPlacement: "inside",
                            indexLabelFontWeight: "bolder",
                            indexLabelFontColor: "white",
                            dataPoints: dataRes
                        }]
                    });
                    chart2.render();
                },
                error: function(data){
                    console.log('ERREUR : ' + data);
                }
            });
        });
    </script>
</head>
<body>

<div class="container" style="margin-top: 50px">

    <div class="row">
        <div style="float: left; border: 2px solid black; width: 50%; height: 350px" class="left">
            <div id="chartContainer" style="height: 330px; max-width: 920px; margin: 0px auto; font-size: 5px"></div>
        </div>
        <div style="float: right; border: 2px ridge black; width: 50%; height: 350px" class="right">
            <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
            <div class="form-inline" style="float: right; margin-top: 5px; margin-right: 5px">
                <input type="text" id="ann" placeholder="Année académique" class="form-control">
                <input type="button" id="lancer" value="Lancer" class="btn btn-primary">
            </div>
        </div>
    </div>

    <div class="row">
        <div style="float: right; border: 2px ridge black; width: 50%; height: 350px" class="right">
            <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
            <div class="form-inline" style="float: right; margin-top: 5px; margin-right: 5px">
                <input type="text" id="annSer" placeholder="Année académique" class="form-control">
                <input type="button" id="lancerSer" value="Lancer" class="btn btn-primary">
            </div>
        </div>
        <div style="float: right; border: 2px solid black; width: 50%; height: 350px" class="left">
            <div id="chartContainer3" style="height: 330px; width: 100%;"></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/canvasjs-3.2/canvasjs.min.js"></script>
</body>
</html>
