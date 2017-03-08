<style>
	.sale-interest-text{
		font-size:20px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Aircraft Sales Interests <small>listing of all interested users</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Sales Interests</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="sales_interest_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aircraft</th>
                            <th>Name</th>
							<th>Email</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Subject</th>
                            <th>Message</th>
							<th>Received on</th>
							<th>Notes</th>
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
		$('#sales_interest_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "aircraft/sales_interest_datatable/<?php echo $aircraft_id; ?>",
			"oLanguage": {
				"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Data</span>'
			},
			"oTableTools": {
				"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
				"aButtons": [{
						"sExtends": "pdf",
						"sButtonText": "<i class='fa fa-save'></i> PDF",
						"sPdfOrientation": "landscape",
						"sPdfSize": "tabloid",
						"mColumns": [1, 2, 3, 4, 5, 6]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				}, {
					"aTargets": [7],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				}, {
					"aTargets": [9],
					"bSearchable": true,
					"bSortable": true,
					"mRender": function (data, type, full) {
					switch (data) {
					case '1':
								return '<div class="form-group"><select id="aircraft_sales_interest_status_' + full[0] + '" class="form-control input-sm" onchange="aircraft_sales_interest_status(' + full[0] + ')"><option value="1"selected="selected">Open</option><option value="2">Follow Up</option><option value="3">Sold</option><option value="4">Closed</option></select></div>';
								break;
							case '2':
								return '<div class="form-group"><select id="aircraft_sales_interest_status_' + full[0] + '" class="form-control input-sm" onchange="aircraft_sales_interest_status(' + full[0] + ')"><option value="1">Open</option><option value="2" selected="selected">Follow Up</option><option value="3">Sold</option><option value="4">Closed</option></select></div>';
								break;
							case '3':
								return '<div class="form-group"><select id="aircraft_sales_interest_status_' + full[0] + '" class="form-control input-sm" onchange="aircraft_sales_interest_status(' + full[0] + ')"><option value="1">Open</option><option value="2">Follow Up</option><option value="3" selected="selected">Sold</option><option value="4">Closed</option></select></div>';
								break;
							case '4':
								return '<div class="form-group"><select id="aircraft_sales_interest_status_' + full[0] + '" class="form-control input-sm" onchange="aircraft_sales_interest_status(' + full[0] + ')"><option value="1">Open</option><option value="2">Follow Up</option><option value="3">Sold</option><option value="4" selected="selected">Closed</option></select></div>';
								break;
							default:
								return '<div class="form-group"><select id="aircraft_sales_interest_status_' + full[0] + '" class="form-control input-sm" onchange="aircraft_sales_interest_status(' + full[0] + ')"><option value="1"selected="selected">Open</option><option value="2">Follow Up</option><option value="3">Sold</option><option value="4">Closed</option></select></div>';
						}
					}
				}
			], "fnDrawCallback": function (oSettings) {
			$(".popover_link").popover({html: true, placement: 'auto right'});
			},
				}).fnSetFilteringDelay(700);
	});
		function aircraft_sales_interest_status(aircraft_sales_interest_id) {
	bootbox.confirm('Save Note ?', function (result) {
			if (result) {
				$.post(base_url + 'aircraft/change_sales_interest_status', {aircraft_sales_interest_id: aircraft_sales_interest_id, aircraft_sales_interest_status: $("#aircraft_sales_interest_status_" + aircraft_sales_interest_id).val()}, function (data) {
					if (data === '1') {
					bootbox.alert("Note Saved Successfully", function () {
						document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error Saving Note.");
						} else { 				 	bootbox.alert(data);
					}
				});
			}
		});
	}
</script>