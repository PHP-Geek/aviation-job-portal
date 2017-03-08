<style>
	.has-error{
		color:red;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Job Requests <small>listing of all job to approve</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Job Requests</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="form-group text-center">
				<h4 class="text-info"> Approval Process Status : <input type="checkbox" name="approval_process_status" onchange="change_process_status()" id="approval_process_status" <?php echo $configuration_array['configuration_value'] === '1' ? 'checked="checked"' : ''; ?>/> <?php echo $configuration_array['configuration_value'] === '1' ? 'Active' : 'Not Active'; ?>
					<br>(Please check or uncheck approval process to activate or deactivate)</h4>
			</div>
			<div class="box-body table-responsive">
				<table id="job_requests" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th class="medwidth">Logo</th>
							<th class="medwidth">Job Type</th>
							<th class="smallwidth">Job Title</th>
							<th class="medwidth">Email</th>
							<th class="medwidth">Company</th>
							<th class="medwidth">Employee Type</th>
							<th class="medwidth">Job Details</th>
							<th class="largewidth">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</section>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Write Reason</h3>
			</div>
			<form id="job_request_form" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="job_id" id="job_id"/>
						<input type="hidden" name="job_status" id="job_status" value="0"/>
						<label>Please write reason to reject the job :</label>
						<textarea name="job_reject_reason" id="job_reject_reason" class="form-control" placeholder="Reason for reject job"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="job_reject_button" class="btn btn-primary">Submit</button>
				</div>
			</form>
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
					$(function () {
						$("#job_request_form").validate({
							errorElement: 'span',
							errorClass: 'help-block text-right',
							focusInvalid: true,
							ignore: null,
							rules: {
								job_reject_reason: {
									required: true,
									minlength: 30
								}
							},
							messages: {
								job_reject_reason: {
									required: "Please fill the reason",
									minlength: "Please fill minimum 30 charaters"
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
								error.appendTo(element.closest('.form-group'));
							},
							submitHandler: function (form) {
								$("#job_reject_button").button("loading");
								$.post(base_url + 'job/response', $("#job_request_form").serialize(), function (data) {
									if (data === '1') {
										$.post(base_url + 'job/change_status', {job_id: $("#job_id").val(), job_status: '-1'}, function (data1) {
											if (data1 === '1') {
												bootbox.alert('Job Rejected Successfully', function () {
													document.location.href = '';
												});
											} else if (data1 === '0') {
												bootbox.alert('Error Rejecting job');
											} else {
												bootbox.alert(data1);
											}
										});
									} else if (data === '0') {
										bootbox.alert("Error submitting records");
									} else {
										bootbox.alert(data);
									}
									$("#job_reject_button").button("reset");
								});
							}
						});
						$('#job_requests').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "job/request_datatable",
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
										"mColumns": [1, 2, 3, 4, 5, 6, 7, 8]
									}, {
										"sExtends": "csv",
										"sButtonText": "<i class='fa fa-save'></i> CSV",
										"mColumns": [1, 2, 3, 4, 5, 6, 7, 8]
									}]
							},
							"aoColumnDefs": [
								{
									"aTargets": [0],
									"bVisible": false,
									"bSearchable": false
								},
								{
									"aTargets": [7],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
									}
								},
								{
									"aTargets": [1],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										return '<img class="img-responsive" src="' + data + '" style="max-width:100px;max_height:90px"/>';
									}
								},
								{
									"aTargets": [8],
									"bSearchable": false,
									"bSortable": false,
									"mData": null,
									"mRender": function (data, type, full) {
										return '<div><button type="button" class="btn btn-success btn-sm" onclick="approve_job(' + full[0] + ')">Approve</button> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="show_dialog(' + full[0] + ')">Reject</button> <a href="' + base_url + 'job/edit/' + full[0] + '" class="btn btn-info btn-sm" target="_blank">Edit</a></div>';
									}
								}
							], "fnDrawCallback": function (oSettings) {
								$(".popover_link").popover({html: true, placement: 'auto right'});
								$("#job_requests tr th.largewidth").css({'min-width': '200px'});
								$("#job_requests tr th.smallwidth").css({'min-width': '85px'});
								$("#job_requests tr th.medwidth").css({'min-width': '130px'});
							},
						}).fnSetFilteringDelay(700);
					});

					function approve_job(job_id) {
						bootbox.confirm('Job will publish on the website, Approve Job?', function (result) {
							if (result) {
								$("#job_requests").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
								$.post(base_url + 'job/response', {job_id: job_id, job_status: '1'}, function (data) {
									if (data === '1') {
										$.post(base_url + 'job/change_status', {job_id: job_id, job_status: '1'}, function (data1) {
											if (data1 === '1') {
												bootbox.alert('Job Approved Successfully.', function () {
													document.location.href = '';
												});
											} else if (data1 === '0') {
												bootbox.alert('Error Approving Job');
											} else {
												bootbox.alert(data1);
											}
										});
									} else if (data === '0') {
										bootbox.alert("Error Approving Job.");
									} else {
										bootbox.alert(data);
									}
									$("#job_requests").unblock();
								});
							}
						});
					}
					function show_dialog(job_id) {
						$("#job_id").val(job_id);
					}
					function change_process_status() {
						var process_status = $('#approval_process_status').is(':checked') === true ? '1' : '0';
						console.log(process_status);
						$.post(base_url + 'configuration/change_configuration', {configuration_id: '1', configuration_value: process_status}, function (data) {
							if (data === '1') {
								if (process_status === '1') {
									bootbox.alert('Approval Process Activated Successfully.', function () {
										document.location.href = '';
									});
								} else {
									bootbox.alert('Approval Process Deactivated Successfully.', function () {
										document.location.href = '';
									});
								}
							} else if (data === '0') {
								bootbox.alert('Error Updating Process');
							} else {
								bootbox.alert(data);
							}
						});
					}
</script>