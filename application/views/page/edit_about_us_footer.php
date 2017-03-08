<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit About Us Grey Box Content<small>Edit About Us Grey Box Content</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit About Us Grey Box Content</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit About Us Grey Box Content</h3>
                    </div>
                    <form id="edit_about_increw_footer_footer_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="about_increw_footer_title">Title</label>
								<input type="text" class="form-control" name="about_increw_footer_title" id="about_increw_footer_title" placeholder="Title" value="<?php echo $about_increw_footer_array['about_increw_footer_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="about_increw_footer_content">Content</label>
								<textarea id="about_increw_footer_content" name="about_increw_footer_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $about_increw_footer_array['about_increw_footer_content']); ?></textarea>
							</div>
							<div class="form-group">
								<label for="about_increw_footer_title">Link</label>
								<input type="text" class="form-control" name="about_increw_footer_link" id="about_increw_footer_link" placeholder="Link" value="<?php echo $about_increw_footer_array['about_increw_footer_link']; ?>"/>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_about_us_footer" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_about_us_footer_button" type="button" class="btn btn-primary pull-right" onclick="edit_about_increw_footer();">Update <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript">
								$(function () {
									CKEDITOR.replace('about_increw_footer_content');
								});
								function edit_about_increw_footer() {
									$("#edit_about_us_footer_button").button('loading');
									var about_increw_footer_content = CKEDITOR.instances.about_increw_footer_content.getData();
									$.post('', {about_increw_footer_title: $("#about_increw_footer_title").val(), about_increw_footer_content: about_increw_footer_content,about_increw_footer_link: $("#about_increw_footer_link").val()}, function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'page/list_about_us_footer';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("#edit_about_us_footer_button").button('reset');
									});
								}

</script>