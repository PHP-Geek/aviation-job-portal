<?php
$this->load->model('page_model');
$social_media_array = $this->Page_model->get_social_media_links();
?>
<div class="footer">
    <div class="container">
		<div class="main-footer">
			<div class="row">
                <div class="col-sm-8 col-md-3 col-lg-3">
                    <h5>About Us</h5>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>about-us">About InCrew</a></li>
                        <li><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                        <li><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <h5>Aviation Services</h5>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>contract-crew-request">Contract Crew Support</a></li>
                        <li><a href="<?php echo base_url(); ?>staff-recruitment">Staff Recruitment</a></li>
                        <li><a href="<?php echo base_url(); ?>aircraft-management">Aircraft Management</a></li>
                    </ul>
                </div>
                <div class="col-sm-8 col-md-3 col-lg-3">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>news-and-events">News & Events </a></li>
                        <li><a href="<?php echo base_url(); ?>careers">Careers</a></li>
                        <li><a href="<?php echo base_url(); ?>sales-and-acquisitions">Aircraft Sales & Acquisitions</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-2 col-lg-2">
					<div class="footer-last-child">
						<h5>Join Us</h5>
						<ul>
							<?php if (isset($_SESSION['user'])) { ?>
								<li><a href="<?php echo base_url(); ?>dashboard">My Dashboard</a>
									<a href="<?php echo base_url(); ?>user/change_password">Change Password</a></li>
							<?php } else { ?>
								<li><a href="<?php echo base_url(); ?>login">Login | Register</a></li>
							<?php } ?>
						</ul>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="main-footer-right">
									<?php $social_media_array = $this->Page_model->get_social_media_links(); ?>
									<ul>
										<li><a  onclick="social_links_model('1');" data-toggle="modal" data-target="#footer_social_links_modal"><i class="fa fa-facebook fa-2x" id="social-menu-size"></i></a></li>
										<li><a href="<?php echo $social_media_array['3']['social_media_link_url']; ?>" target="_blank"><i class="fa fa-twitter fa-2x" id="social-menu-size"></i></a></li>
										<li><a href="<?php echo $social_media_array['2']['social_media_link_url']; ?>" target="_blank"><i class="fa fa-google-plus fa-2x" id="social-menu-size"></i></a></li>
										<li><a href="<?php echo $social_media_array['0']['social_media_link_url']; ?>" target="_blank"><i class="fa fa-linkedin fa-2x" id="social-menu-size"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<div class="footer-end">
    <div class="container">
        <div class="row">
			<div class="col-md-6 col-sm-6">
				<p>InCrew &copy; 2016 &bull; www.InCrew.com.au</p>
			</div>
			<div class="col-md-6 col-sm-6">
				<a href="<?php echo base_url(); ?>privacy-policy"><p class="footer-text-right">Privacy Policy</p></a>
			</div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="footer_social_links_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Social Links</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-4">
						<div class="text-center" id="link1"></div>
						<div class="spacer9"></div>
						<div class="text-center" id="title1"></div>
					</div>
					<div class="col-xs-4">
						<div class="text-center" id="link2"></div>
						<div class="spacer9"></div>
						<div class="text-center" id="title2"></div>
					</div>
					<div class="col-xs-4">
						<div class="text-center" id="link3"></div>
						<div class="spacer9"></div>
						<div class="text-center" id="title3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function social_links_model(social_id) {
		switch (social_id) {
			case '0' :
			{
				$('.modal-title').text("<?php echo $social_media_array['0']['social_media_link_name']; ?> Links");
				$('#link1').html("<a href=\'<?php echo $social_media_array['0']['social_media_link_url']; ?>\' target='_blank'><i class='fa fa-linkedin fa-2x' id='social-menu-size'></i></a>");
				$('#title1').html("<a href=\'<?php echo $social_media_array['0']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['0']['social_media_link_title']; ?></a>");
				$('#link2').html("<a href=\'<?php echo $social_media_array['0']['social_media_link_url1']; ?>\' target='_blank'><i class='fa fa-linkedin fa-2x' id='social-menu-size'></i></a>");
				$('#title2').html("<a href=\'<?php echo $social_media_array['0']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['0']['social_media_link_title1']; ?></a>");
				$('#link3').html("<a href=\'<?php echo $social_media_array['0']['social_media_link_url2']; ?>\' target='_blank'><i class='fa fa-linkedin fa-2x' id='social-menu-size'></i></a>");
				$('#title3').html("<a href=\'<?php echo $social_media_array['0']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['0']['social_media_link_title2']; ?></a>");
				break;
			}
			case '1' :
			{
				$('.modal-title').text("<?php echo $social_media_array['1']['social_media_link_name']; ?> Links");
				$('#link1').html("<a href=\'<?php echo $social_media_array['1']['social_media_link_url']; ?>\' target='_blank'><i class='fa fa-facebook fa-2x' id='social-menu-size'></i></a>");
				$('#title1').html("<a href=\'<?php echo $social_media_array['1']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['1']['social_media_link_title']; ?></a>");
				$('#link2').html("<a href=\'<?php echo $social_media_array['1']['social_media_link_url1']; ?>\' target='_blank'><i class='fa fa-facebook fa-2x' id='social-menu-size'></i></a>");
				$('#title2').html("<a href=\'<?php echo $social_media_array['1']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['1']['social_media_link_title1']; ?></a>");
				$('#link3').html("<a href=\'<?php echo $social_media_array['1']['social_media_link_url2']; ?>\' target='_blank'><i class='fa fa-facebook fa-2x' id='social-menu-size'></i></a>");
				$('#title3').html("<a href=\'<?php echo $social_media_array['1']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['1']['social_media_link_title2']; ?></a>");
				break;
			}
			case '2' :
			{
				$('.modal-title').text("<?php echo $social_media_array['2']['social_media_link_name']; ?> Links");
				$('#link1').html("<a href=\'<?php echo $social_media_array['2']['social_media_link_url']; ?>\' target='_blank'><i class='fa fa-google-plus fa-2x' id='social-menu-size'></i></a>");
				$('#title1').html("<a href=\'<?php echo $social_media_array['2']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['2']['social_media_link_title']; ?></a>");
				$('#link2').html("<a href=\'<?php echo $social_media_array['2']['social_media_link_url1']; ?>\' target='_blank'><i class='fa fa-google-plus fa-2x' id='social-menu-size'></i></a>");
				$('#title2').html("<a href=\'<?php echo $social_media_array['2']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['2']['social_media_link_title1']; ?></a>");
				$('#link3').html("<a href=\'<?php echo $social_media_array['2']['social_media_link_url2']; ?>\' target='_blank'><i class='fa fa-google-plus fa-2x' id='social-menu-size'></i></a>");
				$('#title3').html("<a href=\'<?php echo $social_media_array['2']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['2']['social_media_link_title2']; ?></a>");
				break;
			}
			case '3' :
			{
				$('.modal-title').text("<?php echo $social_media_array['3']['social_media_link_name']; ?> Links");
				$('#link1').html("<a href=\'<?php echo $social_media_array['3']['social_media_link_url']; ?>\' target='_blank'><i class='fa fa-twitter fa-2x' id='social-menu-size'></i></a>");
				$('#title1').html("<a href=\'<?php echo $social_media_array['3']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['0']['social_media_link_title']; ?></a>");
				$('#link2').html("<a href=\'<?php echo $social_media_array['3']['social_media_link_url1']; ?>\' target='_blank'><i class='fa fa-twitter fa-2x' id='social-menu-size'></i></a>");
				$('#title2').html("<a href=\'<?php echo $social_media_array['3']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['3']['social_media_link_title1']; ?></a>");
				$('#link3').html("<a href=\'<?php echo $social_media_array['3']['social_media_link_url2']; ?>\' target='_blank'><i class='fa fa-twitter fa-2x' id='social-menu-size'></i></a>");
				$('#title3').html("<a href=\'<?php echo $social_media_array['3']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['3']['social_media_link_title2']; ?></a>");
				break;
			}
			case '4' :
			{
				$('.modal-title').text("<?php echo $social_media_array['4']['social_media_link_name']; ?> Links");
				$('#link1').html("<a href=\'<?php echo $social_media_array['4']['social_media_link_url']; ?>\' target='_blank'><i class='fa fa-youtube fa-2x' id='social-menu-size'></i></a>");
				$('#title1').html("<a href=\'<?php echo $social_media_array['4']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['0']['social_media_link_title']; ?></a>");
				$('#link2').html("<a href=\'<?php echo $social_media_array['4']['social_media_link_url1']; ?>\' target='_blank'><i class='fa fa-youtube fa-2x' id='social-menu-size'></i></a>");
				$('#title2').html("<a href=\'<?php echo $social_media_array['4']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['4']['social_media_link_title1']; ?></a>");
				$('#link3').html("<a href=\'<?php echo $social_media_array['4']['social_media_link_url2']; ?>\' target='_blank'><i class='fa fa-youtube fa-2x' id='social-menu-size'></i></a>");
				$('#title3').html("<a href=\'<?php echo $social_media_array['4']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['4']['social_media_link_title2']; ?></a>");
				break;
			}
			case '5' :
			{
				$('.modal-title').text("<?php echo $social_media_array['5']['social_media_link_name']; ?> Links");
				$('#link1').html("<a href=\'<?php echo $social_media_array['5']['social_media_link_url']; ?>\' target='_blank'><i class='fa fa-pinterest-p fa-2x' id='social-menu-size'></i></a>");
				$('#title1').html("<a href=\'<?php echo $social_media_array['5']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['5']['social_media_link_title']; ?></a>");
				$('#link2').html("<a href=\'<?php echo $social_media_array['5']['social_media_link_url1']; ?>\' target='_blank'><i class='fa fa-pinterest-p fa-2x' id='social-menu-size'></i></a>");
				$('#title2').html("<a href=\'<?php echo $social_media_array['5']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['5']['social_media_link_title1']; ?></a>");
				$('#link3').html("<a href=\'<?php echo $social_media_array['5']['social_media_link_url2']; ?>\' target='_blank'><i class='fa fa-pinterest-p fa-2x' id='social-menu-size'></i></a>");
				$('#title3').html("<a href=\'<?php echo $social_media_array['5']['social_media_link_url']; ?>\' target='_blank'><?php echo $social_media_array['5']['social_media_link_title2']; ?></a>");
				break;
			}
		}

	}
</script>
<?php $this->load->view('templates/common/footer_include'); ?>
<!--{elapsed_time}|{memory_usage}-->
</body>
</html>