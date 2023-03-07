<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/report_controller.php';
include ROOT_PATH . 'Templets/navbar.php';

@$survey_id = $_REQUEST['sid'];
$uemail = $_REQUEST['uemail'];

$surveyreport = new report;
$data = $surveyreport->survey_data($survey_id, $uemail);

?>
<style>
    th,
    td {
        border: 1px solid grey;
    }
</style>

<body>
    <button class="m-3" onclick="history.back()" style="font-size:20px;border-width:0px; background-color:white;"><i
            class="fa-solid fa-arrow-left-long"></i> Back</button>
    <div class="container">
        <table class="table table-hover border p-3">
            <thead style="background-color: #1f8585; color:white;">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ((array) @$data as $key => $val) {
                    foreach ($val as $e => $m) {
                        foreach ($m as $q => $a) {
                            ?>
                            <tr>
                                <td><b>
                                        <?= $count++; ?>.
                                    </b></td>
                                <td>
                                    <?= $a['ques']; ?>
                                </td>
                                <?php
                                if ($a['type'] == 'File' && !empty($a['ans'])) {
                                    ?>
                                    <td class="td2" style="width:25%"><a href='../image/<?= $a['ans']; ?>' target='_blank'>View
                                            Here</a></td>
                                <?php
                                } else {
                                    ?>
                                    <td class="td2" style="width:25%">
                                        <?= $a['ans']; ?>
                                    </td>

                                    <?php
                                }
                                if ($a['type'] == "Multiple_ChoiceComment" || $a['type'] == "MCQComment") { ?>
                                    <td class="td2" style="width:25%;background-color:#c8f5d3; text-align:center;">
                                        <?= empty($a['cmt']) ? "----" : $a['cmt']; ?>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td class="td2" style="width: 25%;color:grey;"><i>N/A</i></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>