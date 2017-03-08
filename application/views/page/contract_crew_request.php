<style>
	.little-banner-2{
		margin-bottom: 0px;
	}
	.footer{
		margin-top: 0px;
	}
	.about-us h4{
		font-size:30px;
	}
	.about-us p{
		min-height: auto !important;
	}
	.well-white{
		padding:0px ;
	}
	.about-us h4 {
		font-size: 25px;
	}
	.h3, h3 {
		font-size: 20px;
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		#warning_button_small_devices{
			font-size:14px !important;
			padding: 6px 14px !important;
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
                    <li class="active">Contract Crew Support</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="little-banner-text">
                    <h1><span style="font-weight: 500">Contract Crew Support</span></h1>
                    <p>InCrew has an extensive database of professional, dedicated and readily available Pilots, Engineer, Flight Attendant, Operations, Air Traffic Controller and Corporate personnel available for short and long term contract positions. Not only will we provide excellent crew that will manage your trip completely giving you peace of mind, but our services will also save you money. Our crew support the latest makes and models of aircraft in the commercial, private and corporate aviation sectors.
						Engage us today to obtain contract crew support!
					</p>
                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>crew-request-form" class="btn btn-warning btn-lg" role="button">Request Crew Support   <span class="fa fa-plane"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="spacer9"></div>
</div>
<div class="bg-in-pages">
	<div class="container">
		<?php $i = 1;
		foreach ($contract_crew_support_array as $contract_crew_support) {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="well-white<?php
					if (count($contract_crew_support_array) == $i) {
						echo ' spacebot-20';
					}
					$i++;
					?>">
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="space-10 about-us">
									<h4><?php echo $contract_crew_support['contract_crew_support_title']; ?></h4>
	<?php echo $contract_crew_support['contract_crew_support_content']; ?>
									<a role="button" class="btn btn-warning btn-lg pull-right btn-margin-bottom" href="<?php echo $contract_crew_support['contract_crew_support_button_link']; ?>">  <?php echo $contract_crew_support['contract_crew_support_button_text']; ?> <span class="fa fa-plane"></span></a>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6 image-left-fix">
								<div class="about-us">
									<img class="img-responsive center-block pull-right" alt="pilot-2" src="<?php echo base_url() . 'uploads/pages/contract_crew/' . date('Y/m/d/H/i/s/', strtotime($contract_crew_support['contract_crew_support_created'])) . $contract_crew_support['contract_crew_support_image']; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php } ?>
	</div>
</div>
