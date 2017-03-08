<style type="text/css">
    #job_alert_form .select2-container {
        padding:0;
        border:none;
    }
    #job_alert_form .select2-choice,#job_alert_form .select2-default {
        min-height:34px !important;
        padding-top:3px;
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
    h4{
        font-size: 24px !important;
    }
    td{
        vertical-align: middle !important;
    }
    .has-error .select2-choice.select2-default {
        border: 1px solid red !important;
        border-radius:5px;
    }
    .saved_job_delete_button{
        margin-left: 25px;
    }
    .table-responsive{
        border:none !important;
    }
    .alert-button-right{
        margin:3px 0px 15px;
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
    .bg-primary {
        padding: 15px;
    }
    .bg-primary a{
        font-size: 14px;
        color:#ddd;
    }
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
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
    .button_job_view{
        padding : 2px 17px;
        margin-top:-8px;
    }
    .job_alert_modal{
        background-color:#273f87;
        color:white;
    }
	.job-alert-button-size{
		width:171px;
		margin-right: 2px;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Job Alerts</li>
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
							<div class="//piceffect">
								<img src="<?php
								if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'])) {
									echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'];
								} else {
									echo base_url() . 'assets/img/profile.png';
								}
								?>" alt="profile" class="img-responsive"/>
								<!--								<div class="//overlay">
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
						<div class="col-md-3 col-sm-3 col-lg-4 ">
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
<div class="bg-in-pages padbot-20">
    <div class="container">
        <div class="well-white">
            <div class="table-responsive">
                <table id="job_alerts_datatable" class="table table-bordered table-hover">
                    <div class="row">
                        <div class="col-md-8 col-sm-5">
                            <h4 class="job-alert">Jobs Alerts</h4>
                        </div>
                        <div class="col-md-4 col-sm-7 alert-button-right">
                            <a class="btn btn-warning alert-button-right job-alert-button-size pull-lg-right" href="<?php echo base_url() . 'careers-open/' . $_SESSION['user']['job_type_slug']; ?>">Jobs Board <i class="fa fa-plane"></i></a>
                            <a class="btn btn-success alert-button-right job-alert-button-size pull-lg-right" href="javascript:;" data-toggle="modal" data-target="#job_alert_modal">Create Job Alert <i class="fa fa-plane"></i></a>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th>Job Alert Id</th>
                            <th class="smallwidth">Keywords</th>
                            <th class="smallwidth">Company</th>
                            <th class="smallwidth">Position</th>
                            <th class="smallwidth">Location</th>
                            <th class="smallwidth">Type</th>
                            <th class="smallwidth">Email Job Alerts</th>
                            <th class="largewidth">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="job_alert_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="job_alert_form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Job Alerts</h4>
                    Creating a job alert allows you to obtain emails on jobs posted by employers that you are tailored to your interests. Create and edit job alerts by completing the below.
                </div>
                <div class="modal-body job_alert_modal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keywords">Keyword(s) <span class="required">*</span></label>
                                <input type="text" class="form-control" id="keywords" placeholder="keywords" name="keywords" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="position">Position <span class="required">*</span></label>
                                <select class="form-control" id="position" name="position" data-placeholder="Select Position">
                                    <option></option>
									<?php
									foreach ($job_type_array as $job_type) {
										?><option value="<?php echo $job_type['job_type_id']; ?>" > <?php echo $job_type['job_type_name']; ?></option><?php
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" data-placeholder="Select Role">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select class="form-control" id="location" name="location" data-placeholder="Select location">
                                    <option></option>
									<?php
									foreach ($job_locations as $job_countries) {
										?>
										<option value="<?php echo $job_countries['country_id']; ?>">
											<?php echo $job_countries['country_name']; ?></option>
									<?php }
									?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="company">Company(s) <span class="required">*</span></label>
                                <select class="form-control" id="company" name="company" data-placeholder="Select Company">
                                    <option></option>
                                    <option value="1"> All</option>
                                    <option value="2"> other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="employmenttpye">Employment Type</label>
                                <select class="form-control" id="employment_type" name="employment_type" data-placeholder="Select Employment Type">
                                    <option></option>
                                    <option value="1">Full time</option>
                                    <option value="2">contract</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group" id="other_company">

                            </div>
                        </div>
                    </div>
                    <div class="spacer9"></div>
                    <div class="spacer9"></div>
                    <div class="spacer9"></div>
                    <div class="row">
						<div class="col-md-12">
							<div class="text-center">
								<button type="submit"  class="btn btn-warning" id="job_alert_button" data-loading-text="Please wait..." >Save Job Alert <i class="fa fa-plane"></i></button>
							</div>
						</div>
                    </div>
                    <div class="spacer9"></div>
                    <div class="spacer9"></div>
                    <div class="spacer9"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('templates/dashboard/upload_pic'); ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
										$(function () {
											$('#position ,#role ,#location ,#company ,#employment_type').select2({allowClear: true});
											$('#position').change(function () {
												$('#role').select2('val', '');
												$('#role').empty();
												var position_id = $(this).val();
												$.post(base_url + 'job/get_role_by_position', {position: position_id}, function (data) {
													for (var i = 0; i < data.length; i++) {
														//data[i].position_id
														$("#role").append('<option value="' + data[i].position_id + '">' + data[i].position_name + '</option>');
													}
												});
											});
											$('select').change(function () {
												$("#job_alert_form").validate().element($(this));
											});
											$('#company').change(function () {
												var company_name = $(this).val();
												$('#other_company').html('');
												if (company_name == '2') {
													$('#other_company').append('<label for="employmenttpye">Other company</label><input type="text" name="company_name" id="company_name" class="form-control" />');
												}
											});
											$("#job_alert_form").validate({
												errorElement: 'span',
												errorClass: 'help-block pull-right',
												focusInvalid: true, ignore: null,
												rules: {
													keywords: {
														required: true
													},
													position: {
														required: true
													},
													company: {
														required: true
													},
													company_name: {
														required: {
															depends: function (element) {
																return $("#company").val() == '2';
															}
														}
													}
												},
												messages: {
													keywords: {
														required: "Please enter keyword"

													},
													position: {
														required: "Please select position"
													},
													company: {
														required: "Please select company name"
													},
													company_name: {
														required: "Please enter company name"
													}
												},
												highlight: function (element) {
													$(element).closest('.form-group').addClass('has-error');
												},
												unhighlight: function (element) {
													$(element).closest('.form-group').removeClass('has-error');
												},
												success: function (element) {
													$(element).closest('.form-group').removeClass('has-error');
													$(element).closest('.form-group').children('span.help-block').remove();
												},
												errorPlacement: function (error, element) {
													error.appendTo(element.closest('.form-group '));
												},
												submitHandler: function (form) {
													$("#job_alert_button").button("loading");
													$.post(base_url + 'job/setup_job_alert', $("#job_alert_form").serialize(), function (data) {
														if (data === '1') {
															bootbox.alert('Job notifications will be sent to you as new job is posted.', function (data) {
																document.location.href = '';
															});
														} else if (data === '0') {
															bootbox.alert("Error submitting records");
														} else {
															bootbox.alert(data);
														}
														//	$("#user_signup_button").button("reset");
													});
												}
											});
											$('#job_alerts_datatable').dataTable({
												"aaSorting": [['0', 'asc']],
												"sAjaxSource": base_url + "job/job_alerts_datatable",
												"oLanguage": {
													"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Data.</span>'
												},
												"oTableTools": {
													"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
													"aButtons": [{
															"sExtends": "pdf",
															"sButtonText": "<i class='fa fa-save'></i> PDF",
															"sPdfOrientation": "landscape",
															"sPdfSize": "tabloid",
															"mColumns": [1, 2, 3, 4, 5, 6]
														}, {
															"sExtends": "csv",
															"sButtonText": "<i class='fa fa-save'></i> CSV",
															"mColumns": [1, 2, 3, 4, 5, 6]
														}]
												},
												"aoColumnDefs": [
													{
														"aTargets": [0],
														"bVisible": false,
														"bSearchable": false
													},
													{
														"aTargets": [4],
														"mRender": function (data, type, full) {
															if (data == '1') {
																return 'all';
															}
															return 'other';
														}
													},
													{
														"aTargets": [5],
														"mRender": function (data, type, full) {
															if (data == '1') {
																return 'Full Time';
															}
															return 'Contract';
														}
													},
													{
														"aTargets": [6],
														"mRender": function (data, type, full) {
															switch (data) {
																case '1':
																	return '<div class="text-center"><input onchange="job_alert_email_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
																	break;
																default:
																	return '<div class="text-center"><input onchange="job_alert_email_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
																	break;
															}
														}
													},
													{
														"aTargets": [7],
														"bSearchable": false,
														"bSortable": false,
														"mData": null,
														"mRender": function (data, type, full) {
															return '<div class=""><a href="' + base_url + 'job/edit_job_alert/' + full[0] + '" class="btn btn-success button_job_view">Edit <i class="fa fa-plane"></i></a> <span class="action-buttons"><a href="javascript:;" class="saved_job_delete_button text-danger" onclick="confirm_delete(' + full[0] + ');"><i class="fa fa-trash fa-2x"></i></a></span></div>'
														}
													}
												],
												"fnDrawCallback": function (oSettings) {
													$("#job_alerts_datatable tr th.largewidth").css({'min-width': '200px'});
													$("#job_alerts_datatable tr th.smallwidth").css({'min-width': '85px', 'max-width': '90px'});
													$("#job_alerts_datatable tr th.medwidth").css({'min-width': '130px', 'max-width': '130px'});
												},
											}).fnSetFilteringDelay(700);

										});
										function job_alert_email_status(job_alert_id) {
											$.post(base_url + 'job/change_job_alert_email_status', {job_alert_id: job_alert_id, job_alert_email_status: $("#id_" + job_alert_id).is(':checked')}, function (data) {
												if (data === '1') {
													bootbox.alert('Status Changed Successfully.', function () {
														document.location.href = '';
													});
												} else if (data === '0') {
													bootbox.alert('Error changing status');
												} else {
													bootbox.alert(data);
												}
											});
										}
										function confirm_delete(job_alert_id) {
											bootbox.confirm('Are you sure to delete job alert?', function (result) {
												if (result) {
													$.post(base_url + 'job/delete_job_alert', {job_alert_id: job_alert_id}, function (data) {
														if (data === '1') {
															bootbox.alert('Job alert deleted successfully.', function () {
																document.location.href = '';
															});
														} else if (data === '0') {
															bootbox.alert('Error deleting job alert');
														} else {
															bootbox.alert(data);
														}
													});
												}
											});
										}
</script>