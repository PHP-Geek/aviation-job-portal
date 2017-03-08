Dear <b><?php echo $user_first_name . ' ' . $user_last_name; ?></b>,<br>
<h4 style="color:#333;">Thanks for registering on <b style="font-size:27px;"><span style="color:#5095F7;">In</span><span style="color:#263662;">Crew!</span></b></h4>
<p style="color:#333;">
	Before you can get started, you will need to verify your account.
</p>
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
	   border-radius: 4px;margin: 0 auto;text-decoration: none" href="<?php echo base_url(); ?>auth/verify/<?php echo $user_id . '/' . $user_security_hash; ?>">Verify Email Address</a>
</p>
<p>
	<span style="color:#333;">If the button above is not visible please copy and paste the link below into a new browser:</span><br/>
	<a href="<?php echo base_url(); ?>auth/verify/<?php echo $user_id . '/' . $user_security_hash; ?>"><?php echo base_url(); ?>auth/verify/<?php echo $user_id . '/' . $user_security_hash; ?></a>
</p>
<p style="color:#333;">
	Once you have verified your account with InCrew, you will be able to take advantage of the below features:
</p>