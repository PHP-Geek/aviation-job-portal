<style>
    .text-top-center {
        margin-top:46px;
    }
	.top-image{
        margin-top:41px;
    }
	.our-client-testmonial p {
		font-size: 15px;
	}
	.divider {
		margin: 13px 0;
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.testmonial {
			float: none;
		}
		.testmonial-icon {
			float: none;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Testimonials</li>
        </ol>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="little-banner-text">
            <h1><span style="font-weight: 500">Testimonials</span></h1>
        </div>
    </div>
</div>
<div class="container">
	<div class="spaceup-20"></div>
	<div class="spacebot-20">
		<?php
		if (count($testimonial_array) > 0) {
			$counter = 1;
			foreach ($testimonial_array as $key => $testimonial) {
				if ($counter % 2 === 1) {
					?>					
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="our-client-testmonial">
								<p class="text-top-center"><?php echo $testimonial['testimonial_content']; ?></p>
								<span class="testmonial"><i class="fa fa-user"></i>  <?php echo $testimonial['testimonial_user_name']; ?></span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="about-us">
								<img src="<?php echo base_url(); ?>uploads/testimonials/<?php echo date('Y/m/d/H/i/s/', strtotime($testimonial['testimonial_created'])) . $testimonial['testimonial_image']; ?>" alt="pilot" class="img-responsive pull-right"/>
							</div>
						</div>
					</div><?php } else { ?>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="our-client-testmonial">
								<p class="text-top-center"><?php echo $testimonial['testimonial_content'];
					?></p>
								<span class="testmonial"><i class="fa fa-user"></i>  <?php echo $testimonial['testimonial_user_name']; ?></span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="about-us">
								<img src = "<?php echo base_url(); ?>uploads/testimonials/<?php echo date('Y/m/d/H/i/s/', strtotime($testimonial['testimonial_created'])) . $testimonial['testimonial_image']; ?>" alt = "pilot" class = "img-responsive pull-right"/>
							</div>
						</div>						
					</div>
				<?php } if ($key !== count($testimonial_array) - 1) { ?>
					<div class="divider">
						<img src="<?php echo base_url(); ?>assets/img/divider.png" alt="divider" class="img-responsive center-block"/>
					</div>
					<?php
				}
				$counter++;
				?>
				<?php
			}
		} else {
			echo '<h4 class="well">No Testimonials.</h4>';
		}
		?>
	</div>
</div>