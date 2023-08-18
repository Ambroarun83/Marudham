<?php

include('../../ajaxconfig.php');

// $sql = $con->query("SELECT cs.cus_id
//     FROM closed_status cs
//     LEFT JOIN in_issue ii ON ii.cus_id = cs.cus_id AND ii.cus_status < 20
//     LEFT JOIN request_creation rc ON rc.cus_id = cs.cus_id AND rc.cus_status < 20
//     WHERE cs.cus_sts >= 20
//     AND (ii.cus_id IS NULL AND rc.cus_id IS NULL);");

$arr = array();$sno=1;
$sub_status = [1=>'Bronze',2=>'Silver',3=>'Gold',4=>'Platinum',5=>'Diamond'];
$sql = $con->query("SELECT cus_id,consider_level FROM closed_status WHERE cus_sts >= 20 ");
while($row = $sql->fetch_assoc()){
    $qry1 = $con->query("SELECT cus_id FROM in_issue WHERE cus_status < 20 AND cus_id ='".$row['cus_id']."' ");

    $qry2 = $con->query("SELECT cus_id FROM request_creation WHERE cus_status < 20 AND cus_id ='".$row['cus_id']."' ");

    if($qry1->num_rows == 0 && $qry2->num_rows == 0){
        //means customer is in request / loan process
        //take customer promotion chart
        $arr[] = array('cus_id' => $row['cus_id'],'sub_status' => $row['consider_level']);
    }
}

//die;
?>


<table class="table custom-table" id='promotion_list'>
    <thead >
        <th width='20'>S.No</th>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Branch</th>
        <th>Group</th>
        <th>Line</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Sub Status</th>
        <th>List Date</th>
        <th>View</th>
        <th>Action</th>
        <th>Follow Date</th>
    </thead>
    <tbody>
        <?php foreach($arr as $val){
            $sql = $con->query("SELECT cp.*,al.area_name,sl.sub_area_name,bc.branch_name from acknowlegement_customer_profile cp LEFT JOIN area_list_creation al ON cp.area_confirm_area = al.area_id 
                LEFT JOIN sub_area_list_creation sl ON cp.area_confirm_subarea = sl.sub_area_id LEFT JOIN area_group_mapping agm ON FIND_IN_SET(sl.sub_area_id,agm.sub_area_id)
                LEFT JOIN branch_creation bc ON agm.branch_id = bc.branch_id
                WHERE cp.cus_id = ".$val['cus_id']." ORDER BY cp.id DESC");
            $row = $sql->fetch_assoc();
        ?>
            <tr>
                <td><?php echo $sno;$sno++; ?></td>
                <td><?php echo $row['cus_id'] ; ?></td>
                <td><?php echo $row['cus_name']; ?></td>
                <td><?php echo $row['area_name']; ?></td>
                <td><?php echo $row['sub_area_name']; ?></td>
                <td><?php echo $row['branch_name']; ?></td>
                <td><?php echo $row['area_group']; ?></td>
                <td><?php echo $row['area_line']; ?></td>
                <td><?php echo $row['mobile1']; ?></td>
                <td><?php echo 'Consider'; ?></td>
                <td><?php echo $sub_status[$val['sub_status']]; //fetched from closed status table above mentioned?></td>
                <td>
                    <?php 
                        $qry = $con->query("SELECT created_date FROM closed_status WHERE cus_id = '".$row['cus_id']."' ORDER BY id DESC limit 1");
                        //take last closed date of this customer to show when this customer added to promotion list
                        if($qry->num_rows > 0){
                            $ldate = $qry->fetch_assoc()['created_date'];
                            echo date('d-m-Y',strtotime($ldate));
                        }else{
                            echo '';
                        }
                    ?>
                </td>
                <td>
                    <?php  
                        $action="<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";
                        
                        $action .= "<a class='promo-chart' data-id='".$row['cus_id']."' data-toggle='modal' data-target='#promoChartModal'><span>Promotion Chart</span></a>
                        <a class='personal-info' data-toggle='modal' data-target='#personalInfoModal' data-id='".$row['cus_id']."'><span>Personal Info</span></a>
                        <a class='cust-profile' data-reqid='".$row['req_id']."' data-cusid='".$row['cus_id']."'><span>Customer Profile</span></a>
                        <a class='loan-history' data-reqid='".$row['req_id']."' data-cusid='".$row['cus_id']."'><span>Loan History</span></a>
                        <a class='doc-history' data-reqid='".$row['req_id']."' data-cusid='".$row['cus_id']."'><span>Document History</span></a>";

                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
                <td>
                    <?php  //for intrest or not intrest choice to make
                        $action="<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";
                        
                        $action .= "<a class='intrest' data-toggle='modal' data-target='#addPromotion' data-id='".$row['cus_id']."'><span>Interested</span></a>
                            <a class='not-intrest' data-toggle='modal' data-target='#addPromotion' data-id='".$row['cus_id']."'><span>Not Interested</span></a>";

                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
                <td>
                    <?php 
                        $qry = $con->query("SELECT follow_date FROM new_promotion WHERE cus_id = '".$row['cus_id']."' ORDER BY created_date DESC limit 1");
                        //take last promotion follow up date inserted from new promotion table
                        if($qry->num_rows > 0){
                            $fdate = $qry->fetch_assoc()['follow_date'];
                            echo date('d-m-Y',strtotime($fdate));
                        }else{
                            echo '';
                        }
                    ?>
                </td>
            </tr>

        <?php } ?>

    </tbody>
</table>

<script>
    $('#promotion_list').dataTable({
        'processing': true,
        'iDisplayLength': 5,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ]
    })
    
    let dropdownOpen = false;

    $('.dropdown').off('click').click(function(event) {
        event.preventDefault();
        if (!dropdownOpen) {
            $('.dropdown').not(this).removeClass('active');
            $(this).toggleClass('active');
            dropdownOpen = true;
        } else {
            dropdownOpen = false;
        }
    });

    $(document).click(function(event) {
        var target = $(event.target);
        if (!target.closest('.dropdown').length) {
            $('.dropdown').removeClass('active');
            dropdownOpen = false;
        }
    });

    $('.intrest, .not-intrest').click(function(event) {
        event.stopPropagation();
    });

    
</script>
<style>
    .dropdown-content{
        color: black;
    }
    @media (max-width: 598px) {
        #exCusDiv{
            overflow: auto;
        }
    }
    
</style>