<style>
	.sale-interest-text{
		font-size:20px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Aircraft Crew Requests <small>listing of all crew requests</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Crew Requests</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="crew_request_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="smallwidth">ID</th>
                            <th class="smallwidth">Job Type</th>
                            <th class="smallwidth">Duration</th>
                            <th class="medwidth">Start Date</th>
							<th class="largewidth">Completion Date</th>
                            <th class="medwidth">Location</th>
                            <th class="medwidth">License</th>
                            <th class="medwidth">Company</th>
                            <th class="medwidth">Name</th>
                            <th class="medwidth">Contact</th>
                            <th class="medwidth">Email</th>
							<th class="medwidth">Notes</th>
							<th class="medwidth">Modified On</th>
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
		$('#crew_request_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "page/crew_history_datatable/<?php echo $crew_support_id; ?>",
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
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				}, {
					"aTargets": [11],
					"bSearchable": true,
					"bSortable": true,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return 'Open';
								break;
							case '2':
								return 'Follow Up';
								break;
							case '3':
								return 'Sold';
								break;
							case '4':
								return 'Closed';
								break;
							default:
								return '';
						}
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$("#crew_request_datatable tr th.largewidth").css({'min-width': '140px'});
				$("#crew_request_datatable tr th.smallwidth").css({'min-width': '90px'});
				$("#crew_request_datatable tr th.medwidth").css({'min-width': '110px'});
			}
		}).fnSetFilteringDelay(700);
	});
	function crew_request_status(crew_support_id) {
		bootbox.confirm('Save Note?', function (result) {
			if (result) {
				$.post(base_url + 'page/change_crew_status', {crew_support_id: crew_support_id, crew_support_status: $("#crew_status_" + crew_support_id).val()}, function (data) {
					if (data === '1') {
						bootbox.alert('Note Saved Successfully.', function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert('Error Saving Notes');
					} else {
						bootbox.alert(data);
					}
				});
				//document.location.href = '';
			}
		});
	}
</script>
