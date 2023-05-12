<?php
session_start();
include '../ajaxconfig.php';

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

<table class="table custom-table" id='dataCheckTable'>
    <thead>
    <tr>
        <th width="15">S.No</th>
		<th>Customer ID</th>
		<th>Custommer Name</th>            
		<th>Mobile Number</th>
		<th>Guarentor Name</th>
		<th>Status</th>
        <th>Sub Status</th>
	</tr>
    </thead>
    <tbody>
	<?php

$cus_id = $_POST['cus_id'];
								 $guarentorInfo = $connect->query("SELECT acp.id as acpID, acp.req_id, acp.cus_id,acp.cus_name,acp.mobile1,vfi.famname,vfi.relation_aadhar,ii.cus_status as ii_sts FROM `acknowlegement_customer_profile` acp  JOIN `verification_family_info` vfi  on acp.guarentor_name = vfi.id  JOIN `in_issue` ii ON acp.req_id = ii.req_id WHERE vfi.relation_aadhar ='".strip_tags($cus_id)."' && ii.cus_status >= 13  ");

								$i = 1;
								while ($guarentor = $guarentorInfo->fetch()) {
								?>
									<tr>
										<td> <?php  echo $i++; ?></td>
										<td> <?php  echo $guarentor['cus_id']; ?></td>
										<td> <?php  echo $guarentor['cus_name']; ?></td>
										<td> <?php  echo $guarentor['mobile1']; ?></td>
										<td> <?php  echo $guarentor['famname']; ?></td>
										<td><?php if($guarentor['ii_sts'] < 20){echo 'Present';}else if($guarentor['ii_sts'] >= 20){ echo 'Closed';} ?></td>  <!-- Status -->
										<td><?php if($guarentor['ii_sts'] == 13){
                                                    echo 'In Issue';
                                                }
                                                    else if($pending_sts[$i-1] == 'true' && $od_sts[$i-1] == 'false'){
													if($guarentor['ii_sts'] == '15'){
														echo 'Error';
													}elseif($guarentor['ii_sts']== '16'){
														echo 'Legal';
													}else{
														echo 'Pending';
													}
												}else if($od_sts[$i-1] == 'true'){
													if($guarentor['ii_sts'] == '15'){
														echo 'Error';
													}elseif($guarentor['ii_sts']== '16'){
														echo 'Legal';
													}else{
														echo 'OD';
													}
												}elseif($due_nil_sts[$i-1] == 'true'){
													if($guarentor['ii_sts'] == '15'){
														echo 'Error';
													}elseif($guarentor['ii_sts']== '16'){
														echo 'Legal';
													}else{
														echo 'Due Nil';
													}
												}elseif($pending_sts[$i-1] == 'false'){
													if($guarentor['ii_sts'] == '15'){
														echo 'Error';
													}elseif($guarentor['ii_sts']== '16'){
														echo 'Legal';
													}else{
														if($closed_sts[$i-1] == 'true'){
															echo "Closed";
														}else{
															echo 'Current';
														}
													}
												} ?></td> <!-- Sub status -->
									</tr>
								<?php
								}
								?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#dataCheckTable').DataTable({
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