<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Terms and Conditions Page Setup</h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Terms and Conditions Setup</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update Terms and Conditions Content</h3>
                    </div>
                    <form id="term_condition_edit_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label>Page</label>
								<select name="page_id" id="page_id" class="form-control select2_edit_profile" data-placeholder="Page">
									<?php foreach ($all_term_array as $term) { ?>
										<option value="<?php echo $term['page_id']; ?>"><?php echo $term['page_title']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Content</label>
								<textarea id="page_content" name="page_content" placeholder="Content" class="form-control" rows="15"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $terms_array['page_content']); ?></textarea>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_about_us" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_terms_button" type="button" class="btn btn-primary pull-right" onclick="edit_terms();">Update <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript">
								$(function () {
									$("select").select2();
									CKEDITOR.replace('page_content');
								});
								$("#page_id").on('change', function () {
									$("form").block({'message': 'Please Wait...'});
									$.post(base_url + 'page/get_term_and_condition_by_page_id', {page_id: $("#page_id").val()}, function (data) {
										CKEDITOR.instances.page_content.setData(data.page_content);
										$("form").unblock();
									});
								})
								function edit_terms() {
									$("#edit_terms_button").button('loading');
									var page_content = CKEDITOR.instances.page_content.getData();
									$.post('', {page_id: $("#page_id").val(), page_content: page_content}, function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = '';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("#edit_terms_button").button('reset');
									});
								}
</script>