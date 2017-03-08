<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Charter Page Writing <small>view/edit charter page writing</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Charter Page Writing</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update Charter Page Writing</h3>
                    </div>
                    <form id="edit_page_content_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="page_content_title">Title</label>
								<input type="text" class="form-control" name="page_content_title" id="page_content_title" placeholder="Title" value="<?php echo $page_content_array['page_content_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="page_content_content">Content</label>
								<textarea id="page_content_content" name="page_content" placeholder="Content" class="form-control" rows="12"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $page_content_array['page_content']); ?></textarea>
							</div>
						</div>
						<div class="box-footer text-center">
							<button id="edit_page_content_button" type="button" class="btn btn-primary" onclick="edit_page_content();" data-loading-text="Please Wait..">Update <i class="fa fa-chevron-right"></i></button>
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
								function edit_page_content() {
									$("edit_page_content_button").button('loading');
									$.post('', $("#edit_page_content_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = '';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_page_content_button").button('reset');
									});
								}
</script>