
<style>
    .dashboard{
        background-color: rgba(0, 0, 0, 0.6);
        background: rgba(0, 0, 0, 0.6);
        color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 20px
    }
    .dashboard img{
        margin-bottom: 10px;
    }
    .btn-primary {
        width:171px;
    }
    .dashboard-divider {
        border-left: 4px solid #2c2c2c;
        padding: 0 0 0 36px;
    }
    .btn-warning {
        width: 159px;
    }
	.dashboard-title h3{
		margin-top: 0px!important;
	}
    .dashboard-heading h3{
        color:#009fff;
    }
    .well .row
    {
        margin-bottom: 15px;
    }
</style>
<div class = "bread">
    <div class = "container">
        <div class = "row">
            <div class = "col-lg-12">
                <ol class = "breadcrumb">
                    <li><a href = "<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                    <li class = "active">Profile</li>
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
								if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_thumb'])) {
									echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_thumb'];
								} else {
									echo base_url() . 'assets/img/profile.png';
								}
								?>" alt="profile" class="img-responsive"/>
                                <!--<div class="overlay">
                                        <a href="javascript:;" class="info" data-toggle="modal" data-target="#upload_modal">Change Image <i class="fa fa-plane"></i></a>
                                </div>-->
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
										</div>
									</div>
								</div>
							<?php } ?>
                        </div>
                        <div class="col-md-3 col-lg-4 col-sm-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-title dashboard-heading">
                                        <h3><?php echo $user_details_array['user_first_name'] . ' ' . $user_details_array['user_last_name']; ?></h3>
                                    </div>
                                    <div class="dashboard-title">
                                        <p><strong><?php echo $user_details_array['employer_type']; ?></strong></p>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="col-md-4 col-lg-4 col-sm-6 dashboard-divider">
                            <div class="dashboard-title">
                                <h3>Status</h3>
                            </div>
							<?php $this->load->view('templates/dashboard/qualification_employer.php'); ?>
							<?php if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'employer') {
								?>
								<div class = "spacer9"></div>
								<div class="row">
									<div class="col-md-12 col-lg-12 col-sm-12">
										<a class="btn btn-primary btn-md" href="<?php echo base_url(); ?>user/employer_edit_profile">Edit Profile <i class="fa fa-plane"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
    <div class="container">
        <div class="row">            
			<div class="col-md-12  col-lg-12">
				<div class="well-white">
                    <h4>Company Details</h4>
                    <div class="row">
                        <div class="col-md-offset-2 col-sm-offset-1 col-xs-offset-2">
                            <div class="col-md-6 col-sm-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Company Trading Name :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_business_name']; ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Company Legal/Registered Name :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_business_legal_name']; ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Company Number :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_business_number']; ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Registered Country :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_registered_country_name']; ?>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6"></div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">            
			<div class="col-md-12 col-lg-12">
				<div class="well-white">
                    <h4>Company Information</h4>
					<div class="row">
						<div class="col-md-offset-2 col-sm-offset-1 col-xs-offset-2">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Address :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_address'] . ' ' . $user_details_array['user_city'] . ' ' . $user_details_array['user_state'] . ' - ' . $user_details_array['user_zipcode'] . '<br/>' . $user_details_array['country_name']; ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Website :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_website_address']; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6"></div>
						</div>
					</div>
                </div>
            </div>
        </div>
		<?php $this->load->view('templates/employer_profile/contact_person'); ?>
		<?php $this->load->view('templates/employer_profile/operation_info'); ?>
        <div class="row">            
			<div class="col-md-12  col-lg-12">
				<div class="well-white">
                    <h4>Fleet Details</h4>
                    <div class="row">
                        <div class="col-md-offset-2 col-sm-offset-1 col-xs-offset-2">
                            <div class="col-md-6 col-sm-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>
												Number of Aircrafts :
											</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_number_of_aircrafts']; ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>Type of Aircraft:</label>
										</div>
										<div class="col-md-6 col-sm-6">
											<?php
											if (count($user_aircraft_array) > 0) {
												$aircraft_array = array();
												foreach ($user_aircraft_array as $user_aircrafts) {
													$aircraft_array[] = $user_aircrafts['my_aircraft_name'];
												}
												echo implode(' , ', $aircraft_array);
											} else {
												echo "No Aircrafts.";
											}
											?>
										</div>
									</div>
								</div>
                            </div>
                            <div class="col-md-6 col-sm-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">           
			<div class="col-md-12 col-lg-12">
				<div class="well-white">
                    <h4>Company Certificate of Registration</h4>
                    <div class="row">
                        <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
										<?php
										if ($user_details_array['user_business_certificate'] !== '' && is_file(FCPATH . 'uploads/users/company_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_business_certificate'])) {
											$ext = pathinfo($user_details_array['user_business_certificate'], PATHINFO_EXTENSION);
											$file_icon = '';
											switch ($ext) {
												case 'doc':
												case 'docx':
													$file_icon = 'fa-file-word-o';
													break;
												case 'pdf':
													$file_icon = 'fa-file-pdf-o';
													break;
												default :
													$file_icon = 'fa-file-doc-o';
											}
											?>
											<a href="<?php echo base_url() . 'uploads/users/company_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_business_certificate']; ?>" title="click to view or download" target="_blank"> <i class="fa <?php echo $file_icon; ?> fa-3x"></i> </a><br>
											<?php echo $user_details_array['user_business_certificate_original_name']; ?>
											<?php
										} else {
											echo 'No Certificate Available.';
										}
										?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">             
			<div class="col-md-12  col-lg-12">
				<div class="well-white">
                    <h4>Company Description</h4>
                    <div class="row">
                        <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<?php echo $user_details_array['user_business_description']; ?>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6"></div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">            
			<div class="col-md-12  col-lg-12">
				<div class="well-white">
                    <h4>How Did You Hear About Us?</h4>
                    <div class="row">
                        <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
										<?php echo $user_details_array['user_find_us']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>