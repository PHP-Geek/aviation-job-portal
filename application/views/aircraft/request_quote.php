<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	.has-error .select2-container--default .select2-selection--single {
		border: 1px solid red !important;
		border-radius:5px;
	}
	#country_code
	{
		vertical-align:top;
		background-color:#F5F5F5;
		text-align:left;
	}
	#country_code.has-error  .select2-container {
		width:100% !important;
	}
	.request_quote_form_buttons{
		width:115px;
	}
	.has-error #aircraft_quote_phone
	{
		border-radius:5px;
	}
	.h3, h3 {
		font-size: 20px;
	}
	label {
		font-size: 11px;
	}
	.form-control::-moz-placeholder {
		font-size:11px;
	}
	.select2-container--default .select2-selection--single .select2-selection__placeholder {
		font-size: 11px;
	}
	@media (max-width:420px)
	{
		#country_code
		{
			float:left;
			width:100%;
		}
		#country_code .select2-container--default
		{
			text-align:left;
			width:100% !important;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>our-services">Our Services</a></li>
                    <li><a href="<?php echo base_url() . 'aircraft-charter'; ?>">Aircraft Charter</a></li>
					<?php echo isset($form_title) ? '<li>' . $form_title . '</li>' : ''; ?>
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
                    <h1><span style="font-weight: 500"><?php echo isset($title) ? $title : '';
					?></span></h1>
                    <p><?php if ($form_title === 'Private Charter') { ?>InCrew’s private charter service encompasses private jets, airliners, specialist aircraft and helicopters primarily for VIP’s, corporate executives, celebrities, patients and government officials.
						<?php }if ($form_title === 'Airline Charter') { ?>
							Group charters comprise of regional airlines, corporate jets and larger airlines for clients including corporate executives, VIP’s, entertainers, celebrities, sports teams, agencies, government officials, tour operators and blue chip companies.
						<?php }if ($form_title === 'Cargo Charter') { ?>
							At InCrew, cargo charter is catered for urgent package deliveries, hand carriages, dangerous goods transportation, fragile, small, heavy and oversize package delivery as well as general delivery to remote and convenient locations worldwide.
						<?php } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "well spaceup-20">
		<form method = "post" id="add_aircraft_quote_form" role = "form" action = "" class="form-horizontal">
			<div class = "row">
				<div class = "col-md-12 col-lg-12">
					<h3><?php echo isset($title) ? $title : '';
						?></h3>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
					<div class="register">
						<div class="form-group">
							<label for="aircraft_quote_company_name" class="col-sm-4 control-label">Company Name</label>
							<div class="col-sm-8 place-error">
								<input type="text" class="form-control" id="aircraft_quote_company_name" placeholder="Company Name" name="aircraft_quote_company_name" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_first_name" class="col-sm-4 control-label">First Name</label>
							<div class="col-sm-8 place-error">
								<input type="text" class="form-control" id="aircraft_quote_first_name" name="aircraft_quote_first_name" placeholder="Name" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_last_name" class="col-sm-4 control-label">Last Name <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<input type="text" class="form-control" id="aircraft_quote_last_name" name="aircraft_quote_last_name"  placeholder="Last Name" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_email" class="col-sm-4 control-label">Email <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<input type="email" class="form-control" id="aircraft_quote_email" name="aircraft_quote_email" placeholder="Email" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_phone_number" class="col-sm-4 control-label">Contact Number <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<div class="input-group">
									<div class="input-group-addon" id="country_code" style="border:none;padding:0">
										<select name="aircraft_quote_country_code" id="aircraft_quote_country_code" class="select2_request_quote" data-placeholder="Country Code">
											<option></option>
											<?php
											foreach ($country_array as $country) {
												if ($country['country_code'] != '') {
													echo '<option value="' . $country['country_code'] . '">' . $country['country_name'] . '(' . $country['country_code'] . ')' . '</option>';
												}
											}
											?>
										</select>
									</div>
									<input type="text" class="form-control" id="aircraft_quote_phone" name="aircraft_quote_phone" placeholder="Contact Number">
								</div>
							</div>
						</div>
						<?php if ($title !== 'Cargo Charter Request') { ?>
							<div class="form-group">
								<label for="aircraft_quote_passengers" class="col-sm-4 control-label">Number of Passengers</label>
								<div class="col-sm-8 place-error">
									<input type="text" id="aircraft_quote_passengers" name="aircraft_quote_passengers" placeholder="No of Passengers" class="form-control" autocomplete="off" value="<?php echo isset($aircraft_charter_array['aircraft_passengers']) ? $aircraft_charter_array['aircraft_passengers'] : ''; ?>"/>
								</div>
							</div>
						<?php } ?>
						<?php if ($title !== 'Cargo Charter Request') { ?>
							<div class="form-group">
								<label for="charter_type" class="col-sm-4 control-label">Cargo</label>
								<div class="col-sm-8 place-error">
									<input type="checkbox" value="Cargo" name="charter_type" id="cargo_charter_type"/>
								</div>
							</div>
						<?php } ?>
						<div class="form-group" id="cargo_size_div">
							<label for="aircraft_quote_cargo_size" class="col-sm-4 control-label">Size of Cargo </label>
							<div class="col-sm-8 place-error">
								<input type="text" name="aircraft_quote_cargo_size" id="aircraft_quote_cargo_size" class="form-control" placeholder="eg: 1m x 2m x 1.5m">
							</div>
						</div>
						<div class="form-group" id="cargo_weight_div">
							<label for="aircraft_quote_cargo_weight" class="col-sm-4 control-label">Weight of Cargo </label>
							<div class="col-sm-8 place-error">
								<input type="text" name="aircraft_quote_cargo_weight" id="aircraft_quote_cargo_weight" class="form-control" placeholder="eg: 600 Kg">
							</div>
						</div>
						<div class="form-group" id="cargo_dangerous_goods_div">
							<label for="aircraft_quote_dangerous_goods" class="col-sm-4 control-label">Dangerous Goods </label>
							<div class="col-sm-8 place-error">
								<input type="checkbox" name="aircraft_quote_is_dangerous_good" id="aircraft_quote_is_dangerous_good">
							</div>
						</div>
						<div class="form-group" id="cargo_dangerous_goods_div1">
							<label for="aircraft_quote_dangerous_good" class="col-sm-4 control-label">Describe the Dangerous good</label>
							<div class="col-sm-5 place-error">
								<textarea name="aircraft_quote_dangerous_good" id="aircraft_quote_dangerous_good" class="form-control" placeholder="Describe the Dangerous good" rows="2"></textarea>
							</div>
							<div class="col-sm-3">
								<a href="<?php echo base_url(); ?>aircraft/download_dangerous_good_pdf" target="_blank"><i class="fa fa-file-pdf-o"></i> Dangerous Goods Explained</a>
							</div>
						</div>
						<?php if ($title === 'Cargo Charter Request') { ?>
							<div class="form-group">
								<label for="aircraft_quote_passengers" class="col-sm-4 control-label">Number of Passengers</label>
								<div class="col-sm-8 place-error">
									<input type="text" id="aircraft_quote_passengers" name="aircraft_quote_passengers" placeholder="No of Passengers" class="form-control" autocomplete="off" value="<?php echo isset($aircraft_charter_array['aircraft_passengers']) ? $aircraft_charter_array['aircraft_passengers'] : ''; ?>"/>
								</div>
							</div>
						<?php } ?>
						<div class="form-group">
							<label for="aircraft_quote_departure_city" class="col-sm-4 control-label">Departure City <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<input type="text" class="form-control" id="aircraft_quote_departure_city" name="aircraft_quote_departure_city" placeholder="Departure City" value="<?php echo isset($aircraft_charter_array['aircraft_departure_city']) ? $aircraft_charter_array['aircraft_departure_city'] : ''; ?>" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_arrival_city" class="col-sm-4 control-label">Arrival City <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<input type="text" class="form-control" id="aircraft_quote_arrival_city" name="aircraft_quote_arrival_city" placeholder="Arrival City" value="<?php echo isset($aircraft_charter_array['aircraft_destination_city']) ? $aircraft_charter_array['aircraft_destination_city'] : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_departure_date" class="col-sm-4 control-label">Departure Date <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<span class="input-group date datepicker_request_quote" id="departure_date">
									<input type='text' class="form-control" id="aircraft_quote_departure_date" name="aircraft_quote_departure_date" placeholder="Departure Date" value="<?php echo isset($aircraft_charter_array['aircraft_departure_date']) ? $aircraft_charter_array['aircraft_departure_date'] : ''; ?>" autocomplete="off"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_return_date" class="col-sm-4 control-label">Return Date</label>
							<div class="col-sm-8 place-error">
								<div class='input-group date' id="return_date">
									<input type='text' class="form-control" id="aircraft_quote_return_date" name="aircraft_quote_return_date" placeholder="Return Date" autocomplete="off"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="my_aircrafts_id" class="col-sm-4 control-label">Your Aircraft of Choice</label>
							<div class="col-sm-8 place-error">
								<select id="charter_aircrafts_id" class="form-control select2_request_quote" name="charter_aircrafts_id" data-placeholder="Aircraft of Choice">
									<option></option>
									<?php foreach ($charter_aircraft_array as $aircraft) { ?>
										<option value="<?php echo $aircraft['charter_aircraft_id']; ?>"><?php echo $aircraft['charter_aircraft_name']; ?></option>
									<?php } ?>
									<option value="0">Specific Aircraft Request</option>
								</select>
							</div>
						</div>
						<div class="form-group" id="my_aircraft_div" style="display:none">
							<label for="my_aircrafts_id" class="col-sm-4 control-label">Aircraft</label>
							<div class="col-sm-8 place-error">
								<select id="my_aircrafts_id" class="form-control select2_request_quote" name="my_aircrafts_id" data-placeholder="Aircraft">
									<option></option>
									<?php foreach ($my_aircraft_array as $my_aircraft) {
										if ($my_aircraft['my_aircraft_category'] !== 'MILITARY & WARBIRDS') {
											?>
											<option value="<?php echo $my_aircraft['my_aircraft_id']; ?>"><?php echo $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name']; ?></option>
	<?php }
} ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="aircraft_quote_additional_requirements" class="col-sm-4 control-label">Additional Requests/Requirements</label>
							<div class="col-sm-8 place-error">
								<textarea id="aircraft_quote_additonal_requirements" name="aircraft_quote_requirements" class="form-control" rows="3" placeholder="Additional Requests/Requirements"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<button type="submit" name="aircraft_add_quote_button" id="aircraft_add_quote_button" class="btn btn-success request_quote_form_buttons">Submit <span class="fa fa-plane"></span></button>
						&nbsp; &nbsp;
						<button type="reset" id="form_reset" class="btn btn-success request_quote_form_buttons">Reset <span class="fa fa-plane"></span></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
	$("#form_reset").click(function () {
		$("input").val('');
		$("select ,textarea").val('');
		$("select").select2({allowClear: true});
	});
	$("#charter_aircrafts_id").on('change', function () {
		if ($("#charter_aircrafts_id").val() === '0') {
			$("#my_aircraft_div").show();
		} else {
			$("#my_aircraft_div").hide();
		}
	});
	$(function () {
		setTimeout(function () {
			$("#cargo_size_div").css('display', 'none');
			$("#cargo_weight_div").css('display', 'none');
			$("#cargo_dangerous_goods_div").css('display', 'none');
			$("#cargo_dangerous_goods_div1").css('display', 'none');
			var href = location.href;
			if (href.substr(href.lastIndexOf('/') + 1) == "cargo-charter") {
				$("#cargo_size_div").css('display', 'block');
				$("#cargo_weight_div").css('display', 'block');
				$("#cargo_dangerous_goods_div").css('display', 'block');
			}
		}, 100);
		$("#departure_date").datepicker({
			clearBtn: true,
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '+0d',
			startView: 2,
			todayBtn: "linked"
		});
		$("#return_date").datepicker({
			clearBtn: true,
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '+0d',
			startView: 2,
			todayBtn: "linked"
		});
		$("#cargo_charter_type").on('change', function () {
			if ($("#cargo_charter_type").is(':checked')) {
				$("#cargo_size_div").css('display', 'block');
				$("#cargo_weight_div").css('display', 'block');
				$("#cargo_dangerous_goods_div").css('display', 'block');
			} else {
				$("#cargo_size_div").css('display', 'none');
				$("#cargo_weight_div").css('display', 'none');
				$("#cargo_dangerous_goods_div").css('display', 'none');
			}
		});
		$("#aircraft_quote_is_dangerous_good").on('change', function () {
			if ($("#aircraft_quote_is_dangerous_good").is(':checked')) {
				$("#cargo_dangerous_goods_div1").css('display', 'block');
			} else {
				$("#cargo_dangerous_goods_div1").css('display', 'none');
			}
		});
		$(".select2_request_quote").select2({allowClear: true});
		$("#add_aircraft_quote_form").validate({
			errorElement: 'span', errorClass: 'help-block pull-right',
			focusInvalid: true,
			ignore: null,
			rules: {
				aircraft_quote_last_name: {required: true
				},
				aircraft_quote_email: {required: true,
					email: true
				},
				aircraft_quote_country_code: {
					required: true
				},
				aircraft_quote_phone: {
					required: true,
					number: true,
					minlength: 4
				},
				aircraft_quote_dangerous_good: {
					required: {
						depends: function () {
							if ($("#aircraft_quote_dangerous_goods1").is(':checked')) {
								return true;
							}
							return false;
						}
					}
				},
				aircraft_quote_passengers: {
					allow_no_zero: {
						depends: function () {
							if ($('#aircraft_quote_passengers').val() !== '') {
								return true;
							}
							return false;
						}
					},
					allow_integers: {
						depends: function () {
							if ($('#aircraft_quote_passengers').val() !== '') {
								return true;
							}
							return false;
						}
					}

				},
				aircraft_quote_departure_city: {required: true
				},
				aircraft_quote_arrival_city: {required: true
				},
				aircraft_quote_departure_date: {required: true
				}
			},
			messages: {
				aircraft_quote_last_name: {required: "Please enter your last name"
				},
				aircraft_quote_email: {required: "Please enter your email",
					email: "Email must be valid"
				},
				aircraft_quote_country_code: {
					required: "Please select your country code"
				},
				aircraft_quote_passengers: {
					allow_no_zero: "Invalid number of passengers.",
					allow_integers: "Invalid value of passengers"
				},
				aircraft_quote_dangerous_good: {
					required: "Please enter description of dangerous goods"
				},
				aircraft_quote_phone: {
					required: "Please enter your contact number",
					number: "Contact number must be valid",
					minlength: "Contact number must have atleast 4 digits"
				},
				aircraft_quote_departure_city: {required: "Please enter departure city"
				},
				aircraft_quote_arrival_city: {required: "Please enter arrival city"
				},
				aircraft_quote_departure_date: {required: "Please enter departure date"
				}
			},
			highlight: function (element) {
				$(element).closest('.form-group div').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group div').removeClass('has-error');
			},
			success: function (element) {
				$(element).closest('.form-group div').removeClass('has-error');
				$(element).closest('.form-group div').children('span.help-block').remove();
			},
			errorPlacement: function (error, element) {
				error.appendTo(element.closest('.form-group div'));
			},
			submitHandler: function (form) {
				$("#aircraft_add_quote_button").button('loading');
				$.post('', $("#add_aircraft_quote_form").serialize(), function (data) {
					if (data === '1') {
						bootbox.alert('Thank you for requesting a quote. We will respond to you shortly.', function () {
							document.location.href = base_url + 'aircraft-charter';
						});
					} else if (data === '0') {
						bootbox.alert('Error sending quote');
					} else {
						bootbox.alert(data);
					}
					$("#aircraft_add_quote_button").button('reset');
				});
			}
		});
	});
	$('select').change(function () {
		$("#add_aircraft_quote_form").validate().element($(this));
	});
	$('.datepicker_request_quote').on('change', function () {
		$(this).closest('.form-group div').removeClass('has-error');
		$(this).closest('.form-group div').removeClass('has-error');
		$(this).closest('.form-group div').children('span.help-block').remove();
	});
	$.validator.addMethod("return_date", function (value, element) {
		var startdate = $('#aircraft_quote_departure_date').val();
		var year = startdate.substring(6, 10);
		var month = startdate.substring(3, 5);
		var date = startdate.substring(0, 2);
		var endYear = value.substring(6, 10);
		var endMonth = value.substring(3, 5);
		var endDate = value.substring(0, 2);
		var startDate = new Date(year, month - 1, date);
		var endDate = new Date(endYear, endMonth - 1, endDate);
		if (startDate < endDate) {
			return true;
		}
	});
	$.validator.addMethod("allow_no_zero", function (value, element) {
		return value != '0' || value == '';
	});
	$.validator.addMethod("allow_integers", function (value, element) {
		var pattern = /^\d+$/;
		return  pattern.test(value);
	});
	function show_signup_error() {
		$("#add_aircraft_quote_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error While Creating an Account !!!</div>');
		setTimeout(function () {
			$('.alert-danger').fadeOut();
		}, 2000);
	}

	$("button[type=reset]").click(function () {
		$("#add_aircraft_quote_form").validate().resetForm();
		$("#add_aircraft_quote_form .place-error").removeClass("has-error");
		$("#add_aircraft_quote_form .place-error .input-group").removeClass("has-error");
		$("#add_aircraft_quote_form .place-error .input-group .input-group-addon").removeClass("has-error");
		$("select").val('').select2({allowClear: true});
	});

</script>
