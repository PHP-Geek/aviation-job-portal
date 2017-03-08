<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Page Blue Box <small>Edit Page Blue Box</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Page Blue Box</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Page Blue Box</h3>
                    </div>
                    <form id="edit_page_blue_box_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="page_blue_box_title">Title</label>
								<input type="text" class="form-control" name="page_blue_box_title" id="page_blue_box_title" placeholder="Title" value="<?php echo $page_blue_box_array['page_blue_box_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="page_blue_box_content">Content</label>
								<textarea id="page_blue_box_content" name="page_blue_box_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $page_blue_box_array['page_blue_box_content']); ?></textarea>
							</div>
							<div class="form-group">
								<label for="page_blue_box_button_text">Button Text</label>
								<input type="text" class="form-control" name="page_blue_box_button_text" id="page_blue_box_button_text" placeholder="Button Text" value="<?php echo $page_blue_box_array['page_blue_box_button_text']; ?>"/>							</div>
							<div class="form-group">
								<label for="page_blue_box_button_link">Button Link</label>
								<input type="text" class="form-control" name="page_blue_box_button_link" id="page_blue_box_button_link" placeholder="Button Link" value="<?php echo $page_blue_box_array['page_blue_box_button_link']; ?>"/>							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/page_blue_box" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_page_blue_box_button" type="button" class="btn btn-primary pull-right" onclick="edit_page_blue_box();" data-loading-text="Please Wait..">Update <i class="fa fa-chevron-right"></i></button>
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
									CKEDITOR.replace('page_blue_box_content');
								});
								function edit_page_blue_box() {
									$("edit_page_blue_box_button").button('loading');
									var tab_content = CKEDITOR.instances.page_blue_box_content.getData();
									$.post('', {page_blue_box_title: $('#page_blue_box_title').val(), page_blue_box_content: tab_content, page_blue_box_button_text: $('#page_blue_box_button_text').val(), page_blue_box_button_link: $('#page_blue_box_button_link').val()}, function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = '';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_page_blue_box_button").button('reset');
									});
								}
</script>