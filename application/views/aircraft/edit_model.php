<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Aircraft Model <small>Edit Aircraft Model</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Aircraft Model</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Aircraft Model</h3>
                    </div>
                    <form id="edit_model_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="manufacturers_id" class="control-label">Aircraft Type</label>
								<select name="manufacturers_id" id="manufacturers_id"   class="form-control">
									<option></option>
									<?php foreach ($manufacturer_array as $manufacturer) { ?>
										<option <?php
										if ($model_array['manufacturers_id'] === $manufacturer['manufacturer_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['manufacturer_name']; ?></option>
										<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="model_name">Model Name</label>
								<input type="text" name="model_name" id="model_name" placeholder="Model Name" class="form-control" value="<?php echo $model_array['model_name']; ?>"/>
							</div>
						</div>
						<div class="box-footer text-right">
							<a href="<?php echo base_url(); ?>aircraft/models" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_model_button" type="button" class="btn btn-primary btn-md"> Update <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$(function () {
		$("#manufacturers_id").select2({
			placeholder: "Manufacturer"
		});
	});
	$("#edit_model_button").click(function () {
		$("#edit_model_button").button("loading");
		$.post('', $("#edit_model_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Aircraft Model Updated Successfully !!!", function () {
					document.location.href = base_url + 'aircraft/models';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#edit_model_button").button("reset");
		});
	});
</script>

