<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Office Details <small>Edit Office Details</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Office Details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Office Details</h3>
                    </div>
                    <form id="edit_office_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="contact_office_name">Office Type</label>
								<input type="text" class="form-control" name="contact_office_name" id="contact_office_name" placeholder="Office Type (e.g. - Head Office,Singapore Office)" value="<?php echo $contact_office_array['contact_office_name']; ?>"/>
							</div>
							<div class="form-group">
								<label for="contact_office_phone">Phone</label>
								<input type="text" class="form-control" name="contact_office_phone" id="contact_office_phone" placeholder="+61-123456789" value="<?php echo $contact_office_array['contact_office_phone']; ?>"/>
							</div>
							<div class="form-group">
								<label for="contact_office_email">Email</label>
								<input type="text" class="form-control" name="contact_office_email" id="contact_office_email" placeholder="info@increw.com.au" value="<?php echo $contact_office_array['contact_office_email']; ?>"/>
							</div>
							<div class="form-group">
								<label for="contact_office_name">Complete Address</label>
								<textarea class="form-control" name="contact_office_address" id="contact_office_address" placeholder="Complete Office Address with Zip Code" rows="3"><?php echo str_replace(array('<br />','<br>','<br/>'), '', $contact_office_array['contact_office_address']); ?></textarea>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/contact_office" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_office_button" type="button" class="btn btn-primary pull-right" onclick="edit_contact_office();">Update <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	function edit_contact_office() {
		$("edit_office_button").button('loading');
		$.post('', $("#edit_office_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert('Office Updated Successfully', function () {
					document.location.href = base_url + 'page/contact_office';
				});
			} else if (data === '0') {
				bootbox.alert('Error Saving Data');
			} else {
				bootbox.alert(data);
			}
			$("edit_office_button").button('reset');
		});
	}
</script>