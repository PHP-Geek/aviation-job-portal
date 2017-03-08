<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Verify Email Address</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-6">
			<?php if (isset($error_message)) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $error_message; ?>
				</div>
			<?php } else { ?>
				<div class="alert alert-success" role="alert">
					<?php echo $success_message; ?>
				</div>
			<?php } ?>
			<br/>
			Redirecting to Login...
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		setTimeout(function () {
<?php if (isset($_SESSION['user'])) { ?>
				document.location.href = base_url + 'dashboard';
<?php } ?>
		}, 5000);
	});
</script>