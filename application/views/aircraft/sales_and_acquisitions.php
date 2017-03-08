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
	.about-us p{
		min-height: auto !important;
	}
	.help-block{
        color:red !important;
		margin-bottom:-15px !important;
    }
	.modal-footer-button button {
		min-width:116px;
	}
	.well-white{
		padding:0px;
	}
	.about-us p {
		margin-bottom: 20px;
	}
	.btn-success {
		margin-bottom:7px;
	}
	#contact_us_submit {
		margin: 0;
		border: none;
		color:grey !important;
	}
	.message-alert{
		margin-top: 20px;
	}
	@media only screen and (max-width:1024px) and (min-width:768px) and (orientation: portrait){
		.about-us p {
			height: 107px;
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
					<li class="active">Aircraft Sales &AMP; Acquisitions</li>
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
					<h1><span style="font-weight: 500">Aircraft Sales & Acquisitions</span></h1>
					<p>Are you looking to purchase or sell a new or pre-owned aircraft?<br/>
						InCrew has experience and strong networks with many renowned buyers and sellers. We can support you whether you are an experienced individual or company or it is your first time being involved in a sale or acquisition. We understand that every customer and each asset is unique. Engage us today!</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<div class="about-us">
			<?php
			foreach ($sales_and_acquisition_array as $key => $sales_and_acquisition) {
				if ($key % 2 === 0) {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="well-white">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="space-10">
											<h4><?php echo $sales_and_acquisition['sales_and_acquisition_title']; ?></h4>
											<?php echo $sales_and_acquisition['sales_and_acquisition_content']; ?>
											<div class="pull-right">
												<a class="btn btn-success btn-lg btn-space-right" role="button" href="<?php echo $sales_and_acquisition['sales_and_acquisition_button_link']; ?>"><?php echo $sales_and_acquisition['sales_and_acquisition_button_text']; ?>  &nbsp;<span class="fa fa-plane "></span></a>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 image-left-fix">
										<div class="about-us">
											<img src="<?php
											if (is_file(FCPATH . 'uploads/pages/sales_and_acquisitions' . date('/Y/m/d/H/i/s/', strtotime($sales_and_acquisition['sales_and_acquisition_created'])) . $sales_and_acquisition['sales_and_acquisition_image'])) {
												echo base_url() . 'uploads/pages/sales_and_acquisitions' . date('/Y/m/d/H/i/s/', strtotime($sales_and_acquisition['sales_and_acquisition_created'])) . $sales_and_acquisition['sales_and_acquisition_image'];
											} else {
												echo base_url() . 'assets/img/pilot.jpg';
											}
											?>" alt="pilot" class="img-responsive  pull-right"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="well-white">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 image-left-fix">
										<div class="about-us">
											<img src="<?php
											if (is_file(FCPATH . 'uploads/pages/sales_and_acquisitions' . date('/Y/m/d/H/i/s/', strtotime($sales_and_acquisition['sales_and_acquisition_created'])) . $sales_and_acquisition['sales_and_acquisition_image'])) {
												echo base_url() . 'uploads/pages/sales_and_acquisitions' . date('/Y/m/d/H/i/s/', strtotime($sales_and_acquisition['sales_and_acquisition_created'])) . $sales_and_acquisition['sales_and_acquisition_image'];
											} else {
												echo base_url() . 'assets/img/management.jpg';
											}
											?>" alt="pilot" class="img-responsive  pull-left"/>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="space-right-10">
											<h4><?php echo $sales_and_acquisition['sales_and_acquisition_title']; ?></h4>
											<?php echo $sales_and_acquisition['sales_and_acquisition_content']; ?>
											<div class="row">
												<div class="col-md-12">
													<div class="pull-right">
														<?php if ($sales_and_acquisition['sales_and_acquisition_id'] === '2') { ?>
															<a class="btn btn-success btn-lg btn-space-right" role="button" data-toggle="modal" data-target="#sales_and_acquisition_modal"><?php echo $sales_and_acquisition['sales_and_acquisition_button_text']; ?>  &nbsp;<span class="fa fa-plane "></span></a>
														<?php } else {
															?>
															<a class="btn btn-success btn-lg btn-space-right" role="button" href="<?php echo $sales_and_acquisition['sales_and_acquisition_button_link']; ?>"><?php echo $sales_and_acquisition['sales_and_acquisition_button_text']; ?>  &nbsp;<span class="fa fa-plane "></span></a>
														<?php }
														?>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="sales_and_acquisition_modal" class="modal fade" role="dialog">
    <form id="sales_and_acquisition_form" action="" method="post">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="contact_us_submit" data-dismiss="modal">&times;</button>
					<div class="modal-title-head">
						<h4 class="modal-title">Contact Us</h4>
						<span>Please provide your information below, including details on what aircraft you are looking for. The InCrew team will be in touch shortly after you submit your request.</span>
					</div>
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="sales_and_acquisitions_button">Submit <i class="fa fa-plane"></i></button>
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
		$("#sales_and_acquisition_form").validate({
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
					email: "Please enter valid email"
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
				$("#sales_and_acquisitions_button").button("loading");
				$.post('', $("#sales_and_acquisition_form").serialize(), function (data) {
					if (data === '1') {
						$(".modal-title-head").after('<div class="alert alert-success message-alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your request has been submitted successfully, the InCrew Sales Team will contact you soon.</div>');
						setTimeout(function () {
							document.location.href = '';
						}, 3000);
					} else if (data === '0') {
						bootbox.alert("Error submitting records");
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	});
</script>