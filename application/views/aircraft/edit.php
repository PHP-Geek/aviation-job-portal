<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	.pdf_upload1{
		padding:10px;
		background-color:#F5F5F5;
	}
	.pdf_upload{
		padding:30px;
	}
	.btn-success{
		width:130px !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Aircraft <small>Edit Aircraft</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Aircraft</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Aircraft</h3>
                    </div>
                    <form id="edit_aircraft_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="aircraft_types_id" class="control-label">Aircraft Type</label>
								<input type="hidden" name="aircraft_types_id" value="<?php echo $aircraft_array['aircraft_types_id']; ?>">
								<select name="aircraft_types_id" id="aircraft_types_id" class="form-control select2_edit_aircraft" data-placholder="Aircraft Type" disabled="disabled">
									<option></option>
									<?php foreach ($aircraft_type_array as $aircraft_type) { ?>
										<option <?php
										if ($aircraft_array['aircraft_types_id'] === $aircraft_type['aircraft_type_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $aircraft_type['aircraft_type_id']; ?>"><?php echo $aircraft_type['aircraft_type_name']; ?></option>
										<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="aircraft_name" class="control-label">Aircraft Name</label>
								<input type="text" name="aircraft_name" id="aircraft_name" class="form-control" placeholder="Aircraft name" value="<?php echo $aircraft_array['aircraft_name']; ?>"/>
							</div>
							<div class="form-group">
								<label for="models_id" class="control-label">Model</label>
								<input type="text" readonly="readonly" value="<?php echo $aircraft_array['model_name']; ?>" class="form-control"/>
								<input type="hidden" name="models_id" value="<?php echo $aircraft_array['models_id']; ?>"/>
							</div>
							<div class="form-group">
								<label for="aircraft_year" class="control-label">Year</label>
								<select name="aircraft_year" class="form-control select2_edit_aircraft" data-placeholder="Aircraft Year">
									<option></option>
									<?php for ($i = 1950; $i <= 2025; $i++) { ?>
										<option <?php echo $i == $aircraft_array['aircraft_year'] ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="aircraft_price" class="control-label">Price</label>
								<input type="text" id="aircraft_price" name="aircraft_price" class="form-control" placeholder="Aircraft Price" value="<?php echo $aircraft_array['aircraft_price']; ?>"/>
							</div>
							<div class="form-group">
								<label for="aircraft_origination_date" class="control-label">Date of Origination</label>
								<div class="input-group date edit_aircraft_date_picker">
									<input type="text" id="aircraft_origination_date" class="form-control date-picker" name="aircraft_origination_date" placeholder="Date of Origination" value="<?php echo $aircraft_array['aircraft_origination_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($aircraft_array['aircraft_origination_date'])) : ''; ?>">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="aircraft_detail">About Aircraft</label>
								<textarea class="form-control" name="aircraft_detail" id="aircraft_details" rows="4"><?php echo str_replace(array('<br>', '<br />', '<br/>'), '', $aircraft_array['aircraft_detail']); ?></textarea>
							</div>
							<div class="form-group" id="pdf-container">
								<a title="" id="pdf_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-file-pdf-o"></i> Upload File</a>
								<label> Aircraft Sales Sheet (*.pdf)</label>
								<input type="hidden" name="aircraft_sales_sheet" id="aircraft_sales_sheet" value="<?php echo $aircraft_array['aircraft_sales_sheet']; ?>"/>
								<div class="text-center" id="pdf_uploaded">
									<?php if (is_file(FCPATH . 'uploads/aircrafts/sales_sheets' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_array['aircraft_sales_sheet'])) { ?>
										<a href="<?php echo base_url() . 'uploads/aircrafts/sales_sheets' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_array['aircraft_sales_sheet']; ?>" target="_blank" title="click to view" id="sales_sheet_link">
											<i class="fa fa-file-pdf-o fa-4x"></i>
										</a>
									<?php } ?>
								</div>
							</div>
							<hr/>
							<div class="form-group" id="thumbnail-container">
								<a title="" id="thumbnail_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="air"> Change Aircraft Thumbnail Image <abbr>(646 x 366) (*.jpg,.png 10 MB max)</abbr></label>
							</div>
							<div class="form-group text-center">
								<input type="hidden" name="aircraft_image" value="<?php echo $aircraft_array['aircraft_image']; ?>" id="aircraft_image">
								<a href="<?php echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_array['aircraft_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_array['aircraft_image']; ?>" style="max-width: 100px;max-height: 100px" id="aircraft_image_show"/>
								</a>
							</div>
							<div class="form-group" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image(s)</a>
								<label> Aircraft Images <abbr> (646 x 366) (*.jpg, .png) 4-12 images</abbr></label>
							</div>
							<ul id="uploaded_images" style="list-style-type: none;">
								<?php foreach ($aircraft_array['aircraft_images'] as $images) { ?>
									<li class="col-md-6"><a title="remove image" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><input type="hidden" name="aircraft_images[]" id="aircraft_images" value="<?php echo $images['aircraft_image_name']; ?>"><img alt="" class="img img-responsive" src="<?php echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $images['aircraft_image_name']; ?>" /></li>
								<?php } ?>
							</ul>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>aircraft" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_aircraft_button" type="button" class="btn btn-primary pull-right">Update <i class="fa fa-chevron-right"></i></button>
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
										$(".edit_aircraft_date_picker").datepicker({
											clearBtn: true,
											format: 'dd/mm/yyyy',
											autoclose: true,
											startView: 2,
											todayBtn: "linked"
										});
										$("#edit_aircraft_button").click(function () {
											$("#edit_aircraft_button").button("loading");
											$.post('', $("#edit_aircraft_form").serialize(), function (data) {
												if (data === '1') {
													bootbox.alert("Aircraft Update Successfully !!!", function () {
														document.location.href = base_url + 'aircraft';
													});
												} else if (data === '0') {
													bootbox.alert("Error Updating Data !!!");
												} else {
													bootbox.alert(data);
												}
												$("#edit_aircraft_button").button("reset");
											});
										});
</script>
<script type="text/javascript">
	$(function () {
		$(".select2_edit_aircraft").select2();
		var image_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "image_uploader",
			container: "image-container",
			url: base_url + 'aircraft/upload_files',
			resize: {
				width: 646,
				height: 366
			},
			chunk_size: '1mb',
			unique_names: true,
			flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
			silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
			multi_selection: true,
			filters: {
				max_file_size: '5mb',
				min_height: 366,
				min_width: 646,
				mime_types: [
					{title: "Image files", extensions: "jpg,jpeg,png"}
				]
			},
			init: {
				FilesAdded: function (up, files) {
					if (up.files.length > 12) {
						up.splice();
						bootbox.alert('You must upload atleast 4 images and maximum 12 images. !!!');
					} else {
						setTimeout(function () {
							up.start();
							$(window).block({message: 'Please wait...'});
						}, 1);
					}
				}, FileUploaded: function (up, file) {
					$("#uploaded_images").append('<li class="col-md-6"><a title="remove image" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><input type="hidden" name="aircraft_images[]" id="aircraft_images" value="' + file.target_name + '"><img alt="" class="img img-responsive" src="' + base_url + 'uploads/' + file.target_name + '" /></li>');
				},
				UploadComplete: function () {
					$(window).unblock();
				},
				Error: function (up, err) {
					$(window).unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
		var thumbnail_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "thumbnail_uploader",
			container: "thumbnail-container",
			url: base_url + 'aircraft/upload_files',
			resize: {
				width: 646,
				height: 366
			},
			chunk_size: '1mb',
			unique_names: true,
			flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
			silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
			multi_selection: false,
			filters: {
				max_file_size: '5mb',
				min_height: 366,
				min_width: 646,
				mime_types: [
					{title: "Image files", extensions: "jpg,jpeg,gif,png"}
				]
			},
			init: {
				FilesAdded: function (up, files) {
					if (thumbnail_uploader.files.length > 1) {
						thumbnail_uploader.removeFile(thumbnail_uploader.files[0]);
						$("#uploaded_images").empty();
					}
					setTimeout(function () {
						up.start();
						$(window).block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#aircraft_image").val(file.target_name);
					$("#aircraft_image_show").attr("src", base_url + "uploads/" + file.target_name);
					$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
				},
				UploadComplete: function () {
					$(window).unblock();
				},
				Error: function (up, err) {
					$(window).unblock();
					bootbox.alert(err.message);
				}
			}
		});
		thumbnail_uploader.init();
	});
	var pdf_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "pdf_uploader",
		container: "pdf-container",
		url: base_url + 'aircraft/upload_files',
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
		multi_selection: false,
		filters: {
			max_file_size: '5mb',
			mime_types: [
				{title: "Pdf files", extensions: "pdf"}
			]
		},
		init: {
			FilesAdded: function (up, files) {
				if (up.files.length > 1) {
					up.removeFile(up.files[0]);
					$("#pdf_uploaded").empty();
				}
				setTimeout(function () {
					$("#pdf_uploaded").empty();
					up.start();
					$(window).block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#aircraft_sales_sheet").val(file.target_name);
				$("#pdf_uploaded").append('<div class="row"><div class="col-md-3  col-md-offset-4"><div class="pdf_upload1"><a title="remove pdf" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><div class="pdf_upload"><a href="' + base_url + 'uploads/' + file.target_name + '" target="_blank"><i class="fa fa-file-pdf-o fa-4x"></i></a></div></div></div></div>');
			},
			UploadComplete: function () {
				$(window).unblock();
			},
			Error: function (up, err) {
				$(window).unblock();
				bootbox.alert(err.message);
			}
		}
	});
	pdf_uploader.init();
	plupload.addFileFilter('min_width', function (minwidth, file, cb) {
		var self = this, img = new o.Image();
		function finalize(result) {
			img.destroy();
			img = null;
			// if rule has been violated in one way or another, trigger an error
			if (!result) {
				self.trigger('Error', {
					code: plupload.IMAGE_DIMENSIONS_ERROR,
					message: "Image width should be atleast " + minwidth + " pixels.",
					file: file
				});
			}
			cb(result);
		}
		img.onload = function () {
			// check if resolution cap is not exceeded
			finalize(img.width >= minwidth);
		};
		img.onerror = function () {
			finalize(false);
		};
		img.load(file.getSource());
	});
	plupload.addFileFilter('min_height', function (minheight, file, cb) {
		var self = this, img = new o.Image();
		function finalize(result) {
			img.destroy();
			img = null;

			// if rule has been violated in one way or another, trigger an error
			if (!result) {
				self.trigger('Error', {
					code: plupload.IMAGE_DIMENSIONS_ERROR,
					message: "Image height should be atleast " + minheight + " pixels.",
					file: file
				});
			}
			cb(result);
		}
		img.onload = function () {
			// check if resolution cap is not exceeded
			finalize(img.height >= minheight);
		};
		img.onerror = function () {
			finalize(false);
		};
		img.load(file.getSource());
	});
</script>
