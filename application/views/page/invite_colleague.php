<style>
    .contact {
        margin-bottom: 20px;
    }
    .contact h3{
        color:#363f5c;
        font-size:41px;
        margin-bottom: 20px;
    }
    .contact-form {
        background-color: #eaeaea;
        background-image: none;
        border: 1px solid #eaeaea;
        border-radius: 4px;
        color: #555;
        display: block;
        font-size: 14px;
        line-height: 1.42857;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
		resize:none;
    }
    .contact-form:focus {
        border-color: #66afe9;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6);
        outline: 0 none;
    }
    .contact-2{
        margin-top:20px;
        margin-bottom:10px;
    }
    .contact-2 h4{
        font-size:20px;
        font-weight: 500;
        margin-top:50px;
    }
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Invite Colleague</li>
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
                    <h1><span style="font-weight: 500">Invite Your Colleague</h1>
                    <p>Aided by InCrew's online Aircrew Brokerage, we make ferrying and delivery a breeze. A call to InCrew secures a crew, flightplan, en route planning and permissions, and flight watch for your ferry flight, with the minimum of fuss.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="contact">
                        <h4>Invite Your Colleague/Friend</h4>
                        <div class="row">
                            <div class="col-md-8">
								<form id="invite_colleague_form" method="post" action="">
									<div class="form-group">
										<label for="invite_colleague_recipient">Email ID</label>
										<select name="invite_colleague_recipient[]" id="invite_colleague_recipient" class="form-control select2_invite_colleague" multiple="multiple" data-tags="true" data-placeholder="Add email(s). Type email id and hit enter and may add multiple emails.">
										</select>
									</div>
									<div>
										<button type="submit" id="invite_colleague_button" class="btn btn-success">Invite <i class="fa fa-plane"></i></button>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(function () {
		$(".select2_invite_colleague").select2({
			tags: true,
			allowClear: true});
		$("#invite_colleague_form").validate({
			errorElement: 'span',
			errorClass: 'help-block text-right',
			focusInvalid: true,
			ignore: null,
			rules: {
				"invite_colleague_recipient[]": "required"
			},
			messages: {
				"invite_colleague_recipient[]": "Please fill your colleague email ID"
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
				$("#invite_colleague_button").button("loading");
				$.post('', $("#invite_colleague_form").serialize(), function (data) {
					if (data === '1') {
						bootbox.alert("Invitation has been sent successfully.", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error submitting records");
					} else {
						bootbox.alert(data);
					}
					$("#invite_colleague_button").button("reset");
				});
			}
		});
	});
	function show_signup_error() {
		$("#invite_colleague_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error !!!</div>');
		setTimeout(function () {
			$('.alert-danger').fadeOut();
		}, 2000);
	}
</script>