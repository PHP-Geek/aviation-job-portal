<style>
    .little-banner{
        margin-bottom: 0px;
    }
    .aboutus_content {
		min-height: 162px;
        overflow: hidden;
    }
    .footer{
        margin-top: 0px;
    }
    .well-white{
        padding: 0px;
        padding-bottom: 10px;
    }
    .about-us h4 {
        font-size: 22px; 
    }
    .about-us p{
        margin-bottom:5px !important;
		font-weight: 300;
    }
    .aboutus_content {
        font-size: 16px;
        font-weight: 300;
    }
	.career-top-margin {
		overflow: hidden;
	}
	@media only screen and (max-width:1024px) and (min-width:768px){
		.about-us p {
			padding: 0;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Careers</li>
        </ol>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="little-banner-text">
            <h1><span style="font-weight: 500">Careers</span></h1>
            <p>Join InCrew and never miss a career opportunity in the aviation industry. Our strong relationships with airlines, aircraft owners and corporate means InCrew has contract and permanent positions available for Pilots, Maintenance Engineers, Flight Attendants, Operations, Executives, Air Traffic Controllers and Corporate personnel. Apply now to further your career!</p>
        </div>
    </div>
</div>
<div class="bg-in-pages padbot-20">
    <div class="container about-us">
        <div class="row">
			<?php
			$i = 1;
			foreach ($job_type_array as $key => $job_type) {
				if ($key % 3 === 0 || $key === 0) {
					?>
				<?php } ?>
				<div class="col-md-4 col-lg-4 col-sm-6">
					<div class="well-white">
						<img class="img-responsive center-block center-block" alt="Position Image" src="<?php echo base_url(); ?>uploads/job_types/<?php echo date('/Y/m/d/H/i/s/', strtotime($job_type['job_type_created'])) . $job_type['job_type_image']; ?>"/>
						<div class="fix-text">
							<h4 class=""><?php echo $job_type['job_type_name']; ?> Jobs</h4>
							<p class="aboutus_content"><?php echo $job_type['job_type_description']; ?></p>
							<div class="pull-right">
								<a role="button" class="btn btn-success btn-lg" href="<?php echo base_url(); ?>careers-open/<?php echo $job_type['job_type_slug']; ?>">View Jobs <span class="fa fa-plane"></span></a>
							</div>
						</div>
					</div>
				</div>


				<?php
			}
			?>
        </div>
    </div>
</div>
