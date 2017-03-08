<style>
	.event-date{
		margin-left:2px;
	}
	.top-image{
		margin-top:15px;
	}
	.about-us h4 {
		font-size: 40px;
	}
</style>
<div class="bread">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>event">News &amp; Events</a></li>
					<li class="active">View News and Events</li>
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
					<h1><span style="font-weight: 500">News &amp; Events</span></h1>
					<p>Aided by InCrew's online Aircrew Brokerage, we make ferrying and delivery a breeze. A call to InCrew secures a crew, flightplan, en route planning and permissions, and flight watch for your ferry flight, with the minimum of fuss.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-lg-6 col-sm-6">
			<div class="about-us">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<h4><?php echo $event_array['event_title']; ?></h4>
						<span class="event-date"><?php echo date('M d, Y, h:i a', strtotime($event_array['event_created'])); ?></span>
						<hr/>
					</div>
				</div>
				<p><?php echo $event_array['event_detail']; ?></p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-6">
			<div class="about-us">
				<img src="<?php echo base_url() . 'uploads/events' . date('/Y/m/d/H/i/s/', strtotime($event_array['event_created'])) . $event_array['event_image']; ?>" alt="event-image" class="img-responsive center-block top-image pull-right"/>
			</div>
		</div>
	</div>
</div>
