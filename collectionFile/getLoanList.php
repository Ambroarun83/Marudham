<?php
session_start();
include '../ajaxconfig.php';

if(isset($_SESSION["userid"])){
    $user_id = $_SESSION["userid"];
}
if(isset($_POST["pending_sts"])){
    $pending_sts = explode(',',$_POST["pending_sts"]);
}
if(isset($_POST["od_sts"])){
    $od_sts = explode(',',$_POST["od_sts"]);
}
if(isset($_POST["due_nil_sts"])){
    $due_nil_sts = explode(',',$_POST["due_nil_sts"]);
}
if(isset($_POST["closed_sts"])){
    $closed_sts = explode(',',$_POST["closed_sts"]);
}
if(isset($_POST["bal_amt"])){
    $bal_amt = explode(',',$_POST["bal_amt"]);
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .dropbtn {
		color: white;
		/* background-color: #009688; */
		/* padding: 10px; */
		font-size: 10px;
		border: none;
		cursor: pointer;
	}
	.dropdown {
		position: relative;
		display: inline-block;
	}
	.dropdown-content {
		display: none;
		position: absolute;
		right: 0;
		background-color: #F9F9F9;
		min-width: 160px;
		margin-top:-50px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}
	.dropdown-content a {
		color: black;
		padding: 10px 10px;
		text-decoration: none;
		display: block;
	}
	.dropdown-content a:hover {background-color: #fafafa;}
	.dropdown:hover .dropdown-content {
		display: block;
	}
	.dropdown:hover .dropbtn {
		background-color: #3E8E41;
	}
    .btn-outline-secondary {
        color: #383737;
        border-color: #383737;
        position: inherit;
        left: -20px;
    }
</style>
<?php
function moneyFormatIndia($num) {
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
<table class="table custom-table" id='loanListTable'>
    <thead>
        <tr>
            <th width="50">Loan ID</th>
            <th>Loan Category</th>
            <th>Sub Category</th>
            <th>Agent</th>
            <th>Loan date</th>
            <th>Loan Amount</th>
            <th>Banlance Amount</th>
            <th>Collection Method</th>
            <th>Status</th>
            <th>Sub Status</th>
            <th>Collect</th>
            <th>Charts</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $req_id = $_POST['req_id'];
        $cus_id = $_POST['cus_id'];
        $run = $connect->query("SELECT lc.loan_category,lc.sub_category,lc.loan_amt_cal,lc.due_amt_cal,lc.net_cash_cal,lc.collection_method,ii.req_id,ii.updated_date,ii.cus_status,
        rc.agent_id,lcc.loan_category_creation_name as loan_catrgory_name, us.collection_access
        from acknowlegement_loan_calculation lc JOIN in_issue ii ON lc.req_id = ii.req_id JOIN request_creation rc ON ii.req_id = rc.req_id 
        JOIN loan_category_creation lcc ON lc.loan_category = lcc.loan_category_creation_id JOIN user us ON us.user_id = $user_id
        WHERE lc.cus_id_loan = $cus_id and (ii.cus_status >= 14 and ii.cus_status < 20)"); //Customer status greater than or equal to 14 because, after issued data only we need

        $i = 1;
        while ($row = $run->fetch()) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["loan_catrgory_name"]; ?></td>
                <td><?php echo $row["sub_category"]; ?></td>
                <td>
                    <?php 
                        if($row["agent_id"] != '' || $row["agent_id"] != NULL){
                            $run1 = $connect->query('SELECT ag_name from agent_creation where ag_id = "'.$row['agent_id'].'" ');
                            echo $run1->fetch()['ag_name'];
                        } 
                        ?>
                </td>
                <td><?php echo date('d-m-Y',strtotime($row["updated_date"])); ?></td>
                <td><?php echo moneyFormatIndia($row["loan_amt_cal"]); ?></td>
                <td><?php echo moneyFormatIndia($bal_amt[$i-1]); ?></td>
                <td><?php if($row["collection_method"] == '1'){ echo 'By Self';}else if($row["collection_method"] == '2'){ echo 'Spot Collection';}else if($row["collection_method"] == '3'){ echo 'Cheque Collection';}else if($row["collection_method"] == '4'){ echo 'ECS';} ?></td>
                <td><?php echo 'Present'; ?></td>
                <td><?php if($pending_sts[$i-1] == 'true' && $od_sts[$i-1] == 'false'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'Pending';
                            }
                        }else if($od_sts[$i-1] == 'true'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'OD';
                            }
                        }elseif($due_nil_sts[$i-1] == 'true'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'Due Nil';
                            }
                        }elseif($pending_sts[$i-1] == 'false'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                if($closed_sts[$i-1] == 'true'){
                                    echo "Move To Close";
                                }else{
                                    echo 'Current';
                                }
                            }
                        } ?></td>
                <td><?php echo "<span class='btn btn-success collection-window' style='font-size: 17px;position: relative;top: 0px; background-color:#009688;";
                            if($row['cus_status']== '16' ){echo 'display:none';} //|| $row['cus_status']== '15' || $closed_sts[$i-1] == 'true'
                echo " ' data-value='".$row['req_id']."''>$</span>"; ?></td>
                <td>
                    <?php 
                        $action="<div class='dropdown' style='float:right;'><button class='btn btn-outline-secondary' ";
                        
                        $action .="><i class='fa'>&#xf107;</i></button><div class='dropdown-content'>";
                        $action .= "<a><span data-toggle='modal' data-target='.DueChart' class='due-chart' value='".$row['req_id']."' > Due Chart</span></a>
                        <a><span data-toggle='modal' data-target='.PenaltyChart' class='penalty-chart' value='".$row['req_id']."' > Penalty Chart</span></a>
                        <a><span data-toggle='modal' data-target='.collectionChargeChart' class='coll-charge-chart' value='".$row['req_id']."' > Collection Charge Chart</span></a>";
                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
                <td>
                    <?php
                        $action="<div class='dropdown' style='float:right;'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'>";
                        if($row['collection_access'] == '0'){
                            $action .= "<a href='' class='move-error' value='".$row['req_id']."' > Move To Error</a>
                            <a href='' class='move-legal' value='".$row['req_id']."' > Move To Legal</a>
                            <a href='' class='return-sub' value='".$row['req_id']."' > Return Sub Status</a>
                            <a><span data-toggle='modal' data-target='.collectionCharges' class='coll-charge' value='".$row['req_id']."' > Collection Charges </span></a>";
                            //if balance is eqauls to zero, then that loan must be able to moved as closed
                            // if($closed_sts[$i-1] == 'true'){
                            //     $action .= "<a href='' class='move-closed' value='".$row['req_id']."' > Move To Closed</a>";
                            // }
                        }
                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
            </tr>

        <?php  $i++;} ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#loanListTable').DataTable({
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