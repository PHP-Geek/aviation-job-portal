<style>
    .form-control {
        height:27px;
    }
    #country_code
    {
        background-color: #FFFFFF;
        vertical-align: top;
        text-align:left;
    }
    #contact_number {
        float: left;
        width: 100%;
    }
	.sales-grey > ul {
		padding-left: 16px;
	}
    #share_modal {
        width:250px;
	}

    #share_modal .facebook{
		/*        background-color: #3b5998;*/
        color:#fff;
        text-align: center;
        padding: 15px 0px;
        margin-bottom: 4px;
        margin:2px;
    }
    #share_modal .twitter{
		/*        background-color: #00aced;*/
        color:#fff;
        text-align: center;
        padding: 15px 0px;
        margin:2px;
    }
    #share_modal .google_plus{
		/*        background-color: #db4935;*/
        color:#fff;
        text-align: center;
		padding: 15px 0px;
        margin:2px;
    }
    #share_modal .linkdin{
		/*        background-color: #007bb6;*/
        color:#fff;
        text-align: center;
        padding: 15px 0px;
        margin:2px;

    }
    .facebook:hover {
        background-color: #fff;
		box-shadow:3px 4px 20px 0 rgba(0, 0, 0, 0.2);
    }
    .twitter:hover {
        background-color: #fff;
		box-shadow:3px 4px 20px 0 rgba(0, 0, 0, 0.2);
    }
    .linkdin:hover {
        background-color: #fff;
		box-shadow:3px 4px 20px 0 rgba(0, 0, 0, 0.2);
    }
    .google_plus:hover {
        background-color: #fff;
		box-shadow:3px 4px 20px 0 rgba(0, 0, 0, 0.2);
    }
    #share_content {
		background-color: #f5f5f5;
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
		padding: 15px;
	}
    .facebook > p {
        padding: 10px 20px 10px;
        text-align: center;
        font-weight: 400;
        margin: 0px;
    }
    #share_header{
        padding: 0px;
        border: none;
    }
    .google_plus > p {
        padding: 10px 20px 10px;
        text-align: center;
        font-weight: 400;
        margin: 0px;
    }
    .twitter > p {
        padding: 10px 20px 10px;
        text-align: center;
        font-weight: 400;
        margin: 0px;
    }
    .linkdin > p {
        padding: 10px 20px 10px;
        text-align: center;
        font-weight: 400;
        margin: 0px;
    }
    #share_content{
        padding: 15px;
    }
    .aircraft-sales-dropdown {
        background-color: #26355f;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        display: block;
        font-size: 18px;
        height: 40px;
        line-height: 1.42857;
        padding: 6px 12px;
        text-align: center;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
        color:#fff;
    }
    .aircraft-sales-dropdown::-moz-placeholder {
        color: #999;
        opacity: 1;
    }
    .sale-sheet{
        border:1px solid #dadfdf;
        padding:10px;
        margin-bottom: 34px;
    }
    .sale-sheet h4{
        color:#626262;
    }
    .sale-sheet li {
        font-size: 16px;
    }
    .sales-menu{
        margin-top: 30px;
    }
    .tab-content {
        background: #f8f8f8 none repeat scroll 0 0;
        padding: 18px;
    }
    .nav > li > a {
        font-size:20px;
    }
    .nav-pills > li > a {
        border-radius: 0px;
    }
    .sales-grey h3{
        color:#fff;
        margin-top: 1px;
        font-size: 23px;
    }
    .sales-grey li {
        font-size: 15px;
        font-weight: 300;
        padding: 4px 1px;
    }
	.highlight-content {
        font-size: 15px;
    }
    #share_close{
        color: #000!important;
        margin:0px!important;
    }
    .fa-download{
        color:#fff;
    }
    .carousel {
        margin-bottom: 5px;
    }
    #share_body{
        padding: 10px 15px 0px;
    }
    .item .thumb {
        cursor: pointer;
        float: left;
        margin: 0 3px;
        width: 24%;
    }
    .help-block{
        color:red !important;
        margin-bottom:-15px !important;
    }
    .tab-header{
        color:#191970;
    }
    .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
        background-color: hsl(224, 43%, 27%) !important;
    }
	.sales-open-aircraft-name h1{
		font-size:30px;
	}
	.btn-success{
		margin: 0px !important;
	}
	.sales-open-aircraft-name h2{
		font-size:25px;
	}
	.heading-about-specification li a{
		font-size:16px !important;
	}
	.tab-content p{
		font-size:14px;
	}
	#contact_us_submit {
		color:grey !important;
	}
	.message-alert{
		margin-top: 20px;
	}
	.select2-container .select2-choice > .select2-chosen {
		font-size: 11px;
	}
	.carousel-inner .active.left { left: -25%; }
	.carousel-inner .active.right { left: 25%; }
	.carousel-inner .next        { left:  25%; }
	.carousel-inner .prev    { left: -25%; }
	.carousel-control        { width:  4%; }

	@media only screen and (max-width:1024px) and (min-width:768px) and (orientation: landscape){
		.btn-success {
			width: auto;;
		}
		.btn-success {
			width: 129px;
		}
		.item .thumb {
			margin: 0;
			width: 25%;
		}
	}
    @media only screen and (max-width:766px) and (min-width:480px){
        .btn-success {
            width: 156px;
        }
	}
    @media only screen and (max-width:480px) and (min-width:320px) {
        .item .thumb {
            width: 22%;
        }
		#share_modal {
			width: auto;
		}
		.btn-success {
			margin: 2px 0 !important;
			width: 156px;
		}
    }		
</style>
<script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
	stLight.options({publisher: "33fc197f-6e9c-4cf5-8622-00acb75b0dfb", doNotHash: false, doNotCopy: false, hashAddressBar: false});
	function share(url, id, service) {
		$.getJSON('http://rest.sharethis.com/v1/count/urlinfo?url=' + url + '&provider=' + service + '&api_key=33fc197f-6e9c-4cf5-8622-00acb75b0dfb', function (callback_data) {
			$.post(base_url + 'aircraft/update_social_media_share', {share_count: callback_data[service]['outbound'] + callback_data[service]['inbound'], aircraft_id: id, social_media_service: service}, function (data) {
				if (data === '1') {
					console.log('done');
				} else if (data === '0') {
					console.log('error');
				} else {
					console.log(data);
				}
			});
		});
	}
</script>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>aircraft-sales">Aircraft Sales</a></li>
                    <li class="active">View Aircraft</li>
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
                    <h1><span style="font-weight: 500">New & Pre-owned Aircraft For Sale</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="padbot-20">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="sales-open-aircraft-name">
					<h1><?php echo $aircraft_array['aircraft_name']; ?></h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-6">
				<div id="carousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php
						$counter = 0;
						foreach ($aircraft_image_array as $aircraft_image) {
							if ($counter === 0) {
								?>
								<div class="item active">
									<img src="<?php echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_image['aircraft_image_name']; ?>" alt="sale-3" class="img-responsive center-block"/>
								</div>
							<?php } else { ?>
								<div class="item">
									<img src="<?php echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_image['aircraft_image_name']; ?>" alt="sale-3" class="img-responsive center-block"/>
								</div>
								<?php
							}
							$counter++;
						}
						?>
					</div>
				</div>
				<div class="clearfix">
					<div id="thumbcarousel" class="carousel slide" data-interval="false">
						<div class="carousel-inner">
							<?php
							$counter = 0;
							foreach ($aircraft_image_array as $aircraft_image) {
								if ($counter === 0) {
									echo '<div class="item active">';
								} else if ($counter % 4 === 0) {
									echo '<div class="item">';
								}
								?>
								<div class="thumb" data-slide-to="<?php echo $counter; ?>" data-target="#carousel"><img class="img-responsive center-block" alt="sale-3" src="<?php echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_image['aircraft_image_name']; ?>"></div>
								<?php
								$counter++;
								if ($counter % 4 === 0 || $counter === count($aircraft_image_array)) {
									echo '</div>';
								}
							}
							?><!-- /item -->
							<!-- /item -->
						</div><!-- /carousel-inner -->
						<a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div> <!-- /thumbcarousel -->
				</div><!-- /clearfix -->
			</div>
			<div class="col-md-5 col-lg-5 col-sm-6">
				<div class="sales-open-aircraft-name">
					<h2>HIGHLIGHTS</h2>
				</div>
				<div class="sales-grey">
					<?php if (count($aircraft_highlight_array) > 0) { ?>
						<ul>
							<?php foreach ($aircraft_highlight_array as $highlight) { ?>
								<li><?php echo $highlight['aircraft_highlight_value']; ?></li>
							<?php } ?>
						</ul>
						<?php
					} else {
						echo '<div class="well">No Highlights</div>';
					}
					?>
				</div>
				<p class="highlight-content"><?php echo $aircraft_array['aircraft_detail']; ?></p>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<a class="btn btn-success btn-lg" id="share_open"role="button" href="<?php echo base_url() . 'aircraft/sales_sheet_download/' . $aircraft_array['aircraft_slug'] . '/' . $aircraft_array['aircraft_id']; ?>" target="_blank">Sales Sheet <span class="fa fa-download "></span></a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<button type="button" data-toggle="modal" data-target="#aircraft_sales_interest_modal" class="btn btn-success btn-lg" id="share_open"role="button">Contact Us <span class="fa fa-phone "></span></button>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<button type="button" data-toggle="modal" data-target="#aircraft_sales_interest_modal-2" class="btn btn-success btn-lg" id="share_open"role="button">Share <span class="fa fa-share-alt"></span></button>
					</div>
					<!-- Modal -->
					<div id="aircraft_sales_interest_modal-2" class="modal fade" role="dialog">
						<div class="modal-dialog" id="share_modal">
							<!-- Modal content-->
							<div class="modal-content" id="share_content">
								<div class="modal-header" id="share_header">
									<button type="button" class="close" id="share_close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Share</h4>
								</div>
								<div class="modal-body" id="share_body">
									<div class="row">
										<div class="col-md-6 share_outer col-sm-6 col-xs-6">
											<a href="#">  <div class="facebook">
													<i id="social-menu-size" class=""></i>
													<span class='st_facebook_large' displayText='Facebook' st_url="<?php echo current_url(); ?>" st_title="<?php echo $aircraft_array['aircraft_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $aircraft_array['aircraft_id']; ?>', 'facebook');"></span>
												</div>
											</a>
										</div>
										<div class="col-md-6 share_outer col-sm-6 col-xs-6">
											<a href="#">  <div class="twitter">
													<i id="social-menu-size" class=""></i>
													<span class='st_twitter_large' displayText='Tweet' st_url="<?php echo current_url(); ?>" st_title="<?php echo $aircraft_array['aircraft_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $aircraft_array['aircraft_id']; ?>', 'twitter');"></span>
												</div>
											</a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 share_outer col-sm-6 col-xs-6">
											<a href="#"> <div class="google_plus">
													<i id="social-menu-size" class=""></i>
													<span class='st_googleplus_large' displayText='Google +' st_url="<?php echo current_url(); ?>" st_title="<?php echo $aircraft_array['aircraft_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $aircraft_array['aircraft_id']; ?>', 'googleplus');"></span>
												</div>
											</a>
										</div>
										<div class="col-md-6 share_outer col-sm-6 col-xs-6">
											<a href="#">  <div class="linkdin">
													<i id="social-menu-size" class=""></i>
													<span class='st_linkedin_large' displayText='LinkedIn' st_url="<?php echo current_url(); ?>" st_title="<?php echo $aircraft_array['aircraft_name']; ?>" onclick="share('<?php echo current_url(); ?>', '<?php echo $aircraft_array['aircraft_id']; ?>', 'linkedin');"></span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (count($aircraft_tabs) > 0) { ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="sales-menu spacebot-20 ">
					<ul class="nav nav-pills heading-about-specification">
						<?php
						foreach ($aircraft_tabs as $key => $tab) {
							?>
							<li class="<?php
							if ($key === 0) {
								echo 'active';
							}
							?>"><a data-toggle="pill" href="#tab_<?php echo $tab['aircraft_sale_tab_id']; ?>" class="tab-header"><?php echo $tab['aircraft_sale_tab_name']; ?></a></li>
								<?php
							}
							?>
					</ul>
					<div class="tab-content">
						<?php
						foreach ($aircraft_tabs as $key => $tab) {
							?>
							<div id="tab_<?php echo $tab['aircraft_sale_tab_id']; ?>" class="tab-pane <?php
							if ($key === 0) {
								echo ' fade in active';
							}
							?>">
									 <?php echo $tab['aircraft_sale_tab_content']; ?>
							</div><?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- Modal -->
<div id="aircraft_sales_interest_modal" class="modal fade" role="dialog">
    <form id="aircraft_sales_interest_form" action="" method="post">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="contact_us_submit" data-dismiss="modal">&times;</button>
					<div class="modal-title-head">
						<h4 class="modal-title">Contact Us</h4>
						<span>Please enter your information below and any specific questions or message you	have and the InCrew Sales Team will be in touch shortly.</span>
					</div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="aircraft_sales_interest_name">Name<span class="required">*</span></label>
                            <input type="text" name="aircraft_sales_interest_name" id="aircraft_sales_interest_name" class="form-control" placeholder="Name"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="aircraft_sales_interest_company">Company</label>
                            <input type="text" name="aircraft_sales_interest_company" id="aircraft_sales_interest_company" class="form-control" placeholder="Company"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aircraft_sales_interest_contact">Contact Number <span class="required">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon" id="country_code" style="border:none;padding:0">
                                <div class="form-group">
                                    <select name="aircraft_sales_interest_country_code" class="select2_register" data-placeholder="&nbsp;Country Code">
                                        <option></option>
										<?php
										foreach ($user_country_array as $country) {
											if ($country['country_code'] != '') {
												?>
												<option value="<?php echo $country['country_code']; ?>">(<?php echo $country['country_code'] . ')' . $country['country_name']; ?></option>
												<?php
											}
										}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="contact_number">
                                <input type="text" class="form-control" id="aircraft_sales_interest_contact_number" name="aircraft_sales_interest_contact" placeholder="Contact Number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aircraft_sales_interest_email">Email<span class="required">*</span></label>
                        <input type="text" name="aircraft_sales_interest_email" id="aircraft_sales_interest_email" class="form-control" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <label for="aircraft_sales_interest_subject">Subject<span class="required">*</span></label>
                        <select name="aircraft_sales_interest_subject" class="col-xs-12 select2_register" data-placeholder="Enter Subject" style="padding:0;">
                            <option></option>
                            <option value="Interested In Aircraft">Interested in Aircraft</option>
                            <option value="Aircraft For Sale">Aircraft for Sale</option>
                            <option value="Entry Into Service">Entry into Service</option>
                            <option value="Aircraft Management">Aircraft Management</option>
                            <option value="Aircraft Acquisition">Aircraft Acquisition</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="aircraft_sales_interest_message">Message</label>
                        <textarea name="aircraft_sales_interest_message" id="aircraft_sales_interest_message" class="form-control" placeholder="Enter Your Message(optional)" rows="3"/></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="aircraft_sales_interest_button">Submit <i class="fa fa-plane"></i></button>
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
															$("#aircraft_sales_interest_form").validate({
																errorElement: 'span',
																errorClass: 'help-block text-right',
																focusInvalid: true,
																ignore: null,
																rules: {
																	aircraft_sales_interest_name: {
																		required: true
																	},
																	aircraft_sales_interest_country_code: {
																		required: true
																	},
																	aircraft_sales_interest_contact: {
																		required: true,
																		number: true,
																		minlength: 4
																	},
																	aircraft_sales_interest_location: {
																		required: true
																	},
																	aircraft_sales_interest_subject: {
																		required: true
																	},
																	aircraft_sales_interest_email: {
																		required: true,
																		email: true
																	}
																},
																messages: {
																	aircraft_sales_interest_name: {
																		required: "Please complete the name"
																	},
																	aircraft_sales_interest_country_code: {
																		required: "Please complete the country Code"
																	},
																	aircraft_sales_interest_contact: {
																		required: "Please complete the contact number",
																		number: "Contact number must be valid.",
																		minlength: "Contact number must be atleast 4 digits long."
																	},
																	aircraft_sales_interest_location: {
																		required: "Please complete the location"
																	},
																	aircraft_sales_interest_subject: {
																		required: "Please complete the subject"
																	},
																	aircraft_sales_interest_email: {
																		required: "Please complete the email",
																		email: "Please fill valid email"
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
																	$("#aircraft_sales_interest_button").button("loading");
																	$.post('', $("#aircraft_sales_interest_form").serialize(), function (data) {
																		if (data === '1') {
																			$(".modal-title-head").after('<div class="alert alert-success message-alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your request has been submitted successfully. The InCrew sales team will contact you soon.</div>');
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
<script>
	$(document).ready(function () {
		$('.carousel slide .item').each(function () {
			var next = $(this).next();
			if (!next.length) {
				next = $(this).siblings(':first');
			}
			next.children(':first-child').clone().appendTo($(this));

			if (next.next().length > 0) {
				next.next().children(':first-child').clone().appendTo($(this));
			} else {
				$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
			}
		});
	});
</script>