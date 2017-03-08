<style>
	.sale-interest-text{
		font-size:20px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">User Lists <small>listing of all lists</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add New List</button>

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User Lists</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="user_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
							<th>List Name</th>
							<th>View Users</th>
							<th>Delete</th>
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
		$('#user_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "user/list_datatable",
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
						"mColumns": [1]
					}, {"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				},
				{
					"aTargets": [2],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<a href="' + base_url + 'user/view_list/' + full[0] + '" class="btn btn-info">View Users</a>';
					}
				},
				{
					"aTargets": [3],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<button class="btn btn-danger" role="button" onclick="confirm_delete(' + full[0] + ');"><i class="fa fa-times"></i> Delete</button>';
					}
				}
			]
		}).fnSetFilteringDelay(700);
	});
	function confirm_delete(list_id) {
		bootbox.confirm('Are you sure to delete?', function (result) {
			if (result) {
				$.post(base_url + 'user/delete_list', {list_id: list_id}, function (data) {
					if (data === '1') {
						bootbox.alert("List Deleted Successfully.", function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert("Error Deleting List !!!");
					} else {
						bootbox.alert(data);
					}
				})
			}
		});
	}
	function list_status(list_id) {
		$.post(base_url + "user/change_list_status", {list_id: list_id, list_status: $("#id_" + list_id).is(":checked")}, function (data) {
			if (data === '1') {
				bootbox.alert("Status Changed Successfully");
			} else if (data === '0') {
				bootbox.alert("Error Updating Status !!!");
			} else {
				bootbox.alert(data);
			}
		});
	}
	function add_list() {
		$.post(base_url + 'user/add_list', $("#user_list_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("List added successfully.", function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert("Error!")
			} else {
				bootbox.alert(data);
			}
		});
	}
</script>