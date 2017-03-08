<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Social Media Setup<small>Social Media Setup</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Social Media Setup</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Social Media Setup</h3>
                    </div>
                    <form id="social_media_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<?php foreach ($social_media_link_array as $key => $social_media) { ?>
								<input type="hidden" name="social_media_link_id[]" value="<?php echo $social_media['social_media_link_id']; ?>"/>
								<div class="form-group">
									<label for="social_media_link_name"><?php echo $social_media['social_media_link_name']; ?></label>
									<div class="row">
										<div class="col-md-7">
											<div class="col-sm-3 text-center">
												Link <?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>1 <?php } ?>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="social_media_link_url[]" id="social_media_login" value="<?php echo $social_media['social_media_link_url']; ?>" placeholder="<?php echo $social_media['social_media_link_name']; ?> URL"/>
											</div>
										</div>
										<div class="col-md-5">
											<div class="col-sm-3 text-center">
												Title <?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>1 <?php } ?>
											</div>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="social_media_link_title[]" id="social_media_login" value="<?php echo $social_media['social_media_link_title']; ?>" placeholder="<?php echo $social_media['social_media_link_name']; ?> Title"/>
											</div>
										</div>
									</div>
									<?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>
										<div class="row">
											<div class="col-md-7">
												<div class="col-sm-3 text-center">
													Link <?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>2 <?php } ?>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="social_media_link_url1[]" id="social_media_login" value="<?php echo $social_media['social_media_link_url1']; ?>" placeholder="<?php echo $social_media['social_media_link_name']; ?> URL"/>
												</div>
											</div>
											<div class="col-md-5">
												<div class="col-sm-3 text-center">
													Title <?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>2 <?php } ?>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="social_media_link_title1[]" id="social_media_login" value="<?php echo $social_media['social_media_link_title1']; ?>" placeholder="<?php echo $social_media['social_media_link_name']; ?> Title"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-7">
												<div class="col-sm-3 text-center">
													Link <?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>3 <?php } ?>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="social_media_link_url2[]" id="social_media_login" value="<?php echo $social_media['social_media_link_url2']; ?>" placeholder="<?php echo $social_media['social_media_link_name']; ?> URL"/>
												</div>
											</div>
											<div class="col-md-5">
												<div class="col-sm-3 text-center">
													Title <?php if (in_array($social_media['social_media_link_id'], array('2'))) { ?>3 <?php } ?>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="social_media_link_title2[]" id="social_media_login" value="<?php echo $social_media['social_media_link_title2']; ?>" placeholder="<?php echo $social_media['social_media_link_name']; ?> Title"/>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
						<div class="box-footer text-center">
							<button id="social_media_link_button" type="button" class="btn btn-primary btn-lg" onclick="social_media_link_update();" data-loading-text="Please Wait..">Update</button>
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
								function social_media_link_update() {
									$("social_media_link_button").button('loading');
									$.post('', $("#social_media_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = '';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("social_media_link_button").button('reset');
									});
								}
</script>