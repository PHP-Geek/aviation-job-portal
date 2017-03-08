<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Testimonial Title <small>Edit Testimonial Title</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Testimonial Title</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Testimonial Title</h3>
					</div>
                    <form id="edit_testimonial_title_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="configuration_name" class="control-label">Title</label>
								<input type="text" name="configuration_name" id="configuration_name" class="form-control" placeholder="Testimonial Title" value="<?php echo $configuration_array['configuration_name']; ?>"/>
							</div>
						</div>
						<div class="box-footer text-center">
							<button id="edit_testimonial_title_button" type="button" class="btn btn-primary pull-right">Update <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#edit_testimonial_title_button").click(function () {
		$("#edit_testimonial_title_button").button("loading");
		$.post('', $("#edit_testimonial_title_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Testimonial Title Updated Successfully !!!", function () {
					document.location.href = base_url + 'testimonial/edit_title';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#edit_testimonial_title_button").button("reset");
		});
	});
</script>