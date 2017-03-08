<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	.btn-success{
		width:130px !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h2>Add New Tab : <?php echo $aircraft_tab_array['aircraft_name']; ?></h2>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Tab</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Tab</h3>
					</div>
					<div class="box-body">
						<form id="edit_sale_tab_form" method="post">
							<div class="form-group">
								<label for="aircrafts_id">Aircraft</label>
								<input type="hidden" name="aircrafts_id" id="aircrafts_id" value="<?php echo $aircraft_tab_array['aircraft_id']; ?>"/>
								<input type="text" value="<?php echo $aircraft_tab_array['aircraft_name']; ?>" class="form-control" readonly="readonly"/>
							</div>
							<div class="form-group">
								<label for="aircraft_sale_tab_name">Header Text</label>
								<input type="text" name="aircraft_sale_tab_name" id="aircraft_sale_tab_name" class="form-control" placeholder="Tab Heading" value="<?php echo $aircraft_tab_array['aircraft_sale_tab_name']; ?>"/>
							</div>
							<div class="form-group">
								<label for="aircraft_sale_tab_content">Content</label>
								<textarea name="aircraft_sale_tab_content" id="aircraft_sale_tab_content" class="form-control"><?php echo $aircraft_tab_array['aircraft_sale_tab_content']; ?></textarea>
							</div>
						</form>
					</div>
					<div class="box-footer">
						<a href="<?php echo base_url(); ?>aircraft/sale_tabs/<?php echo $aircraft_tab_array['aircraft_id']; ?>" class="btn btn-default"><i class="fa fa-angle-left"></i> Cancel</a>
						<button type="button" id="edit_sale_tab_button" class="btn btn-primary pull-right">Update Tab <i class="fa fa-angle-right"></i></button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript">
	$(function () {
		CKEDITOR.replace('aircraft_sale_tab_content');
	});
	$("#edit_sale_tab_button").click(function () {
		$("#edit_sale_tab_button").button('loading');
		var tab_content = CKEDITOR.instances.aircraft_sale_tab_content.getData();
		$.post('', {aircrafts_id: $("#aircrafts_id").val(), aircraft_sale_tab_name: $("#aircraft_sale_tab_name").val(), aircraft_sale_tab_content: tab_content}, function (data) {
			if (data === '1') {
				bootbox.alert('Updated Successfully', function () {
					document.location.href = base_url + 'aircraft/sale_tabs/<?php echo $aircraft_tab_array['aircraft_id']; ?>';
				});
			} else if (data === '0') {
				bootbox.alert('Error updating data');
			} else {
				bootbox.alert(data);
			}
			$("#edit_sale_tab_button").button('reset');
		});
	});
</script>