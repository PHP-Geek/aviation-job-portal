<style>
	.sale-interest-text{
		font-size:20px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Employers <small>listing of all employers</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Employers</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="text-center">
				<h4>Current Active Users : <span class="text-info"><?php echo $active_user_count; ?></span></h4>
			</div>
			<hr/>
            <div class="box-body table-responsive">
                <table id="user_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="medwidth">Business Name</th>
                            <th class="medwidth">Category</th>
                            <th class="smallwidth">Skype</th>
							<th class="medwidth">Website</th>
                            <th class="medwidth">Location</th>
                            <th class="medwidth">Contact Person</th>
                            <th class="medwidth">Email</th>
                            <th class="largewidth">Contact Number</th>
							<th class="smallwidth">Status</th>
							<th class="largewidth">Joining Date</th>
                            <th class="largewidth">Last Logged In</th>
                            <th class="smallwidth">Profile</th>
							<th class="smallwidth">Edit Profile</th>
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
			"sAjaxSource": base_url + "user/general_aviation_datatable",
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
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8]
					}, {"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6, 7, 8]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				},
				{
					"aTargets": [4],
					"bVisible": true,
					"mRender": function (data, type, full) {
						return '<div><a href="' + data + '">' + data + '</a></div>';
					}
				},
				{
					"aTargets": [7],
					"bVisible": true,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="mailto:' + data + '">' + data + '</a></div>';
					}
				},
				{
					"aTargets": [10],
					"bSortable": false
				},
				{
					"aTargets": [11],
					"bSortable": false
				},
				{
					"aTargets": [9],
					"bSearchable": false,
					"bSortable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="user_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /> </div>';
								break;
							default:
								return '<div class="text-center"><input onchange="user_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /> </div>';
								break;
						}
					}
				},
				{
					"aTargets": [12],
					"bSearchable": false,
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'user/employer_profile/' + data + '" target="_blank"><i class="fa fa-user"></i> View</a></div>';
					}
				},
				{
					"aTargets": [13],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'user/employer_edit_profile/' + full[0] + '" target="_blank"><i class="fa fa-pencil-square-o"></i> Edit</a></div>';
					}
				}
			],
			"fnDrawCallback": function (oSettings) {
				$("#user_datatable tr th.largewidth").css({'min-width': '200px'});
				$("#user_datatable tr th.smallwidth").css({'min-width': '85px'});
				$("#user_datatable tr th.medwidth").css({'min-width': '130px'});
			},
		}).fnSetFilteringDelay(700);
	});
	function user_status(user_id) {
		$.post(base_url + "user/change_status", {user_id: user_id, user_status: $("#id_" + user_id).is(":checked")}, function (data) {
			if (data === '1') {
				bootbox.alert("User Status Changed Successfully");
			} else if (data === '0') {
				bootbox.alert("Error Updating User Status !!!");
			} else {
				bootbox.alert(data);
			}
		});
	}
	function confirm_delete(users_id) {
		bootbox.confirm("Are you sure you want to proceed ?", function (result) {
			if (result) {
				$.post(base_url + 'user/delete', {users_id: users_id}, function (data) {
					if (data === '1') {
						document.location.href = '';
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}
</script>