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
        <h1 style="display:inline-block">Job Categories <small>listing of all job categories</small></h1>
		<a href="<?php echo base_url(); ?>aircraft/add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Job Category</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Job Categories</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="category_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Category Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Actions</th>
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
		$('#category_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "job/category_datatable",
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
					"aTargets": [2],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				},
				{
					"aTargets": [3],
					"bSearchable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="job_category_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked"/></div>';
								break;
							default:
								return '<div class="text-center"><input onchange="job_category_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox"/></div>';
								break;
						}
					}
				},
				{
					"aTargets": [4],
					"bSearchable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'job/edit_category/' + full[0] + '" class="btn btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a> <a href="#" class="btn btn-danger" onclick="job_category_delete(' + full[0] + ')"><i class="fa fa - times"></i> Delete</a></div>'
					}
				}
			],
			"fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true});
			},
		}).fnSetFilteringDelay(700);
	});
	function job_category_status(job_type_id) {
		$.post(base_url + 'job/category_status', {job_type_id: job_type_id, job_type_status: $("#id_" + job_type_id).is(':checked')}, function (data) {
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
	function job_category_delete(job_type_id) {
		bootbox.confirm("You are about to delete a Category. Are you sure", function (result) {
			if (result) {
				$.post(base_url + 'job/delete_category', {job_type_id: job_type_id}, function (data) {
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