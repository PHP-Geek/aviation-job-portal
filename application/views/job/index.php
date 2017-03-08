<style type="text/css">
    .bg-primary {
        padding: 15px;
    }
    .bg-primary a{
        font-size: 14px;
        color:#ddd;
    }
	.delete-button{
		color:#818181;
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		border-top: 0px !important;
	}
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    #job_table th:nth-child(7) {
        text-align: center;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .btn {
        padding: 2px 12px;
    }
    .active_title{
        font-weight: bold;
    }
    #view_applicant{
        border:1px solid #adadad;
		background-color:#f5f5f5;
        color:#333;
        font-weight: bold;

    }
	.view-applicant{
		color:#25358f !important;
		margin-right:5px;
	}
    #post_job {
		margin-top: 15px;
	}
    #job_table {
        border: medium none;
    }
    .job_active {
        font-weight: bold;
        color:#3299d5;
    }
   
    .cursor_pointer{
        cursor : pointer;
    }
    .dataTables_wrapper .row{
        margin-left:1px;
        margin-top:4px;
    }
    .button_job_view{
        padding : 0px 10px;
    }
	.active_job_title{
		color:0099ff;
	}
	h4{
		margin-top:0px !important;
	}
	.table tr td:last-child {
		width:275px !important;
		text-align: center !important;
	}
	.table tr th:last-child{
		text-align: center;
	}
	.x-button{
		margin-right:5px;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Jobs</li>
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
                    <h1><span style="font-weight: 500">Jobs</span></h1>
                    <p>Aided by InCrew's online Aircrew Brokerage, we make ferrying and delivery a breeze. A call to InCrew secures a crew, flightplan, en route planning and permissions, and flight watch for your ferry flight, with the minimum of fuss.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages  padbot-20">
    <div class="container">
		<div class="well-white">
			<div class="row">
				<div class="col-md-10 col-sm-9 col-xs-12">
					<h3 class="active_title">Active Jobs</h3>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<a id="post_job" class="btn btn-warning btn-lg login_overlap" href="<?php echo base_url() . 'post-job' ?>">Post a Job <span class="fa fa-plane"></span></a>
				</div>
			</div>
			<div class="table-responsive">
				<table id="active_job_datatable" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Job</th>
							<th>Position</th>
							<th>Location</th>
							<th>Type</th>
							<th>Date Posted</th>
							<th>No. of Applicants</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="well-white">
			<div class="row">
				<div class="col-md-10 col-sm-9 col-xs-12">
					<h3 class="active_title">Expired Jobs</h3>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<a id="post_job" class="btn btn-warning btn-lg login_overlap" href="<?php echo base_url() . 'post-job' ?>">Post a Job <span class="fa fa-plane"></span></a>
				</div>
			</div>
			<div class="table-responsive" id="job_table">
				<table id="expired_job_datatable" class="table" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Job</th>
							<th>Position</th>
							<th>Location</th>
							<th>Type</th>
							<th>Date Posted</th>
							<th>Applicants</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
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
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$('#active_job_datatable').dataTable({
				"aaSorting": [['0', 'asc']],
				"sAjaxSource": base_url + "job/active_job_datatable",
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
						"aTargets": [1],
						"bSortable": false,
						"mRender": function (data, type, full) {
							return data;
						}
					},
					{
						"aTargets": [7],
						"bSearchable": false,
						"bSortable": false,
						"mData": null,
						"mRender": function (data, type, full) {
							return '<div class="text-center"><a id="view_applicant" class="btn btn-success view-applicant" href="' + base_url + 'job/view_applicants/' + full[0] + '">View Applicants</a><a target="_blank" id="contact_us_feed_button" class="btn btn-success x-button" href="' + base_url + 'job/edit/' + full[0] + '">Edit  <span class="fa fa-plane"></span></a><a href="javascript:;" class="delete-button" onclick="delete_job(' + full[0] + ', 1);">X</a></div>'
						}
					}
				],
				"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					$(nRow).attr("id", 'job_' + aData[0]);
				}
			}).fnSetFilteringDelay(700);
			$('#expired_job_datatable').dataTable({
				"aaSorting": [['0', 'asc']],
				"sAjaxSource": base_url + "job/expired_job_datatable",
				"oTableTools": {
					"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
					"aButtons": [{
							"sExtends": "pdf",
							"sButtonText": "<i class='fa fa-save'></i> PDF",
							"sPdfOrientation": "landscape",
							"sPdfSize": "tabloid",
							"mColumns": [1, 2, 3, 4, 5]
						}, {
							"sExtends": "csv",
							"sButtonText": "<i class='fa fa-save'></i> CSV",
							"mColumns": [1, 2, 3, 4, 5]
						}]
				},
				"aoColumnDefs": [
					{
						"aTargets": [0],
						"bVisible": false,
						"bSearchable": false
					},
					{
						"aTargets": [1],
						"bSearchable": true,
						"bSortable": false,
						"mRender": function (data, type, full) {
							return data;
						}
					},
					{
						"aTargets": [7],
						"bSearchable": false,
						"bSortable": false,
						"mData": null,
						"mRender": function (data, type, full) {
							return '<div class="text-center"><a id="view_applicant" class="btn btn-success view-applicant" href="' + base_url + 'job/view_applicants/' + full[0] + '">View Applicants</a><a target="_blank" id="contact_us_feed_button" class="btn btn-success" href="' + base_url + 'job/edit/' + full[0] + '">Repost  <span class="fa fa-plane"></span></a><a href="javascript:;" class="delete-button" onclick="delete_job(' + full[0] + ', 2);">X</a></div>'
						}
					}
				],
				"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					$(nRow).attr("id", 'expire_job_' + aData[0]);
				}
			}).fnSetFilteringDelay(700);
		});
		function delete_job(job_id, option) {
			bootbox.confirm("Are you sure to delete the job?", function (result) {
				if (result) {
					$(window).block({message: "Please Wait"});
					$.post(base_url + 'job/delete', {job_id: job_id}, function (data) {
						if (data === '1') {
							if (option == '1') {
								$("#job_" + job_id).hide(500);
							} else if (option == '2') {
								$("#expired_job_" + job_id).hide(500);
							}
						} else if (data === '0') {
							bootbox.alert("Error Deleting Job");
						} else {
							bootbox.alert(data);
						}
						$(window).unblock();
					});
				}
			});
		}
	</script>