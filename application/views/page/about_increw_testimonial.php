<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit About Us Page Testimonial<small>Edit About Us Page Testimonial</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Page Testimonial</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit About Us Page Testimonial</h3>
                    </div>
                    <form id="edit_page_testimonial_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="page_testimonial_page">Testimonial Content</label>
								<textarea name="page_testimonial_content" id="page_testimonial_content" class="form-control" rows="7"><?php echo $page_testimonial_array['page_testimonial_content']; ?></textarea>
							</div>
							<div class="form-group">
								<label for="page_testimonial_page">Person Name</label>
								<input type="text" id="page_testimonial_person" name="page_testimonial_person" value="<?php echo $page_testimonial_array['page_testimonial_person']; ?>" class="form-control"/>
							</div>
						</div>
						<div class="box-footer text-center">
							<button id="edit_page_testimonial_button" type="button" class="btn btn-primary" onclick="edit_page_testimonial();" data-loading-text="Please Wait..">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
								function edit_page_testimonial() {
									$("edit_page_testimonial_button").button('loading');
									$.post('', $("#edit_page_testimonial_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = '';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_page_testimonial_button").button('reset');
									});
								}
</script>