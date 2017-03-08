<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Manufacturer <small>Add Manufacturer</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Manufacturer</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Manufacturer</h3>
                    </div>
                    <form id="add_manufacturer_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="manufacturer_name" class="control-label">Manufacturer Name</label>
								<input type="text" name="manufacturer_name" id="manufacturer_name" class="form-control" placeholder="Manufacturer name" value=""/>
							</div>
						</div>
						<div class="box-footer text-right">
							<a href="<?php echo base_url(); ?>manufacturer" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="add_manufacturer_button" type="button" class="btn btn-primary">Add Manufacturer <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript">
	$("#add_manufacturer_button").click(function () {
		$("#add_manufacturer_button").button("loading");
		$.post('', $("#add_manufacturer_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.confirm("Manufacturer Added Successfully !!!", function (result) {
					document.location.href = base_url + 'manufacturer';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#add_manufacturer_button").button("reset");
		});
	});
</script>

