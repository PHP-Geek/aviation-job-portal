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
    .top-image{
        margin-top:41px;
    }
	.little-banner{
		margin-bottom: 0px;
	}
	.footer{
		margin-top: 0px;
	}
	.well-white{
		padding:0px;
	}
	.about-us h4 {
		color: #000000 !important;
	}
	.text-aboutus-blue{
		color:#337ab7;
		font-size: 20px;
	}
	.content-blue-p p{
		font-size:15px;
	}
	.our-client-testmonial h3 {
		font-size: 20px;
	}
	.our-client-testmonial p {
		font-size: 15px;
	}
	.well-white_blue{
		background-color: #5495FF;
		border: 1px solid #e3e3e3;
		border-radius: 4px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
		min-height: 20px;
		padding: 19px;
		overflow: hidden;
		color: #fff;
		border-top: 1px solid #fff;
	}
	@media only screen and (max-width:640px) and (min-width:481px){
		.space-right-10 {
			margin: 10px;
		}
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.top-image {
			margin-top: 0px;
		}
		.space-right-10 {
			margin: 10px;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">About Us</li>
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
                    <h1><span style="font-weight: 500">About Us</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages">
	<div class="container">
		<div class="about-us">
			<?php
			foreach ($about_increw_array as $key => $about_increw) {
				if ($key === 0) {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="well-white_blue spaceup-20">
								<h5 class="title_aboutus"><?php echo $about_increw['about_increw_title']; ?></h5>
								<?php echo $about_increw['about_increw_content']; ?>
							</div>
						</div>
					</div>
					<?php
				} else if ($key % 2 !== 0) {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="well-white">
								<div class="row">
									<div class="col-md-6 col-lg-6 col-sm-6 image-left-fix">
										<img src="<?php echo base_url(); ?>uploads/pages/about_increw/<?php echo date('Y/m/d/H/i/s/', strtotime($about_increw['about_increw_created'])) . $about_increw['about_increw_image']; ?>" alt="pilot" class="img-responsive"/>
									</div>
									<div class="col-md-6 col-lg-6 col-sm-6">
										<div class="space-right-10">
											<h4><?php echo $about_increw['about_increw_title']; ?></h4>
											<?php echo $about_increw['about_increw_content']; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="well-white">
								<div class="row">
									<div class="col-md-6 col-lg-6 col-sm-6">
										<div class="space-10">
											<h4><?php echo $about_increw['about_increw_title']; ?></h4>
											<?php echo $about_increw['about_increw_content']; ?>
										</div>
									</div>
									<div class="col-md-6 col-lg-6 col-sm-6 image-left-fix">
										<img src="<?php echo base_url(); ?>uploads/pages/about_increw/<?php echo date('Y/m/d/H/i/s/', strtotime($about_increw['about_increw_created'])) . $about_increw['about_increw_image']; ?>" alt="pilot" class="img-responsive pull-right"/>
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
	<div class = "container">
		<div class="row">			
			<div class="col-md-12">
				<div class="well-white">
					<div class="content-blue-p space-10 space-right-10">
						<?php foreach ($about_increw_footer_array as $about_increw_footer) { ?>
							<div class="row">
								<div class="col-lg-12">
									<h3 class="text-aboutus-blue"><?php if ($about_increw_footer['about_increw_footer_link'] !== '') { ?>
											<a href="<?php echo $about_increw_footer['about_increw_footer_link']; ?>"><?php } echo $about_increw_footer['about_increw_footer_title']; ?>
											<?php if ($about_increw_footer['about_increw_footer_link'] !== '') { ?>
											</a><?php } ?>
									</h3>
									<p><?php echo $about_increw_footer['about_increw_footer_content']; ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="well-white spacebot-20">
					<div class="row">
						<div class="col-md-10 col-lg-10 col-sm-10">
							<div class="our-client-testmonial space-10">
								<h3 class="text-left">Testimonial</h3>
								<p><?php echo $page_testimonial_array['page_testimonial_content']; ?></p>
								<span class="testmonial"><?php echo $page_testimonial_array['page_testimonial_person']; ?></span>
								<span class="testmonial-icon"><i class="fa fa-user"></i></span>
							</div>
						</div>
						<div class="col-md-2 col-lg-2 col-sm-2">
							<div class="our-client-testmonial">
								<img src="<?php
								echo base_url() . 'assets/img/client.png';
								?>" alt="our-client" class="img-responsive center-block img-rounded top-image"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //echo $page_testimonial_array['page_testimonial_content']; ?>
<?php // echo $page_testimonial_array['page_testimonial_person']; ?>
