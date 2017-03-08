<style>
	form{
		font-size:15px;
	}
	#marketing_email_send_date{
		height: 28px !important;
		margin-top: 2px !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Marketing Email Setup <small>Setup Marketing Email</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Marketing Email Setup</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
					<form id="marketing_email_form" method="post" action="" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 col-lg-4 col-sm-4">
										<label>Select Template </label>
									</div>
									<div class="col-md-8 col-lg-8 col-sm-8">
										<div class="row">
											<div class="col-md-3 col-lg-3">
												<input type="radio" name="marketing_email_template" id="marketing_email_template" value="1" checked="checked"/> Template 1
											</div>
											<div class="col-md-9 col-lg-9">
												<input type="radio" name="marketing_email_template" id="marketing_email_template" value="2"/> Template 2
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr/>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 col-lg-4 col-sm-4">
										<label>Send To </label>
									</div>
									<div class="col-md-8 col-lg-8 col-sm-8">
										<div class="row">
											<div class="col-md-3 col-lg-3">
												<input type="radio" name="send_to" id="send_to1" value="1" checked="checked"/> Specific Person
											</div>
											<div class="col-md-4 col-lg-4">
												<input type="radio" name="send_to" id="send_to2" value="2"/> Registered Emails
											</div>
											<div class="col-md-5 col-lg-5">
												<!--<input type="radio" name="send_to" id="send_to3" value="3"/> Subscribed User-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group" id="single_user_div">
								<div class="row">
									<div class="col-md-4 col-lg-4 col-sm-4">
										<label>Email </label>
									</div>
									<div class="col-md-8 col-lg-8 col-sm-8">
										<input type="text" name="marketing_email_sent_to_user" id="marketing_email_sent_to_user" class="form-control" placeholder="Enter Email"/>
									</div>
								</div>
							</div>
							<div class="form-group" id="category_div">
								<div class="row">
									<div class="col-md-4 col-lg-4 col-sm-4">
										<label>Select Category</label>
									</div>
									<div class="col-md-8 col-lg-8 col-sm-8">
										<select name="marketing_email_send_to" id="marketing_email_send_to" class="form-control" data-placeholder="Users Email Data">
											<option></option>
											<option value="users">Registered Users Data</option>
											<option value="crew_support">Crew Requests Data</option>
											<option value="aircraft_quotes">Charter Requests Data</option>
											<option value="contact_us_feeds">Contact Feeds Data</option>
											<!--<option value="5">All</option>-->
										</select>
									</div>
									<div class="col-md-1 col-lg-1"></div>
								</div>
							</div>
							<hr/>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 col-lg-4 col-sm-4"></div>
									<div class="col-md-8 col-lg-8 col-sm-8">
										<div class="row">
											<div class="col-md-3 col-lg-3 col-sm-3">
												<input type="radio" name="marketing_email_schedule" id="marketing_email_schedule1" checked="checked" value="1"/> Send Now
											</div>
											<div class="col-md-9 col-lg-9 col-sm-9">
												<input type="radio" name="marketing_email_schedule" id="marketing_email_schedule2" value="2"/> Schedule Emails
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="send_email_div">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4"><label>Sending Date</label></div>
										<div class="col-md-8 col-lg-8 col-sm-8">
											<div class="row">
												<div class="col-md-4 col-lg-4 col-sm-4">
													Date <select name="marketing_email_date">
														<option value="">DD</option>
														<?php
														for ($i = 1; $i <= 31; $i++) {
															if ($i < 10) {
																$i = '0' . $i;
															}
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-4 col-lg-4 col-sm-4">
													Month <select name="marketing_email_month">
														<option value="">MM</option>
														<?php
														for ($i = 1; $i <= 12; $i++) {
															if ($i < 10) {
																$i = '0' . $i;
															}
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-4 col-lg-4 col-sm-4">
													Year <select name="marketing_email_year">
														<option value="">YY</option>
														<?php
														for ($i = Date('Y'); $i <= Date('Y') + 20; $i++) {
															if ($i < 10) {
																$i = '0' . $i;
															}
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4 col-lg-4 col-sm-4"><label>Sending Time</label></div>
										<div class="col-md-8 col-lg-8 col-sm-8">
											<div class="row">
												<div class="col-md-4 col-lg-4 col-sm-4">
													Hour <select name="marketing_email_hour">
														<?php
														for ($i = 0; $i <= 24; $i++) {
															if ($i < 10) {
																$i = '0' . $i;
															}
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-4 col-lg-4 col-sm-4">
													Minutes <select name="marketing_email_minute">
														<?php
														for ($i = 0; $i <= 60; $i++) {
															if ($i < 10) {
																$i = '0' . $i;
															}
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-4 col-lg-4 col-sm-4">
													Seconds <select name="marketing_email_second">
														<?php
														for ($i = 0; $i <= 60; $i++) {
															if ($i < 10) {
																$i = '0' . $i;
															}
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr/>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 col-lg-4">
										<label>Send A Copy To MySelf</label>
									</div>
									<div class="col-md-8 col-lg-8">
										<input type="checkbox" name="marketing_email_send_to_admin" id="marketing_email_send_to_admin" value="1" checked="checked"/>
									</div>
								</div>
							</div>
							<div class="form-group" id="show_emails">
								<div class="row">
									<div class="col-md-6 col-lg-6 col-sm-10 col-md-offset-4 col-lg-offset-4 col-sm-offset-2">
										<div class="table-responsive">
											<table id="show_emails" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th><input type="checkbox" name="select_all_emails" id="select_all_emails"/> All</th>
														<th>Emails</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer text-center">
								<input type="button" id="marketing_email_button" class="btn btn-primary btn-lg" value="Submit"/>
							</div>
						</div>
					</form>
				</div>
			</div>
	</section>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
	$(function () {
		$("select").select2();
		$(".email_datepicker").datepicker({
			clearBtn: true,
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '+0d',
			startView: 2,
			todayBtn: "linked"});
		$("#category_div").css('display', 'none');
		$("#show_emails").css('display', 'none');
		$("#send_email_div").css('display', 'none');
	});
	$("#marketing_email_button").click(function () {
		if ($("#send_to2").is(':checked')) {
			if ($('input[name="select_email[]"]:checked').length) {
			} else {
				bootbox.alert("Please select atleast one user.");
				return false;
			}
		}
		bootbox.confirm("Send emails..?", function (result) {
			if (result) {
				$(window).block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Sending...'});
				$.post('', $("#marketing_email_form").serialize(), function (data) {
					if (data === '1') {
						bootbox.alert("Successful!", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error! Please Try Again.");
					} else {
						bootbox.alert(data);
					}
					$(window).unblock();
				});
			}
		});
	});
	$("#select_all_emails").change(function () {
		$('input[name="select_email[]"]').prop('checked', $(this).prop("checked"));
	});
	$("#marketing_email_send_to").on('change', function () {
		$("#marketing_email_form").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
		$.getJSON(base_url + 'email/get_emails_by_form_categories/' + $(this).val(), function (data) {
			$("#show_emails").css('display', 'block');
			$("#show_emails tbody").empty();
			$.each(data, function (i, v) {
				$("#show_emails tbody").append('<tr><td><input type="checkbox" name="select_email[]" id="select_email" value="' + v.email + '"/></td><td>' + v.email + '</td></tr>');
			});
			$("#marketing_email_form").unblock();
		});
	});
	$("#send_to1,#send_to2").change(function () {
		if ($(this).val() === '1') {
			$("#marketing_email_send_to").val('');
			$("#marketing_email_send_to").select2();
			$("#single_user_div").css('display', 'block');
			$("#category_div").css('display', 'none');
			$("#show_emails tbody").empty();
			$("#show_emails").css('display', 'none');
		} else if ($(this).val() === '2') {
			$("#single_user_div").css('display', 'none');
			$("#category_div").css('display', 'block');
		} else {
			$("#single_user_div").css('display', 'none');
			$("#category_div").css('display', 'none');
		}
	});
	$("#marketing_email_schedule1,#marketing_email_schedule2").change(function () {
		if ($(this).val() === '2') {
			$("#send_email_div").css('display', 'block');
		} else {
			$("#send_email_div").css('display', 'none');
		}
	});
</script>