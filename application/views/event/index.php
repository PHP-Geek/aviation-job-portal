<style>
	.about-us p{
		min-height: auto !important;
	}
	.pagination{
		margin-bottom: 0px;
	}
	.little-banner{
		margin-bottom: 0px;
	}
	.image-left-fix {
		padding-left: 0 !important;
		padding-right: 0 !important;
	}
	.footer{
		margin-top: 0px;
	}
	.well-white {
		padding: 0;
	}
    .top-image{
        margin-top:14px;
    }
	.event-date{
		margin-left:2px;
	}
	.event-expand{
		height:auto !important;
	}
	.btn-success {
		margin: 0px;
	}
	.about-us p {
		padding:0px;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">News &amp; Events</li>
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
                    <p>Keep up to date with the latest InCrew and aviation industry news and events.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-in-pages">
	<div class="container">
		<?php foreach ($event_array as $key => $event) { ?>
			<div class="row">
				<div class="well-white">
					<div class="col-md-6 col-sm-6 col-lg-6">
						<div class="about-us">
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<h4><?php echo $event['event_title']; ?></h4>
									<span class="event-date"><?php echo date('d-m-Y', strtotime($event['event_created'])); ?></span>
									<div class="spacer9"></div>
								</div>
							</div>
							<div id="content_<?php echo $event['event_id']; ?>">
								<?php
								if (strlen($event['event_detail']) > 200) {
									$length = strpos($event['event_detail'], ' ', 250);
								} else {
									$length = strlen($event['event_detail']);
								}
								echo substr($event['event_detail'], 0, $length);
								if (strlen($event['event_detail']) > 200) {
									?>
								<?php } ?>
								<div class="spacer9"></div>
								<a href="javascript:;" data-toggle="collapse" data-target="#event_<?php echo $event['event_id']; ?>" aria-expanded="false" aria-controls="collapseExample" onclick="hide_current_content(<?php echo $event['event_id']; ?>);" class="btn btn-success pull-right btn-margin-bottom">
									Read More <i class="fa fa-plane"></i>
								</a>
								<div class="spacer9"></div>
							</div>
							<div class="collapse" id="event_<?php echo $event['event_id']; ?>">
								<?php echo $event['event_detail']; ?>
	<!--									<a href="javascript:;" onclick="hide_event(<?php //echo $event['event_id'];                   ?>);" class="btn btn-success pull-right">
										Collapse <i class="fa fa-plane"></i>
									</a>
								</p>-->
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 image-left-fix">
						<div class="about-us">
							<img src="<?php echo base_url() . 'uploads/events' . date('/Y/m/d/H/i/s/', strtotime($event['event_created'])) . $event['event_image']; ?>" alt="event-image" class="img-responsive center-block  pull-right"/>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="text-center">
					<?php echo $page_links; ?>
				</div>
			</div>
		</div>
		<div class="spacer9"></div>
		<div class="spacer9"></div>
		<div class="spacer9"></div>
	</div>
</div>
<script>
	function hide_event(event_id) {
		$("#event_" + event_id).hide(0);
		$("#event_" + event_id).addClass('event-expand');
		$("#content_" + event_id).show(0);
	}
	function hide_current_content(event_id) {
		$("#content_" + event_id).hide(0);
		$("#event_" + event_id).show(0);
	}
</script>