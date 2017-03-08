<style>
	#license_type_modal .select2-container , #license_modal .select2-container  {
		padding:0;
		border:none;
	}
	#license_type_modal .select2-choice,#license_type_modal .select2-default ,#license_modal .select2-choice,#license_modal .select2-default {
		min-height:34px !important;
		padding-top:3px;
	}

</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Licenses <small>listing of all licenses</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#license_modal"><i class="fa fa-plus-circle"></i> Add License</button>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#license_type_modal"><i class="fa fa-plus-circle"></i> Add License Type</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Licenses</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="quote_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>License Type</th>
							<th>Positions</th>
							<th>License Name</th>
							<th>License Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="license_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add License</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form" id="add_license">
					<div class="form-group">
						<label for="license_type">License Type</label>
						<select class="form-control" id="license_type" name="license_type" data-placeholder="Select License Type">
						<option></option>
						<?php
							foreach ($license_type_array as $license_type) {
										?><option value="<?php echo $license_type['license_type_id']; ?>" > <?php echo $license_type['license_type_name']; ?></option><?php
									}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="license_type">License</label>
						<input type="text" class="form-control" name="license_name" id="license_name" placeholder="License "/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" onclick="add_license();" data-loading-text="Please wait..." id="add_license_button">Add License <i class="fa fa-angle-right" ></i></button>
			</div>
		</div>
	</div>
</div>
<div id="license_type_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add License Type</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form" id="add_license_type">
					<div class="form-group">
						<label for="position">Position</label>
						<select class="form-control" id="position" name="position" data-placeholder="Select Position">
									<option></option>
									<?php
									foreach ($job_type_array as $job_type) {
										?><option value="<?php echo $job_type['job_type_id']; ?>" > <?php echo $job_type['job_type_name']; ?></option><?php
									}
									?>
						</select>
					</div>
					<div class="form-group">
						<label for="license_type_name">License Type</label>
						<input type="text" class="form-control" name="license_type_name" id="license_type_name" placeholder="License Type"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" onclick="add_license_type();" data-loading-text="Please wait..." id="add_license_type_button">Add License <i class="fa fa-angle-right" ></i></button>
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
					$(function () {
						$('select').select2({allowClear: true});
						$('#quote_datatable').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/license_datatable",
							"oLanguage": {
								"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Licenses.</span>'
							},
							"oTableTools": {
								"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
								"aButtons": [{
										"sExtends": "pdf",
										"sButtonText": "<i class='fa fa-save'></i> PDF",
										"sPdfOrientation": "landscape",
										"sPdfSize": "tabloid",
										"mColumns": [1,2,3]
									}, {
										"sExtends": "csv",
										"sButtonText": "<i class='fa fa-save'></i> CSV",
										"mColumns": [1,2,3]
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
												return '<div class="text-center"><input onchange="license_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="license_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function license_status(license_id) {
						$.post(base_url + 'configuration/change_license_status', {license_id: license_id, license_status: $("#id_" + license_id).is(':checked')}, function (data) {
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
					function add_license() {
						$("#add_license_button").button("loading");
						$.post(base_url + 'configuration/add_license',$('#add_license').serialize(), function (data) {
							if (data === '1') {
								bootbox.alert('License Added Successfully.', function () {						
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding License');
							} else {
								bootbox.alert(data);
							}
							$("#add_license_button").button("reset");
						});						
					}
					function add_license_type(){
						$("#add_license_type_button").button("loading");
						$.post(base_url+'configuration/add_license_type',$('#add_license_type').serialize(),
							function(data){
								if(data==='1'){
									bootbox.alert('License Type Added Successfully.',function(){
										document.location.href='';
									});
								} else if(data==='0'){
									bootbox.alert('Error Adding License Type');
								} else {
									bootbox.alert(data);
								}
								$("#add_license_type_button").button("reset");
						});						
					}

</script>