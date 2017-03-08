<style>
    .dashboard{
        background-color: rgba(0, 0, 0, 0.6);
        background: rgba(0, 0, 0, 0.6);
        color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 20px
    }
	.saved_job_delete_button{
		margin-left: 25px;
	}
	.dashboard-divider {
		border-left: 1px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
	.dashboard-divider {
		border-left: 4px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
	.dashboard-title h3{
		margin-top: 0px!important;
    }
	.dashboard-heading h3{
		color:#009fff;
	}
	td{
		vertical-align: middle !important;
	}
	.btn-success{
		width:118px;
	}
    .dashboard img{
        margin-bottom: 10px;
    }
    .bg-primary {
        padding: 15px;
    }
	.bg-grey{
		background: #F7F7F9;
		padding: 10px 0 0;
		overflow: hidden;
		margin: 0 15px;
	}
	.action-buttons a:hover {
		opacity: 1;
		text-decoration: none;
		transform: scale(1.2);
	}
	.action-buttons a {
		display: inline-block;
		margin: 0 3px;
		transition: all 0.1s ease 0s;
		font-size: 10px;
		margin: 7px 0;
		cursor: pointer;
	}
	.red {
		color: #dd5a43 !important;
	}
	.bg-white{
		background: #fff;
		padding: 10px 0 0;
		overflow: hidden;
		margin: 0 15px;
	}
	.buttom_primary{
		width:158px !important;
	}
	.view-profile p{
		font-size:15px !important;
		margin-top:-11px;
	}
    .bg-primary {
        padding: 15px;
    }
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .table-responsive > .table > thead > tr > th,
    .table-responsive > .table > tbody > tr > th,
    .table-responsive > .table > tfoot > tr > th,
    .table-responsive > .table > thead > tr > td,
    .table-responsive > .table > tbody > tr > td,
    .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
    .table-responsive > .table-bordered {
        border: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:first-child,
    .table-responsive > .table-bordered > tbody > tr > th:first-child,
    .table-responsive > .table-bordered > tfoot > tr > th:first-child,
    .table-responsive > .table-bordered > thead > tr > td:first-child,
    .table-responsive > .table-bordered > tbody > tr > td:first-child,
    .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:last-child,
    .table-responsive > .table-bordered > tbody > tr > th:last-child,
    .table-responsive > .table-bordered > tfoot > tr > th:last-child,
    .table-responsive > .table-bordered > thead > tr > td:last-child,
    .table-responsive > .table-bordered > tbody > tr > td:last-child,
    .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
    }
    .table-responsive > .table-bordered > tbody > tr:last-child > th,
    .table-responsive > .table-bordered > tfoot > tr:last-child > th,
    .table-responsive > .table-bordered > tbody > tr:last-child > td,
    .table-responsive > .table-bordered > tfoot > tr:last-child > td {
        border-bottom: 0;
    }
    .cursor_pointer{
        cursor : pointer;
    }
	.dataTables_wrapper .row{
		margin-left:1px;
		margin-top:4px;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Jobs Applied For</li>
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
								<!--								<div class="overlay">
																	<a href="javascript:;" class="info" data-toggle="modal" data-target="#upload_modal">Change Image <i class="fa fa-plane"></i></a>
																</div>-->
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
						<div class="col-md-3 col-sm-3 col-lg-4 col-sm-6">
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
						<div class="col-md-5 col-lg-5 col-sm-6 dashboard-divider">
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
		<div class="well-white">
			<div class="table-responsive">
				<table class="table">
					<div class="row">
						<div class="col-md-6">
							<h4><strong>Jobs Applied</strong></h4>
						</div>
						<div class="col-md-6">
							<a class="btn btn-warning pull-right" href="<?php echo base_url() . 'careers-open/' . $_SESSION['user']['job_type_slug']; ?>">Jobs Board <i class="fa fa-plane"></i></a>
						</div>
					</div>
					<thead>
						<tr>
							<th>Job</th>
							<th>Position</th>
							<th>Location</th>
							<th>Type</th>
							<th>Date Applied</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php if (count($applied_job_array) > 0) { ?>
						<tbody>
							<?php foreach ($applied_job_array as $job) { ?>
								<tr>
									<td><a href="<?php echo base_url() . 'job/view/' . $job['job_slug'] . '/' . $job['job_id']; ?>" target="_blank"><h4><?php echo $job['job_title']; ?></h4></a>
										<?php echo $job['job_company_name']; ?></td>
									<td><?php echo $job['job_type_name']; ?></td>
									<td><?php echo $job['country_name']; ?></td>
									<td><?php echo $job['job_employee_type'] === '1' ? 'Full Time' : 'Contract Basis'; ?></td>
									<td><?php echo date('d M Y', strtotime($job['job_application_created'])); ?></td>
									<td>
										<div class="action-buttons">
											<a title="Delete" class="red" onclick="delete_job_application(<?php echo $job['job_application_id']; ?>)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					<?php } else { ?>
						<tfoot>
							<tr><td>
									<span class="text-info" style="font-size: 18px">No Data.</span>
								</td></tr>
						</tfoot>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<div class="well-white">
			<div class="table-responsive">
				<table class="table">
					<div class="row">
						<div class="col-md-6">
							<h4><strong>Saved Jobs</strong></h4>
						</div>
						<div class="col-md-6">
							<a class="btn btn-warning pull-right" href="<?php echo base_url() . 'careers-open/' . $_SESSION['user']['job_type_slug']; ?>">Jobs Board <i class="fa fa-plane"></i></a>
						</div>
					</div>
					<thead>
						<tr>
							<th>Job</th>
							<th>Position</th>
							<th>Location</th>
							<th>Type</th>
							<th>Last Date To Apply</th>
							<th>Actions</th>
							<!--<th>Delete</th>-->
						</tr>
					</thead>
					<?php if (count($saved_job_array) > 0) { ?>
						<tbody>
							<?php foreach ($saved_job_array as $saved_job) { ?>
								<tr>
									<td><a href="<?php echo base_url() . 'job/view/' . $saved_job['job_slug'] . '/' . $saved_job['job_id']; ?>" target="_blank"><h4><?php echo $saved_job['job_title']; ?></h4></a>
										<?php echo $saved_job['job_company_name']; ?></td>
									<td><?php echo $saved_job['job_type_name']; ?></td>
									<td><?php echo $saved_job['country_name']; ?></td>
									<td><?php echo $saved_job['job_employee_type'] === '1' ? 'Full Time' : 'Contract Basis'; ?></td>
									<td><?php echo date('d M Y', strtotime($saved_job['job_expire_date'])); ?></td>
									<td>
										<!--									</td>
																			<td>-->
										<div class="action-buttons">
											<?php
											if ($saved_job['job_expire_date'] >= date('Y-m-d')) {
												if ($saved_job['job_applied'] === '0') {
													?>
													<button class="btn btn-success btn-md" onclick="apply_job(<?php echo $saved_job['job_id']; ?>)">Apply <i class="fa fa-plane"></i></button><?php } else { ?>
													<button class="btn btn-success btn-md" disabled="disabled">Applied <i class="fa fa-plane"></i></button>
													<?php
												}
											}
											?>
											<a title="Delete" class="red" onclick="delete_saved_job(<?php echo $saved_job['saved_job_id']; ?>)"><i class="fa fa-trash fa-2x saved_job_delete_button" aria-hidden="true"></i></a>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					<?php } else { ?>
						<tfoot>
							<tr><td>
									<span class="text-info" style="font-size: 18px">No Data.</span>
								</td></tr>
						</tfoot>
					<?php } ?>
				</table>
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
				<a class="btn btn-primary" href="javascript:;" onclick="send_verify_link();">Resend Verify Email</a>
				<a class="btn btn-primary" href="<?php echo base_url(); ?>login">Ok</a>
			</div>
		</div>

	</div>
</div>
<?php $this->load->view('templates/dashboard/upload_pic'); ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script>
					function delete_job_application(job_application_id) {
						bootbox.confirm("Are your sure to delete the job applied", function (result) {
							if (result) {
								$(window).block({message: 'Please Wait...'});
								$.post('', {job_application_id: job_application_id}, function (data) {
									if (data === '1') {
										bootbox.alert('Deleted Successfully', function () {
											document.location.href = '';
										});
									} else if (data === 0) {
										bootbox.alert('Error');
									} else {
										bootbox.alert(data);
									}
									$(window).unblock();
								});
							}
						});
					}
					function delete_saved_job(saved_job_id) {
						bootbox.confirm("Are your sure to delete the saved job?", function (result) {
							if (result) {
								$(window).block({message: 'Please Wait...'});
								$.post(base_url + 'job/delete_saved_job', {saved_job_id: saved_job_id}, function (data) {
									if (data === '1') {
										bootbox.alert('Deleted Successfully', function () {
											document.location.href = '';
										});
									} else if (data === 0) {
										bootbox.alert('Error');
									} else {
										bootbox.alert(data);
									}
									$(window).unblock();
								});
							}
						});
					}
					function apply_job(job_id) {
						$(window).block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
						$.post(base_url + 'job/apply', {job_id: job_id}, function (data) {
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
</script>