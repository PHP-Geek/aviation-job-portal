<!-- Previous employment details -->
<div class="register">
    <?php
    if (count($user_previous_employment_array) > 0) {
	foreach ($user_previous_employment_array as $key => $previous_employment) {
	    ?>
	    <div class="clone_component_7">
		<div class="row">
		    <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4>Previous Employment</h4>
			<div class="form-group">
			    <label for="Subject" class="col-sm-4 control-label">Company/Organization</label>
			    <div class="col-sm-8">
				<input type="text" id="user_previous_employment_company" class="form-control" name="user_previous_employment_company[]" placeholder="Company" value="<?php echo $previous_employment['user_previous_employment_company'] ?>">
			    </div>
			</div>
			<div class="form-group">
			    <label for="user_previous_employment_positions_id" class="col-sm-4 control-label">Position</label>
			    <div class="col-sm-8">
				<select name="user_previous_employment_positions_id[]" class="form-control select2_edit_profile previous_employment_position-other-select" id="user_previous_employment_positions_id" data-placeholder="Position">
				    <option></option>
				    <?php $other_selected=false;
				    foreach ($position_array as $position) {
					if($previous_employment['positions_id']==='0'){
					    $other_selected=true;
					}?>
	    			    <option <?php echo $position['position_id'] === $previous_employment['positions_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
				    <?php } ?>
				    <option value="0" <?php echo $other_selected?'selected="selected"':'';?>>Other</option>
				</select>
			    </div>
			</div>
			<div class="form-group previous_employment_other_position form-other-input" style="display:none" id="previous_employment_other_position_div">
			    <label for="user_previous_employment_other_position" class="col-sm-4 control-label">Other</label>
			    <div class="col-sm-8">
				<input type="text" name="user_previous_employment_other_position[]" id="user_previous_employment_other_position" class="form-control" placeholder="Other Position" value="<?php echo isset($previous_employment['user_previous_employment_position_other']) && $previous_employment['user_previous_employment_position_other']['user_previous_employment_position_other_name']?$previous_employment['user_previous_employment_position_other']['user_previous_employment_position_other_name']:'' ?>"/>
			    </div>
			</div>
			<div class="form-group">
			    <label for="user_previous_employment_start_date" class="col-sm-4 control-label">From</label>
			    <div class="col-sm-8">
				<div class="input-group date edit_profile_date_picker">
				    <input type="text" placeholder="Start Date" id="user_previous_employment_start_date" name="user_previous_employment_start_date[]" class="form-control" value="<?php echo $previous_employment['user_previous_employment_start_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($previous_employment['user_previous_employment_start_date'])) : ''; ?>">
				    <span class="input-group-addon">
					<i class="fa fa-calendar bigger-110"></i>
				    </span>
				</div>
			    </div>
			</div>
			<div class="form-group">
			    <label for="user_previous_employment_end_date" class="col-sm-4 control-label">To</label>
			    <div class="col-sm-8">
				<div class="input-group date edit_profile_date_picker">
				    <input type="text" id="user_previous_employment_end_date" class="form-control" placeholder="End Date" name="user_previous_employment_end_date[]" value="<?php
				    echo $previous_employment['user_previous_employment_end_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($previous_employment['user_previous_employment_end_date'])) : '';
				    ?>">
				    <span class="input-group-addon">
					<i class="fa fa-calendar bigger-110"></i>
				    </span>
				</div>
			    </div>
			</div>
			<div class="text-right">
			    <?php if ($key == count($user_previous_employment_array) - 1) { ?>
	    		    <a class="clone_component_button_7" href="javascript:;" onclick="clone_component(this, 7);"><i class="fa fa-plus-circle"></i> Add a Previous Employer</a>
			    <?php } else { ?>
	    		    <a class="clone_component_button_7" href="javascript:;" onclick="clone_component(this, 7);" style="display:none"><i class="fa fa-plus-circle"></i> Add a Previous Employer</a>
			    <?php } ?>
			    <?php if (count($user_previous_employment_array) === 1) { ?>
	    		    <a class="remove_component_button_7" href="javascript:;" onclick="remove_component(this, 7);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
			    <?php } else { ?>
	    		    <a class="remove_component_button_7" href="javascript:;" onclick="remove_component(this, 7);"><i class="fa fa-minus-circle"></i> Remove</a>
			    <?php } ?>
			</div>
		    </div>
		</div>
	    </div>
	    <?php
	}
    } else {
	?>
        <div class="clone_component_7">
    	<div class="row">
    	    <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
    		<h4>Previous Employment</h4>
    		<div class="form-group">
    		    <label for="Subject" class="col-sm-4 control-label">Company/Organization</label>
    		    <div class="col-sm-8">
    			<input type="text" id="user_previous_employment_company" class="form-control" name="user_previous_employment_company[]" placeholder="Company">
    		    </div>
    		</div>
    		<div class="form-group">
    		    <label for="user_previous_employment_positions_id" class="col-sm-4 control-label">Position</label>
    		    <div class="col-sm-8">
    			<select name="user_previous_employment_positions_id[]" class="form-control select2_edit_profile previous_employment_position-other-select" id="user_previous_employment_positions_id" data-placeholder="Position">
    			    <option></option>
				<?php foreach ($position_array as $position) { ?>
				    <option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
				<?php } ?>
    			    <option value="0">Other</option>
    			</select>
    		    </div>
    		</div>
    		<div class="form-group previous_employment_other_position form-other-input" style="display:none" id="previous_employment_other_position_div">
    		    <label for="user_previous_employment_other_position" class="col-sm-4 control-label">Other</label>
    		    <div class="col-sm-8">
    			<input type="text" name="user_previous_employment_other_position[]" id="user_previous_employment_other_position" class="form-control" placeholder="Other Position"/>
    		    </div>
    		</div>
    		<div class="form-group">
    		    <label for="user_previous_employment_start_date" class="col-sm-4 control-label">From</label>
    		    <div class="col-sm-8">
    			<div class="input-group date edit_profile_date_picker">
    			    <input type="text" placeholder="Start Date" id="user_previous_employment_start_date" name="user_previous_employment_start_date[]" class="form-control">
    			    <span class="input-group-addon">
    				<i class="fa fa-calendar bigger-110"></i>
    			    </span>
    			</div>
    		    </div>
    		</div>
    		<div class="form-group">
    		    <label for="user_previous_employment_end_date" class="col-sm-4 control-label">To</label>
    		    <div class="col-sm-8">
    			<div class="input-group date edit_profile_date_picker">
    			    <input type="text" id="user_previous_employment_end_date" class="form-control" placeholder="End Date" name="user_previous_employment_end_date[]">
    			    <span class="input-group-addon">
    				<i class="fa fa-calendar bigger-110"></i>
    			    </span>
    			</div>
    		    </div>
    		</div>
    		<div class="text-right">
    		    <a class="clone_component_button_7" href="javascript:;" onclick="clone_component(this, 7);"><i class="fa fa-plus-circle"></i> Add a Previous Employer</a>
    		    <a class="remove_component_button_7" href="javascript:;" onclick="remove_component(this, 7);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
    		</div>
    	    </div>
    	</div>
        </div>
    <?php } ?>
</div>
<hr/>
<script>
    $(document).ready(function () {
        $(".previous_employment_position-other-select").each(function (i, v) {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            }
        });
        add_previous_employment_other();
    });
    function add_previous_employment_other() {
        $(".previous_employment_position-other-select").on('change', function () {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            } else {
                $(this).closest('.form-group').next('div').hide();
            }
        });
    }
</script>