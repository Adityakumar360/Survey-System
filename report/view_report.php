<?php
include '../configuration/connection.php';
include ROOT_PATH . 'controller/report_controller.php';
include ROOT_PATH . 'Templets/navbar.php';


@$survey_id = $_REQUEST['sid'];
$surveyreport = new report;
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<style>
    .view {
        color: #11624f;
        text-decoration: none;
    }

    table.dataTable.no-footer {
        border-bottom: none;
    }
</style>

<button class="m-3" onclick="history.back()" style="font-size:20px;border-width:0px; background-color:white;"><i
        class="fa-solid fa-arrow-left-long"></i> Back</button>
<h3 style="text-align:center;font-style:italic;margin:1%;"><u>Report</u></h3>

<!-- Table -->
<table class="table table-hover cell-border p-3" cellspacing="0" id="myTable">
    <thead style="background-color: #1f8585; color:white;">
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">UserName</th>
            <th scope="col">UserEmail</th>
            <th scope="col">Status</th>
            <th scope="col" style="width:15%">View Response</th>
            <th scope="col">Download</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $report = $surveyreport->user_data($survey_id);
        $count = 0;
        while ($row = $report->fetch_assoc()) {

            $count++;
            echo "<tr>";
            ?>
            <td><b>
                    <?= $count; ?>.
                </b></td>
            <td>
                <?= $row['user_name']; ?>
            </td>
            <td>
                <?= $row['user_email']; ?>
            </td>
            <td style="text-align: center;">
                <?= $row['status']; ?>
            </td>
            <td><a href="../report/view_response.php?sid=<?= $survey_id; ?>&uemail=<?= $row['user_email']; ?>"
                    class="view m-1"><i class="fa-solid fa-eye" title="View Response"></i> View</a></td>
            <td style="text-align:center;color:black;"><a
                    href="../report/export.php?sid=<?= $survey_id; ?>&email=<?= $row['user_email']; ?>"><i
                        class="fa-sharp fa-solid fa-download"></i></a></td>
            <?php
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    // Datatable pagination
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

</script>