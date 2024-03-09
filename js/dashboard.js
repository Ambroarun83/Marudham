document.addEventListener('DOMContentLoaded', () => {


    initializeCounterAnimation();
    getBranchList();

    $('#branch_id').change(function () {
        getRequestDashboard();
    });

    $('#req_title').click(function () {
        let check = $('#req_body');
        check.find('.card-body').show();//show the card body of this title
        if (check.is(':visible')) {
            check.slideUp();
        } else {
            getRequestDashboard();
            check.slideDown();
            $('.card-body').not('#req_body').not($('#req_body').find('.card-body')).slideUp();//hide the card body other than this card
        }
    });
    $('#ver_title').click(function () {
        let check = $('#ver_body');
        check.find('.card-body').show();//show the card body of this title
        if (check.is(':visible')) {
            check.slideUp();
        } else {
            check.slideDown();
            $('.card-body').not('#ver_body').not($('#ver_body').find('.card-body')).slideUp();//hide the card body other than this card
        }
    });


});


function getBranchList() {
    $.post('dashboardFile/getBranchList.php', function (data) {
        $('#branch_id').empty();
        $('#branch_id').append('<option value="">Choose Branch</option>');
        $('#branch_id').append('<option value="0">All Branch</option>');
        for (let i = 0; i < data.length; i++) {
            $('#branch_id').append('<option value="' + data[i].branch_id + '">' + data[i].branch_name + '</option>');
        }
    }, 'json')
}

function getSubAreaList(branch_id) {

    return new Promise((resolve, reject) => {
        if (branch_id != '') {
            $.ajax({
                url: 'dashboardFile/getSubAreaList.php',
                type: 'POST',
                data: { branch_id },
                dataType: 'json',
                success: function (data) {
                    //convert json array to string to return as string if not empty and then return to calling function
                    if (data != 'Error') {
                        let sub_area_list = data;
                        $('#sub_area_list').val(sub_area_list);
                        resolve(sub_area_list);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No Sub Area for this Branch!',
                            icon: 'error',
                            confirmButtonColor: '#009688',
                        }).then(function () {
                            $('#branch_id').val('');
                        })
                        resolve('');
                    }
                }
            });
        } else {
            resolve('');
        }
    })

}



// *****************************************************************************************************************************************
//Request Dashboard initalization
function getRequestDashboard() {

    let branch_id = $('#branch_id').val();
    localStorage.clear();//clear localstorage before fetching data for prevent conflict
    getSubAreaList(branch_id).then(sub_area_list => {

        $.post('dashboardFile/getRquestDashboard.php', { sub_area_list }, function (data) {

            $('#tot_req').text(data.tot_req)
            $('#tot_issue').text(data.tot_issue)
            $('#tot_bal').text(data.tot_balance)
            $('#today_req').text(data.today_req)
            $('#today_issue').text(data.today_issue)
            $('#today_bal').text(data.today_balance)

            localStorage.setItem('tot_cancel', data.tot_cancel);
            localStorage.setItem('tot_revoke', data.tot_revoke);
            localStorage.setItem('today_cancel', data.today_cancel);
            localStorage.setItem('today_revoke', data.today_revoke);

            localStorage.setItem('tot_new', data.tot_new);
            localStorage.setItem('tot_existing', data.tot_existing);
            localStorage.setItem('today_new', data.today_new);
            localStorage.setItem('today_existing', data.today_existing);


            $('input[name="chart_selector"]').trigger('change');//trigger at start

        }, 'json');

        $('input[name="chart_selector"]').change(function () {
            let selectedValue = $('input[name="chart_selector"]:checked').next().text().trim();
            $('#chart1,#chart2').empty();


            if (selectedValue == 'Cancel & Revoke') {
                let tot_cancel = localStorage.getItem('tot_cancel');
                let tot_revoke = localStorage.getItem('tot_revoke');
                let today_cancel = localStorage.getItem('today_cancel');
                let today_revoke = localStorage.getItem('today_revoke');

                tot_cr_chart(tot_cancel, tot_revoke);
                tdy_cr_chart(today_cancel, today_revoke);
            } else if (selectedValue == 'Customer Type') {
                let tot_new = localStorage.getItem('tot_new');
                let tot_existing = localStorage.getItem('tot_existing');
                let today_new = localStorage.getItem('today_new');
                let today_existing = localStorage.getItem('today_existing');

                tot_ct_chart(tot_new, tot_existing);
                tdy_ct_chart(today_new, today_existing);

            }
        });
    })

}

//Cancel and Revoke Charts
function tot_cr_chart(tot_cancel, tot_revoke) {

    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Request Status", "Count", { role: "style" }],
            ["Cancel", parseInt(tot_cancel), "#faae7b"],
            ["Revoke", parseInt(tot_revoke), "#432371"],
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "Total Cancelled and Revoked",
            width: '100%',
            height: '400px',
            bar: { groupWidth: "90%" },
            legend: { position: "none" },
            vAxis: { format: 'decimal', gridlines: { interval: [0, 5, 10, 15, 20] } },//this is for left vertical column count interval
            chartArea: {

            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart1"));
        chart.draw(view, options);
    }
}
function tdy_cr_chart(today_cancel, today_revoke) {
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Request Status", "Count", { role: "style" }],
            ["Cancel", parseInt(today_cancel), "#faae7b"],
            ["Revoke", parseInt(today_revoke), "#432371"],
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "Today Cancelled and Revoked",
            width: '100%',
            height: '400px',
            bar: { groupWidth: "90%" },
            legend: { position: "none" },
            vAxis: { format: 'decimal', gridlines: { interval: [0, 5, 10, 15, 20] } },//this is for left vertical column count interval
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart2"));
        chart.draw(view, options);
    }
}

//Customer Type Charts
function tot_ct_chart(tot_new, tot_existing) {
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Customer Type", "Count", { role: "style" }],
            ["New Customer", parseInt(tot_new), "#faae7b"],
            ["Existing Customer", parseInt(tot_existing), "#432371"],
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "Total New & Existing Customers",
            width: '100%',
            height: '400px',
            bar: { groupWidth: "90%" },
            legend: { position: "none" },
            vAxis: { format: 'decimal', gridlines: { interval: [0, 5, 10, 15, 20] } },//this is for left vertical column count interval
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart1"));
        chart.draw(view, options);
    }
}
function tdy_ct_chart(today_new, today_existing) {
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Customer Type", "Count", { role: "style" }],
            ["New Customer", parseInt(today_new), "#faae7b"],
            ["Existing Customers", parseInt(today_existing), "#432371"],
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "Today New & Existing Customers",
            width: '100%',
            height: '400px',
            bar: { groupWidth: "90%" },
            legend: { position: "none" },
            vAxis: { format: 'decimal', gridlines: { interval: [0, 5, 10, 15, 20] } },//this is for left vertical column count interval
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("chart2"));
        chart.draw(view, options);
    }
}


// *****************************************************************************************************************************************

function initializeCounterAnimation() {
    const counterUp = window.counterUp.default;

    const callback = entries => {
        entries.forEach(entry => {
            const el = entry.target;
            if (entry.isIntersecting && !el.classList.contains('is-visible')) {
                counterUp(el, {
                    // duration: 2000,
                    // delay: 70,
                });
                el.classList.add('is-visible');
            }
        });
    };

    const IO = new IntersectionObserver(callback, {
        threshold: 0
    });

    const els = document.querySelectorAll('.counter');
    els.forEach(el => {
        IO.observe(el);
    });
}