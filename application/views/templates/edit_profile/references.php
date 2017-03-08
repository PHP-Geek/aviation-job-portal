<!-- References Details -->
<div class="register">
    <div class="row">
        <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
            <h4>Background Check</h4>
            <div class="form-group">
                <label for="user_is_accident_case" class="col-sm-4 control-label checkbox_label">Any accident or incidents ? </label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="checkbox" name="user_is_accident_case" id="user_is_accident_case" <?php echo $user_details_array['user_is_accident_case'] === '1' ? 'checked="checked"' : ''; ?> value="1" class="accident_case_box"/>
                        </div>
                        <!--						<div class="col-sm-9">
                                                                                <input type="radio" name="user_is_accident_case" id="user_is_accident_case1" <?php //echo $user_details_array['user_is_accident_case'] === '0' ? 'checked="checked"' : '';           ?> value="0" class="accident_case_box"/> No
                                                                        </div>-->
                    </div>
                </div>
            </div>
            <div class="form-group" id="accident_div">
                <label for="user_is_accident_case_desc" class="col-sm-4 control-label">Please Describe</label>
                <div class="col-sm-8">
                    <textarea name="user_accident_case_description" id="user_accident_case_description" class="form-control" placeholder="Describe Accident or incidents"><?php echo $user_details_array['user_accident_case_description']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="user_is_criminal_case" class="col-sm-4 control-label checkbox_label">Any Criminal History ? </label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="checkbox" name="user_is_criminal_case" id="user_is_criminal_case" <?php echo $user_details_array['user_is_criminal_case'] === '1' ? 'checked="checked"' : ''; ?> value="1" class="accident_case_box"/>
                        </div>
                        <!--						<div class="col-sm-9">
                                                                                <input type="radio" name="user_is_criminal_case" id="user_is_criminal_case1" <?php //echo $user_details_array['user_is_criminal_case'] === '0' ? 'checked="checked"' : '';         ?> value="0" class="accident_case_box"/> No
                                                                        </div>-->
                    </div>
                </div>
            </div>
            <div class="form-group" id="criminal_div">
                <label for="user_criminal_case_desc" class="col-sm-4 control-label">Please Describe </label>
                <div class="col-sm-8">
                    <textarea name="user_criminal_case_description" id="user_criminal_case_description" class="form-control" placeholder="Describe Criminal History"><?php echo $user_details_array['user_criminal_case_description']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="register">
    <?php
    if (count($user_reference_array) > 0) {
        foreach ($user_reference_array as $key => $reference) {
            ?>
            <div class="clone_component_12">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                        <h4>References</h4>
                        <div class="form-group">
                            <label for="user_reference_name" class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_reference_name[]" id="user_reference_name" class="form-control" placeholder="Name" value="<?php echo $reference['user_reference_name']; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_reference_company" class="col-sm-4 control-label">Company</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_reference_company[]" id="user_reference_company" class="form-control" placeholder="Company" value="<?php echo $reference['user_reference_company']; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_reference_positions_id" class="col-sm-4 control-label">Position</label>
                            <div class="col-sm-8">
                                <select name="user_reference_positions_id[]" class="form-control select2_edit_profile references_position-other-select" id="user_reference_positions_id" data-placeholder="Position">
                                    <option></option>
                                    <?php
                                    $other_selected = false;
                                    foreach ($position_array as $position) {
                                        if ($reference['positions_id'] === '0') {
                                            $other_selected = true;
                                        }
                                        ?>
                                        <option <?php echo $reference['positions_id'] === $position['position_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
        <?php } ?>
                                    <option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group references_other_position form-other-input" style="display:none" id="references_other_position_div">
                            <label for="user_reference_other_position" class="col-sm-4 control-label">Other</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_reference_other_position[]" id="user_reference_other_position" class="form-control" placeholder="Other Position" value="<?php echo isset($reference['user_reference_position_other']['user_reference_position_other_name']) && $reference['user_reference_position_other']['user_reference_position_other_name'] !== '' ? $reference['user_reference_position_other']['user_reference_position_other_name'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_reference_relation" class="col-sm-4 control-label">Relationship</label>
                            <div class="col-sm-8">
                                <select name="user_reference_relation[]" class="form-control select2_edit_profile" id="user_reference_relation" data-placeholder="Relationship">
                                    <option></option>
                                    <?php foreach ($relation_array as $relation) { ?>
                                        <option <?php echo $relation === $reference['user_reference_relation'] ? 'selected="selected"' : ''; ?> value="<?php echo $relation; ?>"><?php echo $relation; ?></option>
        <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_reference_email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_reference_email[]" id="user_reference_email" class="form-control" placeholder="Email" value="<?php echo $reference['user_reference_email']; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_reference_contact_number"  class="col-sm-4 control-label">Contact Number</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon" id="user_reference_country_code" style="border:none;padding:0">
                                        <select name="user_reference_country_code[]" class="select2_edit_profile" data-placeholder="&nbsp;Country Code">
                                            <option></option>
                                            <?php
                                            foreach ($country_array as $country) {
                                                if ($country['country_code'] != '') {
                                                    ?>
                                                    <option <?php echo $country['country_code'] === $reference['user_reference_country_code'] ? 'selected="selected"' : ''; ?> value="<?php echo $country['country_code']; ?>"><?php echo $country['country_name'] . '(' . $country['country_code'] . ')'; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control" id="user_reference_contact_number" name="user_reference_contact_number[]" placeholder="Contact Number" value="<?php echo $reference['user_reference_contact_number']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <?php if ($key === count($user_reference_array) - 1) { ?>
                                <a class="clone_component_button_12" href="javascript:;" onclick="clone_component(this, 12);"><i class="fa fa-plus-circle"></i> Add A Reference</a>
                            <?php } else { ?>
                                <a class="clone_component_button_12" href="javascript:;" onclick="clone_component(this, 12);" style="display:none"><i class="fa fa-plus-circle"></i> Add A Reference</a>
                            <?php } ?>
                            <?php if (count($user_reference_array) === 1) { ?>
                                <a class="remove_component_button_12" href="javascript:;" onclick="remove_component(this, 12);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
                            <?php } else { ?>
                                <a class="remove_component_button_12" href="javascript:;" onclick="remove_component(this, 12);"><i class="fa fa-minus-circle"></i> Remove</a>
        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="clone_component_12">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                    <h4>References</h4>
                    <div class="form-group">
                        <label for="user_reference_name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_reference_name[]" id="user_reference_name" class="form-control" placeholder="Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_reference_company" class="col-sm-4 control-label">Company</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_reference_company[]" id="user_reference_company" class="form-control" placeholder="Company"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_reference_positions_id" class="col-sm-4 control-label">Position</label>
                        <div class="col-sm-8">
                            <select name="user_reference_positions_id[]" class="form-control select2_edit_profile references_position-other-select" id="user_reference_positions_id" data-placeholder="Position">
                                <option></option>
                                <?php foreach ($position_array as $position) { ?>
                                    <option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
    <?php } ?>
                                <option value="0">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group references_other_position form-other-input" style="display:none" id="references_other_position_div">
                        <label for="user_reference_other_position" class="col-sm-4 control-label">Other</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_reference_other_position[]" id="user_reference_other_position" class="form-control" placeholder="Other Position"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_reference_relation" class="col-sm-4 control-label">Relationship</label>
                        <div class="col-sm-8">
                            <select name="user_reference_relation[]" class="form-control select2_edit_profile" id="user_reference_relation" data-placeholder="Relationship">
                                <option></option>
                                <?php foreach ($relation_array as $relation) { ?>
                                    <option value="<?php echo $relation; ?>"><?php echo $relation; ?></option>
    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_reference_email" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_reference_email[]" id="user_reference_email" class="form-control" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_reference_contact_number"  class="col-sm-4 control-label">Contact Number</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon" id="user_reference_country_code" style="border:none;padding:0">
                                    <select name="user_reference_country_code[]" class="select2_edit_profile" data-placeholder="&nbsp;Country Code">
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
                                <input type="text" class="form-control" id="user_reference_contact_number" name="user_reference_contact_number[]" placeholder="Contact Number">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a class="clone_component_button_12" href="javascript:;" onclick="clone_component(this, 12);"><i class="fa fa-plus-circle"></i> Add a Reference</a>
                        <a class="remove_component_button_12" href="javascript:;" onclick="remove_component(this, 12);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
                    </div>
                </div>
            </div>
        </div>
<?php }
?>
</div>
<hr/>
<script>
    $(function () {
        setTimeout(function () {
            $("#accident_div").hide();
            $("#criminal_div").hide();
            if ($("#user_is_accident_case").prop('checked') == true) {
                $("#accident_div").show();
            }
            if ($("#user_is_criminal_case").prop('checked') == true) {
                $("#criminal_div").show();
            }
        }, 100);
    });
    $("#user_is_accident_case").on('change', function () {
        if ($("#user_is_accident_case").is(':checked')) {
            $("#accident_div").show();
        } else {
            $("#accident_div").hide();
        }
    });
    $("#user_is_criminal_case").on('change', function () {
        if ($("#user_is_criminal_case").is(':checked')) {
            $("#criminal_div").show();
        } else {
            $("#criminal_div").hide();
        }
    });
</script>
<script>
    $(document).ready(function () {
        $(".references_position-other-select").each(function (i, v) {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            }
        });
        add_references_other();
    });
    function add_references_other() {
        $(".references_position-other-select").on('change', function () {
            if ($(this).val() === '0') {
                $(this).closest('.form-group').next('div').show();
            } else {
                $(this).closest('.form-group').next('div').hide();
            }
        });
    }
</script>