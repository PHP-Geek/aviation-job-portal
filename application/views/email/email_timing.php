<?php
if ($configuration_email_from !== '') {
	$from = '1';
	$from_hour = explode(':', $configuration_email_from)[0];
	$from_min = explode(':', $configuration_email_from)[1];
	if (intval($from_hour) == '12') {
		$from = '2';
	}
	if (intval($from_hour) > 12) {
		$from_hour = intval($from_hour) - 12;
		$from_hour = '0' . $from_hour;
		$from = '2';
	}
	if (intval($from_hour) == '00') {
		$from_hour = "12";
	}
}
if ($configuration_email_to !== '') {
	$to = '1';
	$to_hour = explode(':', $configuration_email_to)[0];
	$to_min = explode(':', $configuration_email_to)[1];
	if (intval($to_hour) == '12') {
		$to = '2';
	}
	if (intval($to_hour) > 12) {
		$to_hour = intval($to_hour) - 12;
		$to_hour = '0' . $to_hour;
		$to = '2';
	}
	if (intval($to_hour) == '00') {
		$to_hour = "12";
	}
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Set Email Timing <small>set sending email timing</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li><li>Email Timing</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Set Sending Email Timing (For Employer)</h3>
					</div>
                    <form id="set_time_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="configuration_email_from_hour" class="control-label">From</label>
										<div class="row">
											<div class="col-md-4">

												<select class="form-control search_license_type" name="configuration_email_from_hour" id="configuration_email_from">
													<?php for ($i = 1; $i < 13; $i++) { ?>
														<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php echo ($from_hour === str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected="selected"' : '' ?>><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
													<?php } ?>										
												</select>
											</div>
											<div class="col-md-4">

												<select class="form-control search_license_type" name="configuration_email_from_min" id="configuration_email_from1" data-placeholder="Start minute">
													<?php for ($i = 0; $i < 60; $i++) { ?>
														<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php echo ($from_min === str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected="selected"' : '' ?>><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-4">												<select class="form-control search_license_type" name="configuration_email_from" id="configuration_email_from1" data-placeholder="Start minute">
													<option value="1" <?php echo ($from === '1') ? 'selected="selected"' : ''; ?>> a.m.</option>
													<option value="2" <?php echo ($from === '2') ? 'selected="selected"' : ''; ?>> p.m.</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="configuration_email_to_hour" class="control-label">To</label>
										<div class="row">
											<div class="col-md-4">
												<select class="form-control search_license_type" name="configuration_email_to_hour" id="configuration_email_to" data-placeholder="End Time">
													<?php for ($i = 1; $i < 13; $i++) { ?>
														<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php echo ($to_hour === str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected="selected"' : '' ?>><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-4">
												<select class="form-control search_license_type" name="configuration_email_to_min" id="configuration_email_to" data-placeholder="End Time">
													<?php for ($i = 0; $i < 60; $i++) { ?>
														<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php echo ($to_min === str_pad($i, 2, "0", STR_PAD_LEFT)) ? 'selected="selected"' : '' ?>><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-4">												<select class="form-control search_license_type" name="configuration_email_to" id="configuration_email_from1" data-placeholder="Start minute">
													<option value="1" <?php echo ($to === '1') ? 'selected="selected"' : ''; ?>> a.m.</option>
													<option value="2" <?php echo ($to === '2') ? 'selected="selected"' : ''; ?>> p.m.</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer text-center">
							<button id="set_time_button" type="button" class="btn btn-primary pull-right" <?php echo ($configuration_email_status !== '1') ? 'disabled' : '' ?>>Set Timing <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#set_time_button").click(function () {
		$("#set_time_button").button('loading');
		$.post('', $("#set_time_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Timing has been Set Successfully", function () {
					document.location.href = base_url + 'email/email_timing';
				});
			} else if (data === '0') {
				bootbox.alert("Error Setting Time for Sending Email.");
			} else {
				bootbox.alert(data);
			}
			$("#set_time_button").button('reset');
		});
	});
	function change_process_status() {
		var process_status = $('#set_timing_process_status').is(':checked') === true ? '1' : '0';
		console.log(process_status);
		$.post(base_url + 'email/change_configuration', {configuration_id: '3', configuration_email_status: process_status}, function (data) {
			if (data === '1') {
				if (process_status === '1') {
					bootbox.alert('Set Timing Process Activated Successfully.', function () {
						document.location.href = '';
					});
				} else {
					bootbox.alert('Set Timing Process Deactivated Successfully.', function () {
						document.location.href = '';
					});
				}
			} else if (data === '0') {
				bootbox.alert('Error Updating Process');
			} else {
				bootbox.alert(data);
			}
		});
	}
</script>
