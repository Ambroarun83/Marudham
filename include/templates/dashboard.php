<?php
@session_start();
if (isset($_SESSION["userid"])) {
	$userid = $_SESSION["userid"];
}

$getValues = $userObj->getDataForDashboard($mysqli,$userid);

?>
<!-- for fadeIn animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/css/libs/animate.min.css" rel="stylesheet">
<!-- for counter -->
<script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>

<style>
	.heading-list {
		font-size: 2rem;
		font-weight: bold;
		text-align: center;
	}

	.counter-head {
		font-size: 1.5rem;
		font-weight: bold;
	}

	.counter {
		font-size: 4rem;
		font-family: fantasy;
		font-weight: 100;
	}

	@media (max-width: 768px) {
		/* .card {
			height: 80vh;
		} */

		.counter {
			font-size: 6.5rem;
		}
	}

	@media (max-width: 600px) {
		/* .card {
			height: 77vh;
		} */

		.counter {
			font-size: 4rem;
		}
	}

	@media (max-width: 320px) {
		/* .card {
			height: 65vh;
		} */

		.counter {
			font-size: 2.5rem;
		}
	}
</style>
<!-- Page header start -->
<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - Dashboard
	</div>
</div><br>

<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id="dashboard_form" name="dashboard_form" action="" method="post" enctype="multipart/form-data">

		<!-- Row start -->
		<p class="heading-list wow fadeInUp">Request</p>
		<div class="row gutters">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card  wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Today's Request</p>
									<p class="counter wow fadeInUp"><?php echo $getValues['today_request']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card  wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Month's Request</p>
									<p class="counter wow fadeInUp"><?php echo $getValues['month_request']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row start -->
		<p class="heading-list wow fadeInUp">Loan</p>
		<div class="row gutters">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card  wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Today's Issued Loan</p>
									<p class="counter wow fadeInUp">8</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card  wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Month's Issued Loan</p>
									<p class="counter wow fadeInUp">40</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row start -->
		<p class="heading-list wow fadeInUp">Collection</p>
		<div class="row gutters">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Today's No of Collection</p>
									<p class="counter wow fadeInUp">12</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Month's No of Collection</p>
									<p class="counter wow fadeInUp">115</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Today's Collection</p>
									<p class="counter wow fadeInUp">15,750</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card wow">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row">
							<div class="col-12">
								<div class="form-group text-center">
									<p class='counter-head wow fadeIn'>Month's Collection</p>
									<p class="counter wow fadeInUp">48,100</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form>
</div>



<script>
	document.addEventListener('DOMContentLoaded', () => {
		new WOW().init();
		const counterUp = window.counterUp.default;

		const callback = entries => {
			entries.forEach(entry => {
				const el = entry.target;
				if (entry.isIntersecting && !el.classList.contains('is-visible')) {
					counterUp(el, {
						// duration: 3000,
						// delay: 20,
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
	});
</script>