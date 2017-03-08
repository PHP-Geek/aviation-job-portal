<style>
	.modal-dialog {
		margin-top:100px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Change Password </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Change Password</h3>
                    </div>
                    <form id="change_password_form" role="form" method="post" action="">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="user_login_password">New Password</label>
                                <input name="user_login_password" type="password" class="form-control" id="user_login_password" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="user_confirm_password">Confirm Password</label>
                                <input name="user_confirm_password" type="password" class="form-control" id="user_confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="box-footer text-right">
                            <button id="change_password_button" type="button" class="btn btn-success">Change Password <i class="fa fa-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
	$("#change_password_button").click(function () {
		$.post('', $("#change_password_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.confirm("Your password has been changed successfully.!", function (result) {
					document.location.href = base_url + 'dashboard';
				});
			} else {
				bootbox.alert(data);
			}
		});
	});
</script>