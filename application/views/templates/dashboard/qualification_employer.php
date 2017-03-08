<style>
	.employer-font{
		font-weight:500;
	}
</style>
<div class = "row">
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="dashboard-title">
			<p class = "text-left employer-font">Next Job Expiry: </p>
		</div>
	</div>
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<p class="employer-font"><?php echo $next_job_expiry !== '0000-00-00' ? date('d M Y', strtotime($next_job_expiry)) : '-'; ?></p>
	</div>
</div>
<div class = "row">
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="dashboard-title">
			<p class = "text-left employer-font">No of Posted Jobs: </p>
		</div>
	</div>
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<p class="employer-font"><?php echo $posted_jobs_count > 0 ? $posted_jobs_count : '-'; ?></p>
	</div>
</div>
<div class = "row">
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="dashboard-title">
			<p class = "text-left employer-font">No of Applicants: </p>
		</div>
	</div>
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<p class="employer-font"><?php echo $no_of_applicant > 0 ? $no_of_applicant : '-'; ?></p>
	</div>
</div>
<div class = "row">
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="dashboard-title">
			<p class = "text-left employer-font">New Applicants: </p>
		</div>
	</div>
	<div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<p class="employer-font"><?php echo $new_applicant > 0 ? $new_applicant : '-'; ?></p>
	</div>
</div>
