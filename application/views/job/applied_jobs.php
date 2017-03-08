<div class="content-wrapper">
    <section class="content-header">
        <h1>Jobs Applied <small>listing of applied jobs by user</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Jobs Applied</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="well">
				<div class="row">
					<div class="col-md-6">
						<h4><label>Name</label> : <?php echo $user_array['user_first_name'] . ' ' . $user_array['user_last_name']; ?></h4> </div>
					<div class="col-md-6"><h4><label>Email </label>: <?php echo $user_array['user_email']; ?></h4>
					</div></div>
			</div>
			<div class="box-body table-responsive">
				<table id="user_datatable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th> </th>
							<th>Job Title</th>
							<th>Location</th>
							<th>Company</th>
							<th>Application Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (count($job_application_array) > 0) {
							foreach ($job_application_array as $job_application) {
								?>
								<tr>
									<td><img src="<?php echo base_url() . 'uploads/jobs/company_logos/' . date('Y/m/d/H/i/s/', strtotime($job_application['job_created'])) . $job_application['job_company_logo']; ?>" style="max-width:100px;max-height: 100px;"/></td>
									<td><?php echo $job_application['job_title']; ?></td>
									<td><?php echo $job_application['country_name']; ?></td>
									<td><?php echo $job_application['job_company_name']; ?></td>
									<td><?php echo date('d M Y', strtotime($job_application['job_application_created'])); ?></td>
								</tr>
								<?php
							}
						} else {
							echo '<td colspan="2"><h4 class="text-info">No Data</h4></td>';
						}
						?>
					</tbody>
					<tfoot>
						<?php echo $page_links; ?>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
</div>