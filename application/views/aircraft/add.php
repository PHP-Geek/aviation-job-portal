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
        <h1>Add Aircraft For Sale</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Aircraft</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Aircraft For Sale</h3>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_aircraft_type_modal"><i class="fa fa-plus-circle"></i> Add Aircraft Type</button>
                    </div>
                    <form id="add_aircraft_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="aircraft_types_id" class="control-label">Aircraft Type</label>
                                <select name="aircraft_types_id" id="aircraft_types_id"  class="form-control select2_add_aircraft" data-placeholder="Aircraft Type">
                                    <option></option>
                                    <?php foreach ($aircraft_type_array as $aircraft_type) { ?>
                                        <option value="<?php echo $aircraft_type['aircraft_type_id']; ?>"><?php echo $aircraft_type['aircraft_type_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="manufacturers_id" class="control-label">Manufacturer</label>
                                <select name="manufacturers_id" id="manufacturers_id"  class="form-control select2_add_aircraft" data-placeholder="Manufacturer">
                                    <option></option>
                                    <?php foreach ($manufacturer_array as $manufacturer) { ?>
                                        <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['manufacturer_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="models_id" class="control-label">Model</label>
                                <select id="models_id" name="models_id"  class="form-control select2_add_aircraft" data-placeholder="Model">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="aircraft_name" class="control-label">Aircraft Name</label>
                                <input type="text" name="aircraft_name" id="aircraft_name" class="form-control" placeholder="Aircraft name" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="aircraft_year" class="control-label">Year</label>
                                <select name="aircraft_year" class="form-control select2_add_aircraft" data-placeholder="Aircraft Year">
                                    <option></option>
                                    <?php for ($i = 1950; $i <= 2025; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="aircraft_price" class="control-label">Price</label>
                                <input type="text" id="aircraft_price" name="aircraft_price" class="form-control" placeholder="Aircraft Price"/>
                            </div>
                            <div class="form-group">
                                <label for="aircraft_origination_date" class="control-label">Date of Origination</label>
                                <div class="input-group date add_aircraft_date_picker">
                                    <input type="text" id="aircraft_origination_date" class="form-control date-picker" name="aircraft_origination_date" placeholder="Date of Origination">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aircraft_detail">About Aircraft</label>
                                <textarea class="form-control" name="aircraft_detail" id="aircraft_details" rows="4" placeholder="Aircraft Details Here.."></textarea>
                            </div>
                            <div class="form-group" id="thumbnail-container">
                                <a title="" id="thumbnail_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
                                <label> Aircraft Thumbnail Image (646 x 366) (*.jpg,.png 10 MB max) </label>
                                <ul id="uploaded_thumbnail" class="col-md-12 col-lg-12 text-center" style="list-style-type: none;"></ul>
                            </div>
                            <hr/>
                            <div class="form-group" id="pdf-container">
                                <a title="" id="pdf_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-file-pdf-o"></i> Upload File</a>
                                <label> Aircraft Sales Sheet (*.pdf)</label>
                            </div>
                            <div id="uploaded_pdf"></div>
                            <hr/>
                            <div class="form-group" id="image-container">
                                <a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image(s)</a>
                                <label> Aircraft Images <abbr> (646 x 366) (*.jpg, .png 10 MB max) 4-12 images</abbr></label>
                            </div>
                            <ul id="uploaded_images" style="list-style-type: none;"></ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="<?php echo base_url(); ?>aircraft" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
                            <button id="add_aircraft_button" type="button" class="btn btn-primary pull-right">Add Aircraft <i class="fa fa-angle-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="add_aircraft_type_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Aircraft Type</h4>
            </div>
            <div class="modal-body">
                <form id="add_aircraft_type_form" method="post" action="" class="form-group">
                    <div class="form-group">
                        <label for="aircraft_type_name">Aircraft Type</label>
                        <input type="text" name="aircraft_type_name" id="aircraft_type_name" placeholder="Aircraft Type" class="form-control"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Cancel</button>
                <button type="button" id="add_aircraft_type_button" class="btn btn-primary"> Submit <i class="fa fa-chevron-right"></i></button>
            </div>
        </div>

    </div>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
    $(".add_aircraft_date_picker").datepicker({
        clearBtn: true,
        format: 'dd/mm/yyyy',
        autoclose: true,
        startView: 2,
        todayBtn: "linked"
    });
    $("#add_aircraft_button").click(function () {
        $("#add_aircraft_button").button("loading");
        $.post('', $("#add_aircraft_form").serialize(), function (data) {
            if (data === '1') {
                bootbox.alert("Aircraft Added Successfully !!!", function () {
                    document.location.href = base_url + 'aircraft';
                });
            } else if (data === '0') {
                bootbox.alert("Error Saving Data !!!");
            } else {
                bootbox.alert(data);
            }
            $("#add_aircraft_button").button("reset");
        });
    });
    $("#add_aircraft_type_button").click(function () {
        $("#add_aircraft_type_button").button('loading');
        $.post(base_url + "aircraft/add_type", $("#add_aircraft_type_form").serialize(), function (data) {
            if (data === '1') {
                bootbox.alert("Aircraft Type Added Successfully", function () {
                    document.location.href = base_url + 'aircraft';
                });
            } else if (data === '0') {
                bootbox.alert("Error Adding Aircraft Type.");
            } else {
                bootbox.alert(data);
            }
            $("#add_aircraft_type_button").button('reset');
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $(".select2_add_aircraft").select2();
        $("#models_id").select2({
            placeholder: "Select Model"
        });
        $("#manufacturers_id").on('change', function () {
            $.post(base_url + 'aircraft/get_models_by_aircraft_id', {manufacturers_id: $("#manufacturers_id").val()}, function (model_data) {
                $("#models_id").empty();
                $("#models_id").append('<option></option');
                for (var i = 0; i < model_data.length; i++) {
                    $("#models_id").append('<option value=' + model_data[i].model_id + '>' + model_data[i].model_name + '</option>');
                }
            });
        });
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
                max_file_size: '10mb',
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
                },
                FileUploaded: function (up, file) {
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
                height: 366,
                width: 646
            },
            chunk_size: '1mb',
            unique_names: true,
            flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
            silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
            filters: {
                max_file_size: '10mb',
                min_height: 366,
                min_width: 646,
                mime_types: [
                    {title: "Image files", extensions: "jpg,jpeg,png"}
                ]
            },
            init: {
                FilesAdded: function (up, files) {
                    if (up.files.length > 1) {
                        up.removeFile(up.files[0]);
                        $("#uploaded_thumbnail").empty();
                    }
                    setTimeout(function () {
                        up.start();
                        $(window).block({message: 'Please wait...'});
                    }, 1);
                },
                FileUploaded: function (up, file) {
                    $("#uploaded_thumbnail").append('<li><div class="col-md-4 pull-right"><a title="remove image" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><input type="hidden" name="aircraft_image" id="aircraft_image" value="' + file.target_name + '"><img alt="" class="img img-responsive" src="' + base_url + 'uploads/' + file.target_name + '" style="max-width:130px;max-height:120px;" /></div></li>');
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
                        $("#uploaded_pdf").empty();
                    }
                    setTimeout(function () {
                        up.start();
                        $(window).block({message: 'Please wait...'});
                    }, 1);
                },
                FileUploaded: function (up, file) {
                    $("#uploaded_pdf").append('<div class="row"><div class="col-md-3  col-md-offset-4"><div class="pdf_upload1"><a title="remove pdf" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><input type="hidden" name="aircraft_sales_sheet" id="aircraft_sales_sheet" value="' + file.target_name + '"><div class="pdf_upload"><a href="' + base_url + 'uploads/' + file.target_name + '" target="_blank"><i class="fa fa-file-pdf-o fa-4x"></i></a></div></div></div></div>');
                },
                UploadComplete: function () {
                    $(window).unblock();
                },
                Error: function (up, err) {
                    $('#add_aircraft_form').unblock();
                    bootbox.alert(err.message);
                }
            }
        });
        pdf_uploader.init();
    });
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
