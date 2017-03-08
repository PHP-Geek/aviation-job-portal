<style>
	.little-banner{
		margin-bottom: 0px;
	}
	.footer{
		margin-top: 0px;
	}
	.well-white{
		padding:0px;
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		#warning_button_small_devices{
			font-size:14px !important;
			padding: 6px 14px !important;
		}
		.about-us {
			overflow: hidden;
		}
		.about-us img {
			margin-top:15px;
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
                    <li class="active">Staff Recruitment</li>
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
                    <h1><span style="font-weight: 500">Staff Recruitment</span></h1>
                    <p>InCrew has an extensive database of professional, dedicated and readily available Pilots, Engineer, Flight Attendant, Operations, Air Traffic Controller and Corporate personnel available for permanent positions. Not only will we provide excellent crew that will manage your trip completely giving you peace of mind, but our services will also save you money. Our crew support the latest makes and models of aircraft in the commercial, private and corporate aviation sectors. Engage us today to obtain permanent staff to support your operation!
					</p>
					<div class="pull-right">
                        <a role="button" class="btn btn-warning btn-lg btn-margin-bottom" href="<?php echo base_url(); ?>crew-request-form">Request Crew <span class="fa fa-plane"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
	<div class="container">
		<?php
		if (count($staff_recruitment_array) > 0) {
			foreach ($staff_recruitment_array as $key => $staff_recruitment) {
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="well-white">
							<div class="row">
								<div class="col-md-6 col-lg-6 col-sm-6">
									<div class="about-us space-10">
										<h4><?php echo $staff_recruitment['staff_recruitment_title']; ?> </h4>
										<p><?php echo $staff_recruitment['staff_recruitment_content']; ?></p>
										<a href="<?php echo $staff_recruitment['staff_recruitment_button_link']; ?>" class="btn btn-warning btn-lg pull-right btn-margin-bottom" role="button"><?php echo $staff_recruitment['staff_recruitment_button_text']; ?>  <span class="fa fa-plane"></span></a>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-sm-6 image-left-fix">
									<div class="about-us">
										<img class="img-responsive top-image" alt="pilot-2" src="<?php echo base_url(); ?>uploads/pages/staff_recruitment/<?php echo date('Y/m/d/H/i/s/', strtotime($staff_recruitment['staff_recruitment_created'])) . $staff_recruitment['staff_recruitment_image']; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		}
		else{
			echo 'No Data';
		}
		?>
	</div>
</div>  
