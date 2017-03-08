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
		padding : 0px 10px;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Job Applicants</li>
					<li class="active"><?php echo $job_array['job_title']; ?></li>
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
                    <h1><span style="font-weight: 500">Job Applicants : <?php echo $job_array['job_title'] . ' in ' . $job_array['country_name']; ?></span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="bg-primary">Jobs Applicants : <?php echo $job_array['job_title'] . ' in ' . $job_array['country_name']; ?></h3>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="view_applicant_datatable">
					<thead>
						<tr>
							<th>Job Title</th>
							<th>Job Location</th>
							<th>Aircraft Type</th>
							<th>Applicant Name</th>
							<th>Employment Type</th>
							<th>Date Applied</th>
							<th>Applicant Profile</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (count($job_application_array) > 0) {
							foreach ($job_application_array as $job_application) {
								?>
								<tr>
									<td><?php echo $job_application['job_title']; ?></td>
									<td><?php echo $job_application['country_name']; ?></td>
									<td><?php echo $job_application['my_aircraft_name']; ?></td>
									<td><?php echo $job_application['user_first_name'] . ' ' . $job_application['user_last_name']; ?></td>
									<td><?php echo $job_application['job_employee_type'] == '1' ? 'Full Time' : 'Contract Basis'; ?></td>
									<td><?php echo date('d M Y h:i a', strtotime($job_application['job_application_created'])); ?></td>
									<td><a href="<?php echo base_url() . 'user/profile/' . $job_application['user_first_name'] . '-' . $job_application['user_last_name'] . '/' . $job_application['user_id']; ?>" target="_blank"><i class="fa fa-user"></i> View</a></td>
								</tr>
								<?php
							}
						} else {
							echo '<tr><td colspan="7"><h4 class="text-info">No Data.</h4></td>';
						}
						?>
					</tbody>
					<tfoot>
						<tr><td colspan="7" class="text-center"><?php echo $page_links; ?></td></tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
