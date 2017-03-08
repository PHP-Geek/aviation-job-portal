<style>
    .bg-primary {
        padding: 15px;
    }
</style>
<style type="text/css">
    .bg-primary {
        padding: 15px;
    }
	.table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
	.flight {
		background-color: #26355f;
		color: #fff;
		font-size: 12pt;
		font-weight: bold;
		padding: 6px 15px;
	}
	#job_table th:nth-child(7) {
		text-align: center;
	}
    .table-responsive > .table {
        margin-bottom: 0;
    }
	.active_title{
		font-weight: bold;
	}
	#view_applicant{
		border:1px solid #adadad;
		background-color:#f5f5f5;
		color:#333;
		font-weight: bold;
		margin-bottom: 5px;
		margin-top: 5px;
	}
	.btn {
		padding: 2px 12px;
	}
	#view_button {
		border: 1px solid #adadad;
		margin-right: 5px;
		padding: 6px 39px;
		background-color: #f5f5f5 ;
		color: #333;
	}
	#applicant_table select {
		background-color: #f5f5f5;
		border: 1px solid #adadad;
		padding: 3px;
		color: #333;
	}
	#applicant_table td:nth-child(2){
		color: #3299d5;
		font-weight: bold;
	}
	#job_table {
		border: medium none;
	}
	#applicant_table th:nth-child(4){
		width: 50%
	}
	.btn span.glyphicon {
		opacity: 0;
	}
	.btn.active span.glyphicon {
		opacity: 1;
	}
	#applicant_table th:nth-child(6){
		text-align: center;
	}
	#applicant_table{
		border: none;
	}
	#applicant_table th:nth-child(11){
		text-align: center;
	}
	#applicant_check{
		padding:0px 3px;
		background-color: #3299d5;
		border: none;
	}
	#post_job {
		margin-top: 15px;
	}
	.job_active {
		font-weight: bold;
		color:#3299d5;
	}
    .cursor_pointer{
        cursor : pointer;
    }
	.dataTables_wrapper .row{
		margin-left:3px;
		margin-top:5px;
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		vertical-align: middle !important;
	}
	@-moz-document url-prefix() {
		fieldset { display: table-cell; }
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">View Job Applicants</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<div class="well-white">
			<div class="row">
				<div class="col-md-10 col-sm-9 col-xs-12">
					<h3 class="active_title">Applicants Applied</h3>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-12">
					<button id="post_job" class="btn btn-warning btn-lg login_overlap" type="submit">Post a Job <span class="fa fa-plane"></span></button>
				</div>
			</div>
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h4 class="flight"><?php echo $job_details_array['job_title'] . ' in ' . $job_details_array['country_name']; ?></h4>
						</div>
						<div class="col-md-8 col-sm-12 col-xs-12">
							<button id="view_button" class="btn btn-default btn-lg" type="submit">Sort</button>
							<button id="view_button" class="btn btn-default btn-lg" type="submit">Filter</button>
							<button id="view_button" class="btn btn-default btn-lg" type="submit">Delete</button>
							<button id="view_button" class="btn btn-default btn-lg" type="submit">Send Email</button>

						</div>
					</div>
					<thead>
						<tr>
							<th>Select</th>
							<th>Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Status</th>
							<th>Actions</th>

						</tr>
					</thead>
					<tbody>
						<?php
						if (count($job_application_array) > 0) {
							foreach ($job_application_array as $job_applications) {
								?>
								<tr>
									<td>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success" id="applicant_check">
												<input type="checkbox" autocomplete="off">
												<span class="glyphicon glyphicon-ok"></span>
											</label>

										</div>
									</td>
									<td><?php echo $job_applications['user_first_name'] . ' ' . $job_applications['user_last_name']; ?></td>
									<td><?php echo date('d M Y', strtotime($job_applications['job_application_created'])); ?></td>
									<td><?php echo $job_applications['country_name']; ?></td>
									<td><select data-placeholder="&nbsp;Position" class="" name="">
											<option></option>
											<option value="1">Pilot</option>
											<option value="2">Maintenance Engineer</option>
											<option value="3">Flight Attendan</option>
											<option value="4">Operations</option>
											<option value="5">Executive</option>
										</select></td>

									<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
									<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
									<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
									</td>
								</tr>
								<?php
							}
						} else {
							echo '<tr><td colspan="6">No Data.</td></tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="well-white">
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<thead>
						<tr>
							<th>Select </th>
							<th>Candidates Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Licence</th>
							<th>Total Hours</th>
							<th>Rated</th>
							<th>PIC</th>
							<th>SIC</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-success" id="applicant_check">
										<input type="checkbox" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
									</label>
								</div>
							</td>
							<td>James Smith</td>
							<td>03/April/2016</td>
							<td>United States</td>
							<td>ATPL</td>
							<td>5000</td>
							<td>Yes</td>
							<td>1200</td>
							<td>300</td>
							<td><select data-placeholder="&nbsp;Position" class="" name="">
									<option></option>
									<option value="1">Pilot</option>
									<option value="2">Maintenance Engineer</option>
									<option value="3">Flight Attendan</option>
									<option value="4">Operations</option>
									<option value="5">Executive</option>
								</select></td>
							<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
							<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
							<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="well-white">
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<thead>
						<tr>
							<th>Select </th>
							<th>Candidates Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Current Position</th>
							<th>Years Exp</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-success" id="applicant_check">
										<input type="checkbox" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
									</label>
								</div>
							</td>
							<td>James Smith</td>
							<td>03/April/2016</td>
							<td>United States</td>
							<td></td>
							<td></td>
							<td><select data-placeholder="&nbsp;Position" class="" name="">
									<option></option>
									<option value="1">Pilot</option>
									<option value="2">Maintenance Engineer</option>
									<option value="3">Flight Attendan</option>
									<option value="4">Operations</option>
									<option value="5">Executive</option>
								</select></td>
							<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
							<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
							<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="well-white">
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<thead>
						<tr>
							<th>Select </th>
							<th>Candidates Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Licence</th>
							<th>Current Position</th>
							<th>Years Exp</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-success" id="applicant_check">
										<input type="checkbox" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
									</label>
								</div>
							</td>
							<td>James Smith</td>
							<td>03/April/2016</td>
							<td>United States</td>
							<td></td>
							<td></td>
							<td></td>
							<td><select data-placeholder="&nbsp;Position" class="" name="">
									<option></option>
									<option value="1">Pilot</option>
									<option value="2">Maintenance Engineer</option>
									<option value="3">Flight Attendan</option>
									<option value="4">Operations</option>
									<option value="5">Executive</option>
								</select></td>
							<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
							<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
							<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="well-white">
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<thead>
						<tr>
							<th>Select </th>
							<th>Candidates Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Current Position</th>
							<th>Years Exp</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-success" id="applicant_check">
										<input type="checkbox" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
									</label>
								</div>
							</td>
							<td>James Smith</td>
							<td>03/April/2016</td>
							<td>United States</td>
							<td></td>
							<td></td>
							<td><select data-placeholder="&nbsp;Position" class="" name="">
									<option></option>
									<option value="1">Pilot</option>
									<option value="2">Maintenance Engineer</option>
									<option value="3">Flight Attendan</option>
									<option value="4">Operations</option>
									<option value="5">Executive</option>
								</select></td>
							<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
							<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
							<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="well-white">
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<thead>
						<tr>
							<th>Select </th>
							<th>Candidates Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Current Position</th>
							<th>Years Exp</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="btn-group" data-toggle="buttons">

									<label class="btn btn-success" id="applicant_check">
										<input type="checkbox" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
									</label>
								</div>
							</td>
							<td>James Smith</td>
							<td>03/April/2016</td>
							<td>United States</td>
							<td></td>
							<td></td>
							<td><select data-placeholder="&nbsp;Position" class="" name="">
									<option></option>
									<option value="1">Pilot</option>
									<option value="2">Maintenance Engineer</option>
									<option value="3">Flight Attendan</option>
									<option value="4">Operations</option>
									<option value="5">Executive</option>
								</select></td>
							<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
							<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
							<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="well-white">
			<div class="table-responsive" id="applicant_table">
				<table class="table">
					<thead>
						<tr>
							<th>Select </th>
							<th>Candidates Name</th>
							<th>Date Applied</th>
							<th>Location</th>
							<th>Current Position</th>
							<th>Years Exp</th>
							<th>Rating</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="btn-group" data-toggle="buttons">

									<label class="btn btn-success" id="applicant_check">
										<input type="checkbox" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
									</label>
								</div>
							</td>
							<td>James Smith</td>
							<td>03/April/2016</td>
							<td>United States</td>
							<td></td>
							<td></td>
							<td></td>
							<td><select data-placeholder="&nbsp;Position" class="" name="">
									<option></option>
									<option value="1">Pilot</option>
									<option value="2">Maintenance Engineer</option>
									<option value="3">Flight Attendan</option>
									<option value="4">Operations</option>
									<option value="5">Executive</option>
								</select></td>
							<td><button id="view_applicant" class="btn btn-success " type="submit">Notes 0</button></td>
							<td><button id="contact_us_feed_button" class="btn btn-success " type="submit">Shortlist <span class="fa fa-plane"></span></button></td>
							<td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
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
<script type="text/javascript">
	$(function () {
		$('select').select2();
		var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		$('#view_applicant_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "job/view_applicant_datatable",
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
				}, {
					"aTargets": [6],
					"bSearchable": false,
					"bSortable": false,
				},
				{
					"aTargets": [5],
					"bSearchable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return 'Full Time';
								break;
							default:
								return 'Contract Basis';
						}
					}
				},
				{
					"aTargets": [7],
					"bSearchable": false,
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'user/profile/' + data + '"><i class="fa fa-user"></i> View</a></div>';
					}
				}
			],
			"fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
				$("#view_applicant_datatable tr th.largewidth").css({'min-width': '200px'});
				$("#view_applicant_datatable tr th.smallwidth").css({'min-width': '85px'});
				$("#view_applicant_datatable tr th.medwidth").css({'min-width': '130px'});
			},
		}).fnSetFilteringDelay(700);
	});
</script>