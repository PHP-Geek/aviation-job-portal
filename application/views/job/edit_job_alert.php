<style type="text/css">
    #edit_job_alert_form .select2-container {
        padding:0;
        border:none;
    }
    #edit_job_alert_form .select2-choice,#job_alert_form .select2-default {
        min-height:34px !important;
        padding-top:3px;
    }
    .has-error .select2-choice.select2-default {
        border: 1px solid red !important;
        border-radius:5px;
    }
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Edit Job Alert</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="little-banner-text">
                    <h1><span style="font-weight: 500">Edit Job alert</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="well spaceup-20">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-md-offset-1">
				<h3>Update Job Alert</h3>
			</div>
		</div>
		<hr/>
        <div class="row">
            <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
                <form id="edit_job_alert_form" method="post" action="" role="form" class="form-horizontal">
                    <div class="edit_job_alert">
                        <div class="form-group">
                            <label for="job_title" class="col-sm-4 control-label">Keywords</label>
                            <div class="col-sm-8 place-error">
                                <input type="text" id="keywords" class="form-control" name="keywords" placeholder="Keyword" value="<?php echo $job_alert_array['job_alert_keyword']; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_title" class="col-sm-4 control-label">Positions</label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control" id="position" name="position" data-placeholder="Select Position">
									<?php
									foreach ($job_type_array as $job_type) {
										?><option <?php echo $job_type['job_type_id'] === $job_alert_array['job_types_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $job_type['job_type_id']; ?>"><?php echo $job_type['job_type_name']; ?> </option><?php
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_title" class="col-sm-4 control-label">Role</label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control" id="role" name="role" >

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_title" class="col-sm-4 control-label">Location</label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control" id="location" name="location" >
									<?php
									foreach ($job_locations as $job_countries) {
										?>
										<option <?php echo $job_countries['country_id'] === $job_alert_array['countries_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $job_countries['country_id']; ?>">
											<?php echo $job_countries['country_name']; ?></option>
									<?php }
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="job_title" class="col-sm-4 control-label">Company(s)</label>
							<div class="col-sm-8 place-error">
								<select class="form-control" id="company" name="company" data-placeholder="Select Company">
									<?php foreach ($job_alert_company_array as $key => $company) { ?>
										<option <?php
										if ($key == $job_alert_array['job_alert_company']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $key; ?>"><?php echo $company; ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group" id="other_company_div">
							<label for="job_title" class="col-sm-4 control-label">Other Company Name</label>
							<div class="col-sm-8 place-error">
								<input type="text" id="other_company" class="form-control" name="company_name" placeholder="Company Name" value="<?php echo $job_alert_array['job_alert_other_company']; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="job_title" class="col-sm-4 control-label">Employment Type</label>
							<div class="col-sm-8 place-error">
								<select class="form-control" id="employment_type" name="employment_type">
									<?php foreach ($job_alert_employment_array as $key => $employment) { ?>
										<option <?php
										if ($key == $job_alert_array['job_alert_employment_type']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $key; ?>"><?php echo $employment; ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="spacer9"></div>
						<div class="spacer9"></div>
						<div class="form-group">
							<div class="col-md-offset-5 col-md-9">
								<a href="<?php echo base_url(); ?>job-alerts" class="btn btn-success">Cancel <i class="fa fa-plane"></i></a>
								<button id="edit_job_alert_button" class="btn btn-success" data-loading-text="Please wait......." type="submit">Update Job <i class="fa fa-plane"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('select').select2({allowClear: true});
		var position_id = $('#position').val();
		$.post(base_url + 'job/get_role_by_position', {position: position_id}, function (data) {
			var now = new Date();
			for (var i = 0; i < data.length; i++) {
				//data[i].position_id
				$("#role").append('<option value="' + data[i].position_id + '">' + data[i].position_name + '</option>');
			}
			$('#role').select2('val', '<?php echo $job_alert_array['positions_id']; ?>');
		});
	});
	$(function () {
		if ($('#company').val() === '2') {
			$("#other_company_div").css({display: "block"});
		} else {
			$("#other_company_div").css({display: "none"});
		}
		$("#company").on('change', function () {
			if ($(this).val() === '2') {
				$("#other_company_div").css({display: "block"});

			} else {
				$("#other_company_div").css({display: "none"});
				$('#other_company').val('');
			}
		});
		$('#position').change(function () {
			$('#role').select2('val', '');
			$('#role').empty();
			var position_id = $(this).val();
			$.post(base_url + 'job/get_role_by_position', {position: position_id}, function (data) {
				for (var i = 0; i < data.length; i++) {
					//data[i].position_id
					$("#role").append('<option  value="' + data[i].position_id + '">' + data[i].position_name + '</option>');
				}
			});
		});
		$("#edit_job_alert_form").validate({
			errorElement: 'span',
			errorClass: 'help-block pull-right',
			focusInvalid: true, ignore: null,
			rules: {
				keywords: {
					required: true
				},
				position: {
					required: true
				},
				company: {
					required: true
				},
				company_name: {
					required: {
						depends: function (element) {
							return $("#company").val() == '2';
						}
					}
				}
			},
			messages: {
				keywords: {
					required: "Please enter keyword"
				},
				position: {
					required: "Please select position"
				},
				company: {
					required: "Please select company name"
				},
				company_name: {
					required: "Please enter company name"
				}
			},
			highlight: function (element) {
				$(element).closest('.form-group div').addClass('has-error .place-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group div').removeClass('has-error');
			},
			success: function (element) {
				$(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').children('span.help-block').remove();
			},
			errorPlacement: function (error, element) {
				error.appendTo(element.closest('.form-group div'));
			},
			submitHandler: function (form) {
				$("#edit_job_alert_button").button("loading");
				$.post('', $("#edit_job_alert_form").serialize(), function (data) {
					if (data === '1') {
						bootbox.alert('Job Alert Updated Successfully.', function (data) {
							document.location.href = base_url + 'job-alerts';
						});
					} else if (data === '0') {
						bootbox.alert("Error update Job Alert");
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	});
</script>