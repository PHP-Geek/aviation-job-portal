<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li <?php
			if ($this->router->class === 'dashboard' && $this->router->method === 'index') {
				echo 'class="active"';
			}
			?>><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
				<?php if ($_SESSION['user']['group_slug'] === 'administrator') { ?>
				<!-- Contacts-->
				<li class="treeview <?php
				if ($this->router->class === 'page' && in_array($this->router->method, array('contacts', 'contact_office', 'aircraft_sales_acquisition_requests', 'entry_into_service_requests', 'contact', 'edit_page_blue_box'))) {
					echo 'active';
				}
				?>"><a href="#"><i class="fa fa-feed"></i> Contacts
						<span class="fa fa-angle-left pull-right"></span></a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'page' && in_array($this->router->method, array('contacts', 'aircraft_sales_acquisition_requests', 'entry_into_service_requests', 'contact'))) {
							echo 'class="active"';
						}
						?>><a href="#"><i class="fa fa-list"></i> Requests <i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'contact') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>page/contact"><i class="fa fa-list"></i><span>All</span></a></li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'contacts') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>page/contacts"><i class="fa fa-list"></i><span>Contact Feeds</span></a></li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'entry_into_service_requests') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>page/entry_into_service_requests"><i class="fa fa-list"></i><span>Entry into Service</span></a></li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'aircraft_sales_acquisition_requests') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>page/aircraft_sales_acquisition_requests"><i class="fa fa-list"></i><span>Aircraft Sales & Acquisitions</span></a></li>
							</ul>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'contact_office') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>page/contact_office"><i class="fa fa-building"></i><span>Contact Us Page Setup</span></a></li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'edit_page_blue_box') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>page/edit_page_blue_box/2"><i class="fa fa-circle-o"></i>Blue Box Setup</a>
						</li>
					</ul>			
				</li>
				<!--Users-->
				<li class="treeview <?php
				if ($this->router->class === 'user') {
					echo 'active';
				}
				?>">
					<a href="#"><i class="fa fa-users"></i> Users <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'user' && in_array($this->router->method, array('pilot', 'maintenance_engineer', 'flight_attendant', 'operations', 'executive', 'air_traffic_controller', 'corporate', 'employee'))) {
							echo 'class="active"';
						}
						?>><a href=""><i class="fa fa-list"></i> Employee <i class="fa fa-angle-left pull-right"></i></a>

							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'pilot') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/pilot"><i class="fa fa-circle-o"></i> Pilot</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'maintenance_engineer') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/maintenance_engineer"><i class="fa fa-circle-o"></i> Maintenance engineer</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'flight_attendant') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/flight_attendant"><i class="fa fa-circle-o"></i> Flight Attendant</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'operations') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/operations"><i class="fa fa-circle-o"></i> Operations</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'executive') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/executive"><i class="fa fa-circle-o"></i> Executive/Corporate</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'air_traffic_controller') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/air_traffic_controller"><i class="fa fa-circle-o"></i> Air Traffic Controller</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'employee') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/employee"><i class="fa fa-circle-o"></i> All</a>
								</li>
							</ul>
						</li>
						<li <?php
						if ($this->router->class === 'user' && in_array($this->router->method, array('airlines', 'business_aviation', 'general_aviation', 'recruiter', 'employer'))) {
							echo 'class="active"';
						}
						?>><a href=""><i class="fa fa-list"></i> Employer <i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'airlines') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/airlines"><i class="fa fa-circle-o"></i> Airlines</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'business_aviation') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/business_aviation"><i class="fa fa-circle-o"></i> Business Aviation</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'general_aviation') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/general_aviation"><i class="fa fa-circle-o"></i> General Aviation</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'recruiter') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/recruiter"><i class="fa fa-circle-o"></i> Recruiter</a>
								</li>
								<li <?php
								if ($this->router->class === 'user' && $this->router->method === 'employer') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>user/employer"><i class="fa fa-circle-o"></i> All</a>
								</li>
							</ul>
						</li>
						<li <?php
						if ($this->router->class === 'user' && $this->router->method === 'index') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>user"><i class="fa fa-list"></i> Both</a>
						</li>
						<li <?php
						if ($this->router->class === 'user' && $this->router->method === 'lists') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>user/lists"><i class="fa fa-list-alt"></i> User Lists</a>
						</li>
					</ul></li>
				<!--Aircrafts-->
				<li class="treeview <?php
				if (in_array($this->router->class, array('aircraft', 'manufacturer')) && in_array($this->router->method, array('index', 'add', 'edit', 'sale_interests', 'add_model', 'models', 'highlights'))) {
					echo 'active';
				}
				?>">
					<a href="#">
						<i class="fa fa-plane"></i>Aircraft Sales
						<span class="fa fa-angle-left pull-right"></span>
					</a>
					<ul class="treeview-menu">
						<li <?php
						if (in_array($this->router->class, array('aircraft')) && in_array($this->router->method, array('highlights', 'index'))) {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft"><i class="fa fa-list"></i><span>Aircraft Sales List</span></a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'add') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/add"><i class="fa fa-plus-square"></i><span>Add Aircraft for Sale</span></a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'sale_interests') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/sale_interests"><i class="fa fa-thumbs-o-up"></i><span>Aircraft Sales Interest</span></a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'add_model') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/add_model"><i class="fa fa-plus-circle"></i><span>Add Aircraft Model</span></a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'models') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/models"><i class="fa fa-list"></i><span>Aircraft Models</span></a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'list_sales_and_acquisitions') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>aircraft/list_sales_and_acquisitions"><i class="fa fa-circle-o"></i>Sales And Acquisition Content</a>
						</li><!--Manufacturer-->
						<li class="treeview <?php
						if ($this->router->class === 'manufacturer') {
							echo 'active';
						}
						?>">
							<a href="#">
								<i class="fa fa-wrench"></i>Manufacturer
								<span class="fa fa-angle-left pull-right"></span>
							</a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'manufacturer' && $this->router->method === 'index') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>manufacturer"><i class="fa fa-list"></i><span>Manufacturer List</span></a></li>
								<li <?php
								if ($this->router->class === 'manufacturer' && $this->router->method === 'add') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>manufacturer/add"><i class="fa fa-plus-square"></i><span>Add Manufacturer</span></a></li>

							</ul>
						</li>
					</ul>
				</li>
				<!--Aircraft Charter-->
				<li class="treeview <?php
				if ($this->router->class === 'aircraft' && in_array($this->router->method, array('quotes', 'list_charter', 'charter_image', 'charter_content', 'charter_testimonial', 'charter_brochure', 'dangerous_good_doc'))) {
					echo 'active';
				}
				?>">
					<a href="#">
						<i class="fa fa-plane"></i>Aircraft Charter
						<span class="fa fa-angle-left pull-right"></span>
					</a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'quotes') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/quotes"><i class="fa fa-plane"></i> Charter Requests</a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'list_charter') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>aircraft/list_charter"><i class="fa fa-circle-o"></i>Charter Page Setup</a>
						</li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'charter_brochure') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/charter_brochure"><i class="fa fa-file-pdf-o"></i> Charter Brochure</a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'dangerous_good_doc') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>aircraft/dangerous_good_doc"><i class="fa fa-file-pdf-o"></i> Dangerous Good PDF</a></li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'charter_content') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>aircraft/charter_content"><i class="fa fa-circle-o"></i>Charter Page Content</a>
						</li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'charter_image') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>aircraft/charter_image"><i class="fa fa-circle-o"></i>Banner Image</a>
						</li>
						<li <?php
						if ($this->router->class === 'aircraft' && $this->router->method === 'charter_testimonial') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>aircraft/charter_testimonial"><i class="fa fa-circle-o"></i>Charter Page Testimonial</a>
						</li>
					</ul>
				</li>
				<!--Crew Requests-->
				<li class="treeview <?php
				if (in_array($this->router->class, array('page')) && in_array($this->router->method, array('crew_requests', 'crew_history', 'list_contract_crew', 'edit_contract_crew', 'list_staff_recruitment'))) {
					echo 'active';
				}
				?>"><a href="#"><i class="fa fa-paper-plane"></i> <span>Crew Requests</span><span class="fa fa-angle-left pull-right"></span></a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'crew_requests') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>page/crew_requests"><i class="fa fa-list"></i> Request List</a>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'crew_history') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>page/crew_history"><i class="fa fa-list"></i> Crew Requests History</a>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'list_contract_crew') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>page/list_contract_crew"><i class="fa fa-circle-o"></i>Contract Crew Support Page</a>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'list_staff_recruitment') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>page/list_staff_recruitment"><i class="fa fa-circle-o"></i>Staff Recruitment Page</a>
						</li>
					</ul>
				</li>
				<!--Jobs-->
				<li class="treeview <?php
				if ($this->router->class === 'job') {
					echo 'active';
				}
				?>">
					<a href="#">
						<i class="fa fa-plane"></i>Job Pages
						<span class="fa fa-angle-left pull-right"></span>
					</a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'job' && $this->router->method === 'index') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>job" target="_blank"><i class="fa fa-list"></i><span>Jobs</span></a></li>
						<li <?php
						if ($this->router->class === 'job' && $this->router->method === 'post') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>job/post" target="_blank"><i class="fa fa-pencil"></i><span>Post Job</span></a></li>
						<li <?php
						if ($this->router->class === 'job' && $this->router->method === 'view_applicants') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>job/view_applicants" target="_blank"><i class="fa fa-tasks"></i><span>Job Applicants</span></a></li>
						<li <?php
						if ($this->router->class === 'job' && $this->router->method === 'requests') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>job/requests"><i class="fa fa-list"></i><span>Employer Job Requests</span></a></li>
						<li <?php
						if ($this->router->class === 'job' && $this->router->method === 'applications') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>job/applications"><i class="fa fa-list"></i><span>Job Applications</span></a></li>
					</ul>
				</li>
				<!--Advertisements-->
				<li class="treeview <?php
				if ($this->router->class === 'advertisement') {
					echo 'active';
				}
				?>">
					<a href="#">
						<i class="fa fa-tv"></i>Advertising
						<span class="fa fa-angle-left pull-right"></span>
					</a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'advertisement' && in_array($this->router->method, array('index', 'add', 'edit'))) {
							echo 'class="active"';
						}
						?>>
							<a href="#"><i class="fa fa-bars"></i> Job Page Advertising
								<span class="fa fa-angle-left pull-right"></span></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'advertisement' && $this->router->method === 'index') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>advertisement"><i class="fa fa-list"></i><span>View and Edit</span></a></li>
								<li <?php
								if ($this->router->class === 'advertisement' && $this->router->method === 'add') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>advertisement/add"><i class="fa fa-plus-square"></i><span>Add Advertisement</span></a></li>
							</ul>
						</li>
						<li <?php
						if ($this->router->class === 'advertisement' && in_array($this->router->method, array('popup_ads', 'manage_url', 'add_popup_ad', 'edit_popup_ad', 'popup_ads'))) {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>advertisement/popup_ads"><i class="fa fa-list"></i><span>Popup Ads</span></a></li>
					</ul>
				</li>
				<li class="treeview <?php
				if ($this->router->class === 'Page' && $this->router->method === 'social_media_setup') {
					echo 'active';
				}
				?>">
					<a href="<?php echo base_url(); ?>page/social_media_setup">
						<i class="fa fa-users"></i>Social Media Setup
					</a>
				</li>
				<!-- News & Events -->
				<li class="treeview <?php
				if ($this->router->class === 'event') {
					echo 'active';
				}
				?>">
					<a href="#">
						<i class="fa fa-newspaper-o"></i>News & Events
						<span class="fa fa-angle-left pull-right"></span>
					</a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'event' && $this->router->method === 'lists') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>event/lists"><i class="fa fa-list"></i><span>View and Edit</span></a></li>
						<li <?php
						if ($this->router->class === 'event' && $this->router->method === 'add') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>event/add"><i class="fa fa-plus-square"></i><span>Add News and Event</span></a></li>
					</ul>
				</li>
				<!--Testimonial Menu-->
				<li class="treeview <?php
				if ($this->router->class === 'testimonial' && in_array($this->router->method, array('lists', 'add'))) {
					echo 'active';
				}
				?>">
					<a href="#">
						<i class="fa fa-user"></i>Testimonials Page
						<span class="fa fa-angle-left pull-right"></span>
					</a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'testimonial' && in_array($this->router->method, array('lists', 'edit', 'add'))) {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>testimonial/lists"><i class="fa fa-list"></i><span>View and Edit</span></a></li>
						<li <?php
						if ($this->router->class === 'testimonial' && $this->router->method === 'add') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>testimonial/add"><i class="fa fa-plus-square"></i><span>Add Testimonial</span></a></li>

					</ul>
				</li>
				<!--Configuration of Drop down menu-->
				<li class="treeview <?php
				if ($this->router->class === 'configuration') {
					echo 'active';
				}
				?>"><a href="#"><i class="fa fa-wrench"></i> Configuration<span class="fa fa-angle-left pull-right"></span></a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'approval_rating') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/approval_rating"><i class="fa fa-circle-o"></i>Approval Ratings</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'type_ratings') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/type_ratings"><i class="fa fa-circle-o"></i>Type Ratings</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'licenses') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/licenses"><i class="fa fa-circle-o"></i>License List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'license_authorities') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/license_authorities"><i class="fa fa-circle-o"></i>License Authority List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'training') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/training"><i class="fa fa-circle-o"></i>Trainings/Courses List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'locations') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/locations"><i class="fa fa-circle-o"></i>Location List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'countries') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/countries"><i class="fa fa-circle-o"></i>Countries List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'employer_categories') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/employer_categories"><i class="fa fa-circle-o"></i>Employer Categories</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'positions') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/positions"><i class="fa fa-circle-o"></i>Position List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'categories') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/categories"><i class="fa fa-circle-o"></i>Position Sub Category List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'aircrafts') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/aircrafts"><i class="fa fa-circle-o"></i>Aircraft List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'management_experience') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/management_experience"><i class="fa fa-circle-o"></i>Management Experience List</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'skills') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/skills"><i class="fa fa-circle-o"></i>Skills</a></li>
						<li <?php
						if ($this->router->class === 'configuration' && $this->router->method === 'charter_aircrafts') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>configuration/charter_aircrafts"><i class="fa fa-circle-o"></i>Aircraft Choices (Charter Form)</a></li>
					</ul>
				</li>
				<!--Emails-->
				<li class="treeview <?php
				if ($this->router->class === 'email') {
					echo 'active';
				}
				?>">
					<a href="#"><i class="fa fa-envelope"></i> Emails<span class="fa fa-angle-left pull-right"></span></a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'email' && $this->router->method === 'contact_list') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>email/contact_list"><i class="fa fa-envelope-o"></i><span>Email Contact List</span></a>
						</li>
						<li <?php
						if ($this->router->class === 'email' && in_array($this->router->method, array('weekly_newsletters', 'updates', 'marketting', 'others', 'marketing_email_setup'))) {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>email/marketing_email_setup"><i class="fa fa-envelope-o"></i>Marketing Email Setup</a>
						</li>
						<li <?php
						if ($this->router->class === 'email' && $this->router->method === 'email_timing') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>email/email_timing"><i class="fa fa-envelope-o"></i><span>Email Timing</span></a>
						</li>
					</ul>
				</li>
				<!--Metrices-->
				<li class="treeview <?php
				if ($this->router->class === 'metric') {
					echo 'active';
				}
				?>">
					<a href="#"><i class="fa fa-bar-chart-o"></i> Metrics <span class="fa fa-angle-left pull-right"></span></a>
					<ul class="treeview-menu">
						<li <?php
						if ($this->router->class === 'metric' && $this->router->method === 'page_views') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>metric/page_views"><i class="fa fa-list-alt"></i><span>Page Views</span></a></li>
						<li <?php
						if ($this->router->class === 'metric' && $this->router->method === 'jobs_history') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>metric/jobs_history"><i class="fa fa-bars"></i><span>Jobs History</span></a></li>
						<li <?php
						if ($this->router->class === 'metric' && $this->router->method === 'job_shares') {
							echo 'class="active"';
						}
						?>><a href="<?php echo base_url(); ?>metric/job_shares"><i class="fa fa-share-alt"></i><span>Job Shares</span></a></li>
					</ul>
				</li>
				<!--Pages-->
				<li class="treeview <?php
				if (in_array($this->router->class, array('page', 'testimonial', 'aircraft')) && in_array($this->router->method, array('list_slider_image', 'list_home_page', 'list_home_page_links', 'list_about_us', 'list_entry_into_service', 'list_our_services', 'list_aircraft_management', 'aircraft_management_brochure', 'list_sales_and_acquisitions', 'home_page_background_image', 'about_increw_testimonial', 'edit_title', 'home_page_testimonial', 'edit_home_page_testimonial', 'add_home_page_testimonial', 'entry_into_service_brochure', 'list_about_us_footer', 'edit_list_about_us_footer', 'page_banner', 'edit_page_banner', 'page_blue_box', 'edit_page_blue_box', 'privacy_policy_setup', 'terms_setup', 'list_contract_crew', 'edit_contract_crew', 'add_contract_crew', 'edit_slider_image', 'edit_home_page', 'edit_home_page_link', 'edit_about_us', 'add_about_us', 'edit_about_us_footer', 'add_about_us_footer','edit_aircraft_management','add_aircraft_management'))) {
					echo 'active';
				}
				?>">
					<a href="#"><i class="fa fa-file-o"></i> Pages Setup<span class="fa fa-angle-left pull-right"></span></a>
					<ul class="treeview-menu">
						<li <?php
						if (in_array($this->router->class, array('page', 'testimonial')) && in_array($this->router->method, array('page_blue_box', 'edit_page_blue_box', 'list_slider_image', 'edit_slider_image', 'list_home_page', 'edit_home_page', 'list_home_page_link', 'edit_home_page_link', 'edit_title', 'home_page_testimonial', 'edit_home_page_testimonial', 'add_home_page_testimonial', 'home_page_background_image', 'edit_home_page', 'edit_title'))) {
							echo 'class="active"';
						}
						?>>
							<a href="#"><i class="fa fa-list"></i>HOME PAGE<span class="fa fa-angle-left pull-right"></span></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'page_blue_box' || $this->router->method === 'edit_page_blue_box') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/edit_page_blue_box/1"><i class="fa fa-circle-o"></i>Blue Box Setup</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && in_array($this->router->method, array('list_slider_image', 'edit_slider_image'))) {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/list_slider_image"><i class="fa fa-circle-o"></i>Slider Images</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'list_home_page' || $this->router->method === 'edit_home_page') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/list_home_page"><i class="fa fa-circle-o"></i>Page Writings</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'list_home_page_links' || $this->router->method === 'edit_home_page_link') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/list_home_page_links"><i class="fa fa-circle-o"></i>Center Picture Links</a>
								</li>
								<li <?php
								if ($this->router->class === 'testimonial' && $this->router->method === 'edit_title') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>testimonial/edit_title"><i class="fa fa-circle-o"></i>Home Page Testimonial Title</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'home_page_testimonial' || $this->router->method === 'edit_home_page_testimonial' || $this->router->method === 'add_home_page_testimonial') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/home_page_testimonial"><i class="fa fa-circle-o"></i>Home Page Testimonials</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'home_page_background_image') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/home_page_background_image"><i class="fa fa-circle-o"></i>Home Page Background Image</a>
								</li>
							</ul>
						</li>
						<li class="treeview <?php
						if (in_array($this->router->class, array('page')) && in_array($this->router->method, array('list_about_us', 'add_about_us', 'edit_about_us', 'list_about_us_footer', 'edit_about_footer', 'add_about_us_footer', 'edit_about_us_footer', 'about_increw_testimonial'))) {
							echo 'active';
						}
						?>">
							<a href="#"><i class="fa fa-list"></i> ABOUT US<span class="fa fa-angle-left pull-right"></span></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'page' && in_array($this->router->method, array('list_about_us', 'add_about_us', 'edit_about_us'))) {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/list_about_us"><i class="fa fa-circle-o"></i>About Us Page</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && in_array($this->router->method, array('list_about_us_footer', 'edit_about_us_footer', 'add_about_us_footer'))) {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/list_about_us_footer"><i class="fa fa-circle-o"></i>About Us Grey Box</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && in_array($this->router->method, array('about_increw_testimonial'))) {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/about_increw_testimonial"><i class="fa fa-circle-o"></i>About Increw Testimonial</a>
								</li>
							</ul>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'list_our_services') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>page/list_our_services"><i class="fa fa-circle-o"></i>Our Services</a>
						</li>
						<li class="treeview <?php
						if (in_array($this->router->class, array('page')) && in_array($this->router->method, array('list_entry_into_service', 'edit_entry_into_service', 'add_entry_into_service', 'entry_into_service_brochure'))) {
							echo 'active';
						}
						?>">
							<a href="#"><i class="fa fa-list"></i> Ferry, Delivery and Entry into 
								Service<span class="fa fa-angle-left pull-right"></span></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'page' && in_array($this->router->method, array('list_entry_into_service', 'edit_entry_into_service', 'add_entry_into_service'))) {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>page/list_entry_into_service"><i class="fa fa-circle-o"></i>Ferry, Delivery and Entry Into Service</a>
								</li>
								<li <?php
								if ($this->router->class === 'page' && $this->router->method === 'entry_into_service_brochure') {
									echo 'class="active"';
								}
								?>><a href="<?php echo base_url(); ?>page/entry_into_service_brochure"><i class="fa fa-file-pdf-o"></i> Ferry, Delivery and Entry Into Service Brochure </a></li>								
							</ul>
						</li>
						<li class="treeview <?php
						if (in_array($this->router->class, array('page', 'aircraft')) && in_array($this->router->method, array('list_aircraft_management','edit_aircraft_management','add_aircraft_management','aircraft_management_brochure'))) {
							echo 'active';
						}
						?>">
							<a href="#"><i class="fa fa-list"></i> AIRCRAFT MANAGEMENT<span class="fa fa-angle-left pull-right"></span></a>
							<ul class="treeview-menu">
								<li <?php
								if ($this->router->class === 'aircraft' && in_array($this->router->method, array('list_aircraft_management','edit_aircraft_management','add_aircraft_management'))) {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>aircraft/list_aircraft_management"><i class="fa fa-circle-o"></i>Aircraft Management</a>
								</li>
								<li <?php
								if ($this->router->class === 'aircraft' && $this->router->method === 'aircraft_management_brochure') {
									echo 'class="active"';
								}
								?>>
									<a href="<?php echo base_url(); ?>aircraft/aircraft_management_brochure"><i class="fa fa-file-pdf-o"></i>Aircraft Management Brochure</a>
								</li>	
							</ul>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'privacy_policy_setup') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>page/privacy_policy_setup"><i class="fa fa-circle-o"></i>Privacy Policy</a>
						</li>
						<li <?php
						if ($this->router->class === 'page' && $this->router->method === 'terms_setup') {
							echo 'class="active"';
						}
						?>>
							<a href="<?php echo base_url(); ?>page/terms_setup"><i class="fa fa-circle-o"></i>Terms and Conditions</a>
						</li>
					</ul>
				</li>
			<?php } ?>
		</ul>
	</section>
</aside>