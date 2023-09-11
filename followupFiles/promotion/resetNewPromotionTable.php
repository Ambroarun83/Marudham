<?php

include('../../ajaxconfig.php');

// $sql = $con->query("SELECT a.*,b.area_name,c.sub_area_name  FROM new_promotion a JOIN area_list_creation b ON a.area = b.area_id JOIN sub_area_list_creation c ON a.sub_area = c.sub_area_id WHERE 1 ");
$sql = $con->query("SELECT * FROM new_cus_promo WHERE 1 ");

?>


<table class="table custom-table" id='new_promo_table' data-id='new_promotion'>
    <thead>
        <th>Date</th>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Mobile No.</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Action</th>
        <th>Promotion Chart</th>
        <th>Follow Date</th>
    </thead>
    <tbody>
        <?php while($row =  $sql->fetch_assoc()){?>
            <tr>
                <td><?php echo date('d-m-Y',strtotime($row['created_date'])); ?></td>
                <td><?php echo $row['cus_id'] ; ?></td>
                <td><?php echo $row['cus_name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['area']; ?></td>
                <td><?php echo $row['sub_area']; ?></td>
                <td>
                    <?php  //for intrest or not intrest choice to make
                        // if($row['int_status'] == '' or $row['int_status'] == NULL){

                            $action="<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";
                            
                            $action .= "<a class='intrest' data-toggle='modal' data-target='#addPromotion' data-id='".$row['cus_id']."'><span>Interested</span></a>
                            <a class='not-intrest' data-toggle='modal' data-target='#addPromotion' data-id='".$row['cus_id']."'><span>Not Interested</span></a>";
                            $action .= "</div></div>";
                            echo $action;

                        // }elseif($row['int_status'] == '0'){
                        //     echo 'Interested';
                        // }elseif($row['int_status'] == '1'){
                        //     echo 'Not Interested';
                        // }
                    ?>
                </td>
                <td>
                    <?php //for promotion chart
                        echo "<input type='button' class='btn btn-primary promo-chart' data-id='".$row['cus_id']."' data-toggle='modal' data-target='#promoChartModal' value='View' />";
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
                    ?></td>

            </tr>
        <?php } ?>

    </tbody>
</table>

<script>
    $('#new_promo_table').dataTable({
        'processing': true,
        'iDisplayLength': 5,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'lBfrtip',
        buttons: [{
                extend: 'excel',
            },
            {
                extend: 'colvis',
                collectionLayout: 'fixed four-column',
            }
        ],
    })
    $('.dropdown').click(function(event) {
        event.preventDefault();
        $('.dropdown').not(this).removeClass('active');
        $(this).toggleClass('active');
    });

    $(document).click(function(event) {
        var target = $(event.target);
        if (!target.closest('.dropdown').length) {
            $('.dropdown').removeClass('active');
        }
    });
    
</script>
<style>
    .dropdown-content{
        color: black;
    }
    @media (max-width: 598px) {
        #new_promo_div{
            overflow: auto;
        }
    }
    
</style>