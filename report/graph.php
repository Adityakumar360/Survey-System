<?php
include '../configuration/connection.php';
include ROOT_PATH . 'Templets/navbar.php';
include ROOT_PATH . 'controller/report_controller.php';

@$survey_id = $_REQUEST['sid'];
$surveyreport = new report();

$data = $surveyreport->graph_data($survey_id);
$arr_merg = [];
foreach ((array) $data as $q => $a) {
    $arr = [];

    $arr[0] = $q;
    $arr[1] = $a;
    array_push($arr_merg, $arr);
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <link rel="shortcut icon" href="#">
    <style>
        .canvasjs-chart-credit {
            visibility: hidden;
        }
    </style>
</head>

<body>
<div class="mb-5">
    <button onclick="history.back()" style="font-size:25px; background-color:white;border-width:0px;"><i class="fa-solid fa-arrow-left-long"></i>Back</button>
</div>
    <script>
        window.onload = function () {
            <?php foreach ($arr_merg as $q => $a) {

                $count = 0;
                $arr = [];
                foreach ($a[1] as $key => $val) {
                    $sample_array = [
                        'label' => $val['ans'],
                        'y' => $val['count'],
                    ];
                    array_push($arr, $sample_array);
                }
                ?>
                var chart_<?php echo $q; ?> = new CanvasJS.Chart("chartContainer_<?= $a[0]; ?>", {
                    animationEnabled: true,
                    title: {
                        text: "<?php echo $a[0]; ?>"
                    },
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,#",
                        indexLabel: "{label} ({y})",
                        dataPoints: <?= json_encode($arr, JSON_NUMERIC_CHECK); ?>

                                    }]
                });
                chart_<?php echo $q; ?>.render();
                <?php
            }
            ?>
        }
    </script>

    <?php
    $count = 1;
    foreach ($arr_merg as $q => $a) {
        echo '<h4>Q.' . $count++ . '</h4>'; ?>
        <div id="chartContainer_<?= $a[0]; ?>" style="border-style:groove;height:300px;margin-bottom:10px;"></div>

        <?php
    }
    ?>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="../jquery-3.6.2.min.js"></script>
</body>

</html>
