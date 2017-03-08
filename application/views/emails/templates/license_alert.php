Hi <?php echo $user_first_name . ' ' . $user_last_name; ?>,<br><br>
<p>
	Your license will be expire within in next 30 days. Please check the following details for your license: <br><br>
	License Type : <strong><?php echo $license_type; ?></strong><br><br>
	Expired On : <strong><?php echo date('M d Y', strtotime($user_license_expire_date)); ?></strong>
</p>
<p>
	We have people looking for you. Please renew you license.
</p>