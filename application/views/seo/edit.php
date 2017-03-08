<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Page Description <small>Edit Page Description</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Page Description</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Page Description</h3>
                    </div>
                    <form id="edit_page_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="page_title" class="control-label">Page Title</label>
								<input type="text" name="page_title" id="page_title" class="form-control" placeholder="Page title" value="<?php echo $page_array['page_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="page_keyword">Keywords</label>
								<textarea placeholder="Keywords (separate by comma)" class="form-control" rows="3" name="page_keyword" id="page_keyword"><?php echo $page_array['page_keyword']; ?></textarea>
							</div>
							<div class="form-group">
								<label for="page_description">Description</label>
								<textarea id="page_description" name="page_description" placeholder="Description" class="form-control" rows="3"><?php echo $page_array['page_description']; ?></textarea>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>seo" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_page_button" type="button" class="btn btn-primary pull-right" onclick="edit_page();">Submit <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript">
								function edit_page() {
									$("#edit_page_button").button("loading");
									$.post('', $("#edit_page_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully', function () {
												document.location.href = base_url + 'seo';
											});
										} else if (data === '0') {
											bootbox.alert('Error Updating Details');
										} else {
											bootbox.alert(data);
										}
									});
								}
</script>

