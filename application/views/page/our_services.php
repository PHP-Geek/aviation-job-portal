<div class="bread">
    <div class="container">       
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Our Services</li>
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
                    <h1><span style="font-weight: 500">Our Services</span></h1>
                    <p>InCrew is your full service aviation partner catering to your corporate, private and commercial crewing, aircraft sales and acquisitions, aircraft management, entry into service and chartering needs. We offer beginning to end, one stop worldwide professional aviation support at competitive rates to meet or exceed your expectations.</p>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="bg-in-pages"> 
<div class="container">
      <div class="well-white spacebot-20">
	<?php
	foreach ($increw_service_array as $key => $increw_service) {
		if ($key % 2 === 0) {
			?>
			<div class="row"><?php } ?>
			<div class="col-md-6 col-lg-6 col-sm-6">
				<div class="about-us">
					<a href="<?php echo base_url() . $increw_service['increw_service_link']; ?>">
						<img src="<?php
						if (is_file(FCPATH . 'uploads/pages/increw_services' . date('/Y/m/d/H/i/s/', strtotime($increw_service['increw_service_created'])) . $increw_service['increw_service_image'])) {
							echo base_url() . 'uploads/pages/increw_services' . date('/Y/m/d/H/i/s/', strtotime($increw_service['increw_service_created'])) . $increw_service['increw_service_image'];
						} else {
							echo base_url() . 'assets/img/service-5.jpg';
						}
						?>" alt="pilot" class="img-responsive center-block"/></a>
					<a href="<?php echo base_url() . $increw_service['increw_service_link']; ?>"><h4><?php echo $increw_service['increw_service_title'] ?></h4></a>
					<p><?php echo $increw_service['increw_service_content']; ?></p>
				</div>
			</div>
			<?php if ($key % 2 !== 0) { ?>
			</div>
		<?php } ?>
	<?php } ?>
</div>
     </div>
  </div>
