<?php
@session_start();
include '../ajaxconfig.php';

if(isset($_POST["coll_id"])){
	$coll_id=$_POST["coll_id"];
}
// $coll_id='COL-101';
$coll_arr=array();
$qry=$con->query("SELECT * FROM `collection` WHERE coll_code='".strip_tags($coll_id)."' ");
$row=$qry->fetch_assoc();
foreach($row as $key => $val){
	$$key = $val; 
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
<div id="dettable" style="border:1px solid black;width: 75%;margin: auto;">
	<table style="width: 90%;margin: auto;">
		<tr>
			<!-- <td><img src="img/logo.png" height="50px" width="150px" align="right"></td> -->
			<td style="text-align:center"><h1><?php echo $company_from_name; ?></h1></td>
		</tr>
		<tr>
			<td style="text-align: center">
				<?php echo $from_comm_line1.','; ?>
				<?php echo $from_comm_line2.','; ?>
				<?php echo $branch_from_city; ?><br>
				<?php echo 'Phone: '.$branch_from_phone; ?><br>
				<?php echo 'Email: '.$branch_from_email; ?>
			</td>
		</tr>
	</table>
	<br /><br />
	<table rules="all" style="width: 90%;border-style: double;border: 1px solid black;margin: auto;">
		<tr>
			<th style="background-color: white;color: black">Date of RGP</th>
			<th style="background-color: white;color: black">Branch [Sending] Address</th>
			<th style="background-color: white;color: black">Branh [To] Address</th>
			<th style="background-color: white;color: black">Asset Name</th>
			<th style="background-color: white;color: black">Asset Value</th>
			<th style="background-color: white;color: black">Reason for RGP</th>
			<th style="background-color: white;color: black">Retrun Date</th>
		</tr>
		<tr>
			<td style="text-align: center">
				<?php echo $rgp_date; ?>
			</td>
			<td style="margin-left: 5px;padding-left: 30px;text-align: left;">
				<?php
				echo $company_from_name .' - '. $branch_from_name.' Branch,';?><br>
				<?php
				echo $from_comm_line1.',';?><br>
				<?php
				echo $from_comm_line2.',';?><br>
				<?php
				echo $branch_from_city. '.';
				?>
			</td>
			<td style="margin-left: 5px;padding: 30px;text-align: left;">
				<?php
				echo $company_to_name .' - '. $branch_to_name.' Branch,';?><br>
				<?php
				echo $to_comm_line1.',';?><br>
				<?php
				echo $to_comm_line2.',';?><br>
				<?php
				echo $branch_to_city. '.';
				?>
			</td>
			<td style="text-align: center">
				<?php echo $asset_name; ?>
			</td>
			<td style="text-align: center">
				<?php echo $asset_value; ?>
			</td>
			<td style="text-align: center">
				<?php echo $reason_rgp; ?>
			</td>
			<td style="text-align: center">
				<?php echo $return_date; ?>
			</td>
		</tr>
	</table>
	<br/><br /><br /><br/><br />
	<div style="border-top: 1px solid black;margin-left: 10%;margin-right: 10%">
	<br/>
	<b><p style="float: left;">Authorized by</p></b>
	<b><p align="right"><?php echo 'Date: '.date("d/m/Y"); ?></p></b>
	</div>
</div>
				
<button type="button" name="printpurchase" onclick="poprint()" id="printpurchase" class="btn btn-primary">Print</button>

<script type="text/javascript">

function poprint(){
	var Bill = document.getElementById("dettable").innerHTML;
	var printWindow = window.open('', '', 'height=400,width=800');
	printWindow.document.write(Bill);
	printWindow.document.close();
	printWindow.print();
	printWindow.close();
 }
 document.getElementById("printpurchase").click();
 
</script>
