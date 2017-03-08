<script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "33fc197f-6e9c-4cf5-8622-00acb75b0dfb", doNotHash: false, doNotCopy: false, hashAddressBar: false});
	function share(url, id, service) {
		$.getJSON('http://rest.sharethis.com/v1/count/urlinfo?url=' + url + '&provider=' + service + '&api_key=33fc197f-6e9c-4cf5-8622-00acb75b0dfb', function (callback_data) {
			$.post(base_url + 'job/update_social_media_share', {share_count: callback_data[service]['outbound'] + callback_data[service]['inbound'], job_id: id, social_media_service: service}, function (data) {
				if (data === '1') {
					console.log('done');
				} else if (data === '0') {
					console.log('error');
				} else {
					console.log(data);
				}
			});
		});
	}
</script>
<style>
	.little-banner{
		margin-bottom: 0px;
	}
	.about-us p {
		min-height: auto !important;
	}
	.footer{
		margin-top: 0px;
	}
	.view-job-web{
		margin-top:-28px;
	}
	.bg-grey{
		/*background: #F7F7F9;*/
		padding: 10px 0 0;
		overflow: hidden;
	}
	.bg-white{
		/*background: #fff;*/
		padding: 10px 0 0;
		overflow: hidden;
	}
	.view-job-read-more h3{
		font-size:20px !important;
	}
	.view-job h4 {
		color: #283866;
		font-size: 36px;
		font-weight: 500;
	}
	.view-center-button{
		text-align: center;
	}
	.view-image img{
		overflow: hidden;
		margin-bottom:30px;
	}
	.view-image {
		float: right;
	}
	.career-button-forced-right{
		float:right;
	}
	.button-on-right{
		float:right;
	}
	@media only screen and (max-width:1024px) and (min-width:768px){
		.view-image {
			float: none !important;
		}
		.career-button-forced-right {
			float: none;
		}
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.view-image img {
			padding: 0px;
		}
		.view-image {
			float: none !important;
		}
		.button-on-right{
			float:left;
			margin: 5px 0px;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>careers">Careers</a></li>
                    <li><a href="<?php echo base_url() . 'careers-open/' . $job_detail_array['job_type_slug']; ?>"><?php echo $job_detail_array['job_type_name']; ?> Jobs</a></li>
                    <li class="active">View Job</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="little-banner-text">
                    <h1><span style="font-weight: 500"><?php echo $job_detail_array['job_type_name']; ?> Jobs</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="well-white">
					<div class="row">
						<div class="col-md-8 col-lg-8">
							<div class="about-us">
								<h4><?php echo $job_detail_array['job_title']; ?> In <?php echo $job_detail_array['country_name']; ?> <?php
									if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1') {
										echo '<span style="font-size:small" class="badge"> Applied </small>';
									}
									?></h4>
								<div class="row">
									<div class="bg-grey">
										<div class="col-sm-4 col-md-4 col-lg-3">
											<p><strong>Job Title</strong></p>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-9">
											<?php echo $job_detail_array['job_title']; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="bg-white">
										<div class="col-sm-4 col-md-4 col-lg-3">
											<p><strong>Department</strong></p>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-9">
											<?php echo $job_detail_array['job_type_name']; ?>
										</div>
									</div>
								</div>
								<?php if ($job_detail_array['job_type_slug'] === 'pilot' || $job_detail_array['job_type_slug'] === 'maintenance-engineer' || $job_detail_array['job_type_slug'] === 'flight-attendant') { ?>
									<div class="row">
										<div class="bg-white">
											<div class="col-sm-4 col-md-4 col-lg-3">
												<p><strong>Aircraft Type</strong></p>
											</div>
											<div class="col-sm-8 col-md-8 col-lg-9">
												<?php echo $job_detail_array['my_aircraft_name']; ?>
											</div>
										</div>
									</div>
								<?php } ?>
								<div class="row">
									<div class="bg-grey">
										<div class="col-sm-4 col-md-4 col-lg-3">
											<p><strong>Location</strong></p>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-9">
											<?php echo $job_detail_array['country_name']; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="bg-white">
										<div class="col-sm-4 col-md-4 col-lg-3">
											<p><strong>Last Date To Apply</strong></p>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-9">
											<?php echo date('d M Y', strtotime($job_detail_array['job_expire_date'])); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="bg-grey">
										<div class="col-sm-4 col-md-4 col-lg-3">
											<p><strong>Employment Type</strong></p>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-9">
											<p><?php echo $job_detail_array['job_employee_type'] === '1' ? 'Full Time' : 'Part Time'; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="view-image">
								<img src="<?php echo base_url(); ?>uploads/jobs/company_logos/<?php echo date('Y/m/d/H/i/s/', strtotime($job_detail_array['job_created'])) . $job_detail_array['job_company_logo']; ?>" alt="pilot-2" class="img-responsive"/>
								<div class="text-center view-job-web"><?php echo $job_detail_array['job_company_website']; ?></div>
								<button class="btn <?php
								if ($job_detail_array['job_saved_status'] === '1') {
									echo 'bgcolor-grey text-white';
								} else if (strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
									echo 'bgcolor-grey text-white';
								} else {
									echo 'btn-success';
								}
								?> btn-lg" role="button" onclick="save_job(<?php echo $job_detail_array['job_id']; ?>, '<?php echo $job_detail_array['job_slug']; ?>')" <?php
										if (strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
											echo 'disabled="disabled"';
										} else if ($job_detail_array['job_saved_status'] === '1') {
											echo 'disabled="disabled"';
										} else {
											echo 'Save Job';
										}
										?>>
											<?php
											if (strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
												echo 'Save Job';
											} else if ($job_detail_array['job_saved_status'] === '1') {
												echo 'Saved';
											} else {
												echo 'Save Job';
											}
											?> <span class="fa fa-star"></span></button>
									<?php if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] !== 'employer')) { ?>
									<button type = "button" class = "career-button-forced-right btn <?php
									if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
										echo 'bgcolor-grey text-white career-button-forced-right';
									} else {
										echo 'btn-warning';
									}
									?> btn-lg" role = "button" id="job_apply_button" <?php
											if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
												echo 'disabled="disabled"';
											}
											?>  onclick="apply_job();"><?php
												if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
													echo 'Closed';
												} else if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
													echo 'Applied';
												} else {
													echo'Apply Now';
												}
												?> <span class = "fa fa-plane"></span></button>
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="well-white">
					<div class="row">
						<div class = "col-md-12 col-lg-12">
							<div class="about-us view-job-read-more">
								<h3>Description</h3>
								<p><?php echo $job_detail_array['job_details'];
									?></p>
								<h3>Minimum Requirements</h3>
								<p><?php echo $job_detail_array['job_requirements']; ?></p>
								<h3>Salary and Benefits Packages Include</h3>
								<p><?php echo $job_detail_array['job_benifit_package']; ?></p>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-7"></div>
						<div class="col-md-5">
							<div class="pull-left">
								<span class='st_facebook_large' displayText='Facebook' st_url="<?php echo current_url(); ?>" st_title="<?php echo $job_detail_array['job_title'] . ' in ' . $job_detail_array['country_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $job_detail_array['job_id']; ?>', 'facebook');"></span>
								<span class='st_twitter_large' displayText='Tweet' st_url="<?php echo current_url(); ?>" st_title="<?php echo $job_detail_array['job_title'] . ' in ' . $job_detail_array['country_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $job_detail_array['job_id']; ?>', 'twitter');"></span>
								<span class='st_googleplus_large' displayText='Google +' st_url="<?php echo current_url(); ?>" st_title="<?php echo $job_detail_array['job_title'] . ' in ' . $job_detail_array['country_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $job_detail_array['job_id']; ?>', 'googleplus');"></span>
								<span class='st_linkedin_large' displayText='LinkedIn' st_url="<?php echo current_url(); ?>" st_title="<?php echo $job_detail_array['job_title'] . ' in ' . $job_detail_array['country_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $job_detail_array['job_id']; ?>', 'linkedin');"></span>
								<span class='st_email_large' displayText='Email' st_url="<?php echo current_url(); ?>" st_title="<?php echo $job_detail_array['job_title'] . ' in ' . $job_detail_array['country_name']; ?>" ></span>
							</div>
							<div class="button-on-right">
								<?php if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] !== 'employer')) { ?>
									<button type = "button" class = "btn <?php
									if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
										echo 'bgcolor-grey text-white';
									} else {
										echo'btn-warning';
									}
									?> btn-lg" role = "button" id="job_apply_button" <?php
											if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
												echo 'disabled="disabled" value="Applied"';
											}
											?> onclick="apply_job();"><?php
												if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
													echo 'Closed';
												} else if (isset($job_detail_array['job_applied_status']) && $job_detail_array['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($job_detail_array['job_expire_date'])) {
													echo 'Applied';
												} else {
													echo'Apply Now';
												}
												?> <span class = "fa fa-plane"></span></button>
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="resend_email_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p>Please verify your email to apply for jobs and to be considered for up and coming roles.</p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-primary" href="javascript:;" onclick="send_verify_link();">Resesnd Verify Email</a>
				<a class="btn btn-primary" href="<?php echo base_url(); ?>login">Ok</a>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">

					function apply_job() {
						$(window).block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
						$.post('', {success: true}, function (data) {
							if (data === '1') {
								bootbox.alert('You have Applied for job successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('You must login as employee to apply for the job.');
							} else if (data === '-1') {
								bootbox.alert('Please update your profile to apply for the job.', function () {
									document.location.href = base_url + 'edit-profile';
								});
							} else if (data === '2') {
							} else if (data === '3') {
								$('#resend_email_modal').modal('show');
							} else {
								bootbox.alert("You must login first to apply for the job.", function () {
									document.location.href = base_url + 'employee-login';
								});
//								bootbox.alert(data);
							}
							$(window).unblock();
						});
					}
					function save_job(job_id, job_slug) {
						$(window).block({message: ' <br/>Please wait...'});
						$.post(base_url + 'job/save', {job_id: job_id, job_slug: job_slug}, function (data) {
							if (data === '1') {
								bootbox.alert('Job Saved Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '-1') {
								bootbox.alert('You must logged in to save the job', function () {
									document.location.href = base_url + 'employee-login';
								});
							} else if (data === '-2') {
								bootbox.alert('You must log in as employee to save the job');
							} else if (data === '0') {
								bootbox.alert('Error Saving Job. Please Try Again.');
							} else {
								bootbox.alert(data);
							}
							$(window).unblock();
						});
					}
					function send_verify_link() {
						$("#resend_email_modal").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Sending...'});
						$.post(base_url + 'auth/send_verify_link', {'success': true}, function (data) {
							if (data === '1') {
								bootbox.alert('Verification Email Sent. Please Check Your Email.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Sending Email.');
							} else {
								bootbox.alert(data);
							}
							$("#resend_email_modal").unblock();
						});
					}
</script>