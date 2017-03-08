<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard <small>dashboard</small></h1>
        <ol class="breadcrumb">
            <li class="active"><a href="javascript:;"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <section class="content" style="min-height: 654px;">
        <div class="box">
            <div class="box-body">
				<p>Welcome <strong><?php echo $_SESSION['user']['user_first_name'] . ' ' . $_SESSION['user']['user_last_name']; ?></strong></p>
				<img src="<?php echo base_url(); ?>assets/img/large_logo.png" class="img-responsive center-block dashboard-logo">
			</div>
		</div>
	</section>
</div>