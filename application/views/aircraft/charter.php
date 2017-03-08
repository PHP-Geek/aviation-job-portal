<style>
    .charter-content h3{
        color:#2f90c8;
        font-size:23px;
    }
	.charter-content p{
        font-size:15px;
    }
    .charter-content {
        text-align: center;
    }
    .charter-content img{
        border: 3px solid #dfdfdf;
    }
    .charter-content img:hover{
        border: 3px solid #549afb;
    }
    .charter-field {
        margin-bottom: 60px;
        background-color: #fafafb;
        padding:15px 0px;
    }
    .charter{
        background-color: rgba(0, 0, 0, 0.6);
        background: rgba(0, 0, 0, 0.6);
        color: rgba(0, 0, 0, 0.6);
        position: relative;
        top: -129px;
        padding:36px 0;
        color: #fff;
    }
	.form-control::-moz-placeholder {
		font-size: 11px;
	}
    .charter h1{
        color:#fff;
    }
    .btn-warning {
        margin-top: 25px;
    }
    .carousel-indicators {
        display:none;
    }
	.join-us{
        text-align: center;
        margin-top: 40px;
        margin-bottom:40px;
    }
    .join-us p {
        color: #949494;
        margin-top: 18px;
		font-size:15px;
    }
    .our-client {
        margin-bottom: 30px;
        margin-top: -105px;
        text-align: center;
    }
    .our-client h2{
        font-weight:300;
        font-size:34px;
    }
	.help-block {
		color:#737373 !important;
	}
	label {
		font-size: 11px;
	}
	@media only screen and (max-width:1024px) and (min-width:768px) and (orientation: landscape){
		.charter {
			top: -129px !important;
		}
		.our-client {
			margin-top: -109px !important;
		}

	}
	@media only screen and (max-width:1024px) and (min-width:767px){
		.charter {
			top: -184px;
		}
		.charter-field {
			background-color: hsl(240, 11%, 98%);
			margin-bottom: 60px;
		}
		.our-client {
			margin-bottom: 30px;
			margin-top: -170px;
			text-align: center;
		}
	}
	@media only screen and (max-width:766px) and (min-width:640px){
		.charter {
			top: -2px !important;
		}
		.charter-content{
			margin: 27px 0;
		}
		.our-client{
			margin-top: 14px !important;
		}
	}
	@media only screen and (max-width:639px) and (min-width:479px){
		.charter {
			top: -2px !important;
		}
		.charter-content{
			margin: 27px 0;
		}
		.our-client{
			margin-top: 14px !important;
		}

	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.charter {
			top: -2px !important;
		}
		.charter-content{
			margin: 27px 0;
		}
		.our-client {
			margin-bottom: 30px;
			margin-top: -0px;
			text-align: center;
		}
	}
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="bread">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>our-services">Our Services</a></li>
					<li class="active">Aircraft Charter</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<?php if ($configuration_array['configuration_value'] !== '') {
				?>
				<img src="<?php echo base_url(); ?>uploads/pages/charter/banner_image/<?php echo $configuration_array['configuration_value']; ?>" alt="banner-1" class="center-block"/>
			<?php } else {
				?>
				<img src="<?php echo base_url(); ?>assets/img/charter.jpg" alt="banner-1" class="center-block img-responsive"/>
				<?php
			}
			?>

			<div class="charter">
				<div class="container text-center">
					<form class="form-inline" method="post" role="form" id="aircraft_charter_form" action="<?php echo base_url(); ?>aircraft-charter/request">
						<div class="form-group">
							<label for="aircraft_departure_city" class="col-lg-12">Departure <span class="required">*</span></label><br/>
							<input type="text" class="form-control" id="aircraft_departure_city" placeholder="Departure City" name="aircraft_departure_city" autocomplete="off"/>
						</div>
						<div class="form-group">
							<label for="aircraft_destination_city" class="col-lg-12">Destination <span class="required">*</span></label><br/>
							<input type="text" class="form-control" id="aircraft_destination_city" placeholder="Arrival City" name="aircraft_destination_city" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="aircraft_passengers" class="col-lg-12">Number of Passengers</label><br/>
							<input type="text" class="form-control" id="aircraft_passengers" placeholder="Number of Passengers" name="aircraft_passengers" autocomplete="off"/>
						</div>
						<div class="form-group">
							<label for="aircraft_departure_date" class="col-lg-12">Date <span class="required">*</span></label><br/>
							<div class="input-group date" id="departure_date">
								<input type="text" id="aircraft_departure_date" name="aircraft_departure_date" class="form-control" placeholder="Departure Date" autocomplete="off">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
						<button type="submit" id="aircraft_charter_button" name="aircraft_charter_button" class="btn btn-warning btn-lg">Get Quote  <span class="fa fa-plane"></span></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.carousel -->
<div class="container">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="our-client">
				<h2><?php echo $page_content_array['page_content_title']; ?></h2>
				<img class="img-responsive center-block" alt="bottom-line" src="<?php echo base_url(); ?>assets/img/bottom-line.png">
			</div>
			<div class="join-us">
				<p><?php echo $page_content_array['page_content']; ?> </p>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="text-center">
							<a class="btn btn-success btn-lg" role="button" href="<?php echo base_url() . 'aircraft/download_charter_brochure'; ?>">InCrew Charter Brochure  &nbsp;<span class="fa fa-download "></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="charter-field">
	<div class="container">
		<div class="row">
			<?php foreach ($aircraft_charter_array as $aircraft_charter) { ?>
				<div class="col-md-4 col-lg-4">
					<div class="charter-content">
						<a href="<?php echo base_url() . $aircraft_charter['aircraft_charter_link']; ?>"><img src="<?php
							if (is_file(FCPATH . 'uploads/pages/charter' . date('/Y/m/d/H/i/s/', strtotime($aircraft_charter['aircraft_charter_created'])) . $aircraft_charter['aircraft_charter_image'])) {
								echo base_url() . 'uploads/pages/charter' . date('/Y/m/d/H/i/s/', strtotime($aircraft_charter['aircraft_charter_created'])) . $aircraft_charter['aircraft_charter_image'];
							} else {
								echo base_url() . 'aircraft-charter';
							}
							?>" alt="banner-1" class="img-circle"/></a>
						<a href="<?php echo base_url() . $aircraft_charter['aircraft_charter_link']; ?>"><h3><?php echo $aircraft_charter['aircraft_charter_title']; ?></h3></a>
						<p><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $aircraft_charter['aircraft_charter_content']); ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php
if (count($home_page_testimonial_array) > 0) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php foreach ($home_page_testimonial_array as $key => $testimonial) { ?>
							<div class="item <?php
							if ($key === 0) {
								echo 'active';
							}
							?>">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-sm-10">
										<div class="our-client-testmonial">
											<p><?php echo $testimonial['home_page_testimonial_content']; ?></p>
											<span class="testmonial"><?php echo $testimonial['home_page_testimonial_person']; ?></span>
											<span class="testmonial-icon"><i class="fa fa-user"></i></span>
										</div>
									</div>
									<div class="col-md-2 col-lg-2 col-sm-2">
										<div class="our-client-testmonial">
											<img src="<?php
											if (is_file(FCPATH . 'uploads/page_testimonials/home_page' . date('/Y/m/d/H/i/s/', strtotime($testimonial['home_page_testimonial_created'])) . $testimonial['home_page_testimonial_image'])) {
												echo base_url() . 'uploads/page_testimonials/home_page' . date('/Y/m/d/H/i/s/', strtotime($testimonial['home_page_testimonial_created'])) . $testimonial['home_page_testimonial_image'];
											} else {
												echo base_url() . 'assets/img/client.png';
											}
											?>" alt="our-client" class="img-responsive center-block img-rounded"/>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#myCarousel").carousel({
			interval: 4000,
			pause: false
		});
	});
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
	$(function () {
		$("#departure_date").datepicker({
			clearBtn: true,
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '+0d',
			startView: 2,
			todayBtn: "linked"
		});
		$("#aircraft_types_id").select2({
			placeholder: "Aircraft Type"
		});
		$("#aircraft_charter_form").validate({
			errorElement: 'span',
			errorClass: 'help-block',
			focusInvalid: true,
			ignore: null,
			rules: {
				aircraft_departure_city: {
					required: true,
					alpha: true
				},
				aircraft_destination_city: {
					required: true,
					alpha: true
				},
				aircraft_passengers: {
					allow_no_zero: {
						depends: function () {
							if ($('#aircraft_passengers').val() !== '') {
								return true;
							}
							return false;
						}
					},
					allow_integers: {
						depends: function () {
							if ($('#aircraft_passengers').val() !== '') {
								return true;
							}
							return false;
						}
					}
				},
				aircraft_departure_date: {
					required: true
				}
			},
			messages: {
				aircraft_departure_city: {
					required: "Please enter departure city.",
					alpha: "Departure City name must contain only alphabets and spaces."
				},
				aircraft_passengers: {
					allow_no_zero: "Invalid number of passengers.",
					allow_integers: "Invalid value of passengers"
				},
				aircraft_destination_city: {
					required: "Please enter destination city.",
					alpha: "Destination City name must contain only apphabets and spaces."
				},
				aircraft_departure_date: {
					required: "Please enter departure date."
				}
			},
			invalidHandler: function (f, v) {
				var errors = v.numberOfInvalids();
				var err = "";
				if (errors) {
					for (var i = 0; i < v.errorList.length; i++) {
						err += v.errorList[i].message + '<br><br>';
					}
					bootbox.alert(err);
				}
			},
			highlight: function (element) {
				//				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group div').removeClass('has-error');
			},
			success: function (element) {
				$(element).closest('.form-group div').removeClass('has-error');
				$(element).closest('.form-group div').children('span.help-block').remove();
			},
			errorPlacement: function (error, element) {
				//error.appendTo(element.closest('.form-group'));
			},
			submitHandler: function (form) {
				form.submit();
			}
		});
	});
	$.validator.addMethod("alpha", function (value, element) {
		return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
	});
	$.validator.addMethod("allow_no_zero", function (value, element) {
		return value != '0' || value == '';
	});
	$.validator.addMethod("allow_integers", function (value, element) {
		var pattern = /^\d+$/;
		return  pattern.test(value);
	});
	function show_signup_error() {
		$("#aircraft_charter_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error While Creating an Account !!!</div>');
		setTimeout(function () {
			$('.alert-danger').fadeOut();
		}, 2000);
	}
</script>
