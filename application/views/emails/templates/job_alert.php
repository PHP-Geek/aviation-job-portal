<p>
	Dear <?php echo $user_first_name; ?>, job you may be interested based on your profile <br><br>
	Job Title : <b><?php echo $job_title; ?></b><br><br>
	Job Location : <b><?php echo $job_location; ?></b><br><br>
	Job Type : <b><?php echo $job_type; ?></b><br><br>
	Employment Type : <b><?php echo $job_employee_type === '1' ? 'Full Time' : 'Contract Basis'; ?></b><br><br>
<p style="text-align: center">
	<a style="color: #fff;
	   background-color: #337ab7;
	   border-color: #2e6da4;display: inline-block;
	   padding: 6px 12px;
	   margin-bottom: 0;
	   font-size: 14px;
	   font-weight: 400;
	   line-height: 1.42857143;
	   text-align: center;
	   white-space: nowrap;
	   vertical-align: middle;
	   -ms-touch-action: manipulation;
	   touch-action: manipulation;
	   cursor: pointer;
	   -webkit-user-select: none;
	   -moz-user-select: none;
	   -ms-user-select: none;
	   user-select: none;
	   background-image: none;
	   border: 1px solid transparent;
	   border-radius: 4px;margin: 0 auto;text-decoration: none" href="<?php echo base_url(); ?>job/view/<?php echo $job_slug . '/' . $job_id; ?>">Apply</a>
</p>