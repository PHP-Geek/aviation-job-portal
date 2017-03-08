<style>
    .dashboard{
        background-color: rgba(0, 0, 0, 0.6);
        background: rgba(0, 0, 0, 0.6);
        color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 20px
    }
	.dashboard-title h3{
		margin-top: 0px!important;
	}
    .dashboard img{
        margin-bottom: 10px;
    }
	.btn-primary {
		width:171px;
	}
	.dashboard-heading h3{
		color:#009fff;
	}
	.btn-warning {
		width: 159px;
	}
	.about-us p {
		padding: 0px 7px;
	}
	.view-profile-image p {
		background-color: rgba(255, 148, 0, 0.6);
		background: rgba(255, 148, 0, 0.6);
		color: rgba(255, 148, 0, 0.6);
		color: hsl(0, 0%, 100%);
		font-size: 15px;
		opacity: 0.7;
		padding: 4px 0;
		position: absolute;
		text-align: center;
		top: 122px;
		font-weight:400;
		width: 150px;
	}
	.view-profile-image p a{
		color:#fff;
	}
	.view-profile-image a p:hover{
		background:#fff;
		color:#000;
	}
	.dashboard-divider {
		border-left: 4px solid #2c2c2c;
		padding: 0 0 0 38px;
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
</style>
<div class="bread">
	<div class="container">
		<div class = "row">
			<div class = "col-lg-12">
				<ol class = "breadcrumb">
					<li><a href = "<?php echo base_url(); ?>index.php">Home</a></li>
					<li class = "active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="well-black">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-lg-2">
							<div class="//piceffect">
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
							<?php if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employer' && isset($_SESSION['user']['user_profile_completeness'])) { ?>
								<div class="spacer9"></div>
								<div class="profile-complete-overflow">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-7">
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
											<a href="<?php echo base_url(); ?>user/employer_profile" class="info"><h5 class="color-brown">View/Edit Profile <i class="fa fa-plane"></i></h5></a>
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
										<p><strong><?php echo $_SESSION['user']['employer_type']; ?></strong></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4 col-sm-6 dashboard-divider">
							<div class="dashboard-title">
								<h3>Status</h3>
							</div>
							<?php $this->load->view('templates/dashboard/qualification_employer.php'); ?>
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
						<a href="<?php echo base_url(); ?>post-job"><img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>post-job"><h4>Post Job</h4></a>
					</div>
				</div>
			</div>
			<div class = "col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class = "about-us">
						<a href = "<?php echo base_url(); ?>job"><img src = "<?php echo base_url(); ?>assets/img/our-client.png" alt = "pilot" class = "img-responsive"/></a>
						<a href = "<?php echo base_url(); ?>job"><h4>View/Edit Job</h4></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>view-job-applicant"><img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>view-job-applicant"><h4> View Applicants</h4></a>
					</div>
				</div>
			</div>
			<div class = "col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class = "about-us">
						<a href = "<?php echo base_url(); ?>contract-crew-request"><img src = "<?php echo base_url(); ?>assets/img/our-client.png" alt = "pilot" class = "img-responsive"/></a>
						<a href = "<?php echo base_url(); ?>contract-crew-request"><h4>Staff Search/Request </h4></a>
					</div>
				</div>
			</div>
			<div class = "col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class = "about-us">
						<a href = "<?php echo base_url(); ?>user/employer_edit_profile"><img src = "<?php echo base_url(); ?>assets/img/our-client.png" alt = "pilot" class = "img-responsive"/></a>
						<a href = "<?php echo base_url(); ?>user/employer_edit_profile"><h4>View/Edit Profile </h4></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-4">
				<div class="well-white-2">
					<div class="about-us">
						<a href="<?php echo base_url(); ?>our-services"><img src="<?php echo base_url(); ?>assets/img/our-client.png" alt="pilot" class="img-responsive"/></a>
						<a href="<?php echo base_url(); ?>our-services"><h4> InCrew Services</h4></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
