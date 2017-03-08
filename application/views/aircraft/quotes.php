<div class="content-wrapper">
    <section class="content-header">
        <h1>Aircraft Quotes <small>listing of all aircraft quotes</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Quotes</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="quote_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="smallwidth">ID</th>
							<th class="medwidth">Company Name</th>
							<th class="medwidth">Name</th>
							<th class="smallwidth">Email</th>
							<th class="smallwidth">Phone</th>
							<th class="smallwidth">Passengers</th>
							<th class="medwidth">Departure City</th>
							<th class="medwidth">Arrival City</th>
							<th class="medwidth">Departure Date</th>
							<th class="medwidth">Return Date</th>
							<th class="medwidth">Cargo Size</th>
							<th class="medwidth">Cargo Weight</th>
							<th class="medwidth">Dangerous Goods</th>
							<th class="medwidth">Aircraft</th>
							<th class="medwidth">Aircraft Type</th>
							<th class="medwidth">Charter Type</th>
							<th class="largewidth">Additional Requirements</th>
							<th class="medwidth">Received on</th>
							<th class="medwidth">Notes</th>
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
			"sAjaxSource": base_url + "aircraft/quote_datatable",
			"oTableTools": {
				"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
				"aButtons": [{
						"sExtends": "pdf",
						"sButtonText": "<i class='fa fa-save'></i> PDF",
						"sPdfOrientation": "landscape",
						"sPdfSize": "tabloid",
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				}, {
					"aTargets": [12],
					"bSearchable": true,
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				}, {
					"aTargets": [16],
					"bSearchable": true,
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				}, {
					"aTargets": [18],
					"bSearchable": true,
					"bSortable": true,
					"mRender": function (data, type, full) {
					switch (data) {
					case '1':
								return '<div class="form-group"><select id="quote_status_' + full[0] + '" class="form-control input-sm" onchange="quote_status(' + full[0] + ')"><option value="1"selected="selected">Open</option><option value="2">Follow Up</option><option value="3">Sold</option><option value="4">Closed</option></select></div>';
								break;
							case '2':
								return '<div class="form-group"><select id="quote_status_' + full[0] + '" class="form-control input-sm" onchange="quote_status(' + full[0] + ')"><option value="1">Open</option><option value="2" selected="selected">Follow Up</option><option value="3">Sold</option><option value="4">Closed</option></select></div>';
								break;
							case '3':
								return '<div class="form-group"><select id="quote_status_' + full[0] + '" class="form-control input-sm" onchange="quote_status(' + full[0] + ')"><option value="1">Open</option><option value="2">Follow Up</option><option value="3" selected="selected">Sold</option><option value="4">Closed</option></select></div>';
								break;
							case '4':
								return '<div class="form-group"><select id="quote_status_' + full[0] + '" class="form-control input-sm" onchange="quote_status(' + full[0] + ')"><option value="1">Open</option><option value="2">Follow Up</option><option value="3">Sold</option><option value="4" selected="selected">Closed</option></select></div>';
								break;
							default:
								return '<div class="form-group"><select id="quote_status_' + full[0] + '" class="form-control input-sm" onchange="quote_status(' + full[0] + ')"><option value="1"selected="selected">Open</option><option value="2">Follow Up</option><option value="3">Sold</option><option value="4">Closed</option></select></div>';
						}
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({placement: 'auto right'}); 				$("#quote_datatable tr th.largewidth").css({'min-width': '200px'});
				$("#quote_datatable tr th.smallwidth").css({'min-width': '85px'}); 				$("#quote_datatable tr th.medwidth").css({'min-width': '130px'});
		}
				}).fnSetFilteringDelay(700);
	});
	function quote_status(quote_id) {
	bootbox.confirm('Save Note?', function (result) {
			if (result) {
				$.post(base_url + 'aircraft/change_quote_status', {quote_id: quote_id, quote_status: $("#quote_status_" + quote_id).val()}, function (data) {
					if (data === '1') { 						bootbox.alert('Note Save Successfully', function () {
						document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert('Error Saving Note');
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}
</script>