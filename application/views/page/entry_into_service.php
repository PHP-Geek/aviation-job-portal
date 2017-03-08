<style>
    .about-us-middle{
        background: #f0f0f0;
        margin:30px 0px;
        padding: 35px 0;
    }
    .about-us-middle h3{
        color:#2f90c8;
        font-size:28px;
    }
    .button{
        margin-top:10px;
    }
    .help-block{
        color:red;
    }
    .top-image{
        margin:17px 0px;
    }
	.well-white{
		padding:0px;
	}
    #aviation_button{
        margin-left:3px;
    }
	.btn-big{
		min-width:273px;
	}
    .btn-success{        
		margin-bottom:7px;
    }
	.btn-warning {
		margin-bottom:7px;
	}
	.message-alert{
		margin-top: 20px;
	}
	#contact_us_submit{
		color:grey !important;
	}
	.entry-pop-up-button{
		width:auto !important;
	}
    @media only screen and (max-width:1024px) and (min-width:768px) and (orientation: portrait){
        .btn-success{
            margin-left:0px;
        }
        #aviation_button{
            margin-left:0px !important;
        }
    }
    @media only screen and (max-width:480px) and (min-width:320px){
        .btn-success{
            font-size: 13px;
            padding:7px 11px;
        }
        .btn-success{
            width:243px;
        }
        #aviation_button{
            margin-left:4px !important;
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
                    <li class="active">Entry Into Services</li>
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
                    <h1><span style="font-weight: 500">Entry Into Service</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages ">
    <div class="container">
        <div class="about-us">
			<?php
			foreach ($entry_into_service_array as $key => $entry_into_service) {
				?>
				<?php if ($key % 2 === 0) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="well-white">
								<div class="row">
									<div class="col-md-6 col-lg-6 col-sm-6">
										<div class="space-10">
											<h4><?php echo $entry_into_service['entry_into_service_title']; ?></h4>
											<?php echo $entry_into_service['entry_into_service_content']; ?>
										</div>
									</div>
									<div class="col-md-6 col-lg-6 col-sm-6 image-left-fix">
										<img src="<?php echo base_url(); ?>uploads/pages/entry_into_services/<?php echo date('Y/m/d/H/i/s/', strtotime($entry_into_service['entry_into_service_created'])) . $entry_into_service['entry_into_service_image']; ?>" alt="pilot" class="img-responsive pull-right"/>
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
									<div class="col-md-6 col-lg-6 col-sm-6 image-left-fix">
										<img src="<?php echo base_url(); ?>uploads/pages/entry_into_services/<?php echo date('Y/m/d/H/i/s/', strtotime($entry_into_service['entry_into_service_created'])) . $entry_into_service['entry_into_service_image']; ?>" alt="pilot" class="img-responsive"/>
									</div>
									<div class="col-md-6 col-lg-6 col-sm-6">
										<div class="space-right-10">
											<h4><?php echo $entry_into_service['entry_into_service_title']; ?></h4>
											<?php echo $entry_into_service['entry_into_service_content']; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($key !== count($entry_into_service_array) - 1) { ?>

					<?php
				}
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="well-white spacebot-20">
						<div class="space-10 space-right-10">
							<h5 class="text-center">For further information on InCrew Entry Into Services, please download the brochure below and request a quote today!</h5>
							<div class="text-center">
								<a class="btn btn-success btn-lg button btn-big" role="button" href="<?php echo base_url() . 'page/download_entry_into_service_brochure'; ?>">Entry Into Service Brochure  &nbsp;<span class="fa fa-download "></span></a>
								<a class="btn btn-success btn-lg button btn-big" id="aviation_button" role="button" data-toggle="modal" data-target="#entry_into_service_modal">Request Entry Into Service Support  &nbsp;<span class="fa fa-plane "></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="entry_into_service_modal" class="modal fade" role="dialog">
    <form id="entry_into_service_form" action="" method="post">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="contact_us_submit" data-dismiss="modal">&times;</button>
					<div class="modal-title-head">
						<h4 class="modal-title">Contact Us</h4>
						<span>Please provide your Entry Into Service Request below.</span>
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
                    <button type="submit" class="btn btn-success entry-pop-up-button" id="entry_into_service_button">Submit <i class="fa fa-plane"></i></button>
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
		$("#entry_into_service_form").validate({
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
				$("#entry_into_service_button").button("loading");
				$.post('', $("#entry_into_service_form").serialize(), function (data) {
					if (data === '1') {
						$(".modal-title-head").after('<div class="alert alert-success message-alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your request has been submitted successfully, the InCrew Team will contact you soon.</div>');
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