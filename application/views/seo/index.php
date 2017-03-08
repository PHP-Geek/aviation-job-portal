<style type="text/css">
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .table-responsive > .table > thead > tr > th,
    .table-responsive > .table > tbody > tr > th,
    .table-responsive > .table > tfoot > tr > th,
    .table-responsive > .table > thead > tr > td,
    .table-responsive > .table > tbody > tr > td,
    .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
    .table-responsive > .table-bordered {
        border: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:first-child,
    .table-responsive > .table-bordered > tbody > tr > th:first-child,
    .table-responsive > .table-bordered > tfoot > tr > th:first-child,
    .table-responsive > .table-bordered > thead > tr > td:first-child,
    .table-responsive > .table-bordered > tbody > tr > td:first-child,
    .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
    }
    .table-responsive > .table-bordered > thead > tr > th:last-child,
    .table-responsive > .table-bordered > tbody > tr > th:last-child,
    .table-responsive > .table-bordered > tfoot > tr > th:last-child,
    .table-responsive > .table-bordered > thead > tr > td:last-child,
    .table-responsive > .table-bordered > tbody > tr > td:last-child,
    .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
    }
    .table-responsive > .table-bordered > tbody > tr:last-child > th,
    .table-responsive > .table-bordered > tfoot > tr:last-child > th,
    .table-responsive > .table-bordered > tbody > tr:last-child > td,
    .table-responsive > .table-bordered > tfoot > tr:last-child > td {
        border-bottom: 0;
    }
    .cursor_pointer{
        cursor : pointer;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">SEO <small>listing of all pages</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> SEO</a></li>
            <li class="active">SEO</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="event_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Page Title</th>
							<th>Page URL</th>
							<th>Keywords</th>
							<th>Description</th>
							<th>Modify</th>
                        </tr>
                    </thead>
                    <tbody>
					</tbody>
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
		$('#event_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "seo/datatable",
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
					"bVisible": false,
					"bSearchable": false
				},
				{
					"aTargets": [3],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				},
				{
					"aTargets": [4],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				},
				{
					"aTargets": [5],
					"bSearchable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'seo/edit/' + full[0] + '"><i class="fa fa-pencil-square-o"></i> Edit</a></div>'
					}
				}
			],
			"fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
			},
		}).fnSetFilteringDelay(700);
	});
	function event_status(event_id) {
		bootbox.confirm('Are You Sure to Change Status', function (result) {
			if (result) {
				$.post(base_url + 'event/change_status', {event_id: event_id, event_status: $("#id_" + event_id).is(':checked')}, function (data) {
					if (data === '1') {
						bootbox.alert("Status Changed Successfully.", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error Updating status");
					} else {
						bootbox.alert(data);
					}
				});
			}
			document.location.href = '';
		});
	}
	function event_delete(event_id) {
		bootbox.confirm("Event will be deleted parmanently. Are you sure?", function (result) {
			if (result) {
				$.post(base_url + 'event/delete', {event_id: event_id}, function (data) {
					if (data === '1') {
						bootbox.alert("Deleted Successfully.", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error Deleting Record");
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}
</script>