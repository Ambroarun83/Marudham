<?php

include('../../ajaxconfig.php');

// $sql = $con->query("SELECT a.*,b.area_name,c.sub_area_name  FROM new_promotion a JOIN area_list_creation b ON a.area = b.area_id JOIN sub_area_list_creation c ON a.sub_area = c.sub_area_id WHERE 1 ");
$sql = $con->query("SELECT * FROM new_promotion WHERE 1 ");

?>


<table class="table custom-table" id='new_promo_table'>
    <thead>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Mobile No.</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Action</th>
        <th>Promotion Chart</th>
    </thead>
    <tbody>
        <?php while($row =  $sql->fetch_assoc()){?>
            <tr>
                <td><?php echo $row['cus_id'] ; ?></td>
                <td><?php echo $row['cus_name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['area']; ?></td>
                <td><?php echo $row['sub_area']; ?></td>
                <td>
                    <?php  //for intrest or not intrest choice to make
                        if($row['int_status'] == '' or $row['int_status'] == NULL){

                            $action="<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";
                            
                            $action .= "<a data-toggle='modal' data-target='#addPromotion'><span class='intrest' value='".$row['id']."' > Intrested</span></a>
                            <a data-toggle='modal' data-target='#addPromotion'><span class='not-intrest' value='".$row['id']."' > Not Intrested</span></a>";
                            $action .= "</div></div>";
                            echo $action;

                        }elseif($row['int_status'] == '0'){
                            echo 'Intrested';
                        }elseif($row['int_status'] == '1'){
                            echo 'Not Intrested';
                        }
                    ?>
                </td>
                <td>
                    <?php //for promotion chart
                        echo "<input type='button' value='View' class='btn btn-primary' data-id='".$row['id']."' data-toggle='modal' data-target='#promoChartModal' />";
                    ?>
                </td>
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
        ]
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
</style>