<style>
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
	.smallwidth{
		width:90px;
	}
	.medwidth{
		width:150px;
	}
	.largewidth{
		width:500px;
	}
	.table td,th{
		text-align:center;
	}
	.hidden_table_col{
		display:none;
	}
	.table-drag{
		opacity: 0.6;
		color:white;
		background-color:blue;
		cursor: crosshair;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Popup Ads <small>listing of all Popup Ads</small></h1>
		<a href="<?php echo base_url(); ?>advertisement/add_popup_ad" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Add Popup Ads</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Popup Ads</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="box-body table-responsive">
				<form method="post" id="advertisement_form">
					<table id="popup_ad_table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Ad Label</th>
								<th>Ad Link</th>
								<th>Ad Image</th>
								<th>No. of Clicks</th>
								<th>Status</th>
								<th>Manage Page</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</form>
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
		$('#popup_ad_table').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "advertisement/popup_datatable",
			"oLanguage": {
				"sEmptyTable": '<span class="text-info pull-left sale-interest-text">No Data.</span>'
			},
			"oTableTools": {
				"sSwfPath": base_url + "assets/js/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
				"aButtons": [{
						"sExtends": "pdf",
						"sButtonText": "<i class='fa fa-save'></i> PDF",
						"sPdfOrientation": "landscape",
						"sPdfSize": "tabloid",
						"mColumns": [1, 2, 3]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3]
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
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + data + '" target="_blank"><img src="' + data + '" class="img-responsive center-block" style="max-width:80px;max-height:80px" alt="Popup Ad"/></a>';
					}
				},
				{
					"aTargets": [5],
					"bSearchable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="popup_ad_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked"/></div>';
								break;
							default:
								return '<div class="text-center"><input onchange="popup_ad_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox"/></div>';
								break;
						}
					}
				},
				{
					"aTargets": [6],
					"bSearchable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'advertisement/manage_url/' + full[0] + '" class="btn btn-info"><i class="fa fa-arrows"></i> Manage URLs</a></div>';
					}
				},
				{
					"aTargets": [7],
					"bSearchable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<a href="' + base_url + 'advertisement/edit_popup_ad/' + full[0] + '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a> <button type="button" class="btn btn-danger btn-sm" onclick="confirm_delete(' + full[0] + ')"><i class="fa fa-times"></i> Delete</button>';
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
			},
		}).fnSetFilteringDelay(700);
	});
	function popup_ad_status(popup_ad_id) {
		$.post(base_url + 'advertisement/change_popup_ad_status', {popup_ad_id: popup_ad_id, popup_ad_status: $("#id_" + popup_ad_id).is(':checked')}, function (data) {
			if (data === '1') {
				bootbox.alert('Status Updated Successfully');
			} else if (data === '0') {
				bootbox.alert('Error updating status.');
			} else {
				bootbox.alert(data);
			}
		});
	}

	function confirm_delete(popup_ad_id) {
		bootbox.confirm('Are you sure to delete Ad ?', function (result) {
			if (result) {
				$.post(base_url + 'advertisement/delete_popup_ad', {popup_ad_id: popup_ad_id}, function (data) {
					if (data === '1') {
						bootbox.alert('Popup Ad Deleted Successfully.', function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert('Error Deleting Ad');
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}

</script>
