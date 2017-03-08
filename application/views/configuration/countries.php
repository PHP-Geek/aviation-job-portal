<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Countries <small>listing of all countries</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#country_model"><i class="fa fa-plus-circle"></i> Add Country</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Countries</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="country_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Country Code</th>
							<th>Country Name</th>
							<th>Country Status</th>
							<th>Modify</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="country_model" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Country</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form">
					<div class="form-group">
						<label for="country_name">Country Code</label>
						<input type="text" class="form-control" name="country_code" id="country_code" placeholder="Country Code"/>
					</div>
					<div class="form-group">
						<label for="country_name">Country Name</label>
						<input type="text" class="form-control" name="country_name" id="country_name" placeholder="Country Name"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn pull-left btn-default" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" id="add_country_button" data-loading-text="Please wait..."onclick="add_country();">Add Country <i class="fa fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="country_edit_model" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Country Details</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form">
					<div class="form-group">
						<input type="hidden" name="edit_country_id" id="edit_country_id"/>
						<label for="edit_country_code">Country Code</label>
						<input type="text" class="form-control" name="edit_country_code" id="edit_country_code" placeholder="Country Code ex: +63"/>
					</div>
					<div class="form-group">
						<label for="edit_country_name">Country Name</label>
						<input type="text" class="form-control" name="edit_country_name" id="edit_country_name" placeholder="Country Name"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn pull-left btn-default" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" id="edit_country_button" data-loading-text="Please wait..." onclick="edit_country();">Update <i class="fa fa-angle-right"></i></button>
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
<script type="text/javascript">
					$(function () {
						$('#country_datatable').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/country_datatable",
							"oLanguage": {
								"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Countries.</span>'
							},
							"oTableTools": {
								"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
								"aButtons": [{
										"sExtends": "pdf",
										"sButtonText": "<i class='fa fa-save'></i> PDF",
										"sPdfOrientation": "landscape",
										"sPdfSize": "tabloid",
										"mColumns": [1, 2],
										"bSelectedOnly": true
									}, {
										"sExtends": "csv",
										"sButtonText": "<i class='fa fa-save'></i> CSV",
										"mColumns": [1, 2]
									}]
							},
							"aoColumnDefs": [
								{
									"aTargets": [0],
									"bVisible": true,
									"bSearchable": false
								},
								{
									"aTargets": [3],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										switch (data) {
											case '1':
												return '<div class="text-center"><input onchange="country_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="country_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}, {
									"aTargets": [4],
									"bSearchable": true,
									"mData": null,
									"mRender": function (data, type, full) {
										return '<div class="text-center"><a href="#"><i class="fa fa-edit" data-toggle="modal" data-target="#country_edit_model" onclick="edit_country_modal(' + full[0] + '); ">Edit</i></a></div>';
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function country_status(country_id) {
						$.post(base_url + 'configuration/change_country_status', {country_id: country_id, country_status: $("#id_" + country_id).is(':checked')}, function (data) {
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
					function add_country() {
						$('#add_country_button').button('loading');
						$.post(base_url + 'configuration/add_country', {country_name: $("#country_name").val(), country_code: $("#country_code").val()}, function (data) {
							if (data === '1') {
								bootbox.alert('Country Added Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding Countries');
							} else {
								bootbox.alert(data);
							}
							$('#add_country_button').button('reset');
						});
					}
					function edit_country() {
						$('#edit_country_button').button('loading');
						$.post(base_url + 'configuration/edit_country', {country_id: $("#edit_country_id").val(), country_name: $("#edit_country_name").val(), country_code: $("#edit_country_code").val()}, function (data) {
							if (data === '1') {
								bootbox.alert('Country Details Updated Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding Countries');
							} else {
								bootbox.alert(data);
							}
							$('#edit_country_button').button('reset');
						});
					}

					function edit_country_modal(country_id) {						
						$.post(base_url + 'configuration/get_country_by_id', {country_id: country_id}, function (data) {
							$("#edit_country_id").val(data.country_id);
							$("#edit_country_code").val(data.country_code);
							$("#edit_country_name").val(data.country_name);							
						});
					}

</script>