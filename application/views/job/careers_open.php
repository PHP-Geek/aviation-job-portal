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
	.pagination{
		margin-bottom: 0px;
	}
	.little-banner{
		margin-bottom: 0px;
	}
	.about-us p{
		min-height: auto !important;
	}
	.footer{
		margin-top: 0px;
	}
	.top-image{
		margin-top:0px;
	}
	.about-us{
		overflow: hidden;
	}
	.stButton{
		margin-right:2px;
	}
	.new-image img {
		left: -3px;
		position: absolute;
		top: -3px;
		z-index: 15;
	}
	.image-pad {
		position: relative;
	}
	.closed-image img {
		right: -3px;
		position: absolute;
		top: -3px;
		z-index: 15;
	}
	h3{
		color:#a1a1a1;
	}
	.btn-warning {
		border: 2px solid #ff9400;
	}
	@media only screen and (max-width:1024px) and (min-width:767px) and (orientation:landscape){
		.stButton{
			margin-right:2px;
		}
	}
	@media only screen and (max-width:1024px) and (min-width:767px) and (orientation:portrait){
		.stButton{
			margin-right:0px;
			margin-left:0px;
		}
		.closed-image img {
			right: -3px;
			top: -3px;
		}
		.share-icon {
			margin: 14px 0;
		}
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.ads_div{
			display:none;
		}
		.stButton{
			margin-right:0px;
		}
		.stButton{
			margin-left:0px;
		}
		.share-icon{
			margin:15px 0px;
		}
	}
	@media only screen and (max-width:359px) and (min-width:320px){
		.btn-success {
			margin:0;
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
					<li class="active"> <?php echo $job_type; ?> Jobs</li>
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
                    <h1><span style="font-weight: 400"><?php echo $job_type; ?> Jobs</span></h1>
				</div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<?php if (count($jobs_array) > 0) { ?>
			<div class="text-center"><?php echo $page_links; ?></div>
			<?php foreach ($jobs_array as $key => $jobs) {
				?>
				<?php if (isset($advertisement_array) && count($advertisement_array) > 0 && isset($advertisement_array[$key]) && $key === 0) { ?>
					<div class="row ads_div spaceup-20">
						<div class="col-md-12 col-lg-12">
							<a href="<?php echo $advertisement_array[0]['advertisement_link']; ?>" target="_blank">
								<img src="<?php echo base_url(); ?>uploads/advertisements/<?php echo date('Y/m/d/H/i/s/', strtotime($advertisement_array[0]['advertisement_created'])) . $advertisement_array[0]['advertisement_image']; ?>" class="img-responsive center-block"/></a>
						</div>
					</div>
				<?php }
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="image-pad">
							<?php if (strtotime($jobs['job_post_date']) > strtotime(date('Y-m-d', strtotime('-7days')))) { ?>
								<div class="new-image">
									<img class="img-responsive" alt="pilot" src="<?php echo base_url(); ?>assets/img/new-plane.png">
								</div>
							<?php } ?>
							<?php if (strtotime($jobs['job_expire_date']) < strtotime(date('Y-m-d'))) { ?>
								<div class="closed-image">
									<img class="img-responsive" alt="pilot" src="<?php echo base_url(); ?>assets/img/closed.png">
								</div>
							<?php } ?>					
							<div class="well-white">
								<div class="row">
									<div class="col-md-6 col-lg-6 col-sm-8">
										<div class="about-us">
											<h4><?php echo $jobs['job_title']; ?> in <?php echo $jobs['country_name']; ?><?php
												if (isset($jobs['job_applied_status']) && $jobs['job_applied_status'] === '1') {
													echo '<span style="font-size:small" class="badge"> Applied </small>';
												}
												?></h4>
											<div class="row">
												<div class="col-md-12 col-lg-12">
													<h3><?php echo $jobs['job_company_name']; ?></h3>
												</div>
											</div>
											<div class="row">
												<div class='col-sm-7'>
													<p>
														<?php echo $jobs['job_employee_type'] === '1' ? 'Full Time' : 'Part Time'; ?>
													</p>
												</div>
												<div class='col-sm-5'>
													<p><i class="fa fa-map-marker"></i>
														<?php
														echo $jobs['country_name'];
														?></p>
												</div>
												<div class='col-md-6'>

												</div>
											</div>
											<div class="spacer9"></div>
											<div class="row">
												<div class="col-sm-12 col-md-8 col-lg-7">
													<?php if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] !== 'employer')) { ?>
														<button type = "button" class = "btn <?php
														if (isset($jobs['job_applied_status']) && $jobs['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($jobs['job_expire_date'])) {
															echo 'bgcolor-grey text-white';
														} else {
															echo 'btn-warning';
														}
														?> btn-lg" role = "button" id="job_apply_button_<?php echo $jobs['job_id']; ?>" <?php
																if (isset($jobs['job_applied_status']) && $jobs['job_applied_status'] === '1' || strtotime(date('Y-m-d')) > strtotime($jobs['job_expire_date'])) {
																	echo 'disabled="disabled"';
																}
																?> onclick="apply_job(<?php echo $jobs['job_id']; ?>)"><?php
																	if (strtotime(date('Y-m-d')) > strtotime($jobs['job_expire_date'])) {
																		echo 'Closed';
																	} else if (isset($jobs['job_applied_status']) && $jobs['job_applied_status'] === '1') {
																		echo 'Applied';
																	} else {
																		echo 'Apply Now';
																	}
																	?> <span class = "fa fa-plane"></span></button><?php } ?>
													<a href="<?php echo base_url(); ?>job/view/<?php echo $jobs['job_slug']; ?>/<?php echo $jobs['job_id']; ?>" class="btn btn-success" role="button">Read More  <span class="fa fa-plane"></span></a>
												</div>
												<div class="col-sm-12 col-md-4 col-lg-5">
													<div class="row">
														<div class="col-md-12">
															<div class="share-icon">
																<span class='st_facebook_large' displayText='Facebook' st_url="<?php echo base_url('job/view') . '/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>" st_title="<?php echo $jobs['job_title'] . ' in ' . $jobs['country_name']; ?>" onclick="share('<?php echo base_url() . 'job/view/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>', '<?php echo $jobs['job_id']; ?>', 'facebook');"></span>
																<span class='st_twitter_large' displayText='Tweet' st_url="<?php echo base_url('job/view') . '/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>" st_title="<?php echo $jobs['job_title'] . ' in ' . $jobs['country_name']; ?>" onclick="share('<?php echo base_url() . 'job/view/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>', '<?php echo $jobs['job_id']; ?>', 'twitter');"></span>
																<span class='st_googleplus_large' displayText='Google +' st_url="<?php echo base_url('job/view') . '/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>" st_title="<?php echo $jobs['job_title'] . ' in ' . $jobs['country_name']; ?>" onclick="share('<?php echo base_url() . 'job/view/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>', '<?php echo $jobs['job_id']; ?>', 'googleplus');"></span>
																<span class='st_linkedin_large' displayText='LinkedIn' st_url="<?php echo base_url('job/view') . '/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>" st_title="<?php echo $jobs['job_title'] . ' in ' . $jobs['country_name']; ?>" onclick="share('<?php echo base_url() . 'job/view/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>', '<?php echo $jobs['job_id']; ?>', 'linkedin');"></span>
																<span class='st_email_large' displayText='Email' st_url="<?php echo base_url('job/view') . '/' . $jobs['job_slug'] . '/' . $jobs['job_id']; ?>" st_title="<?php echo $jobs['job_title'] . ' in ' . $jobs['country_name']; ?>"></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-6 col-sm-4">
										<div class="about-us">
											<img src="<?php echo base_url(); ?>uploads/jobs/company_logos/<?php echo date('Y/m/d/H/i/s/', strtotime($jobs['job_created'])) . $jobs['job_company_logo']; ?>" alt="pilot-2" class="img-responsive center-block top-image"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if ((isset($advertisement_array) && count($advertisement_array) > 0 && isset($advertisement_array[($key + 1) / 5]) && count($advertisement_array[($key + 1) / 5]) > 0) && (($key === 4 || $key === 9 || ($key >= 1 && $key === count($jobs_array) - 1)))) { ?>
					<div class="row ads_div spaceup-20">
						<div class="col-md-12 col-lg-12">
							<a href="<?php
							if ($key < 5 && $key >= 1 && $key === count($jobs_array) - 1) {
								echo $advertisement_array[1]['advertisement_link'];
							} else if ($key > 5 && $key === count($jobs_array) - 1) {
								echo $advertisement_array[2]['advertisement_link'];
							} else {
								echo $advertisement_array[($key + 1) / 5]['advertisement_link'];
							}
							?>" target="_blank">
								<img src="<?php
								if ($key < 5 && $key >= 1 && $key === count($jobs_array) - 1) {
									echo base_url() . 'uploads/advertisements/' . date('Y/m/d/H/i/s/', strtotime($advertisement_array[1]['advertisement_created'])) . $advertisement_array[1]['advertisement_image'];
								} else if ($key > 5 && $key === count($jobs_array) - 1) {
									echo base_url() . 'uploads/advertisements/' . date('Y/m/d/H/i/s/', strtotime($advertisement_array[2]['advertisement_created'])) . $advertisement_array[2]['advertisement_image'];
								} else {
									echo base_url() . 'uploads/advertisements/' . date('Y/m/d/H/i/s/', strtotime($advertisement_array[($key + 1) / 5]['advertisement_created'])) . $advertisement_array[($key + 1) / 5]['advertisement_image'];
								}
								?>" class="img-responsive center-block"/></a>
						</div>
					</div>
				<?php }
				?>
			<?php }
			?>
			<div class="text-center"><?php echo $page_links; ?></div>
		<?php } else {
			?>
			<div class="well"><h3>Presently all of our opportunities are filled. Please visit again soon and keep your profile up to date in order to apply for the next great opportunity.</h3> <br/>
				<div class="text-center">
					<?php if (isset($_SESSION['user'])) { ?>
						<a href="<?php echo base_url(); ?>dashboard" class="btn btn-success">Dashboard <i class="fa fa-plane"></i></a>
					<?php } else { ?>
						<a href="<?php echo base_url(); ?>login" class="btn btn-success">Login <i class="fa fa-plane"></i></a>
					<?php } ?></div></div>
		<?php }
		?>
	</div>
</div>
<!-- Modal -->
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
					function apply_job(job_id) {
						$("#job_apply_button_" + job_id).button('loading');
						$(window).block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
						$.post('', {job_id: job_id}, function (data) {
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
							}
							$("#job_apply_button_" + job_id).button('reset');
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
