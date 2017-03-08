A Job has been <?php echo $job_state === '1' ? 'approved' : 'rejected'; ?> with following details : <br><br>
Job Title : <b><?php echo $job_title; ?></b><br><br>
Job Type : <b><?php echo $job_type_name; ?></b><br><br>
Posted Date : <b><?php echo $job_post_date; ?></b><br><br>
<?php if (isset($job_rejected_reason)) { ?>
	<strong>Job has been rejected as following reasons</strong>: <br><br>
	<?php echo $job_rejected_reason; ?>
<?php } ?>
