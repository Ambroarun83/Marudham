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

$sql = $con->query("SELECT 
		alm.line_name,
		FROM `acknowlegement_customer_profile` cp
		LEFT JOIN area_line_mapping alm ON FIND_IN_SET(cp.area_confirm_subarea,alm.sub_area_id)
		WHERE cp.req_id='".strip_tags($req_id)."' ");
$rowSql=$sql->fetch_assoc();
$line_name = $rowSql['line_name'];

$sql = $con->query("SELECT 
		alc.due_type,alc.loan_category 
		FROM `acknowlegement_loan_calculation` alc
		LEFT JOIN loan_category_creation lcc ON alc.loan_category = lcc.loan_category_creation_id
		WHERE req_id='".strip_tags($req_id)."' ");
$rowSql=$sql->fetch_assoc();
$loan_category = $rowSql['loan_category'];
if($rowSql['due_type'] == 'Interest' ){
	$loan_type='interest';
}else{
	$loan_type='emi';
}


//Get customer Details
$qry=$con->query("SELECT 
	ac.area_name,
	sac.sub_area_name,
	cr.address,
	cr.mobile1,
	cr.taluk,
	cr.district FROM area_list_creation ac 
	JOIN sub_area_list_creation sac ON sac.area_id_ref = ac.area_id 
	JOIN customer_register cr ON cr.cus_id = '".strip_tags($cus_id)."' 
	WHERE ac.area_id='".strip_tags($area)."' ");
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

?>

<!-- <head>
<style type="text/css">
	th{
		text-align: center;
		font-weight: bold;
	}
	@media print {
        }
</style>
</head>

<input type="hidden" name="coll_id" id="coll_id" value="<?php echo $coll_id; ?>">
<input type="hidden" name="coll_code" id="coll_code" value="<?php echo $coll_code; ?>">

<div class="approvedtablefield">
<div id="dettable" style="border:1px solid black;width: 8cm;height: 8cm;margin: 0;padding: 0;">
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
</div>			 -->


<!-- <div class="frame" id="dettable">
	<div class="captions">
		<div class="text-wrapper">Receipt No:</div>
		<div class="div">Date / Time:</div>
		<div class="text-wrapper-2">Line / Area:</div>
		<div class="text-wrapper-3">Customer ID:</div>
		<div class="text-wrapper-4">Loan Category:</div>
		<div class="text-wrapper-5">Loan No:</div>
		<div class="text-wrapper-6">Due Receipt:</div>
		<div class="text-wrapper-7">Penalty:</div>
		<div class="text-wrapper-8">Due Balance:</div>
		<div class="text-wrapper-9">Loan Balance:</div>
		<div class="text-wrapper-10">Net Received:</div>
		<div class="text-wrapper-11">Customer Name:</div>
	</div>
	<div class="data">
		<div class="text-wrapper-12">COL-101</div>
		<div class="text-wrapper-13">23/11/2023 11:11AM</div>
		<div class="text-wrapper-14">AMC</div>
		<div class="text-wrapper-15">100010001000</div>
		<div class="text-wrapper-16">Appliance</div>
		<div class="text-wrapper-17">LID-101</div>
		<div class="text-wrapper-18">2,610</div>
		<div class="text-wrapper-19">0</div>
		<div class="text-wrapper-20">0</div>
		<div class="text-wrapper-21">45,000</div>
		<div class="text-wrapper-22">2,610</div>
		<div class="text-wrapper-11">Kumaresan M</div>
	</div>
	<img class="group" src="img/group-9.png" />
</div> -->

<div class="frame" id="dettable" style="position: relative; width: 302px; height: 500px; background-color: #ffffff;">
    <div class="overlap-group">
        <div class="captions" style="position: absolute; width: 112px; height: 278px; top: 136px; left: 51px;font-size: 12px">
			<!-- <div class="text-wrapper" style="position: absolute; top: 0; left: 30px; font-family: 'Times New Roman-Regular', Helvetica; font-weight: 400; color: #000000; font-size: 12px; text-align: center; letter-spacing: 0; line-height: normal; white-space: nowrap;">Receipt No:</div> -->
			<!-- Other text-wrapper elements -->
			<b><div class="text-wrapper" style="text-align:right;" >Receipt No :</div></b>
			<div class="div"style="text-align:right;" >Date / Time :</div>
			<div class="text-wrapper-2"style="text-align:right;" >Line / Area :</div>
			<div class="text-wrapper-3"style="text-align:right;" >Customer ID :</div>
			<b><div class="text-wrapper-4"style="text-align:right;" >Customer Name :</div></b>
			<div class="text-wrapper-6"style="text-align:right;" >Loan Category :</div>
			<div class="text-wrapper-6"style="text-align:right;" >Loan No :</div>
			<div class="text-wrapper-7"style="text-align:right;" >Due Receipt :</div>
			<div class="text-wrapper-8"style="text-align:right;" >Penalty :</div>
			<div class="text-wrapper-9"style="text-align:right;" >Fine :</div><br>
			<b><div class="text-wrapper-10"style="text-align:right;" >Net Received :</div></b>
			<div class="text-wrapper-11"style="text-align:right;" >Due Balance :</div>
			<div class="text-wrapper-12"style="text-align:right;" >Loan Balance :</div>
		</div>
		<div class="data" style="position: absolute; width: 128px; height: 278px; top: 136px; left: 164px;font-size: 12px">
			<!-- <div class="text-wrapper-12" style="position: absolute; top: 0; left: 0; font-family: 'Times New Roman-Regular', Helvetica; font-weight: 400; color: #000000; font-size: 12px; text-align: center; letter-spacing: 0; line-height: normal; white-space: nowrap;">COL-101</div> -->
			<!-- Other text-wrapper elements -->
			<b><div class="text-wrapper-13" style="margin-left: 5px;"><?php echo $coll_code; ?></div></b>
			<div class="text-wrapper-14" style="margin-left: 5px;"><?php echo date('d-m-Y H:s:i:a',strtotime($coll_date)); ?></div>
			<div class="text-wrapper-15" style="margin-left: 5px;"><?php echo $line_name; ?></div>
			<div class="text-wrapper-16" style="margin-left: 5px;"><?php echo $_GET['cusidupd']; ?></div>
			<b><div class="text-wrapper-17" style="margin-left: 5px;"><?php echo $cus_name;?></div></b>
			<div class="text-wrapper-18" style="margin-left: 5px;"><?php echo $loan_category; ?></div>
			<div class="text-wrapper-19" style="margin-left: 5px;">LID-101</div>
			<div class="text-wrapper-20" style="margin-left: 5px;">2,610</div>
			<div class="text-wrapper-21" style="margin-left: 5px;">0</div>
			<div class="text-wrapper-22" style="margin-left: 5px;">0</div><br>
			<b><div class="text-wrapper-23" style="margin-left: 5px;">2,610</div></b>
			<div class="text-wrapper-24" style="margin-left: 5px;">0</div>
			<div class="text-wrapper-25" style="margin-left: 5px;">45,000</div>
		</div>
	</div>
    <img class="group" alt="Helo" src="img/group-9.png" style="position: absolute; width: 224px; height: 91px; top: 34px; left: 44px;" />
</div>



<button type="button" name="printpurchase" onclick="poprint()" id="printpurchase" class="btn btn-primary">Print</button>

<script type="text/javascript">

function poprint(){
	var Bill = document.getElementById("dettable").innerHTML;
	var printWindow = window.open('', '','height=1000;weight=1000;');
	printWindow.document.write('<html><head></head><body>');
	printWindow.document.write(Bill);
	printWindow.document.write('</body></html>');
	printWindow.document.close();
	printWindow.print();
	printWindow.close();
 }
 setTimeout(() => {
	 document.getElementById("printpurchase").click();
	
 }, 1500);
 
</script>

<?php
function moneyFormatIndia($num){
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