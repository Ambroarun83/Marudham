$(document).ready(function () {

    OnLoadFunctions();
});

function OnLoadFunctions() {


    $('#due_followup_table').DataTable({
        "order": [[0, "desc"]],
        "processing": true,
        "serverSide": true,
        "serverMethod": 'post',
        "ajax": {
            "url": 'followupFiles/dueFollowup/getDueFollowCus.php',
            "data": function (data) {
                var search = $('input[type=search]').val();
                data.search = search;
            }
        },
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                title: "Due Followup List"
            },
            {
                extend: 'colvis',
                collectionLayout: 'fixed four-column',
            }
        ],
        "lengthMenu": [
            [10, 10, 25, 50, -1],
            [10, 10, 25, 50, "All"]
        ],
        "createdRow": function (row, data, dataIndex) {
            // Add serial number in the first column
            $('td', row).eq(0).html(dataIndex + 1);
        },
        "drawCallback": function () {
            enableDateColoring();
            searchFunction('due_followup_table')
        }
    });


}

function enableDateColoring() {
    //for coloring
    $('#due_followup_table tbody tr').not('th').each(function () {
        let tddate = $(this).find('td:eq(13)').text(); // Get the text content of the 12th td element (Follow date)
        let datecorrection = tddate.split("-").reverse().join("-").replaceAll(/\s/g, ''); // Correct the date format
        let values = new Date(datecorrection); // Create a Date object from the corrected date
        values.setHours(0, 0, 0, 0); // Set the time to midnight for accurate date comparison

        let curDate = new Date(); // Get the current date
        curDate.setHours(0, 0, 0, 0); // Set the time to midnight for accurate date comparison

        let colors = { 'past': 'FireBrick', 'current': 'DarkGreen', 'future': 'CornflowerBlue' }; // Define colors for different date types

        if (tddate != '' && values != 'Invalid Date') { // Check if the extracted date and the created Date object are valid

            if (values < curDate) { // Compare the extracted date with the current date
                $(this).find('td:eq(13)').css({ 'background-color': colors.past, 'color': 'white' }); // Apply styling for past dates
            } else if (values > curDate) {
                $(this).find('td:eq(13)').css({ 'background-color': colors.future, 'color': 'white' }); // Apply styling for future dates
            } else {
                $(this).find('td:eq(13)').css({ 'background-color': colors.current, 'color': 'white' }); // Apply styling for the current date
            }
        }
    });
}
