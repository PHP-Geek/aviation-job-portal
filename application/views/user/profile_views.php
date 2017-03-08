<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	.help-block{
		color:red !important;
	}
	.btn-success{
		width:164px !important;
	}
	#country_code
	{
		vertical-align:top;
		background-color:#F5F5F5;
	}
	.has-error #user_primary_contact
	{
		border-radius:5px;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>Dashboard"></a></li>
                    <li class="active">Profile Views</li>
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
                    <h1><span style="font-weight: 500">Profile Views</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<?php foreach ($employer_seen_array as $view) { ?>
		<div class="well">
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>uploads/users/images/<?php echo date('Y/m/d/H/i/s/', strtotime($view['user_created'])) . $view['user_profile_thumb']; ?>" alt="No Image" class="img-responsive" style="max-height:75px;max-width: 75px"/>
				</div>
				<div class="col-md-3">
					<?php echo $view['user_business_name']; ?>
				</div>
				<div class="col-md-3">
					<?php echo date('M d Y h:i a', strtotime($view['employer_seen_created'])); ?>
				</div>
				<div class="col-md-3 col-lg-3">
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="get_employer(<?php echo $view['user_id']; ?>)">View Employer <i class="fa fa-plane"></i></button>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="text-center"><?php echo $page_links; ?></div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">View Employer Details</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 col-lg-6"><label>Company Name</label></div><div class="col-md-6 col-lg-6" id="company_name"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Address</label></div><div class="col-md-6 col-lg-6" id="company_address"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Email</label></div><div class="col-md-6 col-lg-6" id="company_email"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Contact</label></div><div class="col-md-6 col-lg-6" id="company_contact"></div></div>
				<div class="spacer9"></div><div class="row">
					<div class="col-md-6 col-lg-6"><label>Website</label></div><div class="col-md-6 col-lg-6" id="company_website"></div></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function get_employer(user_id) {
		$.post(base_url + 'user/get_employer', {user_id: user_id}, function (data) {
			$("#company_name").html(data.user_business_name);
			$("#company_address").html(data.user_address + ' ' + data.user_city + ' ' + data.user_state + ' ' + data.user_city + ', ' + data.country_name + ' - ' + data.user_zipcode);
			$("#company_email").html(data.user_email);
			$("#company_contact").html(data.user_primary_contact);
			$("#company_website").html('<a href="' + data.user_website_address + '">' + data.user_website_address + '</a>');
		});
	}
</script>
