<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Edit Profile</li>
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
                    <h1><span style="font-weight: 500">Employer Edit Profile</span></h1>
                    <p>Aided by InCrew's online Aircrew Brokerage, we make ferrying and delivery a breeze. A call to InCrew secures a crew, flightplan, en route planning and permissions, and flight watch for your ferry flight, with the minimum of fuss.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="register">
                <h2>Mandatory Field</h2>
                <p>Please fill in the form. Once registration is complete a confirmation letter will be sent to your email address which will allow you to login and update your profile. </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <form>
                <div class="register">
                    <div class="form-group">
                        <a href="<?php echo base_url(); ?>post-job"><label for="company">+ Repost Previous Job</label></a>
                    </div>
                    <div class="form-group">
                        <label for="company">Contact Email</label>
                        <input type="company" class="form-control" id="" placeholder="Test@gmail.com">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="form-field-mask-2">
                                Contact Number
                                <small class="text-muted">(999) 999-9999</small>
                            </label>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="ace-icon fa fa-phone"></i>
                                </span>

                                <input type="text" id="" class="form-control input-mask-phone">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company">Compnay Name</label>
                        <input type="company" class="form-control" id="" placeholder="Increw">
                    </div>
                    <div class="form-group">
                        <label for="resume">Company Logo ( pdf, doc 5MB max )</label>
                        <input type="file" name="resume" id="resume">
                    </div>
                    <div class="form-group">
                        <label for="">Posted Date</label>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" id="" class="form-control date-picker">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Expiry Date</label>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" id="" class="form-control date-picker">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2">Category</label>
                        <select id="" class="form-control" >
                            <option value="">Pilot</option>
                            <option value="AL">Maint Engineer</option>
                            <option value="AL">Flight att</option>
                            <option value="AL">Exec and Corporate</option>
                            <option value="AL">operation</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2">Job Title</label>
                        <select id="" class="form-control" >
                            <option value="">Pilot</option>
                            <option value="AL">Maint Engineer</option>
                            <option value="AL">Flight att</option>
                            <option value="AL">Exec and Corporate</option>
                            <option value="AL">operation</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2">Employment Type</label>
                        <select id="" class="form-control" >
                            <option value="">Full Time</option>
                            <option value="AL">Contract</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Expected Start Date</label>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" id="" class="form-control date-picker">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputName2">Aircraft Type</label>
                                <select id="" class="form-control">
                                    <option value="">Aircraft Type</option>
                                    <option value="AL">Alabama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2">license Type</label>
                                <select id="" class="form-control">
                                    <option value="">Aircraft Type</option>
                                    <option value="AL">Alabama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company">Location</label>
                        <input type="company" class="form-control" id="" placeholder="Test@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="company">Pay</label>
                        <input type="company" class="form-control" id="" placeholder="Test@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="Subject">Details(Requirments)</label>
                        <textarea class="form-control" rows="3" placeholder="Details"></textarea>
                    </div>
                    <h5>Notification Setup</h5>
                    <label>
                        <input type="checkbox">
                        <span class="label-text">Email And Dashboard</span>
                    </label><br/>
                    <label>
                        <input type="checkbox">
                        <span class="label-text">Email Only</span>
                    </label><br/>
                    <label>
                        <input type="checkbox">
                        <span class="label-text">Dashboard Only</span>
                    </label>
                </div>
            </form>
        </div>
    </div>
    <hr/>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-success " type="button">Submit <span class="fa fa-plane"></span></button>
        </div>
    </div>
</div>