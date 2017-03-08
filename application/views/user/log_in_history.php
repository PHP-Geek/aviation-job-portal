<style>
	.login_filter{
		height:27px !important;
		padding:0px 0px !important;
		margin-top:5px !important;
	}
	#login_div{
		padding:10px;
	}
	.search_result_info{
		background-color: #fafafa;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Login History <small>listing of login history</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Login History</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="well search_result_info" id="login_div">
				<div class="row">
					<div class="col-md-6">
						<h4><label>Name</label> : <?php echo $user_array['user_first_name'] . ' ' . $user_array['user_last_name']; ?></h4> </div>
					<div class="col-md-6"><h4><label>Email </label>: <?php echo $user_array['user_email']; ?></h4>
					</div></div>
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-4"><h4><label>Filter Results By </label>:</h4></div>
							<div class="col-md-6">
								<select class="login_filter form-control" name="login_filter" id="login_filter" data-placeholder="Filter Results">
									<option value=""></option>
									<option value="1">Past Week</option>
									<option value="2">Past Month</option>
									<option value="3">Past Year</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<h4><label>Last Logged In</label> : <?php echo date('d M Y h:i a', strtotime($user_array['user_last_logged_in'])); ?></h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="text-center">
					<h4><label>Search Result For</label> : <?php
						switch ($filter_val) {
							case 1:
								echo 'Last Week';
								break;
							case 2:
								echo 'Last Month';
								break;
							case 3:
								echo 'Last Year';
								break;
							default :
								echo 'All';
						}
						?></h4>
				</div>
			</div>
			<hr>
            <div class="box-body table-responsive">
                <table id="user_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>User Name</th>
							<th>User Email</th>
							<th>IP</th>
							<th>User Agent</th>
							<th>Logged In Time</th>
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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
	$(function () {
		$('select').select2();
		$("#login_filter").on('change', function () {
			document.location.href = base_url + 'user/log_in_history/<?php echo $user_array['user_id']; ?>' + '/' + $("#login_filter").val();
		});
		$('#user_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "user/login_in_history_datatable/<?php echo $login_user_id; ?>/<?php echo $filter_val; ?>",
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
						"mColumns": [1, 2, 3, 4, 5, 6]
					}, {"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6]
					}]
			}, "fnDrawCallback": function (oSettings) {
				$(".table td").css({'min-width': '150px'});
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false, "bSearchable": false
				},
//				{
//					"aTargets": [13],
//					"bSearchable": false,
//					"mData": null,
//					"mRender": function (data, type, full) {
//						return '<div class="text-center"><a href="' + base_url + 'job/applied_jobs/' + full[0] + '" target="_blank">View</a></div>';
//					}
//				}
			]
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