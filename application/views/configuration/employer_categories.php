<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Employer Categories </h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employer_category_modal"><i class="fa fa-plus-circle"></i> Add Employer Category</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Employer Categories</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="employer_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Employer Category</th>
							<th>Employer Category Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="employer_category_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Employer Category</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" role="form">
					<div class="form-group">
						<label for="employer_type">Employer Category</label>
						<input type="text" class="form-control" name="employer_type" id="employer_type" placeholder="Employer Type"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" onclick="add_employer_category();" id="add_employer_category_button" data-loading-text="Please wait...">Add Employer Category <i class="fa fa-angle-right"></i></button>
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
						$('#employer_datatable').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/employer_category_datatable",
							"oLanguage": {
								"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Employer Categories.</span>'
							},
							"oTableTools": {
								"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
								"aButtons": [{
										"sExtends": "pdf",
										"sButtonText": "<i class='fa fa-save'></i> PDF",
										"sPdfOrientation": "landscape",
										"sPdfSize": "tabloid",
										"mColumns": [1]
									}, {
										"sExtends": "csv",
										"sButtonText": "<i class='fa fa-save'></i> CSV",
										"mColumns": [1]
									}]
							},
							"aoColumnDefs": [
								{
									"aTargets": [0],
									"bVisible": true,
									"bSearchable": false
								},
								{
									"aTargets": [2],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										switch (data) {
											case '1':
												return '<div class="text-center"><input onchange="employer_category_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="employer_category_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function employer_category_status(employer_type_id) {
						$.post(base_url + 'configuration/change_employer_type_status', {employer_type_id: employer_type_id, employer_type_status: $("#id_" + employer_type_id).is(':checked')}, function (data) {
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
					function add_employer_category() {
						$('#add_employer_category_button').button('loading');
						$.post(base_url + 'configuration/add_employer_category', {employer_type: $("#employer_type").val()}, function (data) {
							if (data === '1') {
								bootbox.alert('Employer Category Added Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding Employer Category');
							} else {
								bootbox.alert(data);
							}
							$('#add_employer_category_button').button('reset');
						});
					}

</script>