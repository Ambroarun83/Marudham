<?php
include('../ajaxconfig.php');
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['cus_name'])){
    $cus_name = $_POST['cus_name'];
}
function moneyFormatIndia($num)
{
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            if ($i == 0) {
                $explrestunits .= (int)$expunit[$i] . ",";
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash;
}
?>
<table class="table custom-table" id='goldTable'>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Gold Type</th>
            <th>Purity</th>
            <th>Count</th>
            <th>Weight</th>
            <th>Value</th>
            <th>Checklist</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qry = $con->query("SELECT * FROM `gold_info` where req_id = $req_id and used_status != '1' ");
        $cnt = 0;
        $weight = 0;
        $goldVal = 0;
        while($row = $qry->fetch_assoc()){
            $cnt = $cnt + intval($row['gold_Count']);
            $weight = $weight + intval($row["gold_Weight"]);
            $goldVal = $goldVal + intval($row["gold_Value"]);
        ?>
            <tr>
                <td></td>
                <td><?php echo $row['gold_type'];?></td>
                <td><?php echo $row['Purity'];?></td>
                <td><?php echo $row['gold_Count'];?></td>
                <td><?php echo $row['gold_Weight'];?></td>
                <td><?php echo moneyFormatIndia($row['gold_Value']);?></td>
                <td><input type='checkbox' id='gold_check' name='gold_check' class="form-control gold_check"  <?php if($row['noc_given'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of docuemnts uploaded table?>'></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
    <tr>
        <td> <b> Total </b> </td>
        <td> </td>
        <td> </td>
        <td> <b> <?php echo $cnt; ?> </b> </td>
        <td> <b> <?php echo $weight; ?> </b> </td>
        <td> <b> <?php echo moneyFormatIndia($goldVal); ?> </b> </td>
        <td> </td>
    </tr>
</table>

<script type='text/javascript'>
    $(function() {
        $('#goldTable').DataTable({
            "title":"Gold List",
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).find('td:first').html(dataIndex + 1);
            },
            "drawCallback": function(settings) {
                this.api().column(0).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            },
        });
    });
</script>