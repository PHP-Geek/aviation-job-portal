<style>
    .select2-container .select2-selection--single  {
        height:34px !important;
        border:1px solid #ccc !important;
    }
    .has-error .select2-container--default .select2-selection--single {
        border: 1px solid red !important;
        border-radius:5px;
    }
    .help-block{
        color:red !important;
    }
    #country_code
    {
        background-color: hsl(0, 0%, 96%);
        vertical-align: top;
        text-align:left;
    }
    #contact_number .text-right
    {
        float:right;
    }
    #country_code.has-error .select2-container
    {
        width:100% !important;
    }
    .form-validation-p{
        font-size:14px;
    }
    .hide_div{
        display: none;
    }
    .show_div{
        display:block;
    }
    #crew_submit_buttons button {
        min-width:116px;
    }
    @media only screen and (max-width:360px) and (min-width:320px) {
        #country_code
        {
            float:left;
            width:100%;
        }
        #country_code .select2-container--default
        {
            text-align:left;
            width:100% !important;
        }
        .little-banner-text h1 {
            font-size:34px;
        }
    }
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
					<?php if (isset($_SERVER['HTTP_REFERER']) && str_replace(base_url(), '', $_SERVER['HTTP_REFERER']) == 'staff-recruitment') {
						?>
						<li><a href="<?php echo base_url(); ?>our-services">Our Services</a>
						<li><a href="<?php echo base_url(); ?>staff-recruitment">Staff Recruitment</a>
						<li class = "active">Request <?php echo (count($crew_support_job_type_array) > 0) ? (($crew_support_job_type_array['job_type_name'] === 'Operations' || $crew_support_job_type_array['job_type_name'] === 'Corporate') ? (in_array($crew_support_job_type_array['job_type_name'][0], array('A', 'E', 'I', 'O', 'U')) ? 'An ' . $crew_support_job_type_array['job_type_name'] : 'A ' . $crew_support_job_type_array['job_type_name']) . ' Candidate' : (in_array($crew_support_job_type_array['job_type_name'][0], array('A', 'E', 'I', 'O', 'U')) ? 'An ' . $crew_support_job_type_array['job_type_name'] : 'A ' . $crew_support_job_type_array['job_type_name'])) : 'Crew'; ?></li>
					<?php } else { ?>
						<li><a href="<?php echo base_url(); ?>our-services">Our Services</a></li>
						<li><a href="<?php echo base_url(); ?>contract-crew-request">Contract Crew Support</a></li>
						<li class = "active">Request <?php echo (count($crew_support_job_type_array) > 0) ? $crew_support_job_type_array['job_type_name'] : 'Crew'; ?> Support</li>
					<?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="little-banner-text">
            <h1><span style="font-weight: 500">Request <?php
					if (isset($_SERVER['HTTP_REFERER']) && str_replace(base_url(), '', $_SERVER['HTTP_REFERER']) == 'staff-recruitment') {
						echo (count($crew_support_job_type_array) > 0) ? (($crew_support_job_type_array['job_type_name'] === 'Operations' || $crew_support_job_type_array['job_type_name'] === 'Corporate') ? (in_array($crew_support_job_type_array['job_type_name'][0], array('A', 'E', 'I', 'O', 'U')) ? 'An ' . $crew_support_job_type_array['job_type_name'] : 'A ' . $crew_support_job_type_array['job_type_name']) . ' Candidate' : (in_array($crew_support_job_type_array['job_type_name'][0], array('A', 'E', 'I', 'O', 'U')) ? 'An ' . $crew_support_job_type_array['job_type_name'] : 'A ' . $crew_support_job_type_array['job_type_name'])) : 'Crew';
					} else {
						echo count($crew_support_job_type_array) > 0 ? $crew_support_job_type_array['job_type_name'] . ' Support' : 'Crew Support';
					}
					?></span></h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="well spaceup-20">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-field-heading">
                    <h3>Send <?php
						if (isset($_SERVER['HTTP_REFERER']) && str_replace(base_url(), '', $_SERVER['HTTP_REFERER']) == 'staff-recruitment') {
							echo (count($crew_support_job_type_array) > 0) ? (($crew_support_job_type_array['job_type_name'] === 'Operations' || $crew_support_job_type_array['job_type_name'] === 'Executive' || $crew_support_job_type_array['job_type_name'] === 'Corporate') ? $crew_support_job_type_array['job_type_name'] . ' Candidate' : $crew_support_job_type_array['job_type_name']) . ' Request' : 'Crew Request';
						} else {
							echo count($crew_support_job_type_array) > 0 ? $crew_support_job_type_array['job_type_name'] . ' Support Request' : 'Crew Request';
						}
						?></h3>
                </div>
            </div>
        </div>
        <hr/>
        <form id="crew_support_form" method="post" action="" role="form" class="form-horizontal">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                    <div class="register">
                        <div class="form-group">
                            <label for="job_types_id" class="col-sm-4 control-label">Type <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <select id="job_types_id" name="job_types_id" class="form-control select2_crew_request" data-placeholder="&nbsp;Type" <?php
//								if (isset($crew_support_job_type_array) && count($crew_support_job_type_array) > 0) {
//									echo '';
//								}
								?>>
                                    <option></option>
									<?php foreach ($job_types_array as $job_type) { ?>
										<option <?php
										if ($crew_support_job_type_array['job_type_id'] === $job_type['job_type_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $job_type['job_type_id']; ?>">
												<?php echo $job_type['job_type_name']; ?>
										</option>
									<?php }
									?>
                                    <option value="0">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="other_position" style="display:none">
                            <label class="col-sm-4 control-label">Other Type <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" id="crew_support_job_type" name="crew_support_job_type" class="form-control" placeholder="Other Type" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Require more than 1 staff </label>
                            <div class="col-sm-8 place-error">
                                <input type="checkbox" id="crew_support_is_more_staff" name="crew_support_is_more_staff"/>
                            </div>
                        </div>
                        <div class="form-group" id="no_of_crew">
                            <label class="col-sm-4 control-label">How many staff required </label>
                            <div class="col-sm-8 place-error">
                                <input type="text" id="crew_support_no_of_crew" name="crew_support_no_of_crew" placeholder="How many staff required" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group" id="job_type_category_div">
                            <label for="positions_id" class="col-sm-4 control-label">Position <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <select id="positions_id" name="positions_id" class="form-control select2_crew_request" data-placeholder="&nbsp;Position" >
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="positions_id1_div" style="display:none">
                            <label class="col-sm-4 control-label">Other Position <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" id="crew_support_job_category1" name="crew_support_job_category1" class="form-control" placeholder="Other Position" />
                            </div>
                        </div>
                        <!--Options for each categories-->
                        <div class="form-group" id="aircraft_type_div">
                            <label class="col-sm-4 control-label">Aircraft Type <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control select2_crew_request_multiple" id="my_aircrafts_id" name="my_aircrafts_id[]" data-placeholder="&nbsp;Aircraft Type (can select multiple)" multiple="multiple">
									<?php foreach ($my_aircraft_array as $aircrafts) { ?>
										<option value="<?php echo $aircrafts['my_aircraft_id']; ?>"><?php echo $aircrafts['my_aircraft_category'] !== '' ? $aircrafts['my_aircraft_category'] . ' ' . $aircrafts['my_aircraft_name'] : $aircrafts['my_aircraft_name']; ?></option>
									<?php } ?>
									<option value="0">Other</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group" id="other_aircraft" style="display:none">
                            <label class="col-sm-4 control-label">Other Aircraft Type <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" id="crew_support_aircraft_type_other" name="crew_support_aircraft_type_other" class="form-control" placeholder="Other Aircraft Type" />
                            </div>
                        </div>
                        <div class="form-group" id="type_rated_div">
                            <label class="col-sm-4 control-label">Type Rated</label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control select2_crew_request" id="crew_support_type_rated" name="crew_support_type_rated" data-placeholder="&nbsp;Type Rated">
                                    <option></option>
                                    <option value="1">Type Rated</option>
                                    <option value="2">Non Type Rated</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="aircraft_license_authority_div">
                            <label class="col-sm-4 control-label">License Authority</label>
                            <div class="col-sm-8 place-error">
                                <select id="license_authorities_id" name="license_authorities_id"  class="form-control select2_crew_request" data-placeholder="&nbsp;License Authority">
                                    <option value=""></option>
									<?php foreach ($crew_support_license_authority_array as $license_authority) { ?>
										<option value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
									<?php } ?>
									<option value="0">Other</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group" style="display:none">
                            <label class="col-sm-4 control-label">Other License Authority</label>
                            <div class="col-sm-8 place-error">
                                <input class="form-control" id="crew_support_license_authority_other" name="crew_support_license_authority_other" placeholder="Other License Authority"/>
                            </div>
                        </div>
                        <div class="form-group" id="aircraft_license_div">
                            <label class="col-sm-4 control-label">License Type</label>
                            <div class="col-sm-8 place-error">
                                <select id="licenses_id" name="licenses_id"  class="form-control select2_crew_request" data-placeholder="&nbsp;License Type">
                                    <option value=""></option>
									<?php foreach ($license_array as $license) { ?>
										<option value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] . ' ' . $license['license_type']; ?></option>
									<?php } ?>
									<option value="0">Other</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group" style="display:none">
                            <label class="col-sm-4 control-label">Other License Type</label>
                            <div class="col-sm-8 place-error">
                                <input class="form-control" id="crew_support_license_type_other" name="crew_support_license_type_other" placeholder="Other License Type"/>
                            </div>
                        </div>
                        <div class="form-group" id="ratings_div">
                            <label class="col-sm-4 control-label">Ratings</label>
                            <div class="col-sm-8 place-error">
                                <select id="approval_ratings_id" name="approval_ratings_id"  class="form-control select2_crew_request" data-placeholder="&nbsp;Ratings">
                                    <option value=""></option>
									<?php foreach ($type_rating_array as $rating) { ?>
										<option value="<?php echo $rating['approval_rating_id']; ?>"><?php echo $rating['approval_rating_name']; ?></option>
									<?php } ?>
									<option value="0">Other</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group" style="display:none">
                            <label class="col-sm-4 control-label">Other Rating</label>
                            <div class="col-sm-8 place-error">
                                <input class="form-control" id="crew_support_approval_rating_other" name="crew_support_approval_rating_other" placeholder="Other Rating"/>
                            </div>
                        </div>
                        <div class="form-group" id="endorsement_div">
                            <label class="col-sm-4 control-label">Endorsement(s)</label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control select2_crew_request" id="crew_support_endorsement" name="crew_support_endorsement" data-placeholder="&nbsp;Endorsement(s)">
                                    <option></option>
									<?php foreach ($endorsement_array as $endorsement) { ?>
										<option value="<?php echo $endorsement; ?>"><?php echo $endorsement; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="endorsement_div1">
                            <label class="col-sm-4 control-label">Other Endorsement(s)</label>
                            <div class="col-sm-8 place-error">
                                <input class="form-control" id="crew_support_endorsement1" name="crew_support_endorsement1" placeholder="Endorsement(s)"/>
                            </div>
                        </div>
                        <div class="form-group" id="skills_div">
                            <label class="col-sm-4 control-label">Skills </label>
                            <div class="col-sm-8 place-error">
                                <select id="skills_id" name="skills_id"  class="form-control select2_crew_request" data-placeholder="&nbsp;Skills">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="skill_div1">
                            <label class="col-sm-4 control-label">Other Skills </label>
                            <div class="col-sm-8 place-error">
                                <input class="form-control" id="crew_support_skills" name="crew_support_skills" placeholder="Other Skills"/>
                            </div>
                        </div>
                        <div class="form-group" id="year_of_exp_div">
                            <label class="col-sm-4 control-label">
								<?php echo $crew_support_job_type_array['job_type_slug'] === 'flight-attendant' ? 'Minimum Years of Experience' : 'Year Experience'; ?> </label>
                            <div class="col-sm-8">
                                <input class="form-control" id="crew_support_year_of_experience" name="crew_support_year_of_experience" placeholder="Minimum Years of Experience"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Start Date <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <span class="input-group date datepicker_crew_support">
                                    <input type="text" id="crew_support_start_date" name="crew_support_start_date" class="form-control" placeholder="Start Date" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Completion Date</label>
                            <div class="col-sm-8 place-error">
                                <div class="input-group date datepicker_crew_support">
                                    <input type="text" id="crew_support_completion_date" name="crew_support_completion_date" class="form-control" placeholder="Completion Date" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--End of options for each categories-->
                        <div class="form-group">
                            <label for="crew_support_duration" class="col-sm-4 control-label">Duration <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <select id="crew_support_duration" name="crew_support_duration"  class="form-control select2_crew_request" data-placeholder="&nbsp;Duration">
                                    <option></option>
									<?php foreach ($crew_support_duration_array as $crew_support_duration) { ?>
										<option value="<?php echo $crew_support_duration; ?>">
											<?php echo $crew_support_duration; ?>
										</option>
									<?php } ?>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="other_duration_div">
                            <label class="col-sm-4 control-label">Duration Type <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" class="form-control" name="crew_support_other_duration" id="crew_support_other_duration" placeholder="Type duraton here.."/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <input type="checkbox" value="1" name="crew_support_duration_is_extendable" id="crew_support_duration_is_extendable"/> 
                                <label>Possibility to be Extended (Check if duration may be extended.)</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Location (Country) <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <select class="form-control select2_crew_request" name="countries_id" id="countries_id" data-placeholder="&nbsp;Select Location">
                                    <option></option>
									<?php
									foreach ($country_array as $country) {
										echo '<option value="' . $country['country_id'] . '">' . $country['country_name'] . '</option>';
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crew_support_city" class="col-sm-4 control-label">City <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" class="form-control" id="crew_support_city" name="crew_support_city" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crew_support_company" class="col-sm-4 control-label">Company Name</label>
                            <div class="col-sm-8 place-error">
                                <input type="text" class="form-control" id="crew_support_company" name="crew_support_company" placeholder="Company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crew_support_name" class="col-sm-4 control-label">Contact Name <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" class="form-control" id="crew_support_name" name="crew_support_name" placeholder="Contact Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_primary_contact_number" class="col-sm-4 control-label">Contact Number <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <div class="input-group place-error">
                                    <div class="input-group-addon place-error" id="country_code" style="border:none;padding:0">
                                        <select name="crew_support_country_code" class="crew_support_country_code" data-placeholder="&nbsp;Country Code">
                                            <option></option>
											<?php
											foreach ($country_array as $country) {
												if ($country['country_code'] != '') {
													echo '<option value="' . $country['country_code'] . '">' . $country['country_name'] . '(' . $country['country_code'] . ')' . '</option>';
												}
											}
											?>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control" id="crew_support_contact_number" name="crew_support_contact_number" placeholder="Contact Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crew_support_email" class="col-sm-4 control-label">Contact Email <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" class="form-control" id="crew_support_email" name="crew_support_email" placeholder="Contact Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crew_support_email" class="col-sm-4 control-label">Additional Requests/Requirements </label>
                            <div class="col-sm-8 place-error">
                                <textarea class="form-control" id="crew_support_additional_request" name="crew_support_additional_request" placeholder="eg:- Need 3 pilots,Need ADSB Certificate. Need 30 Pilots and 20 Flight Attendants Minimum 5000 hours" rows="4"></textarea>
                            </div>
                        </div>
						<?php if (isset($captcha_image)) { ?>
							<div class="form-group text-center">
								<div class="col-md-offset-3 col-sm-offset-4">
									<?php echo $captcha_image; ?> &nbsp; <a href="javascript:;" onclick="refresh_captcha(this);"><i class="fa fa-refresh"></i></a>
								</div></div><?php }
								?>
                        <div class="form-group">
                            <label for="crew_support_email" class="col-sm-4 control-label">Image Text <span class="required">*</span></label>
                            <div class="col-sm-8 place-error">
                                <input type="text" class="form-control" id="captcha_image_text" name="captcha_image_text" placeholder="Image Text">
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
			<hr/>
			<div class="row">				
				<div class="col-md-12" id="crew_submit_buttons">
					<div class="text-center">
						<button id="crew_support_button" type="submit" class="btn btn-success" data-loading-text="Please wait...">Submit <span class="fa fa-plane"></span></button>
						&nbsp; &nbsp;
						<button type="reset" class="btn btn-success ">Reset <span class="fa fa-plane"></span></button>
					</div>
				</div>
			</div>
        </form>
    </div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
										$("#positions_id").select2({allowClear: true});
										$("#job_types_id").on('change', function () {
											$("#job_type_category_div").removeClass('hide_div').addClass('show_div');
											$.post(base_url + 'page/get_skills_by_job_type_id', {job_types_id: $("#job_types_id").val()}, function (data) {
												$("#skills_id").empty();
												$("#skills_id").append("<option></option>");
												for (var i = 0; i < data.length; i++) {
													$("#skills_id").append('<option value="' + data[i].skill_id + '">' + data[i].skill_name + '</option>');
												}
												$("#skills_id").append('<option value="Other">Other</option>');
											});
											$.post(base_url + 'page/get_license_by_job_types_id', {job_types_id: $("#job_types_id").val()}, function (data) {
												$("#licenses_id").empty();
												$("#licenses_id").append('<option></option>')
												for (var i = 0; i < data.length; i++) {
													$("#licenses_id").append('<option value="' + data[i].license_id + '">' + data[i].license_type_name + ' ' + data[i].license_type + '</option>');
												}
												$("#licenses_id").append('<option value="0">Other</option>');
											});
											if ($("#job_types_id").val() === '0') {
												$("#other_position").css('display', 'block');
												$("#positions_id").empty();
												$("#aircraft_type_div").removeClass('show_div').addClass('hide_div');
												$("#type_rated_div").removeClass('show_div').addClass('hide_div');
												$("#ratings_div").removeClass('show_div').addClass('hide_div');
												$("#year_of_exp_div").removeClass('show_div').addClass('hide_div');
												$("#other_duration_div").removeClass('show_div').addClass('hide_div');
												$("#aircraft_license_div").removeClass('show_div').addClass('hide_div');
												$("#aircraft_license_authority_div").removeClass('show_div').addClass('hide_div');
												$("#job_type_category_div").removeClass('show_div').addClass('hide_div');
												$("#skills_div").removeClass('show_div').addClass("hide_div");
												$("#endorsement_div").removeClass('show_div').addClass("hide_div");
												$("#endorsement_div1").removeClass('show_div').addClass("hide_div");
												$("#skill_div1").removeClass('show_div').addClass("hide_div");
												$("#no_of_crew").removeClass('show_div').addClass("hide_div");
											} else {
												$("#other_position").css('display', 'none');
											}
											if ($("#job_types_id").val() !== '0') {

												$("#job_type_category_div").css('display', 'block');
											} else {
												$("#job_type_category_div").css('display', 'none');
											}
											$("#positions_id").empty();
											$.post(base_url + 'page/get_positions_by_job_types_id', {job_types_id: $("#job_types_id").val()}, function (data) {
												$("#positions_id").select2({allowClear: true}).val('');
												$("#positions_id").append('<option></option');
												for (var i = 0; i < data.length; i++) {
													$("#positions_id").append('<option value="' + data[i].position_id + '">' + data[i].position_name + '</option>');
												}
												$("#positions_id").append('<option value="Other">Other</option>');
											});
											if ($("#job_types_id").val() === '1' || $("#job_types_id").val() === '2') {
												$("#aircraft_type_div").removeClass("hide_div").addClass("show_div");
												$("#type_rated_div").removeClass("hide_div").addClass("show_div");
												$("#year_of_exp_div").removeClass("show_div").addClass("hide_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												if ($("#job_types_id").val() === '1') {
													$("#ratings_div").removeClass("hide_div").addClass("show_div");
												} else {
													$("#ratings_div").removeClass("show_div").addClass("hide_div");
												}
												$("#aircraft_license_div").removeClass("hide_div").addClass("show_div");
												$("#aircraft_license_authority_div").removeClass("hide_div").addClass("show_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											} else if ($("#job_types_id").val() === '3') {
												$("#year_of_exp_div label").html('Minimum Years of Experience');
												$("#aircraft_type_div").removeClass("hide_div").addClass("show_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("hide_div").addClass("show_div");
												$("#aircraft_license_div").removeClass("show_div").addClass("hide_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("show_div").addClass("hide_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											} else if ($("#job_types_id").val() === '4' || $("#job_types_id").val() === '5' || $("#job_types_id").val() === '6') {
												$("#year_of_exp_div label").html('Year Experience');
												$("#aircraft_type_div").removeClass("show_div").addClass("hide_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("hide_div").addClass("show_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_div").removeClass("show_div").addClass("hide_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("show_div").addClass("hide_div");
												$("#skills_div").removeClass("hide_div").addClass("show_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											} else if ($("#job_types_id").val() === '7') {

												$("#aircraft_type_div").removeClass("show_div").addClass("hide_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("show_div").addClass("hide_div");
												$("#type_rating_div").removeClass("hide_div").addClass("show_div");
												$("#endorsement_div").removeClass("hide_div").addClass("show_div");
												$("#aircraft_license_div").removeClass("hide_div").addClass("show_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("hide_div").addClass("show_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("hide_div").addClass("show_div");

											} else {
												$("#aircraft_type_div").removeClass("show_div").addClass("hide_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("show_div").addClass("hide_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_div").removeClass("show_div").addClass("hide_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("show_div").addClass("hide_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											}
										});
										$("#crew_support_endorsement").on('change', function () {
											if ($("#crew_support_endorsement").val() === 'Other') {
												$("#endorsement_div1").removeClass("hide_div").addClass("show_div");
											} else {
												$("#endorsement_div1").removeClass("show_div").addClass("hide_div");
											}
										});
										$("#crew_support_duration").on('change', function () {
											if ($("#crew_support_duration").val() === 'other') {
												$("#other_duration_div").removeClass('hide_div').addClass('show_div');
											} else {
												$("#other_duration_div").removeClass('show_div').addClass('hide_div');
											}
										});
										$(function () {
											setTimeout(function () {
												$("#aircraft_type_div").addClass('hide_div');
												$("#type_rated_div").addClass('hide_div');
												$("#ratings_div").addClass('hide_div');
												$("#year_of_exp_div").addClass('hide_div');
												$("#other_duration_div").addClass('hide_div');
												$("#aircraft_license_div").addClass('hide_div');
												$("#aircraft_license_authority_div").addClass('hide_div');
												//$("#job_type_category_div").addClass('hide_div');
												$("#skills_div").addClass("hide_div");
												$("#endorsement_div").addClass("hide_div");
												$("#endorsement_div1").addClass("hide_div");
												$("#skill_div1").addClass("hide_div");
												$("#no_of_crew").addClass("hide_div");
											}, 500);
											$("#crew_support_is_more_staff").on('change', function () {
												if ($("#crew_support_is_more_staff").is(':checked') == true) {
													$("#no_of_crew").removeClass("hide_div").addClass("show_div");
												} else {
													$("#no_of_crew").removeClass("show_div").addClass("hide_div");
												}
											});
											if ($("#job_types_id").val() !== '') {
												$("#job_type_category_div").removeClass('hide_div').addClass('show_div');
												$.post(base_url + 'page/get_skills_by_job_type_id', {job_types_id: $("#job_types_id").val()}, function (data) {
													$("#skills_id").empty();
													for (var i = 0; i < data.length; i++) {
														$("#skills_id").append('<option value="' + data[i].skill_id + '">' + data[i].skill_name + '</option>');
													}
													$("#skills_id").append('<option value="Other">Other</option>');
												});
											}
											$("select").select2({allowClear: true});
											$(".datepicker_crew_support").datepicker({
												clearBtn: true,
												startView: 2,
												todayBtn: "linked",
												format: 'dd/mm/yyyy',
												autoclose: true,
												beforeShow: function (input, inst) {
													setTimeout(function () {
														var buttonPane = $(input)
																.datepicker("widget")
																.find(".ui-datepicker-buttonpane");
														var html = '<div class="noEndDate"><input type="checkbox"><label> No End Date </label></div>';
														buttonPane.append(html);
													}, 10);
												}
											});
											if ($("#job_types_id").val() === '1' || $("#job_types_id").val() === '2') {
												$("#aircraft_type_div").removeClass("hide_div").addClass("show_div");
												$("#aircraft_license_div").removeClass("hide_div").addClass("show_div");
												$("#type_rated_div").removeClass("hide_div").addClass("show_div");
												$("#year_of_exp_div").removeClass("show_div").addClass("hide_div");
												if ($("#job_types_id").val() === '1') {
													$("#ratings_div").removeClass("hide_div").addClass("show_div");
												} else {
													$("#ratings_div").removeClass("show_div").addClass("hide_div");
												}
												$("#aircraft_license_authority_div").removeClass("hide_div").addClass("show_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											} else if ($("#job_types_id").val() === '3') {

												$("#aircraft_type_div").removeClass("hide_div").addClass("show_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("hide_div").addClass("show_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_div").removeClass("show_div").addClass("hide_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("show_div").addClass("hide_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											} else if ($("#job_types_id").val() === '4' || $("#job_types_id").val() === '5' || $("#job_types_id").val() === '6') {

												$("#aircraft_type_div").removeClass("show_div").addClass("hide_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("hide_div").addClass("show_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_div").removeClass("show_div").addClass("hide_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("show_div").addClass("hide_div");
												$("#skills_div").removeClass("hide_div").addClass("show_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											} else if ($("#job_types_id").val() === '7') {

												$("#aircraft_type_div").removeClass("show_div").addClass("hide_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("show_div").addClass("hide_div");
												$("#type_rating_div").removeClass("hide_div").addClass("show_div");
												$("#aircraft_license_div").removeClass("hide_div").addClass("show_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("hide_div").addClass("show_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("hide_div").addClass("show_div");
											} else {
												$("#aircraft_type_div").removeClass("show_div").addClass("hide_div");
												$("#type_rated_div").removeClass("show_div").addClass("hide_div");
												$("#year_of_exp_div").removeClass("show_div").addClass("hide_div");
												$("#type_rating_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_div").removeClass("show_div").addClass("hide_div");
												$("#ratings_div").removeClass("show_div").addClass("hide_div");
												$("#aircraft_license_authority_div").removeClass("show_div").addClass("hide_div");
												$("#skills_div").removeClass("show_div").addClass("hide_div");
												$("#endorsement_div").removeClass("show_div").addClass("hide_div");
											}
											if ($("#job_types_id").val() !== '') {
												$.post(base_url + 'page/get_positions_by_job_types_id', {job_types_id: $("#job_types_id").val()}, function (data) {
													$("#positions_id").select2({allowClear: true}).val('');
													$("#positions_id").empty();
													$("#positions_id").append('<option></option');
													for (var i = 0; i < data.length; i++) {
														$("#positions_id").append('<option value="' + data[i].position_id + '">' + data[i].position_name + '</option>');
													}
													$("#positions_id").append('<option value="Other">Other</option>');
												});
											}
											$("#crew_support_form").validate({
												errorElement: 'span',
												errorClass: 'help-block pull-right',
												focusInvalid: true,
												ignore: null,
												rules: {
													job_types_id: {
														required: true
													},
													crew_support_job_type: {
														required: {
															depends: function (element) {
																return ($("#job_types_id").val() == "0")
															}
														}
													},
													positions_id1: {
														required: {
															depends: function (element) {
																return ($("#positions_id").val() == "0")
															}
														}
													},
													my_aircrafts_id: {
														required: {
															depends: function (element) {
																return ($("#job_types_id").val() === '1' || $("#job_types_id").val() === '2' || $("#job_types_id").val() === '3')
															}
														}
													},
													crew_support_other_duration: {
														required: {
															depends: function (element) {
																return ($("#crew_support_duration").val() === 'other');
															}
														}
													},
													crew_support_duration: {
														required: true
													},
													countries_id: {
														required: true
													},
													crew_support_start_date: {
														required: true
													},
													crew_support_country_code: {
														required: true
													},
													crew_support_visa: {
														required: true
													},
													crew_support_name: {
														required: true
													},
													crew_support_city: {
														required: true,
													},
													positions_id: {
														required: {
															depends: function (element) {
																return ($("#job_types_id").val() != "0")
															}
														}
													},
													crew_support_country_code: {
														required: true
													},
													crew_support_contact_number: {
														required: true,
														number: true
													},
													crew_support_email: {
														required: true,
														email: true
													},
													captcha_image_text: {
														required: true,
														remote: {
															url: base_url + "page/captcha_validate",
															type: "post"
														}
													}
												},
												messages: {
													job_types_id: {
														required: "Please select job type"
													},
													crew_support_job_type: {
														required: "Please enter job type"
													},
													positions_id1: {
														required: "Please enter position"
													},
													crew_support_duration: {
														required: "Please select duration"
													},
													crew_support_other_duration: {
														required: "Please enter duration"
													},
													positions_id: {
														required: "Please select position"
													},
													my_aircrafts_id: {
														required: "Please select aircaft type"
													},
													countries_id: {
														required: "Please select your location"
													},
													crew_support_visa: {
														required: "Please select visa"
													},
													crew_support_name: {
														required: "Please enter your name"
													},
													crew_support_city: {
														required: "Please enter city name"
													},
													crew_support_country_code: {
														required: "Please select country code"
													},
													crew_support_start_date: {
														required: "Please select start date"
													},
													crew_support_contact_number: {
														required: "&nbsp;Please enter your contact number ",
														number: "Contact number must be valid"
													},
													crew_support_email: {
														required: "Please enter your email",
														email: "Email must be valid"
													},
													captcha_image_text: {
														required: "Please complete the image text",
														remote: "Please enter correct image text"
													}
												},
												highlight: function (element) {
													highlight_select();
													$(element).closest('.form-group div').addClass('has-error');
												},
												unhighlight: function (element) {
													highlight_select();
													$(element).closest('.form-group div').removeClass('has-error');
												},
												success: function (element) {
													highlight_select();
													$(element).closest('.form-group div').removeClass('has-error');
													$(element).closest('.form-group div').children('span.help-block').remove();
												},
												errorPlacement: function (error, element) {
													error.appendTo(element.closest('.form-group div'));
												},
												submitHandler: function (form) {
													$("#crew_support_button").button("loading");
													$.post('', $("#crew_support_form").serialize(), function (data) {
														if (data === '1') {
															bootbox.alert("Your request is registered successfully.", function () {
																document.location.href = '';
															});
														} else if (data === '0') {
															bootbox.alert("Error submitting records");
														} else {
															bootbox.alert(data);
														}
														$("#crew_support_button").button("reset");
													});
												}
											});
										});
										$("#skills_id").on('change', function () {
											if ($("#skills_id").val() === 'Other') {
												$("#skill_div1").removeClass("hide_div").addClass('"show_div');
											} else {
												$("#skill_div1").removeClass("show_div").addClass("hide_div");
											}
										});
										function highlight_select() {
											$('select').change(function () {
												$("#crew_support_form").validate().element($(this));
											});
										}
										$('.datepicker_crew_support').on('change', function () {
											$(this).closest('.form-group div').removeClass('has-error');
											$(this).closest('.form-group div').removeClass('has-error');
											$(this).closest('.form-group div').children('span.help-block').remove();
										});
										$("#positions_id").on('change', function () {
											if ($("#positions_id").val() === 'Other') {
												$("#positions_id1_div").css('display', 'block');
											} else {
												$("#positions_id1_div").css('display', 'none');
											}
										});
										$("#license_authorities_id").on('change', function () {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										});
										$("#licenses_id").on('change', function () {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										});
										$("#approval_ratings_id").on('change', function () {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										});
										$("#my_aircrafts_id").on('change', function () {
											$("#my_aircrafts_id option").each(function () {
												if ($(this).is(':selected')) {
													if ($(this).val() === '0') {
														$(this).closest('.form-group').next('div').show();
													} else {
														$(this).closest('.form-group').next('div').hide();
													}
												} else {
													$(this).closest('.form-group').next('div').hide();
												}
											});
										});
										function show_signup_error() {
											$("#crew_support_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error While Creating an Account !!!</div>');
											setTimeout(function () {
												$('.alert-danger').fadeOut();
											}, 2000);
										}
										$("button[type=reset]").click(function () {
											$("#crew_support_form").validate().resetForm();
											$("#crew_support_form .place-error").removeClass("has-error");
											$("select").val('').select2({allowClear: true});
											$("#positions_id").empty();
											$('#positions_id').append(new Option());
											$("#job_types_id").empty();
											$('#job_types_id').append(new Option());
											$.post(base_url + 'page/get_all_job_types', {param: true}, function (data) {
												for (var i = 0; i < data.length; i++) {
													$("#job_types_id").append('<option value="' + data[i].job_type_id + '">' + data[i].job_type_name + '</option>');
												}
												$("#job_types_id").append('<option value="0">Other</option>');
											});
											$("#aircraft_type_div").removeClass('show_div').addClass('hide_div');
											$("#type_rated_div").removeClass('show_div').addClass('hide_div');
											$("#ratings_div").removeClass('show_div').addClass('hide_div');
											$("#year_of_exp_div").removeClass('show_div').addClass('hide_div');
											$("#other_duration_div").removeClass('show_div').addClass('hide_div');
											$("#aircraft_license_div").removeClass('show_div').addClass('hide_div');
											$("#aircraft_license_authority_div").removeClass('show_div').addClass('hide_div');
											$("#skills_div").removeClass('show_div').addClass("hide_div");
											$("#endorsement_div").removeClass('show_div').addClass("hide_div");
											$("#endorsement_div1").removeClass('show_div').addClass("hide_div");
											$("#skill_div1").removeClass('show_div').addClass("hide_div");
											$("#no_of_crew").removeClass('show_div').addClass("hide_div");
											$("#positions_id1_div").css('display', 'none');
											$("#other_position").css('display', 'none');
										});
</script>
