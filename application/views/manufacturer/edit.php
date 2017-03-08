<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Manufacturer <small>Edit Manufacturer</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Manufacturer</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Manufacturer</h3>
                    </div>
                    <form id="edit_manufacturer_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="manufacturer_name" class="control-label">Manufacturer Name</label>
								<input type="text" name="manufacturer_name" id="manufacturer_name" class="form-control" placeholder="Manufacturer name" value="<?php echo $manufacturer_array['manufacturer_name']; ?>"/>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>manufacturer" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_manufacturer_button" type="button" class="btn btn-primary pull-right">Update <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript">
	$("#edit_manufacturer_button").click(function () {
		$("#edit_manufacturer_button").button("loading");
		$.post('', $("#edit_manufacturer_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Manufacturer Updated Successfully !!!", function (result) {
					document.location.href = base_url + 'manufacturer';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#edit_manufacturer_button").button("reset");
		});
	});
</script>

