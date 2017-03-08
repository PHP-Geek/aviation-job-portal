<div id="retired_pilot_div">
    <?php
    if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'air-traffic-controller') {
        ?>
        <!-- retired pilot Details -->
        <div class="register">
            <div class="">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                        <h4>Retired Pilot</h4>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="retired_pilot_company">Last Company</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="user_retired_pilot_company" id="user_retired_pilot_company" value="<?php echo isset($user_retired_pilot_array['user_retired_pilot_company']) ? $user_retired_pilot_array['user_retired_pilot_company'] : ''; ?>" placeholder="Last Company"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="retired_pilot_positions_id">Current Position</label>
                            <div class="col-sm-8">
                                <select class="form-control select2_edit_profile" data-placeholder="&nbsp;Current Position" id="user_retired_pilot_positions_id" name="user_retired_pilot_positions_id">
                                    <option></option>
                                    <?php
                                    foreach ($pilot_position_array as $position) {
                                        ?>
                                        <option <?php echo isset($user_retired_pilot_array['positions_id']) && $position['position_id'] === $user_retired_pilot_array['positions_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
                                    <?php } ?>
                                    <option value="0" <?php echo isset($user_retired_pilot_array['positions_id']) && $user_retired_pilot_array['positions_id'] === '0' ? 'selected="selected"' : ''; ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group user_retired_pilot_position_other" style="display:none">
                            <label for="user_retired_pilot_position_other_name" class="col-sm-4 control-label">Other</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_retired_pilot_current_position_other_name" id="user_retired_pilot_current_position_other_name" class="form-control" placeholder="Other Position" value="<?php echo isset($user_retired_pilot_array['user_retired_pilot_current_position_other']['user_retired_pilot_current_position_other_name']) && $user_retired_pilot_array['user_retired_pilot_current_position_other']['user_retired_pilot_current_position_other_name'] !== '' ? $user_retired_pilot_array['user_retired_pilot_current_position_other']['user_retired_pilot_current_position_other_name'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="retired_pilot_total_hours">Total Hours</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="user_retired_pilot_total_hours" id="user_retired_pilot_total_hours" value="<?php echo isset($user_retired_pilot_array['user_retired_pilot_total_hours']) ? $user_retired_pilot_array['user_retired_pilot_total_hours'] : ''; ?>" placeholder="Total Hours"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
    <?php } ?>
</div>
<script>
    $(function () {
        $("#user_retired_pilot_positions_id").each(function (i, v) {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            }
        });
        $("#user_retired_pilot_positions_id").on('change', function () {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            } else {
                $(this).closest('.form-group').next('div').hide();
            }
        });
    });
</script>