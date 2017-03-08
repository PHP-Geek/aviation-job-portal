<style>
	.sale-interest-text{
		font-size:20px;
	}
	.back-model {
		background-color:#00a65a;
		color:#FFFFFF;
	}
	.col_inactive{
		background-color: #f5f5f5 !important;
	}
	.col_active{
		background-color: #eaeaea !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Users : Pilots <small>listing of all pilots</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li>Users</li>
            <li class="active">Pilots</li>
        </ol>
    </section>
    <section class="content">
		<form id="action_form" method="post" target="_blank" action="<?php echo base_url(); ?>user/print_users">
			<div class="box">
				<div class="well">
					<div class="row">
						<div class="col-md-5">
							<i class="fa fa-check-square"></i> <span class="text-info">With Selected </span>
							<button role="button" type="button" class="btn btn-primary" id="send_email" name="send_emails" onclick="load_model_send_email();"><i class="fa fa-paper-plane"></i> Send Email</button>
							<button role="button" type="button" class="btn btn-danger" id="delete_user" name="delete_user" onclick="delete_users();"><i class="fa fa-trash"></i> Delete</button>
							<button type="submit" class="btn btn-primary" id="print_user" name="print_users"><i class="fa fa-print"></i> Print</button>
						</div>
						<div class="col-md-7">
							<h4>Current Active Users : <span class="text-info"><?php echo $active_user_count; ?></span></h4>
						</div>
					</div>
				</div>
				<hr/>
				<div class="box-body table-responsive">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Location</th>
								<th>Total Hours</th>
								<th>Total Instructors</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Current Position</th>
								<th>Passports</th>
								<th>Licenses</th>
								<th>Trainings</th>
								<th>Validations</th>
								<th>Visas</th>
								<th>Total Pic</th>
								<th>Total Sic</th>
								<th>Total Jet</th>
								<th>Total Turboprop</th>
								<th>Total Night</th>
								<th>Total Instructor</th>
								<th>Medicals</th>
								<th>Joining Date</th>
								<th>Lists</th>
								<th>Last Logged In</th>
								<th>Profile Completeness(%)</th>
								<th>Status</th>
								<th>Rate User</th>
								<th>View Profile</th>
								<th>Edit Profile</th>
								<th>View Applied Jobs</th>
								<th>Login History</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users_array as $user) { ?>
								<tr>
									<td><input type="checkbox" id="selected_boxes" name="select_boxes[]" value="<?php echo $user['user_id']; ?>"/></td>
									<td><?php echo $user['user_first_name'] . ' ' . $user['user_last_name']; ?></td>
									<td><?php echo $user['user_country_name']; ?></td>
									<td><?php echo $user['user_total_hours']; ?></td>
									<td><?php echo $user['user_total_instructor']; ?></td>
									<td><?php echo $user['user_email']; ?></td>
									<td><?php echo $user['user_country_code'] . $user['user_primary_contact']; ?></td>
									<td><?php echo $user['user_current_position_names']; ?></td>
									<td><?php echo $user['user_passport_countries']; ?></td>
									<td><?php echo $user['user_license_type']; ?></td>
									<td><?php echo $user['user_training_name']; ?></td>
									<td><?php echo $user['user_validation_countries']; ?></td>
									<td><?php echo $user['user_visa_countries']; ?></td>
									<td><?php echo $user['user_total_pic']; ?></td>
									<td><?php echo $user['user_total_sic']; ?></td>
									<td><?php echo $user['user_total_jet']; ?></td>
									<td><?php echo $user['user_total_turboprop']; ?></td>
									<td><?php echo $user['user_total_night']; ?></td>
									<td><?php echo $user['user_total_instructor']; ?></td>
									<td><?php echo $user['user_medical_certificate_examinations']; ?></td>
									<td><?php echo date('d M Y h:i A', strtotime($user['user_created'])); ?></td>
									<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="show_modal('<?php echo $user['user_id']; ?>')">Add To List</button></td>
									<td><?php echo date('d F Y h:i A', strtotime($user['user_last_logged_in'])); ?></td>
									<td><?php echo $user['user_profile_completeness']; ?> %</td>
									<td><?php
										switch ($user['user_status']) {
											case '1':
												echo '<div class="text-center"><input onchange="user_status(' . $user['user_id'] . ')" id="id_' . $user['user_id'] . '" type="checkbox" checked="checked" /> </div>';
												break;
											default:
												echo '<div class="text-center"><input onchange="user_status(' . $user['user_id'] . ')" id="id_' . $user['user_id'] . '" type="checkbox" /> </div>';
												break;
										}
										?></td>
									<td><?php echo $user['user_rating']; ?> / 5</td>
									<td><a href="<?php echo base_url() . 'user/profile/' . $user['user_first_name'] . '-' . $user['user_last_name'] . '/' . $user['user_id']; ?>" target="_blank"><i class="fa fa-user"></i> View</a></td>
									<td><a href="<?php echo base_url() . 'edit-profile/' . $user['user_id']; ?>" target="_blank"><i class="fa fa-pencil-square-o"></i> Edit</a></td>
									<td><a href="<?php echo base_url() . 'job/applied_jobs/' . $user['user_id']; ?>" target="_blank">View</a></td>
									<td><a href="<?php echo base_url() . 'user/log_in_history/' . $user['user_id']; ?>" target="_blank">View</a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
    </section>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form id="add_user_to_list_form">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add To List</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Select List</label>
						<input type="hidden" name="users_id" id="users_id"/>
						<select name="lists_id" id="lists_id" class="form-control">
							<?php foreach ($list_array as $list) { ?>
								<option value="<?php echo $list['list_id']; ?>"><?php echo $list['list_name']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="add_user_list_button" class="btn btn-primary" onclick="add_user_to_list()">Add To List</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Modal for send email -->
<div id="myModal1" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<form id="send_mail_form" method="post">
				<div class="modal-header back-model">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Send Email</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="list_id" id="list_id" value=""/>
						<label>Subject</label>
						<input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Subject"/>
					</div>
					<div class="form-group">
						<label>Message/Text</label>
						<textarea id="email_message" name="email_message" class="form-control" rows="4" placeholder="Message"></textarea>

					</div>
				</div>
				<div id="selected_users"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="view_list_email_button" data-loading-text="Please Wait..." onclick="send_email();">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/t/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
						$(document).ready(function () {
							$('#example thead th').each(function () {
								if ($(this).index() > 0) {
									var title = $('#example thead th').eq($(this).index()).text();
									$(this).html(title + '<br><input type="text" class="form-control input-sm" placeholder="Search ' + title + '" />');
								}
							});
							var table = $('#example').DataTable({
								"order": [[0, "asc"]],
								"stateSave": true,
								"lengthMenu": [[10, 20, 50, 100, 200, 500, -1], [10, 20, 50, 100, 200, 500, "All"]],
								"pagingType": "full_numbers",
								"dom": "<'row'<'col-md-4 col-sm-12'l><'col-md-4 col-sm-12 text-center'B><'col-md-4 col-sm-12'f>r>t<'row'<'col-md-4 col-sm-12'i><'col-md-8 col-sm-12'p>>",
								"scrollX": true,
								"deferRender": true,
								"buttons": ['excel', 'pdf']
							});
							table.columns().eq(0).each(function (colIdx) {
								$('input', table.column(colIdx).header()).on('keyup change', function () {
									table
											.column(colIdx)
											.search(this.value)
											.draw();
								});
								$('input', table.column(colIdx).header()).on('click', function (e) {
									e.stopPropagation();
								});
							});
						});</script>
<script type="text/javascript">
	$("#action_form").submit(function (e) {
		if ($('input[name="select_boxes[]"]:checked').length) {
			return true;
		}
		bootbox.alert("Please select at least one user.");
		return false;
	});
	function user_status(user_id) {
		$.post(base_url + "user/change_status", {user_id: user_id, user_status: $("#id_" + user_id).is(":checked")}, function (data) {
			if (data === '1') {
				bootbox.alert("User Status Changed Successfully");
			} else if (data === '0') {
				bootbox.alert("Error Updating User Status !!!");
			} else {
				bootbox.alert(data);
			}
		});
	}
	function confirm_delete(users_id) {
		bootbox.confirm("Are you sure you want to proceed ?", function (result) {
			if (result) {
				$.post(base_url + 'user/delete', {users_id: users_id}, function (data) {
					if (data === '1') {
						document.location.href = '';
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}
	function show_modal(user_id) {
		$("#users_id").val(user_id);
	}

	function add_user_to_list() {
		$("#add_user_list_button").button("loading");
		$.post(base_url + 'user/add_user_to_list', $("#add_user_to_list_form").serialize(), function (data) {
			if (data === '2') {
				bootbox.alert("User is already in this list.", function () {
				});
			} else if (data === '1') {
				bootbox.alert("User added to List successfully.", function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert("Error!")
			} else {
				bootbox.alert(data);
			}
			$("#add_user_list_button").button("reset");
		});
	}
	function delete_users() {
		if ($('input[name="select_boxes[]"]:checked').length) {
			bootbox.confirm("Are you sure you want to proceed ?", function (result) {
				if (result) {
					$.post(base_url + 'user/delete_user', $("#action_form").serialize(), function (data) {
						if (data === '1') {
							bootbox.alert("User has been deleted successfully.", function () {
								document.location.href = '';
							});
						} else if (data === '0') {
							bootbox.alert("Error in deleteing.");
						} else {
							bootbox.alert(data);
						}
					});
				}
			});
		} else {
			bootbox.alert("Please select any user first.");
		}
	}
	function load_model_send_email() {
		if ($('input[name="select_boxes[]"]:checked').length) {
			var values = $('input[name="select_boxes[]"]:checked').map(function () {
				return this.value;
			}).get();
			for (var a = 0; a < values.length; a++) {
				$('#selected_users').append('<input type="hidden" name="users[]" value="' + values[a] + '">');
			}
			$('#myModal1').modal('show');
		} else {
			bootbox.alert("Please select any user first.");
		}
	}
	function send_email() {
		$("#send_mail_form").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Sending...'});
		$.post(base_url + 'user/send_email_selected_users', $("#send_mail_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Email has been sent successfully.", function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert("Error in sending...");
			} else {
				bootbox.alert(data);
			}
			$("#send_mail_form").unblock();
		});
	}
</script>