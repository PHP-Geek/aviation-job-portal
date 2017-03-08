<style>
	.background_white {
		background-color: white;
	}
	.search_license_type{
		padding:0px 0px !important;
		height:27px !important;
		border:0px;
	}
	.form-control {
		height:27px;
	}
	.nodata {
		background-color: #E2E4FF;
		font-size: 20px;
		padding: 15px;
	}
	.medwidth {
		min-width:130px;
	}
	div.pager {
		text-align: center;
		margin: 1em 0;
	}
	div.pager span {
		display: inline-block;
		width: 1.8em;
		height: 1.8em;
		line-height: 1.8;
		text-align: center;
		cursor: pointer;
		background: #000;
		color: #fff;
		margin-right: 0.5em;
	}

	div.pager span.active {
		background: #3c8dbc;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Search : Users <small>Search users</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Search</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="well background_white">
				<form id="user_search_form" method="post">
					<div class="row">
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Enter Name</label>
								<input type="text" maxlength="128" name="search_term" id="search_term" placeholder="Search Keyword" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>License Type</label>
								<input type="text" maxlength="128" name="user_license_type" id="user_license_type" placeholder="License Type" class="form-control" autocomplete="off">
							</div>
						</div>

						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Type Rating</label>
								<input type="text" maxlength="128" name="user_type_rating" id="user_type_rating" placeholder="Type Rating" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Trainings/Courses</label>
								<input type="text" maxlength="128" name="user_training" id="user_training" placeholder="Training Courses" class="form-control" autocomplete="off">
							</div>
						</div>

						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Medical</label>
								<input type="text" maxlength="128" name="user_medical" id="user_medical" placeholder="Medical Exam" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Experience</label>
								<input type="text" maxlength="128" name="user_experience" id="user_experience" placeholder="Years of Experience" class="form-control" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Location</label>
								<input type="text" maxlength="128" name="user_country" id="user_country" placeholder="Country" class="form-control" autocomplete="off">
							</div>
						</div>

						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Category</label>
								<input type="text" maxlength="128" name="job_type_name" id="job_type_name" placeholder="Category" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Employee Role</label>
								<input type="text" maxlength="128" name="employee_role_name" id="employee_role_name" placeholder="Employee Role" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Hours on Type Rating</label>
								<input type="text" maxlength="128" name="user_hours_type_rating" id="user_hours_type_rating" placeholder="Hours on Type Rating" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Total Instructors</label>
								<input type="text" maxlength="128" name="user_total_instructor" id="user_total_instructor" placeholder="Total Instructors" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Contact No.</label>
								<input type="text" maxlength="128" name="user_primary_contact" id="user_primary_contact" placeholder="Contact No." class="form-control" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Email</label>
								<input type="text" maxlength="128" name="user_email" id="user_email" placeholder="Email Id" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>User Rating</label>
								<input type="text" maxlength="128" name="user_rating" id="user_rating" placeholder="User Rating" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Passport</label>
								<input type="text" maxlength="128" name="user_passport" id="user_passport" placeholder="Passport" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Visa</label>
								<input type="text" maxlength="128" name="user_visa" id="user_visa" placeholder="Visa" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Validation</label>
								<input type="text" maxlength="128" name="user_validation" id="user_validation" placeholder="Validation" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-md-2 col-lg-2">
							<div class="form-group">
								<label>Operation Type</label>
								<input type="text" maxlength="128" name="operation_type" id="operation_type" placeholder="Operation Type" class="form-control" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<label>Hours</label>
							<div class="row">								
								<div class="form-group">									
									<div class="col-sm-12">
										<div class="input-group">
											<div class="input-group-addon" style="border:none;padding:0">
												<select name="total_hours_condition" id="total_hours_condition" class="select2_register" data-placeholder="Set Condition">
													<option></option>
													<option value="1"> Less Than </option>
													<option value="2"> Equal To </option>
													<option value="3"> Greater Than </option>
												</select>
											</div>
											<input type="text" class="form-control" name="user_total_hours" id="user_total_hours" placeholder="Total Hours">		
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<button type="submit" class="btn btn-primary" id="search_button"><i class="fa fa-search"></i> Search</button>
						</div>
					</div>
				</form>
			</div>
			<div class="well background_white well-blocks">
				<?php if (isset($search_array) && count($search_array) === 0) {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="nodata">
								No Data Found.
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if (isset($search_array) && count($search_array) > 0) { ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="box-body table-responsive">
								<table class="table table-striped table-bordered paginated">
									<thead>
										<tr>
											<th class="medwidth">Name</th>
											<th class="medwidth">License Type</th>
											<th class="medwidth">Type Rating</th>
											<th class="medwidth">Trainings/Courses</th>
											<th class="medwidth">Medical Exam</th>
											<th class="medwidth">Experience</th>
											<th class="medwidth">Location</th>
											<th class="medwidth">Category</th>
											<th class="medwidth">Employee Role</th>
											<th class="medwidth">Hours on Type Rating</th>
											<th class="medwidth">Total Instructors</th>
											<th class="medwidth">Contact</th>
											<th class="medwidth">Email</th>
											<th class="medwidth">User Rating</th>
											<th class="medwidth">Passport</th>
											<th class="medwidth">Visa</th>
											<th class="medwidth">Validation</th>
											<th class="medwidth">Operation Type</th>
											<th class="medwidth">Total Hours</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($search_array as $search) { ?>
											<tr>
												<td><?php echo $search['user_first_name'] . ' ' . $search['user_last_name']; ?></td>
												<td><?php echo $search['license_type']; ?></td>
												<td><?php echo $search['type_rating_name']; ?></td>
												<td><?php echo $search['training_name']; ?></td>
												<td><?php echo $search['medical_examination_name']; ?></td>
												<td><?php echo $search['user_years_of_experience']; ?></td>
												<td><?php echo $search['country_name']; ?></td>
												<td><?php echo $search['job_type_name']; ?></td>
												<td><?php echo $search['employee_role_name']; ?></td>
												<td><?php echo $search['user_hours_type_rating']; ?></td>
												<td><?php echo $search['user_total_instructor']; ?></td>
												<td><?php echo $search['user_primary_contact']; ?></td>
												<td><?php echo $search['user_email']; ?></td>
												<td><?php echo $search['user_rating'] . '/5'; ?></td>
												<td><?php
													if (count($search['user_passport'])) {
														$passports_name = array();
														foreach ($search['user_passport'] as $passports) {
															$passports_name[] = $passports['country_name'];
														} echo implode(', ', $passports_name);
													}
													?></td>
												<td><?php
													if (count($search['user_visa'])) {
														$visas_name = array();
														foreach ($search['user_visa'] as $visas) {
															$visas_name[] = $visas['country_name'];
														}echo implode(', ', $visas_name);
													}
													?></td>
												<td><?php
													if (count($search['user_validation'])) {
														$validations_name = array();
														foreach ($search['user_validation'] as $validations) {
															$validations_name[] = $validations['country_name'];
														}echo implode(', ', $validations_name);
													}
													?></td>
												<td><?php echo $search['operation_type']; ?></td>
												<td><?php echo $search['user_total_hours']; ?></td>											
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="pull-right">
							<div class="col-lg-12 col-md-12">
								<nav>
									<?php //echo $pagination;   ?>
								</nav>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</section>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
	$('table.paginated').each(function () {
		var currentPage = 0;
		var numPerPage = 10;
		var $table = $(this);
		$table.bind('repaginate', function () {
			$table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
		});
		$table.trigger('repaginate');
		var numRows = $table.find('tbody tr').length;
		var numPages = Math.ceil(numRows / numPerPage);
		var $pager = $('<div class="pager"></div>');
		for (var page = 0; page < numPages; page++) {
			$('<span class="page-number"></span>').text(page + 1).bind('click', {
				newPage: page
			}, function (event) {
				currentPage = event.data['newPage'];
				$table.trigger('repaginate');
				$(this).addClass('active').siblings().removeClass('active');
			}).appendTo($pager).addClass('clickable');
		}
		$pager.insertBefore($table).find('span.page-number:first').addClass('active');
	});
</script>
<script type="text/javascript">
	$(function () {
		$("select").select2({allowClear: true});
	});
	$("#user_search_form").validate({
		errorElement: 'span',
		errorClass: 'help-block pull-right',
		focusInvalid: true,
		ignore: null,
		rules: {
			search_term: {
				required: function () {
					if ($('#user_type_rating').val() === '' && $('#user_license_type').val() === '' && $('#user_training').val() === '' && $('#user_medical').val() === '' && $('#user_experience').val() === '' && $('#user_country').val() === '' && $('#user_total_hours').val() === '' && $('#job_type_name').val() === '' && $('#employee_role_name').val() === '' && $('#user_hours_type_rating').val() === '' && $('#user_total_instructor').val() === '' && $('#user_primary_contact').val() === '' && $('#user_email').val() === '' && $('#user_rating').val() === '' && $('#user_passport').val() === '' && $('#user_visa').val() === '' && $('#user_validation').val() === '' && $('#operation_type').val() === '') {
						return true;
					}
					return false;
				}
			},
			user_experience: {
				number: true
			},
			user_rating: {
				number: true
			},
			user_total_hours: {
				number: true
			}
		},
		messages: {
			search_term: {
				required: "Please fill atleast one field."
			},
			user_experience: {
				number: "Please fill numeric value in the field."
			},
			user_rating: {
				number: "Please fill numeric value in the field."
			},
			user_total_hours: {
				number: "Please fill numeric value in the field."
			}
		},
		invalidHandler: function (event, validator) {
			//show_signup_error();
		},
		highlight: function (element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function (element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).closest('.form-group').children('span.help-block').remove();
		},
		errorPlacement: function (error, element) {
			error.appendTo(element.closest('.form-group'));
		},
		submitHandler: function (form) {
			return true;
		}
	});
</script>
