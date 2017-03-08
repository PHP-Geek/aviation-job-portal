<style>
	.sale-interest-text{
		font-size:20px;
	}
	.back-model {
		background-color:#00a65a;
		color:#FFFFFF;
	}
	.colVis a{
		color:blue;
		font-size: 16px;
	}
	.col_inactive{
		background-color: #f5f5f5 !important;
	}
	.col_active{
		background-color: #eaeaea !important;
	}
	.colVis td{
		cursor: pointer;
		background-color:#eaeaea;
		padding-left:20px !important;
		border:#FFFFFF solid 1px !important;
	}
	#col_vis_button{
		margin-left:10px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Users : Employees <small>listing of all employees</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Employees</li>
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
				<!--				<div class="col_status">
									<div class="dropdown">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#col_vis_modal" id="col_vis_button">Column Visibility</button>
									</div>
								</div>-->
				<div class="box-body table-responsive">
					<table id="user_datatable" class="table table-bordered table-striped" cellspacing="10">
						<thead>
							<tr>
								<th class="smallwidth no-export"><input type="checkbox" name="select_all" id="select_all"/> </th>
								<th class="medwidth">Name</th>
								<th class="medwidth">Location</th>
								<th class="medwidth">Category</th>
								<th class="largewidth">Aircraft Type Rating</th>
								<th class="medwidth">License Type</th>
								<th class="medwidth">Employee Role</th>
								<th class="medwidth">Hours On Type Rating</th>
								<th class="medwidth">Total Hours</th>
								<th class="medwidth">Total Instructors</th>
								<th class="medwidth">Year of Experience</th>
								<th class="medwidth">User Description</th>
								<th class="medwidth">Email</th>
								<th class="medwidth">Contact</th>
								<th class="medwidth no-export">Lists</th>
								<th class="medwidth no-export">Last Logged In</th>
								<th class="largewidth no-export">Profile Completeness(%)</th>
								<th class="medwidth no-export">Status</th>
								<th class="smallwidth no-export">Rate User</th>
								<th class="medwidth no-export">View Profile</th>
								<th class="smallwidth no-export">Action</th>
								<th class="medwidth no-export">View Applied Jobs</th>
								<th class="medwidth no-export">Login History</th>
							</tr>
						</thead>
						<tbody></tbody>
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
					<button type="button" class="btn btn-primary" onclick="add_user_to_list()">Add To List</button>
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
<!-- Column visibility Modal -->
<div id="col_vis_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" id="modal_content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="fa fa-eye"></i> Click on column name to hide/show the column.</h4>
			</div>
			<div class="modal-body">
				<table cellspacing="10" class="table colVis">
					<tr><td onclick="fnShowHide(1);"><a href="javascript:void(0);">Name</a><span class="pull-right" id="span_1">Active</span></td>
						<td onclick="fnShowHide(2);"><a href="javascript:void(0);">Location</a><span class="pull-right" id="span_2">Active</span></td></tr>
					<tr><td onclick="fnShowHide(3);"><a href="javascript:void(0);">Category</a><span class="pull-right" id="span_3">Active</span></td>
						<td onclick="fnShowHide(4);"><a href="javascript:void(0);">Type Rating</a><span class="pull-right" id="span_4">Active</span></td></tr>
					<tr>
<!--					<tr><td onclick="fnShowHide(5);"><a href="javascript:void(0);">License Type</a><span class="pull-right" id="span_5">Active</span></td>-->
						<td onclick="fnShowHide(6);"><a href="javascript:void(0);">Employee Role</a><span class="pull-right" id="span_6">Active</span></td></tr>
					<tr><td onclick="fnShowHide(7);"><a href="javascript:void(0);">Hours on Type Rating</a><span class="pull-right" id="span_7">Active</span></td>
						<td onclick="fnShowHide(8);"><a href="javascript:void(0);">Total Hours</a><span class="pull-right" id="span_8">Active</span></td></tr>
					<tr><td onclick="fnShowHide(9);"><a href="javascript:void(0);">Total Instructors</a><span class="pull-right" id="span_9">Active</span></td>
						<td onclick="fnShowHide(10);"><a href="javascript:void(0);">Years of Experience</a><span class="pull-right" id="span_10">Active</span></td></tr>
					<tr><td onclick="fnShowHide(11);"><a href="javascript:void(0);">User Description</a><span class="pull-right" id="span_11">Active</span></td>
						<td onclick="fnShowHide(12);"><a href="javascript:void(0);">Email</a><span class="pull-right" id="span_12">Active</span></td></tr>
					<tr><td onclick="fnShowHide(13);"><a href="javascript:void(0);">Contact</a><span class="pull-right" id="span_13">Active</span></td>
						<td onclick="fnShowHide(14);"><a href="javascript:void(0);">Lists</a><span class="pull-right" id="span_14">Active</span></td></tr>
					<tr><td onclick="fnShowHide(15);"><a href="javascript:void(0);">Last Logged In</a><span class="pull-right" id="span_15">Active</span></td>
						<td onclick="fnShowHide(16);"><a href="javascript:void(0);">Profile Completeness</a><span class="pull-right" id="span_16">Active</span></td></tr>
					<tr><td onclick="fnShowHide(17);"><a href="javascript:void(0);">Rate User</a><span class="pull-right" id="span_17">Active</span></td>
						<td onclick="fnShowHide(18);"><a href="javascript:void(0);">Status</a><span class="pull-right" id="span_18">Active</span></td></tr>
					<tr><td onclick="fnShowHide(19);"><a href="javascript:void(0);">View Profile</a><span class="pull-right" id="span_19">Active</span></td>
						<td onclick="fnShowHide(20);"><a href="javascript:void(0);">Action</a><span class="pull-right" id="span_20">Active</span></td></tr>
					<tr><td onclick="fnShowHide(21);"><a href="javascript:void(0);">View Applied Jobs</a><span class="pull-right" id="span_21">Active</span></td>
						<td onclick="fnShowHide(22);"><a href="javascript:void(0);">Login History</a><span class="pull-right" id="span_22">Active</span></td></tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
							$(".colVis td").click(function () {
								if ($(this).hasClass('col_inactive')) {
									$(this).removeClass('col_inactive');
									$(this).addClass('col_active');
								} else {
									$(this).removeClass('col_active');
									$(this).addClass('col_inactive');
								}
							});
							$("#action_form").submit(function (e) {
								if ($('input[name="select_boxes[]"]:checked').length) {
									return true;
								}
								bootbox.alert("Please select at least one user.");
								return false;
							});
							$("#select_all").change(function () {
								if ($("#select_all").is(':checked')) {
									$('input[name="select_boxes[]"]').prop('checked', true)
								} else {
									$('input[name="select_boxes[]"]').prop('checked', false);
								}
							});
							var arr = '';
							function fnShowHide(iCol) {
								var oTable = $('#user_datatable').dataTable();
								var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
								if (bVis == false) {
									$("#span_" + iCol).html("Active");
								} else {
									$("#span_" + iCol).html("Inactive");
								}
								oTable.fnSetColumnVis(iCol, bVis ? false : true);
							}
							$(function () {
								$('#user_datatable').dataTable({
									"aaSorting": [['0', 'asc']],
									"sAjaxSource": base_url + "user/employee_datatable",
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
												"mColumns": "visible"
											}, {"sExtends": "csv",
												"sButtonText": "<i class='fa fa-save'></i> CSV",
												"mColumns": "visible"
											}]},
									"fnDrawCallback": function (oSettings) {
										$(".table td").css({'min-width': '150px'});
									},
									"aoColumnDefs": [
										{
											"aTargets": [0],
											"bSearchable": false,
											"bSortable": false,
											"mRender": function (data, type, full) {
												return '<div id="action_checkboxes"><input type="checkbox" id="selected_boxes" name="select_boxes[]" value="' + full[0] + '"/></div>';
											}
										}, {
											"aTargets": [5],
											"bVisible": false
										}, {
											"aTargets": [12],
											"bVisible": true,
											"mRender": function (data, type, full) {
												return '<a href="mailto:' + data + '">' + data + '</a>';
											}
										},
										{
											"aTargets": [14],
											"bSearchable": false,
											"mRender": function (data, type, full) {
												return '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="show_modal(' + full[0] + ')">Add To List</button>';
											}
										},
										{
											"aTargets": [17],
											"bSearchable": false,
											"mRender": function (data, type, full) {
												switch (data) {
													case '1':
														return '<div class="text-center"><input onchange="user_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /> </div>';
														break;
													default:
														return '<div class="text-center"><input onchange="user_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /> </div>';
														break;
												}
											}
										},
										{
											"aTargets": [19],
											"bSearchable": false,
											"mRender": function (data, type, full) {
												return '<div class="text-center"><a href="' + data + '" target="_blank"><i class="fa fa-user"></i> View</a></div>';
											}},
										{
											"aTargets": [20],
											"bSearchable": false,
											"bSortable": false,
											"mRender": function (data, type, full) {
												return '<div class="text-center"><a href="' + base_url + 'edit-profile/' + full[0] + '" target="_blank"><i class="fa fa-pencil-square-o"></i> Edit</a></div>';
											}
										},
										{
											"aTargets": [21],
											"bSearchable": false,
											"mData": null,
											"bSortable": false,
											"mRender": function (data, type, full) {
												return '<div class="text-center"><a href="' + base_url + 'job/applied_jobs/' + full[0] + '" target="_blank">View</a></div>';
											}},
										{
											"aTargets": [22],
											"bSearchable": false,
											"mData": null,
											"bSortable": false,
											"mRender": function (data, type, full) {
												return '<div class="text-center"><a href="' + base_url + 'user/log_in_history/' + full[0] + '" target="_blank">View</a></div>';
											}
										}
									],
									"fnDrawCallback": function (oSettings) {
										$("#user_datatable tr th.largewidth").css({'min-width': '200px'});
										$("#user_datatable tr th.smallwidth").css({'min-width': '85px'});
										$("#user_datatable tr th.medwidth").css({'min-width': '130px'});
									},
								}).fnSetFilteringDelay(700);
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