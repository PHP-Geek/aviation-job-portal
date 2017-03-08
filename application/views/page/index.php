<style>
    .circle{
		transition:All .0047s ease-out;
		-webkit-transition:All .0047s ease-out;
		-moz-transition:All .0047s ease-out;
		-o-transition:All .0047s ease-out;
    }
	.circle:hover{		
	}
	.plane img {
		left: 36%;
		min-height: 389px;
		position: absolute;
		right: 0;
		top: -22px;
		z-index: 9;
	}
	.btn-success {
		margin: 0;
	}

    .fa {
        margin-top: 5px;
    }
    .circle a{
        color:#fff;
    }
    .circle a:hover{
        color:#dfdfdf;
    }
	.our-client-testmonial p {
		font-size: 15px;
	}
    .circle-fields{
        margin-top:80px;
    }
    .circle-fields h4{
        color:#3299d5;
        font-size:20px;
        font-weight: 500;
    }
	.circle-fields h4:hover{
		color:#055a97;		
	}
    .circle-fields p{
        color:#fff;
        font-weight:300;
		font-size:15px;
    }
    .join-us{
        text-align: center;
        margin-top: 40px;
        margin-bottom:40px;
    }
    .join-us p {
        color: #949494;
        margin-top: 15px;
		font-size:15px;
    }
	.blue-section-button{
		margin-bottom: 20px !important;
	}
    .our-client {
        margin-bottom: 30px;
        margin-top: 0;
        text-align: center;
    }
    .our-client h2{
        font-weight:300;
        font-size:41px;
    }
	.banner-plane p {
		position: relative;
		z-index: 2147483647;
	}
	.banner-plane p {
		color: #fff;
		margin: 0 0 13px;
		padding-top: 10px;
		text-align: initial;
		font-size:15px;
		z-index:10;
	}
    .banner-middle {
        background: rgba(0, 0, 0, 0) url("<?php
		if (is_file(FCPATH . 'uploads/pages/home/background_image/' . $configuration_array['configuration_value'])) {
			echo base_url() . 'uploads/pages/home/background_image/' . $configuration_array['configuration_value'];
		} else {
			echo base_url() . 'assets/img/-middle.jpg';
		}
		?>") repeat scroll 0 0;
        background-position:center;
        margin: 0 auto;
        overflow: hidden;
        background-attachment:fixed;
        padding-bottom: 114px;
        background-size: cover;
    }
    .join-us h2{
        font-weight:300;
        font-size:63px;
    }

    #size-button{
        font-size: 20px;
        padding: 12px 34px;
        margin-bottom:11px;
    }
    .join_us_caption {
        background: hsla(0, 0%, 100%, 0.15) none repeat scroll 0 0;
        visibility: visible;
        bottom: 61px;
        display: block;
        left: 0;
        position: absolute;
        right: 361px;
        text-align: left;
        transform: translate(0px, 0px);
        color:#fff;
    }
    .bg-absolute {
        padding-bottom: 37px;
        padding-top: 9px;
        width:83%;
		box-sizing: border-box;
    }
    .bg-absolute h1{
		font-size:30px;        
    }
	.bg-absolute h4{
		font-size:15px;        
    }
	.btn-success{
		font-size:13px;
	}
    .join_us_caption_2 {
        background-color: rgba(0, 0, 0, 0.34);
        background: rgba(0, 0, 0, 0.34);
        color: rgba(0, 0, 0, 0.34);
        bottom: 0;
        color: hsl(0, 0%, 100%);
        display: block;
        left: 0;
        position: absolute;
        right: 0;
        text-align: left;
        transform: translate(0px, 0px);
        visibility: visible;
    }
    .bg-absolute_2 {
        height: 940px;
        padding-bottom: 37px;
        padding-top: 9px;
        width: 100%;
    }
    .bg-absolute_2 {
        box-sizing: border-box;
    }
    .btn-success {
        border:none;
    }
    @media only screen and (max-width:480px) and (min-width:320px){
		.our-client h2{
            font-size:42px;
        }
        .plane img {
            display: none;
        }
        .banner-plane{
            padding:32px 0px;
        }
        .banner-plane h3{
            padding-top:0px;
        }
        .circle-fields h4{
            text-align:center;
        }
		.circle{
			margin:0px auto;
		}
		.our-client h2 {
		font-size: 28px;
}
    }
    @media only screen and (max-width:639px) and (min-width:480px){
        .plane img {
            display: none;
        }
        .circle-fields h4{
            text-align:center;
        }
		.circle{
			margin:0px auto;
		}
		.our-client h2 {
        font-size: 28px;
}
    }
    @media only screen and (max-width:1024px) and (min-width:768px) and (orientation: portrait){
        .circle-fields h4 {
            text-align: center;
        }
        .banner-plane{
            background: #287CB1;
        }
        .plane img {
            display: none;
        }
		.circle{
			margin:0px auto;
		}
    }
    @media only screen and (max-width:1024px) and (min-width:767px) and (orientation: landscape){
        .banner-plane{
            background: #287CB1;
        }
        .plane img {
            display:none;
        }		
    }
    @media only screen and (max-width:1920px) and (min-width:1400px){

        .banner-middle {
            background: rgba(0, 0, 0, 0) url("<?php
			if (is_file(FCPATH . 'uploads/pages/home/background_image/' . $configuration_array['configuration_value'])) {
				echo base_url() . 'uploads/pages/home/background_image/' . $configuration_array['configuration_value'];
			} else {
				echo base_url() . 'assets/img/banner-middle.jpg';
			}
			?>") repeat scroll 0 0;
            background-size: cover;
            background-attachment:fixed;
            background-position:center;
        }
		.bg-absolute {
			width:88%;
		}

    }
</style>
<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="6000">  <!-- Indicators -->
    <div class="carousel-inner" role="listbox">
		<?php foreach ($slider_images as $key => $slider_image) { ?>
			<div class="item <?php
			if ($key === 0) {
				echo 'active';
			}
			?>">
				<a href="<?php echo base_url(); ?>"><img src="<?php
					if (FCPATH . 'uploads/pages/home/slider_images' . date('/Y/m/d/H/i/s/', strtotime($slider_image['slider_image_created'])) . $slider_image['slider_image_name']) {
						echo base_url() . 'uploads/pages/home/slider_images' . date('/Y/m/d/H/i/s/', strtotime($slider_image['slider_image_created'])) . $slider_image['slider_image_name'];
					} else {
						echo base_url() . 'assets/img/banner-1.jpg';
					}
					?>" alt="banner-1" class="img-responsive center-block"/></a>
				<div class="container hidden-xs">
					<div class="join_us_caption_2 fadeIn">
						<div class="container bg-absolute_2">

						</div>
					</div>
				</div>
				<div class="container hidden-xs">
					<div class="join_us_caption fadeIn">
						<div class="container bg-absolute">
							<h1>
								<?php echo $slider_image['slider_image_title']; ?>
							</h1>
							<h4> <?php echo $slider_image['slider_image_content']; ?>
							</h4>
							<a href="<?php echo $slider_image['slider_image_link']; ?>" class="btn btn-success btn-lg" role="button"><?php echo $slider_image['slider_image_link_text']; ?> <span class="fa fa-plane"></span></a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
    </div>
</div><!-- /.carousel -->
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="our-client">
                <h2><?php echo $page_content_array['page_content_title']; ?></h2>
                <img src="<?php echo base_url(); ?>assets/img/bottom-line.png" alt="bottom-line" class="img-responsive center-block"/>
            </div>
            <div class="join-us">
                <p><?php echo $page_content_array['page_content']; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="banner-middle">
    <div class="container">
        <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="row">
					<div class="circle-fields">
						<div class="col-md-4 col-lg-3">
							<div class="circle">
								<a href="<?php echo $home_page_link_array[0]['home_page_link_url']; ?>">
									<img src="<?php echo base_url(); ?>assets/img/pilot-circle.png" alt="bottom-line" class="img-responsive center-block" id="myImage1" onmouseenter="changeImage(1)" onmouseleave="changeoldImage(1)"/>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-lg-9">
							<a href="<?php echo $home_page_link_array[0]['home_page_link_url']; ?>"><h4><?php echo $home_page_link_array[0]['home_page_link_title']; ?></h4></a>
							<a href="<?php echo $home_page_link_array[0]['home_page_link_url']; ?>"><p><?php echo $home_page_link_array[0]['home_page_link_content']; ?></p></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="row">
					<div class="circle-fields">
						<div class="col-md-4 col-lg-3">
							<div class="circle">
								<a href="<?php echo $home_page_link_array[1]['home_page_link_url']; ?>">
									<img src="<?php echo base_url(); ?>assets/img/plane-circle.png" alt="bottom-line" class="img-responsive center-block" id="myImage2" onmouseenter="changeImage(2)" onmouseleave="changeoldImage(2)"/>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-lg-9">
							<a href="<?php echo $home_page_link_array[1]['home_page_link_url']; ?>"><h4><?php echo $home_page_link_array[1]['home_page_link_title']; ?></h4></a>
							<a href="<?php echo $home_page_link_array[1]['home_page_link_url']; ?>"><p><?php echo $home_page_link_array[1]['home_page_link_content']; ?></p></a>
						</div>
					</div>
				</div>
			</div>			
        </div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="row">
					<div class="circle-fields">
						<div class="col-md-4 col-lg-3">
							<div class="circle">
								<a href="<?php echo $home_page_link_array[2]['home_page_link_url']; ?>">
									<img src="<?php echo base_url(); ?>assets/img/earth-circle.png" alt="bottom-line" class="img-responsive center-block" id="myImage3" onmouseenter="changeImage(3)" onmouseleave="changeoldImage(3)"/>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-lg-9">
							<a href="<?php echo $home_page_link_array[2]['home_page_link_url']; ?>"><h4><?php echo $home_page_link_array[2]['home_page_link_title']; ?></h4></a>
							<a href="<?php echo $home_page_link_array[2]['home_page_link_url']; ?>"><p><?php echo $home_page_link_array[2]['home_page_link_content']; ?></p></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="row">
					<div class="circle-fields">
						<div class="col-md-4 col-lg-3">
							<div class="circle">
								<a href="<?php echo $home_page_link_array[3]['home_page_link_url']; ?>">
									<img src="<?php echo base_url(); ?>assets/img/user-circle.png" alt="bottom-line" class="img-responsive center-block" id="myImage4" onmouseenter="changeImage(4)" onmouseleave="changeoldImage(4)"/>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-lg-9">
							<a href="<?php echo $home_page_link_array[3]['home_page_link_url']; ?>"><h4><?php echo $home_page_link_array[3]['home_page_link_title']; ?></h4></a>
							<a href="<?php echo $home_page_link_array[3]['home_page_link_url']; ?>"><p><?php echo $home_page_link_array[3]['home_page_link_content']; ?></p></a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="banner-plane">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <h3><?php echo $page_blue_box_array['page_blue_box_title']; ?></h3>
				<p><?php echo $page_blue_box_array['page_blue_box_content']; ?></p>
                <a href="<?php echo $page_blue_box_array['page_blue_box_button_link']; ?>" class="btn btn-primary blue-section-button" id="join_us" role="button"><?php echo $page_blue_box_array['page_blue_box_button_text']; ?> <span class="fa fa-plane"></span></a>
				<div class="plane">
					<img src="<?php echo base_url(); ?>assets/img/sky-boeing.png" alt="" class="img-responsive center-block"/>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if (count($home_page_testimonial_array) > 0) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">

				<div class="our-client">
					<h2><?php echo (isset($configuration_testimonial_array) && $configuration_testimonial_array['configuration_name'] !== '') ? $configuration_testimonial_array['configuration_name'] : 'Our Clients' ?></h2>
					<img src="<?php echo base_url(); ?>assets/img/bottom-line.png" alt="bottom-line" class="img-responsive center-block"/>
				</div>
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
											<span class="testmonial"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $testimonial['home_page_testimonial_person']; ?></span>
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
<script>
	function changeImage(imageId) {
		switch (imageId) {
			case 1:
			{
				var image = document.getElementById('myImage1');
				image.src = base_url + "assets/img/pilot-circle-dark-blue.png";
				break;
			}
			case 2:
			{
				var image = document.getElementById('myImage2');
				image.src = base_url + "assets/img/plane-circle-dark-blue.png";
				break;
			}
			case 3:
			{
				var image = document.getElementById('myImage3');
				image.src = base_url + "assets/img/earth-circle-dark-blue.png";
				break;
			}
			case 4:
			{
				var image = document.getElementById('myImage4');
				image.src = base_url + "assets/img/user-circle-dark-blue.png";
				break;
			}
		}
	}
	function changeoldImage(imageId) {
		switch (imageId) {
			case 1:
			{
				var image1 = document.getElementById('myImage1');
				image1.src = base_url + "assets/img/pilot-circle.png";
				break;
			}
			case 2:
			{
				var image1 = document.getElementById('myImage2');
				image1.src = base_url + "assets/img/plane-circle.png";
				break;
			}
			case 3:
			{
				var image1 = document.getElementById('myImage3');
				image1.src = base_url + "assets/img/earth-circle.png";
				break;
			}
			case 4:
			{
				var image1 = document.getElementById('myImage4');
				image1.src = base_url + "assets/img/user-circle.png";
				break;
			}
		}
	}
</script>