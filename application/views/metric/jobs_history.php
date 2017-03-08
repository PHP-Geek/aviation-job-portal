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
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Jobs History</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Jobs History</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
					<?php if (count($job_array) > 0) { ?>
						<thead>
							<tr>
								<th>Logo</th>
								<th>Job Title</th>
								<th>Job Type</th>
								<th>Company</th>
								<th>Post Date</th>
								<th>Expire Date</th>
								<th>Location</th>
								<th>No. of Applicants</th>
								<th>No. of Views</th>
								<th>Social Media Shares</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($job_array as $job) { ?>
								<tr>
									<td><img src="<?php echo base_url() . 'uploads/jobs/company_logos/' . date('Y/m/d/H/i/s/', strtotime($job['job_created'])) . $job['job_company_logo']; ?>" style="max-width: 80px;max-height: 80px;"/></td>
									<td><?php echo $job['job_title']; ?></td>
									<td><?php echo $job['job_type_name']; ?></td>
									<td><?php echo $job['job_company_name']; ?></td>
									<td><?php echo $job['job_post_date']; ?></td>
									<td><?php echo $job['job_expire_date']; ?></td>
									<td><?php echo $job['country_name']; ?></td>
									<td><i class="badge"><?php echo $job['no_of_applicants']; ?></i> <a href="<?php echo base_url(); ?>job/view_applicant/<?php echo $job['job_id']; ?>" target="_blank"><i class="fa fa-users"></i> View</a></td>
									<td><?php echo $job['job_view_count']; ?></td>
									<td><a href="<?php echo base_url(); ?>metric/job_shares/<?php echo $job['job_id']; ?>" title="Click to view details"><?php
											echo $job['job_facebook_share_count'] +
											+ $job['job_twitter_share_count'] + $job['job_googleplus_share_count'] + $job['job_linkedin_share_count'] + $job['job_pinterest_share_count'];
											?></a></td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr><td class="text-center" colspan="10">
									<?php echo $page_links; ?>
								</td>
							</tr>
						</tfoot>
						<?php
					} else {
						echo '<tr><td class="text-info">No Jobs.</td></tr>';
					}
					?>
                </table>
            </div>
        </div>
    </section>
</div>
