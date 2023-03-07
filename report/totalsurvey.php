<?php
include '../configuration/connection.php';
include ROOT_PATH . 'Templets/navbar.php';
// include ROOT_PATH . 'Templets/side_top.php';
include ROOT_PATH . 'controller/report_controller.php';

@$survey_id = $_REQUEST['sid'];
$surveyreport = new report;

$data = $surveyreport->graph_survey_data($_SESSION['id']);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Total Survey</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['status', 'Total'],
                <?php
                while ($row = mysqli_fetch_array($data)) {
                    echo "['" . $row["survey_status"] . "', " . $row["Total"] . "],";
                }
                ?>
            ]);
            var options = {
                title: 'Total survey',
                is3D: true,
                colors: ['#61a481', '#72add9', '#999999', '#e06666']
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div style="border:1px groove;">
        <div id="piechart" style="height:400px;"></div>
    </div>
</body>

</html>
<?php
// include ROOT_PATH . 'Templets/side_footer.php';
?>