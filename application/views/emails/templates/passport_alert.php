Hi <?php echo $user_first_name . ' ' . $user_last_name; ?>,<br><br>
<p>
	Your passport will be expire within in next 30 days. Please check the following details for your passport: <br><br>
	Country : <strong><?php echo $country_name; ?></strong><br><br>
	Expired On : <strong><?php echo date('M d Y', strtotime($user_passport_expire_date)); ?></strong>
</p>
<p>
	We have people looking for you. Please renew you passport.
</p>