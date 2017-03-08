<style>
	.has-error{
		color:red;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Job Applications <small>listing of all job applications to approve</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Job Requests</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="box-body table-responsive">
				<table id="job_applications" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th class="medwidth">Logo</th>
							<th class="medwidth">Job Title</th>
							<th class="medwidth">Job Type</th>
							<th class="medwidth">Company</th>
							<th class="medwidth">Post Date</th>
							<th class="medwidth">Expire Date</th>
							<th class="medwidth">Job Start Date</th>
							<th class="largewidth">Job Details</th>
							<th class="largewidth">Applicant Name</th>
							<th class="largewidth">Applicant Location</th>
							<th class="xlargewidth">Action</th>
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
				<h4 class="modal-title">View Job Details</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 col-lg-6"><label>Job Title</label></div><div class="col-md-6 col-lg-6" id="job_title"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Job Type</label></div><div class="col-md-6 col-lg-6" id="job_type"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Company</label></div><div class="col-md-6 col-lg-6" id="job_company_name"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Post Date</label></div><div class="col-md-6 col-lg-6" id="job_post_date"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Expire Date</label></div><div class="col-md-6 col-lg-6" id="job_expire_date"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Employee Type</label></div><div class="col-md-6 col-lg-6" id="job_employee_type"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Location</label></div><div class="col-md-6 col-lg-6" id="job_location"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Pay</label></div><div class="col-md-6 col-lg-6" id="job_pay"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$(function () {
		$('#job_applications').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "job/application_datatable",
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
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				},
				{
					"aTargets": [8],
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
					"aTargets": [11],
					"bSearchable": false,
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<div><button type="button" class="btn btn-success btn-sm" onclick="approve_job_application(' + full[0] + ');">Approve</button> <button type="button" class="btn btn-danger btn-sm" onclick="reject_job_application(' + full[0] + ');">Reject</button><br><br><button type="button" class="btn btn-info btn-sm" onclick="view_job(' + full[0] + ');" data-toggle="modal" data-target="#myModal">View Job</button> <a href="' + base_url + 'user/profile/' + data + '" target="_blank" class="btn btn-info btn-sm">View User Profile</a></div>';
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
				$("#job_applications tr th.largewidth").css({'min-width': '200px'});
				$("#job_applications tr th.smallwidth").css({'min-width': '85px'});
				$("#job_applications tr th.medwidth").css({'min-width': '130px'});
				$("#job_applications tr th.xlargewidth").css({'min-width': '200px'});
			},
		}).fnSetFilteringDelay(700);
	});
	function approve_job_application(job_application_id) {
		bootbox.confirm('Application will be forwarded to particular employer. Approve Job Application?', function (result) {
			if (result) {
				$("#job_applications").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
				$.post(base_url + 'job/change_application_status', {job_application_id: job_application_id, job_application_status: '1'}, function (data) {
					if (data === '1') {
						bootbox.alert("Job Application Approved Successfully", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error Approving Job Applicatoin");
					} else {
						bootbox.alert(data);
					}
					$("#job_applications").unblock();
				})
			}
		});
	}
	function reject_job_application(job_application_id) {
		bootbox.confirm('Application will not be forwarded to employer. Reject Job Application?', function (result) {
			if (result) {
				$("#job_applications").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
				$.post(base_url + 'job/change_application_status', {job_application_id: job_application_id, job_application_status: '-1'}, function (data) {
					if (data === '1') {
						bootbox.alert("Job Application Rejected Successfully", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error Approving Job Applicatoin");
					} else {
						bootbox.alert(data);
					}
					$("#job_applications").unblock();
				});
			}
		});
	}
	function view_job(job_application_id) {
		$.post(base_url + 'job/get_job', {job_application_id: job_application_id}, function (data) {
			$("#job_title").html(data.job_title);
			$("#job_type").html(data.job_type_name);
			$("#job_company_name").html(data.job_company_name);
			$("#job_post_date").html(data.job_post_date);
			$("#job_expire_date").html(data.job_expire_date);
			$("#job_employee_type").html(data.job_employee_type === '1' ? 'Full Time' : 'Contract Basis');
			$("#job_location").html(data.country_name);
			$("#job_pay").html(data.job_pay_amount + ' ' + data.job_pay_currency + ' ' + data.job_pay_tenor);
		});
	}
</script>