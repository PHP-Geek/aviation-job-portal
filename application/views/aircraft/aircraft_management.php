<style>
	.little-banner{
		margin-bottom: 0px;
	}
	.footer{
		margin-top: 0px;
	}
    .top-image{
        margin-top:41px;
    }
	.button{
		margin-top:10px;
	}
	.help-block{
        color:red !important;
		margin-bottom:-15px !important;
    }
	.well-white{
		padding:0px;
	}
	.modal-footer-button button {
		min-width:116px;
	}
	.btn-success {
		margin-bottom:7px;
	}
	#contact_us_submit{
		color:grey !important;
	}
	.entry-pop-up-button{
		border:none;
	}
	@media only screen and (max-width:1024px) and (min-width:768px) and (orientation: portrait){
		.btn-success{
			margin-left:0px !important;
		}

	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.btn-success{
			font-size: 13px;
			padding:7px 11px;
			width:266px;
		}
		.button-bottom {
			margin: 0 -9px;
			text-align: left;
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
                    <li class="active">Aircraft Management</li>
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
                    <h1><span style="font-weight: 500">Aircraft Management</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<div class="about-us">
			<?php
			foreach ($aircraft_management_array as $key => $aircraft_management) {
				if ($key % 2 === 0) {
					?>
					<div class="row">
						<div class="well-white">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<h4><?php echo $aircraft_management['aircraft_management_title']; ?></h4>
								<?php echo $aircraft_management['aircraft_management_content']; ?>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 image-left-fix">
								<div class="about-us">
									<img src="<?php
									if (is_file(FCPATH . 'uploads/pages/aircraft_management' . date('/Y/m/d/H/i/s/', strtotime($aircraft_management['aircraft_management_created'])) . $aircraft_management['aircraft_management_image'])) {
										echo base_url() . 'uploads/pages/aircraft_management' . date('/Y/m/d/H/i/s/', strtotime($aircraft_management['aircraft_management_created'])) . $aircraft_management['aircraft_management_image'];
									} else {
										echo base_url() . 'assets/img/pilot.jpg';
									}
									?>" alt="pilot" class="img-responsive pull-right"/>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="well-white">
							<div class="col-lg-6 col-md-6 col-sm-6 image-left-fix">
								<div class="about-us">
									<img src="<?php
									if (is_file(FCPATH . 'uploads/pages/aircraft_management' . date('/Y/m/d/H/i/s/', strtotime($aircraft_management['aircraft_management_created'])) . $aircraft_management['aircraft_management_image'])) {
										echo base_url() . 'uploads/pages/aircraft_management' . date('/Y/m/d/H/i/s/', strtotime($aircraft_management['aircraft_management_created'])) . $aircraft_management['aircraft_management_image'];
									} else {
										echo base_url() . 'assets/img/management.jpg';
									}
									?>" alt="pilot" class="img-responsive"/>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<h4><?php echo $aircraft_management['aircraft_management_title']; ?></h4>
								<span class="text-top-center"><?php echo $aircraft_management['aircraft_management_content']; ?></span>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
			<div class="row">
				<div class="well-white">
					<div class="col-lg-12 col-md-12">
						<h5 class="text-center">
							For further information on InCrew’s Aviation Management Services, please download the brochure below and request a quote today!</h5>
						<div class="row">
							<div class="col-md-12">
								<div class="text-center">
									<a class="btn btn-success btn-lg button aviation_button" role="button" href="<?php echo base_url() . 'aircraft/download_aircraft_management_brochure'; ?>">Aircraft Management Brochure  &nbsp;<span class="fa fa-download "></span></a>
									<a id="aviation_button" class="btn btn-success btn-lg button aviation_button" role="button" data-toggle="modal" data-target="#aircraft_management_modal">Request Aviation Management Services  &nbsp;<span class="fa fa-plane "></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="aircraft_management_modal" class="modal fade" role="dialog">
	<form id="aircraft_management_form" action="" method="post">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id="contact_us_submit" data-dismiss="modal">&times;</button>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Contact Us</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="contact_us_feed_name">Name<span class="required">*</span></label>
						<input type="text" name="contact_us_feed_name" id="contact_us_feed_name" class="form-control" placeholder="Name"/>
					</div>
					<div class="form-group">
						<label for="contact_us_feed_email">Email<span class="required">*</span></label>
						<input type="text" name="contact_us_feed_email" id="contact_us_feed_email" class="form-control" placeholder="Email"/>
					</div>
					<div class="form-group">
						<label for="contact_us_feed_message">Message<span class="required">*</span></label>
						<textarea name="contact_us_feed_message" id="contact_us_feed_message" class="form-control" placeholder="Enter Your Message" rows="3"/></textarea>
					</div>
				</div>
				<div class="modal-footer modal-footer-button">
					<button type="submit" class="btn btn-success entry-pop-up-button" id="contact_us_feed_button">Submit <i class="fa fa-plane"></i></button>
				</div> 
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
	$(function () {
		$(".select2_register").select2({
			allowClear: true
		});
		$("#aircraft_management_form").validate({
			errorElement: 'span',
			errorClass: 'help-block text-right',
			focusInvalid: true,
			ignore: null,
			rules: {
				contact_us_feed_name: {
					required: true
				},
				contact_us_feed_email: {
					required: true,
					email: true
				},
				contact_us_feed_message: {
					required: true
				}
			},
			messages: {
				contact_us_feed_name: {
					required: "Please complete the name"
				},
				contact_us_feed_email: {
					required: "Please complete the email",
					email: "Please fill valid email"
				},
				contact_us_feed_message: {
					required: "Please complete the message"
				}
			},
			highlight: function (element) {
			},
			unhighlight: function (element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			success: function (element) {
				$(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').children('span.help-block').remove();
			},
			errorPlacement: function (error, element) {
				error.appendTo(element.closest('.form-group'));
			},
			submitHandler: function (form) {
				$("#aircraft_management_button").button("loading");
				$.post('', $("#aircraft_management_form").serialize(), function (data) {
					if (data === '1') {
						$(".modal-title").after('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your request has been submitted successfully. InCrew team will contact you soon.</div>');
						setTimeout(function () {
							document.location.href = '';
						}, 3000);
					} else if (data === '0') {
						bootbox.alert("Error submitting records");
					} else {
						bootbox.alert(data);
					}
					$("#aircraft_sales_interest_button").button("reset");
				});
			}
		});
	});
</script>