<style>
    .dashboard{
        background-color: rgba(0, 0, 0, 0.6);
        background: rgba(0, 0, 0, 0.6);
        color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 20px
    }
	.dashboard-divider {
		border-left: 1px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
	.dashboard-divider {
		border-left: 4px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
    .btn-warning {
        width: 159px;
    }
    .well .row
    {
        margin-bottom: 15px;
    }
    #rating_star {
        margin-bottom:21px;
    }
    .star_btn {
        width:110px;
        margin-bottom: 2px;
    }
    .dashboard-title h3{
		margin-top: 0px!important;
    }
	.dashboard-heading h3{
		color:#009fff;
	}
	.little-banner {
		padding: 24px 0 0;
	}
	.well-black {
		border: 1px solid #000;
		border-radius: 4px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
		margin-bottom: 20px;
		min-height: 20px;
		padding: 19px;
		background-color: rgba(0, 0, 0, 0.7);
		background: rgba(0, 0, 0, 0.7);
		color: rgba(0, 0, 0, 0.7);
		color:#fff;
	}
</style>
<style>
    fieldset, label { margin: 0; padding: 0; }
    .rating {
        border: none;
        float: left;
    }
    .rating > input { display: none; }
    .rating > label:before {
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }
    .rating > .half:before {
        content: "\f089";
        position: absolute;
    }
    .rating > label {
        color: #ddd;
        float: right;
    }
    .rating > input:checked ~ label,
    .rating1:not(:checked) > label:hover,
    .rating1:not(:checked) > label:hover ~ label { color: #FFD700;  }
    .rating1 > input:checked + label:hover,
    .rating1 > input:checked ~ label:hover,
    .rating1 > label:hover ~ input:checked ~ label,
    .rating1 > input:checked ~ label:hover ~ label { color: #FFED85;  }
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div id="printarea">
    <div class="little-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="well-black">
						<div class="row">
							<div class="col-md-3 col-sm-3 col-lg-2">
								<img src="<?php
								if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'])) {
									echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'];
								} else {
									echo base_url() . 'assets/img/profile.png';
								}
								?>" alt="profile" class="img-responsive"/>
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
									<div class="col-lg-12 print1 dashboard-title dashboard-heading">
										<h3><?php echo $user_details_array['user_first_name'] . ' ' . $user_details_array['user_last_name']; ?></h3>
										<p><?php echo $user_details_array['job_type_name']; ?></p>
									</div>
									<?php if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'administrator') { ?>
										<div class="col-lg-12">
											<!--<h4 style="display:inline-block">Ratings</h4>-->
											<fieldset class="rating" id="rating">
												<input type="radio" value="5" name="rating" id="star5" class="stars" <?php echo ($user_details_array['user_rating'] === '5') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Awesome - 5 stars" for="star5" class="full"></label>
												<input type="radio" value="4.5" name="rating" id="star4half" class="stars" <?php echo ($user_details_array['user_rating'] === '4.5') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Pretty good - 4.5 stars" for="star4half" class="half"></label>
												<input type="radio" value="4" name="rating" id="star4" class="stars" <?php echo ($user_details_array['user_rating'] === '4') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Pretty good - 4 stars" for="star4" class="full"></label>
												<input type="radio" value="3.5" name="rating" id="star3half" class="stars" <?php echo ($user_details_array['user_rating'] === '3.5') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Meh - 3.5 stars" for="star3half" class="half"></label>
												<input type="radio" value="3" name="rating" id="star3" class="stars" <?php echo ($user_details_array['user_rating'] === '3') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Meh - 3 stars" for="star3" class="full"></label>
												<input type="radio" value="2.5" name="rating" id="star2half" class="stars" <?php echo ($user_details_array['user_rating'] === '2.5') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Kinda bad - 2.5 stars" for="star2half" class="half"></label>
												<input type="radio" value="2" name="rating" id="star2" class="stars" <?php echo ($user_details_array['user_rating'] === '2') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Kinda bad - 2 stars" for="star2" class="full"></label>
												<input type="radio" value="1.5" name="rating" id="star1half" class="stars" <?php echo ($user_details_array['user_rating'] === '1.5') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Meh - 1.5 stars" for="star1half" class="half"></label>
												<input type="radio" value="1" name="rating" id="star1" class="stars" <?php echo ($user_details_array['user_rating'] === '1') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Sucks big time - 1 star" for="star1" class="full"></label>
												<input type="radio" value="0.5" name="rating" id="starhalf" class="stars" <?php echo ($user_details_array['user_rating'] === '0.5') ? 'checked="checked"' : '' ?> disabled/>
												<label title="Sucks big time - 0.5 stars" for="starhalf" class="half"></label>
											</fieldset>
										</div>
										<div class="col-lg-12">
											<button class="btn btn-primary rateit" id="rateit" data-toggle="modal" data-target="#myModal">Rate This Profile</button>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-5 col-sm-6 col-lg-5  dashboard-divider">
								<?php if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'employee') { ?>
									<div class="dashboard-title">
										<h3>Qualifications</h3>
									</div>
									<?php $this->load->view('templates/dashboard/qualification.php'); ?>
									<div class="row">
										<div class="col-md-12 col-lg-12 col-sm-12">
											<a class="btn btn-primary btn-md pull-left" href="<?php echo base_url(); ?>edit-profile">Edit Profile <i class="fa fa-plane"></i></a>
										</div>
									</div>
								<?php } ?>
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
								<?php if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'administrator') { ?>
									<a class="btn btn-primary btn-md pull-right" id="printit" onclick="printit();"><i class="fa fa-print"></i> Print Profile</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="bg-in-pages padbot-20">
        <div class="container">

            <div id="bodydiv">
                <div class="row">                    
					<div class="col-md-12 col-lg-12">
						<div class="well-white">
                            <h4>Personal Details</h4>
							<div class="row">
								<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Contact Number: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_details_array['user_country_code'] . '-' . $user_details_array['user_primary_contact']; ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Skype Name: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_details_array['user_skype_id']; ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>LinkedIn: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_details_array['user_linkedin_id']; ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Address: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_details_array['user_address'] . ' ' . $user_details_array['user_city'] . ' ' . $user_details_array['user_state'] . ' , ' . $user_details_array['country_name'] . ' - ' . $user_details_array['user_zipcode']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6"></div>
                        </div>
                    </div>
                </div>
				<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
					<div class="row">						
						<div class="col-md-12  col-lg-12">
							<div class="well-white">
								<h4>Flight Times</h4>
								<div class="row">
									<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_flight">Total Hours: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_hours']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_pic">Total PIC: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_pic']; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_jet">Total SIC: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_sic']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_instructor">Total Jet: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_jet']; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_jet">Total Turboprop: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_turboprop']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_instructor">Total Night: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_night']; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label for="user_total_jet">Total Instructor: </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_details_array['user_total_instructor']; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php $this->load->view('templates/profile/qualification'); ?>
				<?php $this->load->view('templates/profile/aircraft_experience'); ?>
				<?php $this->load->view('templates/profile/licenses'); ?>
				<?php $this->load->view('templates/profile/aircraft_ratings'); ?>
				<?php $this->load->view('templates/profile/validations'); ?>
				<?php $this->load->view('templates/profile/trainings'); ?>
				<?php $this->load->view('templates/profile/area_experiences'); ?>
				<?php $this->load->view('templates/profile/medical'); ?>
				<?php $this->load->view('templates/profile/passport'); ?>
				<?php $this->load->view('templates/profile/visa'); ?>
				<?php $this->load->view('templates/profile/previous_employment'); ?>
				<?php $this->load->view('templates/profile/references'); ?>
				<?php $this->load->view('templates/profile/pilot_qualifications'); ?>
				<?php $this->load->view('templates/profile/maintenance_licenses'); ?>
				<?php $this->load->view('templates/profile/management_experience'); ?>
				<?php $this->load->view('templates/profile/desired_employment'); ?>

                <div class="row">                    
					<div class="col-md-12 col-lg-12">
						<div class="well-white">
                            <h4>Other Details</h4>
							<div class="row">
								<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label id="print3">Resume: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php if (is_file(FCPATH . 'uploads/users/resumes' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_resume'])) { ?>
													<a href="<?php echo base_url() . 'uploads/users/resumes' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_resume']; ?>" target="_blank" title="Resume File"><i class="fa <?php
														$file_extension = pathinfo($user_details_array['user_resume'], PATHINFO_EXTENSION);
														switch ($file_extension) {
															case 'pdf':
																echo 'fa-file-pdf-o';
																break;
															case 'doc':
															case 'docx':
																echo 'fa-file-word-o';
																break;
															default :
																echo 'fa-file-word-o';
														}
														?> fa-3x"></i></a><br/><span><?php echo $user_details_array['user_resume_original_file']; ?></span>																			  <?php
																																																																  } else {
																																																																	  echo '<span>No Resume Added.';
																																																																  }
																																																																  ?></div>	</div>
										<hr/>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>ADDITIONAL INFORMATION: </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_details_array['user_description']; ?>
												</div>
											</div>
										</div>
										<hr/>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>How Did You Hear About Us?:</label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_details_array['user_find_us']; ?>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<form id="add_user_to_list_form">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Rate This User</h4>
						</div>
						<div class="modal-body" id="rating_star">
							<div class="form-group">
								<h4>Rating </h4>
								<input type="hidden" name="user_rate" id="user_rate" value="0">
								<fieldset id="rating1" class="rating rating1">
									<input class="stars" type="radio" id="star_5" name="rating1" value="5" onclick="set_rate('5')">
									<label class="full" for="star_5" title="Awesome - 5 stars"></label>
									<input class="stars" type="radio" id="star_4half" name="rating1" value="4.5" onclick="set_rate('4.5')">
									<label class="half" for="star_4half" title="Pretty good - 4.5 stars"></label>
									<input class="stars" type="radio" id="star_4" name="rating1" value="4" onclick="set_rate('4')">
									<label class="full" for="star_4" title="Pretty good - 4 stars"></label>
									<input class="stars" type="radio" id="star_3half" name="rating1" value="3.5" onclick="set_rate('3.5')">
									<label class="half" for="star_3half" title="Meh - 3.5 stars"></label>
									<input class="stars" type="radio" id="star_3" name="rating1" value="3" onclick="set_rate('3')">
									<label class="full" for="star_3" title="Meh - 3 stars"></label>
									<input class="stars" type="radio" id="star_2half" name="rating1" value="2.5" onclick="set_rate('2.5')">
									<label class="half" for="star_2half" title="Kinda bad - 2.5 stars"></label>
									<input class="stars" type="radio" id="star_2" name="rating1" value="2" onclick="set_rate('2')">
									<label class="full" for="star_2" title="Kinda bad - 2 stars"></label>
									<input class="stars" type="radio" id="star_1half" name="rating1" value="1.5" onclick="set_rate('1.5')">
									<label class="half" for="star_1half" title="Meh - 1.5 stars"></label>
									<input class="stars" type="radio" id="star_1" name="rating1" value="1" onclick="set_rate('1')">
									<label class="full" for="star_1" title="Sucks big time - 1 star"></label>
									<input class="stars" type="radio" id="star_half" name="rating1" value="0.5" onclick="set_rate('0.5')">
									<label class="half" for="star_half" title="Sucks big time - 0.5 stars"></label>
								</fieldset>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary star_btn" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary star_btn" onclick="rate_user(<?php echo $user_details_array['user_id']; ?>)">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('templates/dashboard/upload_pic'); ?>
<script src="<?php echo base_url(); ?>assets/js/plugins/printarea/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
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
								function printit()
								{
									$('#ratingdiv').hide();
									$('a').hide();
									$('#print3').hide();
									$('.print1').addClass('col-sm-6');
									$('.print2').addClass('center-block');
									$('#printarea').printArea();
									$('#ratingdiv').show();
									$('a').show();
									$('#print3').show();
									$('.print1').removeClass('col-sm-6');
									$('.print2').removeClass('center-block');
								}
								function set_rate(user_rate) {
									$("#user_rate").val(user_rate);
								}
								function rate_user(user_id) {
									$.post(base_url + 'user/rate_user', {user_id: user_id, user_rating: $("#user_rate").val()}, function (data) {
										if (data === '1') {
											if (data === '1') {
												bootbox.alert('Rating Updated Successfully.', function () {
													document.location.href = '';
												});
											} else if (data === '0') {
												bootbox.alert('Error Updating Ratings');
											} else {
												bootbox.alert(data);
											}
										}
									});
								}
</script>