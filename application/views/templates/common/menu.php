<style>		
	.login-blue-2 {
		background-color: #153156;
		color: #ffffff;
		margin: 0;
		padding: 7px 44px 35px;
	}
	.close {
		opacity: 0.84 !important;
	}
	#candidate_login_link, #employer_login_link {
		font-size: 13px;
	}
	@media only screen and (max-width:1920px) and (min-width:1400px){
		.pop-up-1920{
			font-size: 19px !important;
		}

	}
	@media only screen and (max-width:640px) and (min-width:360px){
		.modal-size {
			width: 340px;
		}
		.modal-content {
			border: none;
		}
	}
	@media only screen and (max-width:360px) and (min-width:320px){
		.modal-size {
			width: 299px;
		}
		.login-blue-2 {
			padding: 25px 7px 35px;
		}
		#join_increw {
			font-size: 31px;
		}
		.model-text-p {
			font-size: 15px;
		}
		.modal-content {
			border: none;
		}
	}
</style>
<div class="header">
	<div class="top">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 overflow">
					<div class="menu pull-right">
						<ul class="nav nav-pills">
							<?php if (isset($_SESSION['user']) && count($_SESSION['user'] > 0)) { ?>
								<li id="menu-bar-font_duplicate"><a href="<?php echo base_url(); ?>dashboard" style="font-size: 14px">My Dashboard</a></li>
								<li id="menu-bar-font_duplicate"><a style="font-size: 14px">|</a></li>
								<li id="menu-bar-font"><a href="<?php echo base_url(); ?>auth/logout" style="font-size: 14px" class="last-child-menu"> Logout</a></li>
							<?php } else { ?>
								<li id="menu-bar-font_duplicate"><a  href="<?php echo base_url(); ?>login" style="font-size: 14px">Login</a></li>
								<li id="menu-bar-font_duplicate"><a style="font-size: 14px">|</a></li>
								<li id="menu-bar-font" class="last-child-menu"><a data-toggle="modal" data-target=".bs-example-modal-sm" style="font-size: 14px" href="javascript:;">Register</a></li>
								<!-- Modal -->
								<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
									<div class="modal-dialog modal-sm modal-size">
										<div class="modal-content">
											<div class="login-blue-2">
												<button type="button" class="close" data-dismiss="modal" id="button_close" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
												<h2 id="join_increw">Join InCrew</h2>
												<p class="model-text-p">Sign up with us today by selecting the employer or candidate icon below and start applying or posting jobs. </p>
												<a href="<?php echo base_url(); ?>employee-login" class="btn btn-warning btn-lg login_overlap pop-up-1920" id="candidate_login_link">Candidate <span class="fa fa-plane"></span></a>
												<a href="<?php echo base_url(); ?>employer-login" class="btn btn-warning btn-lg login_overlap pop-up-1920" id="employer_login_link">Employer <span class="fa fa-plane"></span></a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="Logo" class="img-responsive mobile-size-logo"></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right" id="menu-right">
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>our-services">Our Services</a></li>
					<li><a href="<?php echo base_url(); ?>careers">Careers</a></li>
					<li><a href="<?php echo base_url(); ?>aircraft-sales">Aircraft Sales</a></li>
					<li><a href="<?php echo base_url(); ?>aircraft-charter">Aircraft Charter</a></li>
					<li><a href="<?php echo base_url(); ?>contact-us" class="last-child-menu">Contact Us</a></li>
				</ul>
			</div>
		</div>
	</nav>
</div>
<script>var url = window.location;
	$('ul.nav a[href="' + url + '"]').parent().addClass('active');
	$(".nav li#logo-active").removeClass('active');
	$(".nav li#menu-bar-font_duplicate").removeClass('active');
	$(".nav li#menu-bar-font").removeClass('active');
</script>