<!-- Training and courses Details -->
<div class="register">
    <?php
    if (count($user_training_array) > 0) {
        foreach ($user_training_array as $key => $user_training) {
            ?>
            <div class="clone_component_9">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                        <h4>Training And Courses Completed</h4>
                        <div class="form-group">
                            <label for="trainings_id" class="col-sm-4 control-label">Course</label>
                            <div class="col-sm-8">
                                <select name="trainings_id[]" id="trainings_id<?php echo $key; ?>" data-placeholder="Training Course Name" class="form-control select2_edit_profile training-other-select">
                                    <option></option>
                                    <?php
                                    $other_selected = false;
                                    foreach ($training_array as $training) {
                                        if ($user_training['trainings_id'] === '0') {
                                            $other_selected = true;
                                        }
                                        ?>
                                        <option <?php
                                        if ($training['training_id'] === $user_training['trainings_id']) {
                                            echo 'selected="selected"';
                                        }
                                        ?> value="<?php echo $training['training_id']; ?>">
                                            <?php echo $training['training_name']; ?></option>
                                    <?php } ?>
                                    <option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
                                </select>
                            </div>
                        </div>			
                        <div class="form-group training_other form-other-input" style="display:none" id="training_div<?php echo $key; ?>">
                            <label for="user_other_training" class="col-sm-4 control-label">Other</label>
                            <div class="col-sm-8">
                                <input type="text" name="other_training[]" id="other_training" class="form-control" placeholder="Other Trainings" value="<?php echo isset($user_training['user_training_course_other']['user_training_course_other_name']) && $user_training['user_training_course_other']['user_training_course_other_name'] !== '' ? $user_training['user_training_course_other']['user_training_course_other_name'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_training_completion_date" class="col-sm-4 control-label">Completion Date</label>
                            <div class="col-sm-8">
                                <div class="input-group date edit_profile_date_picker">
                                    <input type="text" id="user_training_completion_date" class="form-control date-picker" name="user_training_completion_date[]" placeholder="Training Completion Date" value="<?php echo $user_training['user_training_completion_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_training['user_training_completion_date'])) : ''; ?>">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <?php if ($key === count($user_training_array) - 1) { ?>
                                <a class="clone_component_button_9" href="javascript:;" onclick="clone_component(this, 9);"><i class="fa fa-plus-circle"></i> Add a Course</a>
                            <?php } else { ?>
                                <a class="clone_component_button_9" href="javascript:;" onclick="clone_component(this, 9);" style="display:none"><i class="fa fa-plus-circle"></i> Add a Course</a>
                            <?php } ?>
                            <?php if (count($user_training_array) === 1) { ?>
                                <a class="remove_component_button_9" href="javascript:;" onclick="remove_component(this, 9);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
                            <?php } else { ?>
                                <a class="remove_component_button_9" href="javascript:;" onclick="remove_component(this, 9);"><i class="fa fa-minus-circle"></i> Remove</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="clone_component_9">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                    <h4>Training And Courses Completed</h4>
                    <div class="form-group">
                        <label for="trainings_id" class="col-sm-4 control-label">Course</label>
                        <div class="col-sm-8">
                            <select name="trainings_id[]" id="trainings_id" data-placeholder="Training Course Name" class="form-control select2_edit_profile training-other-select">
                                <option></option>
                                <?php foreach ($training_array as $training) { ?>
                                    <option value="<?php echo $training['training_id']; ?>">
                                        <?php echo $training['training_name']; ?></option>
                                <?php } ?>
                                <option value="0">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group training_other form-other-input" style="display:none" id="training_div">
                        <label for="user_other_training" class="col-sm-4 control-label">Other</label>
                        <div class="col-sm-8">
                            <input type="text" name="other_training[]" id="other_training" class="form-control" placeholder="Other Trainings"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_training_completion_date" class="col-sm-4 control-label">Completion Date</label>
                        <div class="col-sm-8">
                            <div class="input-group date edit_profile_date_picker">
                                <input type="text" id="user_training_completion_date" class="form-control date-picker" name="user_training_completion_date[]" placeholder="Training Completion Date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a class="clone_component_button_9" href="javascript:;" onclick="clone_component(this, 9);"><i class="fa fa-plus-circle"></i> Add a Course</a>
                        <a class="remove_component_button_9" href="javascript:;" onclick="remove_component(this, 9);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>
</div>
<hr/>
<script>
    $(document).ready(function () {
        $(".training-other-select").each(function (i, v) {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            }
        });
        add_training_other();
    });
    function add_training_other() {
        $(".training-other-select").on('change', function () {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            } else {
                $(this).closest('.form-group').next('div').hide();
            }
        });
    }
</script>
