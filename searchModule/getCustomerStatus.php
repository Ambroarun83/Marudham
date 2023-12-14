<?php
session_start();
$user_id = $_SESSION["userid"];
include('../ajaxconfig.php');


if (isset($_POST['cus_id'])) {
    $cus_id = $_POST['cus_id'];
}

$records = array();

$result = $con->query("SELECT req.req_id,req.prompt_remark,req.cus_status,
    CASE WHEN req.cus_status >= 14 THEN ii.updated_date ELSE req.dor END AS `updated_date`,
    CASE WHEN req.cus_status >= 14 THEN ii.loan_id ELSE req.req_code END AS `code`,
    CASE WHEN req.cus_status IN (12,2,6,7) THEN vlc.loan_category WHEN req.cus_status IN (3,13,14,15,16,17,20,21) THEN alc.loan_category ELSE req.loan_category END AS loan_category,
    CASE WHEN req.cus_status IN (12,2,6,7) THEN vlc.sub_category WHEN req.cus_status IN (3,13,14,15,16,17,20,21) THEN alc.sub_category ELSE req.sub_category END AS sub_category,
    CASE WHEN req.cus_status IN (12,2,6,7) THEN vlc.loan_amt WHEN req.cus_status IN (3,13,14,15,16,17,20,21) THEN alc.loan_amt ELSE req.loan_amt END AS loan_amt,
    CASE WHEN req.cus_status IN (12,2,6,7,3,13,14,15,16,17,20,21) THEN cp.cus_name ELSE req.cus_name END AS cus_name
    FROM request_creation req
    LEFT JOIN customer_profile cp ON req.req_id = cp.req_id
    LEFT JOIN verification_loan_calculation vlc ON req.req_id = vlc.req_id
    LEFT JOIN acknowlegement_loan_calculation alc ON req.req_id = alc.req_id
    LEFT JOIN in_issue ii ON req.req_id = ii.req_id
    where req.cus_id = $cus_id and (req.cus_status <= 21) ORDER BY req.created_date DESC");

if ($result->num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {

        $records[$i]['updated_date'] = date('d-m-Y', strtotime($row['updated_date']));
        $records[$i]['code'] = $row['code'];

        $req_id = $row['req_id'];
        $cus_name = $row['cus_name'];
        
        $loan_category = $row['loan_category'] ?? '';
        $qry = $con->query("SELECT * FROM loan_category_creation where loan_category_creation_id = $loan_category");
        $row1 = $qry->fetch_assoc();
        $records[$i]['loan_category'] = $row1['loan_category_creation_name'];

        $records[$i]['sub_category'] = $row['sub_category'];
        $records[$i]['loan_amt'] = $row['loan_amt'];
        $records[$i]['remark'] = $row['prompt_remark'] ?? '';
        $cus_status = $row['cus_status'];
        $statusMapping = [
            '0' => ['status' => 'Request', 'sub_status' => 'Requested'],
            '1' => ['status' => 'Verification', 'sub_status' => 'In Verification'],
            '2' => ['status' => 'Approval', 'sub_status' => 'In Approval'],
            '3' => ['status' => 'Acknowledgement', 'sub_status' => 'In Acknowledgement'],
            '4' => ['status' => 'Request', 'sub_status' => 'Cancelled'],
            '5' => ['status' => 'Verification', 'sub_status' => 'Cancelled'],
            '6' => ['status' => 'Approval', 'sub_status' => 'Cancelled'],
            '7' => ['status' => 'Issue', 'sub_status' => 'Issued'],
            '8' => ['status' => 'Request', 'sub_status' => 'Revoked'],
            '9' => ['status' => 'Verification', 'sub_status' => 'Revoked'],
            '13' => ['status' => 'Loan Issue', 'sub_status' => 'In Issue'],
            '14' => ['status' => 'Present', 'sub_status' => getCollectionStatus($con, $cus_id, $user_id)],
            '15' => ['status' => 'Present', 'sub_status' => getCollectionStatus($con, $cus_id, $user_id)],
            '16' => ['status' => 'Present', 'sub_status' => getCollectionStatus($con, $cus_id, $user_id)],
            '17' => ['status' => 'Present', 'sub_status' => getCollectionStatus($con, $cus_id, $user_id)],
            '20' => ['status' => 'Closed', 'sub_status' => 'In Closed'],
            '21' => ['status' => 'Closed', 'sub_status' => 'In Closed']
        ];

        if ($cus_status != '10' && $cus_status != '11') {
            if (array_key_exists($cus_status, $statusMapping)) {
                $records[$i]['status'] = $statusMapping[$cus_status]['status'];
                $records[$i]['sub_status'] = $statusMapping[$cus_status]['sub_status'];

                if ($cus_status == '21') {
                    $Qry = $con->query("SELECT closed_sts from closed_status where cus_id = $cus_id and req_id = '" . $req_id . "' ");
                    $closed_status = ['', 'Consider', 'Waiting List', 'Block List'];
                    $records[$i]['sub_status'] = $closed_status[$Qry->fetch_assoc()['closed_sts']];
                }
            }
        }

        //for document status
        if ($cus_status >= 14 && $cus_status < 21) {
            $records[$i]['doc_status'] = getDocumentStatus($con, $req_id) == 'pending' ? 'Document Pending' : 'Document Completed';
        } elseif ($cus_status >= 21) {
            $records[$i]['doc_status'] = getNOCDocDetails($con, $req_id, $cus_id) == 'pending' ? 'NOC Pending' : 'NOC Completed';
        } else {
            $records[$i]['doc_status'] = '';
        }

        //for info 
        $records[$i]['info_action'] = "<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";

        $records[$i]['info_action'] .= "<a class='personal-info' data-toggle='modal' data-target='#personalInfoModal' data-cusid='" . $cus_id . "'><span>Personal Info</span></a>";

        if ($cus_status >= 2 and $cus_status != 4 and $cus_status != 5 and $cus_status != 8 and $cus_status != 9) {
            $records[$i]['info_action'] .= "<a class='cust-profile' data-reqid='" . $req_id . "' data-cusid='" . $cus_id . "'><span>Customer Profile</span></a>
                <a class='documentation' data-reqid='" . $req_id . "' data-cusid='" . $cus_id . "'><span>Documentation</span></a>
                <a class='loan-calc' data-reqid='" . $req_id . "' data-cusid='" . $cus_id . "'><span>Loan Calculation</span></a>";
        }
        $records[$i]['info_action'] .= "</div></div>";

        //for Charts
        $records[$i]['chart_action'] = "<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";

        if ($cus_status >= 14) {
            $records[$i]['chart_action'] .= "<a><span data-toggle='modal' data-target='.DueChart' class='due-chart' value='" . $req_id . "' data-cusid='" . $cus_id . "'> Due Chart</span></a>
                <a><span data-toggle='modal' data-target='.PenaltyChart' class='penalty-chart' value='" . $req_id . "' data-cusid='" . $cus_id . "'> Penalty Chart</span></a>
                <a><span data-toggle='modal' data-target='.collectionChargeChart' class='coll-charge-chart' value='" . $req_id . "' data-cusid='" . $cus_id . "'> Fine Chart</span></a>
                <a><span data-toggle='modal' data-target='#commitmentChart' class='commitment-chart' data-reqid='" . $req_id . "' data-cusid='" . $cus_id . "'> Commitment Chart </span></a>";
        }
        $records[$i]['chart_action'] .= "</div></div>";

        //for Summary
        $records[$i]['summary_action'] = "<div class='dropdown'><button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button><div class='dropdown-content'> ";

        if ($cus_status > 20) { //if request goes to NOC then noc summary can be fetched
            $records[$i]['summary_action'] .= "<a><span data-reqid='$req_id' data-cusid='$cus_id' data-toggle='modal' data-target='.loansummarychart' class='loansummary-chart' >Loan Summary</span></a>";
            $records[$i]['summary_action'] .= "<a><span class='noc-summary' data-reqid='$req_id' data-cusid='$cus_id' data-cusname='$cus_name' data-toggle='modal' data-target='.noc-summary-modal' >NOC Summary</span></a>";
        }
        $records[$i]['summary_action'] .= "</div></div>";


        $i++;
    }
}

?>
<table class="table table-bordered" id="custStatusTable">
    <thead>
        <tr>
            <th rowspan="2">S.No</th>
            <th rowspan="2">Date</th>
            <th rowspan="2">Req ID/Loan ID</th>
            <th rowspan="2">Loan Category</th>
            <th rowspan="2">Sub Category</th>
            <th rowspan="2">Loan Amount</th>
            <th colspan="2">Loan Status</th>
            <th colspan="4">Document Status</th>
        </tr>
        <tr>
            <th>Status</th>
            <th>Sub Status</th>
            <th>Status</th>
            <th>Info</th>
            <th>Chart</th>
            <th>Summary</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < sizeof($records); $i++) { ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $records[$i]['updated_date']; ?></td>
                <td><?php echo $records[$i]['code']; ?></td>
                <td><?php echo $records[$i]['loan_category']; ?></td>
                <td><?php echo $records[$i]['sub_category']; ?></td>
                <td><?php echo $records[$i]['loan_amt']; ?></td>
                <td><?php echo $records[$i]['status']; ?></td>
                <td><?php echo $records[$i]['sub_status']; ?></td>
                <td><?php echo $records[$i]['doc_status']; ?></td>
                <td><?php echo $records[$i]['info_action']; ?></td>
                <td><?php echo $records[$i]['chart_action']; ?></td>
                <td><?php echo $records[$i]['summary_action']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<input type="hidden" name="docSts" id="docSts">
<div id="printcollection" style="display: none"></div>
<?php
function getCollectionStatus($con, $cus_id, $user_id)
{

    $pending_sts = isset($_POST["pending_sts"]) ? explode(',', $_POST["pending_sts"]) : null;
    $od_sts = isset($_POST["od_sts"]) ? explode(',', $_POST["od_sts"]) : null;
    $due_nil_sts = isset($_POST["due_nil_sts"]) ? explode(',', $_POST["due_nil_sts"]) : null;
    $closed_sts = isset($_POST["closed_sts"]) ? explode(',', $_POST["closed_sts"]) : null;

    $retVal = '';

    $run = $con->query("SELECT lc.due_start_from,lc.loan_category,lc.sub_category,lc.loan_amt_cal,lc.due_amt_cal,lc.net_cash_cal,lc.collection_method,ii.loan_id,ii.req_id,ii.updated_date,ii.cus_status,
        rc.agent_id,lcc.loan_category_creation_name as loan_catrgory_name, us.collection_access
        from acknowlegement_loan_calculation lc JOIN in_issue ii ON lc.req_id = ii.req_id JOIN request_creation rc ON ii.req_id = rc.req_id 
        JOIN loan_category_creation lcc ON lc.loan_category = lcc.loan_category_creation_id JOIN user us ON us.user_id = $user_id
        WHERE lc.cus_id_loan = $cus_id and (ii.cus_status >= 14 and ii.cus_status < 20)"); //Customer status greater than or equal to 14 because, after issued data only we need

    $curdate = date('Y-m-d');
    while ($row = $run->fetch_assoc()) {
        $i = 1;
        if (date('Y-m-d', strtotime($row['due_start_from'])) > date('Y-m-d', strtotime($curdate))) { //If the start date is on upcoming date then the sub status is current, until current date reach due_start_from date.
            if ($row['cus_status'] == '15') {
                $retVal = 'Error';
            } elseif ($row['cus_status'] == '16') {
                $retVal = 'Legal';
            } else {
                $retVal = 'Current';
            }
        } else {
            if ($pending_sts[$i - 1] == 'true' && $od_sts[$i - 1] == 'false') {
                if ($row['cus_status'] == '15') {
                    $retVal = 'Error';
                } elseif ($row['cus_status'] == '16') {
                    $retVal = 'Legal';
                } else {
                    $retVal = 'Pending';
                }
            } else if ($od_sts[$i - 1] == 'true' && $due_nil_sts[$i - 1] == 'false') {
                if ($row['cus_status'] == '15') {
                    $retVal = 'Error';
                } elseif ($row['cus_status'] == '16') {
                    $retVal = 'Legal';
                } else {
                    $retVal = 'OD';
                }
            } elseif ($due_nil_sts[$i - 1] == 'true') {
                if ($row['cus_status'] == '15') {
                    $retVal = 'Error';
                } elseif ($row['cus_status'] == '16') {
                    $retVal = 'Legal';
                } else {
                    $retVal = 'Due Nil';
                }
            } elseif ($pending_sts[$i - 1] == 'false') {
                if ($row['cus_status'] == '15') {
                    $retVal = 'Error';
                } elseif ($row['cus_status'] == '16') {
                    $retVal = 'Legal';
                } else {
                    if ($closed_sts[$i - 1] == 'true') {
                        $retVal = "Move To Close";
                    } else {
                        $retVal = 'Current';
                    }
                }
            }
        }
        $i++;
    }
    return $retVal;
}

function getDocumentStatus($con, $req_id)
{

    $response1 = 'completed';

    $sts_qry = $con->query("SELECT id, doc_Count FROM signed_doc_info WHERE req_id = '$req_id'");
    if ($sts_qry->num_rows > 0) {
        while ($sts_row = $sts_qry->fetch_assoc()) {
            $sts_qry1 = $con->query("SELECT * FROM signed_doc WHERE req_id = '$req_id' AND signed_doc_id = '" . $sts_row['id'] .
                "'");
            if ($sts_qry1->num_rows == $sts_row['doc_Count'] && $response1 != 'pending') {
                $response1 = 'completed';
            } else {
                $response1 = 'pending';
            }
        }
    }

    $response2 = 'completed';
    $sts_qry = $con->query("SELECT id, cheque_count FROM cheque_info WHERE req_id = '$req_id'");
    if ($sts_qry->num_rows > 0) {
        while ($sts_row = $sts_qry->fetch_assoc()) {
            $sts_qry1 = $con->query("SELECT * FROM cheque_upd WHERE req_id = '$req_id' AND cheque_table_id = '" . $sts_row['id'] .
                "'");
            if ($sts_qry1->num_rows == $sts_row['cheque_count'] && $response2 != 'pending') {
                $response2 = 'completed';
            } else {
                $response2 = 'pending';
            }
        }
    }

    $response3 = 'completed';
    $sts_qry = $con->query("SELECT mortgage_process, mortgage_document_pending, endorsement_process, Rc_document_pending FROM acknowlegement_documentation WHERE req_id = '$req_id'");
    if ($sts_qry->num_rows > 0) {
        while ($sts_row = $sts_qry->fetch_assoc()) {
            if ($sts_row['mortgage_process'] == '0') {
                if ($sts_row['mortgage_document_pending'] == 'YES') {
                    $response3 = 'pending';
                }
            }
            if ($sts_row['endorsement_process'] == '0') {
                if ($sts_row['Rc_document_pending'] == 'YES') {
                    $response3 = 'pending';
                }
            }
        }
    }

    $response4 = 'completed';
    $sts_qry = $con->query("SELECT * FROM document_info WHERE req_id = '$req_id'");
    if ($sts_qry->num_rows > 0) {
        while ($sts_row = $sts_qry->fetch_assoc()) {
            if ($sts_row['doc_upload'] == '' || $sts_row['doc_upload'] == null) {
                $response4 = 'pending';
            }
        }
    }

    if ($response1 == 'completed' && $response2 == 'completed' && $response3 == 'completed' && $response4 == 'completed') {
        $response = 'true';
    } else {
        $response = 'false';
    }

    return $response;
}

function getNOCDocDetails($con, $req_id, $cus_id)
{

    $response = 'completed';

    $qry = $con->query("SELECT * FROM signed_doc where req_id ='$req_id' and cus_id = '$cus_id' and noc_given = 0 ");
    if ($qry->num_rows > 0) { // if condition true, then signed doc any one is given other may be pending to give
        $response = 'pending';
    }

    $qry = $con->query("SELECT * FROM cheque_no_list where req_id ='$req_id' and cus_id = '$cus_id' and noc_given = 0 ");
    if ($qry->num_rows > 0) { // if condition true, then Cheque doc any one is given other may be pending to give
        $response = 'pending';
    }

    $qry = $con->query("SELECT * FROM acknowlegement_documentation where req_id ='$req_id' and cus_id_doc = '$cus_id' and (mortgage_process_noc = 0 or mortgage_document_noc = 0 or endorsement_process_noc = 0 or en_RC_noc = 0 or en_Key_noc = 0 ) ");
    if ($qry->num_rows > 0) { // if condition true, then acknowlegement documentation any one is given other may be pending to give
        $response = 'pending';
    }

    $qry = $con->query("SELECT * FROM gold_info where req_id ='$req_id' and cus_id = '$cus_id' and noc_given = 0 ");
    if ($qry->num_rows > 0) { // if condition true, then Gold doc any one is given other may be pending to give
        $response = 'pending';
    }

    $qry = $con->query("SELECT * FROM document_info where req_id ='$req_id' and cus_id = '$cus_id' and doc_info_upload_noc = 0 ");
    if ($qry->num_rows > 0) { // if condition true, then Document doc any one is given other may be pending to give
        $response = 'pending';
    }

    return $response;
}
?>


<style>
    .dropdown-content {
        color: black;
    }

    .img-show {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        object-fit: cover;
        background-color: white;
    }
</style>
<script>
    //datatable initialization and other link click
    var table = $('#custStatusTable').DataTable();
    table.destroy();
    $('#custStatusTable').DataTable({
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
    });
    customerStatusOnClickEvents();

    // $('.dropdown').off('click').click(function(event) {
    //     event.preventDefault();
    //     $('.dropdown').not(this).removeClass('active');
    //     $(this).toggleClass('active');
    // });

    // $(document).off('click').click(function(event) {
    //     var target = $(event.target);
    //     if (!target.closest('.dropdown').length) {
    //         $('.dropdown').removeClass('active');
    //     }
    // });

    // $('.personal-info').off('click').click(function() {
    //     let cus_id = $(this).data('cusid');
    //     $.post('followupFiles/promotion/getPersonalInfo.php', {
    //         cus_id
    //     }, function(html) {
    //         $('#personalInfoDiv').empty().html(html);
    //     })
    // })
    // $('.cust-profile').off('click').click(function() {
    //     let req_id = $(this).data('reqid');
    //     // window.location.href = 'due_followup_info&upd='+req_id+'&pgeView=1';
    //     window.open('due_followup_info&upd=' + req_id + '&pgeView=1', '_blank');
    // })
    // //Documentaion
    // $('.documentation').off('click').click(function() {
    //     let req_id = $(this).data('reqid');
    //     // window.location.href = 'due_followup_info&upd='+req_id+'&pgeView=2';
    //     window.open('due_followup_info&upd=' + req_id + '&pgeView=2', '_blank');
    // })
    // //Loan Calculation
    // $('.loan-calc').off('click').click(function() {
    //     let req_id = $(this).data('reqid');
    //     window.open('due_followup_info&upd=' + req_id + '&pgeView=3', '_blank');
    // })

    // $('.due-chart').off('click').click(function() {
    //     let req_id = $(this).attr('value');
    //     let cus_id = $(this).data('cusid');
    //     dueChartList(req_id, cus_id); // To show Due Chart List.
    //     setTimeout(() => {
    //         $('.print_due_coll').off('click').click(function() {
    //             var id = $(this).attr('value');
    //             Swal.fire({
    //                 title: 'Print',
    //                 text: 'Do you want to print this collection?',
    //                 imageUrl: 'img/printer.png',
    //                 imageWidth: 300,
    //                 imageHeight: 210,
    //                 imageAlt: 'Custom image',
    //                 showCancelButton: true,
    //                 confirmButtonColor: '#009688',
    //                 cancelButtonColor: '#d33',
    //                 cancelButtonText: 'No',
    //                 confirmButtonText: 'Yes'
    //             }).then((result) => {
    //                 if (result.isConfirmed) {
    //                     $.ajax({
    //                         url: 'collectionFile/print_collection.php',
    //                         data: {
    //                             'coll_id': id
    //                         },
    //                         type: 'post',
    //                         cache: false,
    //                         success: function(html) {
    //                             $('#printcollection').html(html)
    //                         }
    //                     })
    //                 }
    //             })
    //         })
    //     }, 1000)
    // })
    // $('.penalty-chart').off('click').click(function() {
    //     let req_id = $(this).attr('value');
    //     let cus_id = $(this).data('cusid');
    //     $.ajax({
    //         //to insert penalty by on click
    //         url: 'collectionFile/getLoanDetails.php',
    //         data: {req_id,cus_id},
    //         dataType: 'json',
    //         type: 'post',
    //         cache: false,
    //         success: function(response) {
    //             penaltyChartList(req_id, cus_id); //To show Penalty List.
    //         }
    //     })
    // })

    // $('.coll-charge-chart').off('click').click(function() {
    //     var req_id = $(this).attr('value');
    //     collectionChargeChartList(req_id) //To Show Fine Chart List
    // })
    // //Commitment chart
    // $('.commitment-chart').off('click').click(function() {
    //     let req_id = $(this).data('reqid');
    //     let cus_id = $(this).data('cusid');
    //     $.post('followupFiles/dueFollowup/getCommitmentChart.php', {cus_id,req_id}, function(html) {
    //         $('#commChartDiv').empty().html(html);
    //     })
    // })

    // $('.noc-summary').off('click').click(function(){
    //     let req_id = $(this).data('reqid');
    //     let cus_id = $(this).data('cusid');
    //     var cus_name = $(this).data('cusname');

    //     $.ajax({
    //         url: 'verificationFile/documentation/getNOCSummary.php',
    //         data: {'req_id':req_id,'cus_id':cus_id},
    //         type: 'post',
    //         cache: false,
    //         success: function(html){
    //             $('#nocsummaryModal').empty();
    //             $('#nocsummaryModal').html(html);
    //         }
    //     }).then(function(){

    //         // To get the Signed Document List on Checklist
    //         $.ajax({
    //             url:'nocFile/getSignedDocList.php',
    //             data: {'req_id':req_id,'cus_name':cus_name},
    //             type: 'post',
    //             cache:false,
    //             success: function(response){

    //                 $('#signDocDiv').empty()
    //                 $('#signDocDiv').html(response);

    //             }
    //         }).then(function(){remove4columns('signDocTable');})


    //         // To get the unused Cheque List on Checklist
    //         $.ajax({
    //             url:'nocFile/getChequeDocList.php',
    //             data: {'req_id':req_id,'cus_name':cus_name},
    //             type: 'post',
    //             cache:false,
    //             success: function(response){

    //                 $('#chequeDiv').empty()
    //                 $('#chequeDiv').html(response);
    //             }
    //         }).then(function(){remove4columns('chequeTable');})

    //         // To get the Mortgage List on Checklist
    //         $.ajax({
    //             url:'nocFile/getMortgageList.php',
    //             data: {'req_id':req_id,'cus_name':cus_name},
    //             type: 'post',
    //             cache:false,
    //             success: function(response){

    //                 $('#mortgageDiv').empty()
    //                 $('#mortgageDiv').html(response);
    //             }
    //         }).then(function(){remove4columns('mortgageTable');})

    //         // To get the Endorsement List on Checklist
    //         $.ajax({
    //             url:'nocFile/getEndorsementList.php',
    //             data: {'req_id':req_id,'cus_name':cus_name},
    //             type: 'post',
    //             cache:false,
    //             success: function(response){

    //                 $('#endorsementDiv').empty()
    //                 $('#endorsementDiv').html(response);
    //             }
    //         }).then(function(){remove4columns('endorsementTable');})

    //         // To get the Gold List on Checklist
    //         $.ajax({
    //             url:'nocFile/getGoldList.php',
    //             data: {'req_id':req_id,'cus_name':cus_name},
    //             type: 'post',
    //             cache:false,
    //             success: function(response){

    //                 $('#goldDiv').empty()
    //                 $('#goldDiv').html(response);
    //             }
    //         }).then(function(){remove4columns('goldTable');})

    //         // To get the Document List on Checklist
    //         $.ajax({
    //             url:'nocFile/getDocumentList.php',
    //             data: {'req_id':req_id,'cus_name':cus_name},
    //             type: 'post',
    //             cache:false,
    //             success: function(response){

    //                 $('#documentDiv').empty()
    //                 $('#documentDiv').html(response);
    //             }
    //         }).then(function(){remove4columns('documentTable');})
    //     })
    // })
    // function remove4columns(tablename){
    //     $('input[type=checkbox]').attr('disabled',true)
    // }

    // $('.loansummary-chart').off('click').click(function(){
    //     var req_id = $(this).data('reqid');var cus_id = $(this).data('cusid');
    //     loanSummaryList(req_id,cus_id);
    // })
</script>