Dear Admin,
<p>
    A new user has signed up. Please see the below details: <br/>
    Details are: <br/><br/>
    First Name: <b><?php echo $user_first_name; ?></b><br/>
    Last Name: <b><?php echo $user_last_name; ?></b><br/>
	User Type: <b><?php echo $user_type; ?></b><br/>
    Email: <b><?php echo $user_email; ?></b><br/>
	<?php if ($user_employer_type !== '') { ?>
		Sector: <b><?php echo $user_employer_type; ?></b><br/>
	<?php } ?>
</p>
