<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Aircraft Models <small>listing of all aircrafts</small></h1>
		<a href="<?php echo base_url(); ?>aircraft/add_model" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Model</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Models</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="quote_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Model Name</th>
							<th>Manufacturer</th>
							<th>Status</th>
							<th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
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
		$('#quote_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "aircraft/model_datatable",
			"oTableTools": {
				"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
				"aButtons": [{
						"sExtends": "pdf",
						"sButtonText": "<i class='fa fa-save'></i> PDF",
						"sPdfOrientation": "landscape",
						"sPdfSize": "tabloid",
						"mColumns": [1, 2]
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
					"bSearchable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="model_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked"/></div>';
								break;
							default:
								return '<div class="text-center"><input onchange="model_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox"/></div>';
								break;
						}
					}
				},
				{
					"aTargets": [4],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'aircraft/edit_model/' + full[0] + '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a></div>'
					}
				}
			],
		}).fnSetFilteringDelay(700);
	});
	function model_status(model_id) {
		$.post(base_url + 'aircraft/change_model_status', {model_id: model_id, model_status: $("#id_" + model_id).is(':checked')}, function (data) {
			if (data === '1') {
				bootbox.alert("Status Changed Successfully", function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert("Error Updating Status.");
			} else {
				bootbox.alert(data);
			}
		});
	}

</script>