<?php
@session_start();
include '../ajaxconfig.php';

if(isset($_POST["coll_id"])){
	$coll_id=$_POST["coll_id"];
}
// $coll_id='COL-106';

$qry=$con->query("SELECT * FROM `collection` WHERE coll_code='".strip_tags($coll_id)."' ");
$row=$qry->fetch_assoc();
foreach($row as $key => $val){
	$$key = $val; 
}

$sql = $con->query("SELECT * FROM `acknowlegement_loan_calculation` WHERE req_id='".strip_tags($req_id)."' ");
$rowSql=$sql->fetch_assoc();
if($rowSql['due_type'] == 'Interest' ){
	$loan_type='interest';
}else{
	$loan_type='emi';
}


//Get customer Details
$qry=$con->query("SELECT ac.area_name,sac.sub_area_name,cr.address,cr.mobile1,cr.taluk,cr.district FROM area_list_creation ac JOIN sub_area_list_creation sac ON 
sac.area_id_ref = ac.area_id JOIN customer_register cr ON cr.cus_id = '".strip_tags($cus_id)."' WHERE ac.area_id='".strip_tags($area)."' ");
$row=$qry->fetch_assoc();
$cus_area = $row['area_name'];
$cus_sub_area = $row['sub_area_name'];
$cus_address = $row['address'];
$cus_mobile = $row['mobile1'];
$cus_taluk = $row['taluk'];
$cus_district = $row['district'];

// $qry = $con->query("SELECT cc.company_name FROM collection c JOIN branch_creation bc ON c.branch = bc.branch_id JOIN company_creation cc ON bc.company_name = cc.company_id WHERE c.coll_code = '$coll_id' ");

// $row = $qry->fetch_assoc();
// $company_name = $row['company_name'];
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

<head>
<style type="text/css">
	th{
		text-align: center;
		font-weight: bold;
	}
</style>
</head>

<input type="hidden" name="coll_id" id="coll_id" value="<?php echo $coll_id; ?>">
<input type="hidden" name="coll_code" id="coll_code" value="<?php echo $coll_code; ?>">

<div class="approvedtablefield">
<div id="dettable" style="border:1px solid black;">
<br /><br />
<div style="width:100%;padding:50px;">
	<table style="width:87%;">
		<tr>
			<td style="text-align:left"><b>From:</b></td>
			<td style="text-align:right"><b>To:</b></td>
		</tr>
		<tr>
			<td style="text-align:left"><b>MARUDHAM CAPITALS</b></td>
			<td style="text-align:right"><b>Name: <?php echo $cus_name;?></b></td>
		</tr>
		<tr>
			<td style="text-align:left"><p>Address: 25, Gandhi Road,</p></td>
			<td style="text-align:right"><p>Address: <?php echo $cus_address;?></p></td>
		</tr>
		<tr>
			<td style="text-align:left"><p>Vandavasi, Thiruvannamalai. </p></td>
			<td style="text-align:right"><p><?php echo $cus_taluk.','.$cus_district;?></p></td>
		</tr>
		<tr>
			<td style="text-align:left"><p>Mobile: +91 9626370666</p></td>
			<td style="text-align:right"><p>Mobile: <?php echo $cus_mobile;?></p></td>
		</tr>
		<!-- <tr>
			<td style="text-align:left"><p>Email:marudham@gmail.com</p></td>
		</tr> -->
		
	</table>
	<br /><br />
	
	<table rules="all" style="border-style: double;border: 1px solid black;width:87%;height:200px;">
		<tr>
			<th style="background-color: white;color: black;" width="100">Date</th>
			<th style="background-color: white;color: black" width="100">Reference ID</th>
			<?php if($loan_type == 'interest'){?>
				<th style="background-color: white;color: black" width="50">Interest Amount</th>
				<th style="background-color: white;color: black" width="50">Paid Principal</th>
				<th style="background-color: white;color: black" width="50">Paid Interest</th>
			<?php }else{ ?>
				<th style="background-color: white;color: black" width="50">Due Amount</th>
				<th style="background-color: white;color: black" width="50">Paid Due</th>
			<?php }?>
			<th style="background-color: white;color: black" width="50">Paid Penalty</th>
			<th style="background-color: white;color: black" width="50">Paid Charges</th>
			<th style="background-color: white;color: black" width="50">Pre Closure</th>
			<th style="background-color: white;color: black" width="100">Penalty Waiver</th>
			<th style="background-color: white;color: black" width="100">Charges Waiver</th>
		</tr>
		<tr>
			<td style="padding:5px;text-align:center;">
				<?php echo date('d-m-Y',strtotime($coll_date)); ?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php echo $coll_code;?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php echo moneyFormatIndia($due_amt);?>
			</td>
			
			<?php if($loan_type == 'interest'){?>
				
				<td style="padding:5px;text-align:center;">
					<?php if($princ_amt_track !=''){echo moneyFormatIndia($princ_amt_track);}else{echo '0';} ?>
				</td>
				<td style="padding:5px;text-align:center;">
					<?php if($int_amt_track !=''){echo moneyFormatIndia($int_amt_track);}else{echo '0';} ?>
				</td>
				
			<?php }else{ ?>
				
				<td style="padding:5px;text-align:center;">
					<?php if($due_amt_track !=''){echo moneyFormatIndia($due_amt_track);}else{echo '0';} ?>
				</td>
				
			<?php }?>

			<td style="padding:5px;text-align:center;">
				<?php if($penalty_track !=''){echo moneyFormatIndia($penalty_track);}else{echo '0';} ?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php if($coll_charge_track !=''){echo moneyFormatIndia($coll_charge_track);}else{echo '0';} ?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php if($pre_close_waiver !=''){echo moneyFormatIndia($pre_close_waiver);}else{echo '0';} ?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php if($penalty_waiver !=''){echo moneyFormatIndia($penalty_waiver);}else{echo '0';} ?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php if($coll_charge_waiver !=''){echo moneyFormatIndia($coll_charge_waiver);}else{echo '0';} ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			
			<?php if($loan_type == 'interest'){?>
				<td colspan="4" style="padding:5px;text-align:center;"><b>
					Total Paid: <?php if($total_paid_track !=''){echo moneyFormatIndia($total_paid_track);}else{echo '0';} ?></b>
				</td>
			<?php }else{ ?>
				<td colspan="3" style="padding:5px;text-align:center;"><b>
					Total Paid: <?php if($total_paid_track !=''){echo moneyFormatIndia($total_paid_track);}else{echo '0';} ?></b>
				</td>
			<?php }?>

			<td colspan="3" style="padding:5px;text-align:center;"><b>
				Total Waiver: <?php if($total_waiver !=''){echo moneyFormatIndia($total_waiver);}else{echo '0';} ?></b>
			</td>

		</tr>
	</table>

		<br/><br /><br /><br/><br />
		<div style="border-top: 1px solid black;width:87%;">
			<br/>
			<b><p style="float: left;">Authorized by</p></b>
			<b><p align="right"><?php echo 'Date: '.date("d/m/Y"); ?></p></b>
		</div>
	</div>
</div>			
<button type="button" name="printpurchase" onclick="poprint()" id="printpurchase" class="btn btn-primary">Print</button>

<script type="text/javascript">

function poprint(){
	var Bill = document.getElementById("dettable").innerHTML;
	var printWindow = window.open('', '', 'height=1000,width=1000');
	printWindow.document.write(Bill);
	printWindow.document.close();
	printWindow.print();
	printWindow.close();
 }
 document.getElementById("printpurchase").click();
 
</script>
