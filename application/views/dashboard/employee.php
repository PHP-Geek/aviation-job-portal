<style>
	#job_alert_form .select2-container {
		padding:0;
		border:none;
	}
	.dashboard-heading h3{
		color:#009fff;
	}
	#job_alert_form .select2-choice,#job_alert_form .select2-default {
		min-height:34px !important;
		padding-top:3px;
	}
	.has-error .select2-choice.select2-default {
		border: 1px solid red !important;
		border-radius:5px;
	}
	.new {
		background: #ffffff none repeat scroll 0 0;
		border-radius: 0 28px 0 25px;
		padding: 10px 31px;
	}
	.progress{
		background-color:#c5c5c4 !important;
	}
	.dashboard{
		background-color: rgba(0, 0, 0, 0.6);
		background: rgba(0, 0, 0, 0.6);
		color: rgba(0, 0, 0, 0.6);
		color: #fff;
		padding: 20px
	}
	.dashboard-divider {
		border-left: 4px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
	.dashboard img{
		margin-bottom: 10px;
	}
	.btn-warning {
		width: 175px;
	}
	.view-profile{
		font-size:15px !important;
		margin-top:-11px;
	}
	#job_alert_button {
		background-color: #3c8dbc;
		border-color: #2e6da4;
		color: #fff;
	}
	.dashboard-title h3{
		margin-top: 0px!important;
		/*color:hsl(202, 62%, 48%);*/
	}
	.little-banner {
		padding: 7px 0 ;
	}
	.view-profile {
		background-color: rgba(0, 0, 0, 0.6);
		background: rgba(0, 0, 0, 0.6);
		color: rgba(0, 0, 0, 0.6);
		font-size: 15px !important;
		position: relative;
		top: -10px;
		display: none;
	}
	.view-profile-msg img:hover{
		background-color: rgba(0, 0, 0, 0.6);
		background: rgba(0, 0, 0, 0.6);
		color: rgba(0, 0, 0, 0.6);
		font-size: 15px !important;
		position: relative;
		top: -10px;
		visibility:visible;

	}
	.well-white-2 {
		background-color: #ffffff;
		border: 1px solid #e3e3e3;
		border-radius: 4px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
		margin-top: 20px;
		min-height: 20px;
		overflow: hidden;
		text-align: center;
		margin-bottom: 20px;
	}
	.color-brown{
		color:#D47900;
	}
</style>
<div class="bread">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="little-banner">
	<div class="container" id="email_send_div">
		<div class="row">
			<div class="col-md-12">
				<div class="well-black">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-lg-2">
							<div class="piceffect">
								<img src="<?php
								if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'])) {
									echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'];
								} else {
									echo base_url() . 'assets/img/profile.png';
								}
								?>" alt="profile" class="img-responsive"/>
								<div class="overlay">
									<a href="javascript:;" class="info" data-toggle="modal" data-target="#upload_modal">Change Image <i class="fa fa-plane"></i></a>
								</div>
							</div>
							<?php if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employee' && isset($_SESSION['user']['user_profile_completeness'])) { ?>
								<div class="profile-complete-overflow">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-7"> <div class="spacer9"></div>
											<h5 class="profile-complete">Profile Completed </h5>
											<div class="progress">
												<div class="progress-bar <?php
												if ($_SESSION['user']['user_profile_completeness'] < 10) {
													echo 'progress-bar-danger';
												} else if ($_SESSION['user']['user_profile_completeness'] < 35) {
													echo 'progress-bar-warning';
												} else if ($_SESSION['user']['user_profile_completeness'] < 65) {
													echo 'progress-bar-info';
												} else {
													echo 'progress-bar-success';
												}
												?>" role="progressbar" aria-valuenow="<?php echo $_SESSION['user']['user_profile_completeness'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $_SESSION['user']['user_profile_completeness'] ?>%">
													<?php echo $_SESSION['user']['user_profile_completeness']; ?>%
												</div>
											</div>
											<a href="<?php echo base_url(); ?>user/profile" class="info"><h5 class="color-brown">View/Edit Profile <i class="fa fa-plane"></i></h5></a>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-md-3 col-lg-4 col-sm-3">
							<div class="row">
								<div class="col-lg-12">
									<div class="dashboard-title dashboard-heading">
										<h3><?php echo $_SESSION['user']['user_first_name'] . ' ' . $_SESSION['user']['user_last_name']; ?></h3>
									</div>
									<div class="dashboard-title">
										<p><strong><?php echo $_SESSION['user']['job_type_name']; ?></strong></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-sm-6 col-lg-5  dashboard-divider">
							<div class="dashboard-title">
								<h3>Qualifications</h3>
							</div>
							<?php $this->load->view('templates/dashboard/qualification.php'); ?>
							<div class = "spacer9"></div>
							<div class = "spacer9"></div>
							<?php if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'employee' && $_SESSION['user']['user_verified'] === '0') {
								?>
								<div class="row">
									<div class="col-md-12 col-lg-12 col-sm-12">
										<a class="btn btn-primary btn-md pull-right" id="printit" onclick="send_verify_link();">Resend Verify Email <i class="fa fa-plane"></i></a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bg-in-pages">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>user/desired_job"><img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>user/desired_job"><h4>Desired Job</h4></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url() . 'careers-open/' . $_SESSION['user']['job_type_slug']; ?>"> <img src="<?php echo base_url(); ?>assets/img/jobs-board.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url() . 'careers-open/' . $_SESSION['user']['job_type_slug']; ?>"><h4>Jobs Board</h4></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>jobs-applied-dashboard"><img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>jobs-applied-dashboard"><h4>Job Saved/Applied</h4></a>
					</div>
				</div>
			</div>


			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>job-alerts" > <img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>job-alerts" ><h4>Jobs Alerts</h4></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>user/profile"> <img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>user/profile"><h4>View/Edit Profile</h4></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>our-services"><img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>our-services"><h4>InCrew Services</h4></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('templates/dashboard/upload_pic'); ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
										function send_verify_link() {
											$(window).block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Sending Email...'});
											$.post(base_url + 'auth/send_verify_link', {'success': true}, function (data) {
												if (data === '1') {
													bootbox.alert('Verification Email Sent. Please Check Your Email.');
												} else if (data === '0') {
													bootbox.alert('Error Sending Email.');
												} else {
													bootbox.alert(data);
												}
												$(window).unblock();
											});
										}
</script>