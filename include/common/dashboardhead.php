<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta -->
	<meta name="description" content="Feather Rasi Project">
	<meta name="author" content="Feather Rasi Project">
	<link rel="shortcut icon" href="img/fav.png" />

	<!-- Title -->
	<title>Marudham </title>


	<!-- *************
		************ Common Css Files *************
	************ -->
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Icomoon Font Icons css -->
	<link rel="stylesheet" href="fonts/style.css">
	<!-- Main css -->
	<link rel="stylesheet" href="css/main.css">
	<!-- <link rel="stylesheet" href="css/chosen.css" /> -->

	<!-- ************************* Vendor Css Files *************-->
	<link rel="stylesheet" href="vendor/customcss/customstyle.css" />
	<link rel="stylesheet" href="vendor/customcss/tabstyle.css" />

<!-- multiselect stylesheet -->
	<link rel="stylesheet" href="vendor/multiselect/public/assets/styles/choices.min.css" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DateRange css -->
		<link rel="stylesheet" href="vendor/daterange/daterange.css" />
<!-- Datepicker css -->
<link rel="stylesheet" href="vendor/datepicker/css/classic.css" />
<link rel="stylesheet" href="vendor/datepicker/css/classic.date.css" />

<link rel="stylesheet" type="text/css" href="cssd/datatables.min.css" />

 <style>
        .dataTables_length {
            margin-bottom: 30px;
        }
        
        .dataTables_length select {
            border: 1px solid #e4e4e4;
        }
        
        .dt-buttons a {
            margin-left: 12px;
            font-size: 12px;
            padding: 6px;
            border: 1px solid #e4e4e4;
            background: #FFF;
            box-shadow: 0px 0px 14px 0px #ececec;
        }
        
        .dataTables_filter input {
            border: 1px solid #e4e4e4;
        }
        
        .table-striped tbody tr {
            line-height: 30px;
        }
		.table-responsive{overflow-x: unset;}
		
		.overlay {
			position: fixed;
			z-index: 9999;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5); /* Add semi-transparent black background */
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.loader {
			border: 4px solid #f3f3f3;
			border-top: 4px solid #3498db;
			border-radius: 50%;
			width: 30px;
			height: 30px;
			animation: spin 2s linear infinite;
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
		.overlay-text {
			color: white;
			font-size: 1.5rem;
			margin-left: 10px;
		}
		#icon-flipped {
				-moz-transform: scaleX(-1);
				-o-transform: scaleX(-1);
				-webkit-transform: scaleX(-1);
				transform: scaleX(-1);
				filter: FlipH;
				-ms-filter: "FlipH";
		}
 </style>	
	<link rel="stylesheet" href="vendor/bs-select/bs-select.css" />
	<script>
		var overlayDiv = document.createElement('div');
		overlayDiv.classList.add('overlay');
		document.body.appendChild(overlayDiv);

		var loaderDiv = document.createElement('div');
		loaderDiv.classList.add('loader');
		overlayDiv.appendChild(loaderDiv);

		var overlayText = document.createElement('span');
		overlayText.classList.add('overlay-text');
		overlayText.innerText = 'Please Wait';
		overlayDiv.appendChild(overlayText);

		window.addEventListener('load', function() {
			overlayDiv.remove();
		});

	</script>
</head>
