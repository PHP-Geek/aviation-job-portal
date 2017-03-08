<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	#job_types_id{
		width:100% !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">User Specific Roles <small>listing of all roles</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employee_role_model"><i class="fa fa-plus-circle"></i> Add Position Type/Role</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User Specific Roles</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="employee_role_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Position</th>
							<th>Role/Position Type</th>
							<th>Status</th>
						</tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="employee_role_model" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Role/Position Type</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form" id="add_employee_role">
					<div class="form-group">
						<label for="job_types_id" class="control-label">Position</label>
						<select name="job_types_id" id="job_types_id"  class="form-control" data-placeholder="Job Position (e.g. pilot,maintainance engineer etc)">
							<?php foreach ($job_type_array as $job_type) { ?>
								<option value="<?php echo $job_type['job_type_id']; ?>"><?php echo $job_type['job_type_name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="employee_role_name">Role/Position Type Name</label>
						<input type="text" class="form-control" name="employee_role_name" id="employee_role_name" placeholder="Role/Position Type Name"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" id="add_position_button" onclick="add_employee_role();">Add Role/Position Type <i class="fa fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript">
					$(function () {
						$('#employee_role_datatable').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/employee_role_datatable",
							"oLanguage": {
								"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No User Specific Roles.</span>'
							},
							"oTableTools": {
								"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
								"aButtons": [{
										"sExtends": "pdf",
										"sButtonText": "<i class='fa fa-save'></i> PDF",
										"sPdfOrientation": "landscape",
										"sPdfSize": "tabloid",
										"mColumns": [1],
										"bSelectedOnly": true
									}, {
										"sExtends": "csv",
										"sButtonText": "<i class='fa fa-save'></i> CSV",
										"mColumns": [1]
									}]
							},
							"aoColumnDefs": [
								{
									"aTargets": [0],
									"bVisible": false,
									"bSearchable": false
								},
								{
									"aTargets": [3],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										switch (data) {
											case '1':
												return '<div class="text-center"><input onchange="employee_role_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="employee_role_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function employee_role_status(employee_role_id) {
						$.post(base_url + 'configuration/change_employee_role_status', {employee_role_id: employee_role_id, employee_role_status: $("#id_" + employee_role_id).is(':checked')}, function (data) {
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
					function add_employee_role() {
						$('#add_position_button').button('loading');
						$.post(base_url + 'configuration/add_employee_role', $("#add_employee_role").serialize(), function (data) {
							if (data === '1') {
								bootbox.alert('Role/Position Type Added Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding User Specific Roles');
							} else {
								bootbox.alert(data);
							}
							$('#add_position_button').button('reset');
						});
					}

</script>