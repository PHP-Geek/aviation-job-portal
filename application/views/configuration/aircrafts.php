<style>
	.select2-container{
		width:100% !important;
	}
	.select2-selection{
		min-height:34px !important;
		outline:none;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Aircrafts <small>listing of all aircrafts</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aircraft_model"><i class="fa fa-plus-circle"></i> Add Aircraft</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircrafts</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="location_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Aircraft Name</th>
							<th>Category</th>
							<th>Positions</th>
							<th>Aircraft Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="aircraft_model" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Aircraft</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form" id="aircraft_model_form">
					<div class="form-group">
						<label for="my_aircraft_name">Aircraft Name</label>
						<input type="text" class="form-control" name="my_aircraft_name" id="my_aircraft_name" placeholder="Aircraft Name"/>
					</div>
					<div class="form-group">
						<label for="my_aircraft_name">Aircraft Category</label>
						<input type="text" class="form-control" name="my_aircraft_category" id="my_aircraft_category" placeholder="Aircraft Category"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" id="add_aircraft_button" data-loading-text="Please wait..." onclick="add_my_aircraft();">Add Aircraft <i class="fa fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
					$(function () {
						$('select').select2({allowClear:true});
						$('#location_datatable').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/aircraft_datatables",
							"oLanguage": {
								"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Data.</span>'
							},
							"oTableTools": {
								"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
								"aButtons": [{
										"sExtends": "pdf",
										"sButtonText": "<i class='fa fa-save'></i> PDF",
										"sPdfOrientation": "landscape",
										"sPdfSize": "tabloid",
										"mColumns": [1,2]
									}, {
										"sExtends": "csv",
										"sButtonText": "<i class='fa fa-save'></i> CSV",
										"mColumns": [1,2]
									}]
							},
							"aoColumnDefs": [
								{
									"aTargets": [0],
									"bVisible": true,
									"bSearchable": false
								},
								{
									"aTargets": [4],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										switch (data) {
											case '1':
												return '<div class="text-center"><input onchange="aircraft_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="aircraft_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function aircraft_status(my_aircraft_id) {
						$.post(base_url + 'configuration/change_aircraft_status', {my_aircraft_id: my_aircraft_id, my_aircraft_status: $("#id_" + my_aircraft_id).is(':checked')}, function (data) {
							if (data === '1') {
								bootbox.alert("Status Changed Successfully", function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert("Error Updating User Status !!!");
							} else {
								bootbox.alert(data);
							}
						});
					}
					function add_my_aircraft() {
						$('#add_aircraft_button').button('loading');
						$.post(base_url + 'configuration/add_aircraft', $("#aircraft_model_form").serialize(), function (data) {
							if (data === '1') {
								bootbox.alert('Aircraft Added Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding Aircrafts');
							} else {
								bootbox.alert(data);
							}
							$('#add_aircraft_button').button('reset');
						});
					}

</script>