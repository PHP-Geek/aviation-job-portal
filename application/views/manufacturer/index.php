<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Manufacturers <small>listing of all manufacturers</small></h1>
		<a href="<?php echo base_url(); ?>manufacturer/add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Manufacturer</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Manufacturers</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="quote_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Manufacturer Name</th>
							<th>Status</th>
							<th>Action</th>
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
			"sAjaxSource": base_url + "manufacturer/datatable",
			"oTableTools": {
				"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
				"aButtons": [{
						"sExtends": "pdf",
						"sButtonText": "<i class='fa fa-save'></i> PDF",
						"sPdfOrientation": "landscape",
						"sPdfSize": "tabloid",
						"mColumns": [1, 2, 3, 4]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4]
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
					"bSearchable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="manufacturer_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked"/> </div>';
								break;
							default:
								return '<div class="text-center"><input onchange="manufacturer_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox"/> </div>';
								break;
						}
					}
				},
				{
					"aTargets": [3],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'manufacturer/edit/' + full[0] + '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a></div>'
					}
				},
			],
		}).fnSetFilteringDelay(700);
	});
	function manufacturer_status(manufacturer_id) {
		$.post(base_url + 'manufacturer/change_status', {manufacturer_id: manufacturer_id, manufacturer_status: $("#id_" + manufacturer_id).is(':checked')}, function (data) {
			if (data === '1') {
				bootbox.alert('Status Updated Successfully', function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert('Error updating status.');
			} else {
				bootbox.alert(data);
			}
		});
	}

</script>