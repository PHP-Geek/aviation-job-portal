<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Conditional Email Setup<small>Configuration of Conditional Email</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Conditional Email Setup</li>
        </ol>
    </section>
    <section class="content">
		<div class="col-md-8 col-lg-8 col-md-offset-2">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Conditional Email Setup</h3>
				</div>
				<form method="post" action="" id="conditional_email_setup_form">
					<div class="box-body">
						<div class="form-group">
							<label for="conditional_email_from">Email</label>
							<input type="text" name="conditional_email_from" id="conditional_email_from" class="form-control" placeholder="Admin Email Address"/>
						</div>
						<div class="form-group">
							<label for="conditional_email_subject">Subject</label>
							<input type="text" name="conditional_email_subject" class="form-control" placeholder="Subject">
						</div>
						<div class="form-group">
							<label for="conditional_email_body">Email Body</label>
							<textarea name="conditional_email_body" id="conditional_email_body" class="form-control" placeholder="Email Setup Body Here" rows="4"></textarea>
						</div>
						<div class="form-group">
							<a href="#" class="btn btn-success">Select File(s)</a>
							<label for="conditional_email_attachment">Attachment(s)</label>
						</div>
					</div>
					<div class="box-footer">
						<button type="button" id="conditional_email_setup_button" class="btn btn-primary pull-right">Submit</button>
					</div>
				</form>
			</div>
		</div>
    </section>
</div>
