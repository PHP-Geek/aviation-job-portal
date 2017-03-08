<style>
	.sale-interest-text{
		font-size:20px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>List : <?php echo $list_array['list_name']; ?> <small>listing of all users</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?php echo base_url(); ?>user/lists">Lists</a></li>
            <li class="active"><?php echo $list_array['list_name']; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="well">
				<button role="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Send Email</button>
			</div>
            <div class="box-body table-responsive">
                <table id="user_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="smallwidth">ID</th>
                            <th class="medwidth">Name</th>
							<th class="medwidth">Location</th>
							<th class="medwidth">Category</th>
							<th class="largewidth">Aircraft Type Rating</th>
							<th class="medwidth">License Type</th>
							<th class="medwidth">Employee Role</th>
							<th class="medwidth">Year of Experience</th>
							<th class="medwidth">User Description</th>
							<th class="medwidth">Email</th>
                            <th class="medwidth">Contact</th>
							<th class="medwidth">Last Logged In</th>
							<th class="largewidth">Profile Completeness(%)</th>
							<th class="medwidth">View Profile</th>
                            <th class="smallwidth">Action</th>
							<th class="medwidth">View Applied Jobs</th>
							<th class="medwidth">Login History</th>
							<th class="medwidth">Remove From List</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form id="send_mail_form" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Send Email</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="list_id" id="list_id" value="<?php echo $list_array['list_id']; ?>"/>
						<label>Subject</label>
						<input type="text" class="form-control" id="view_list_email_subject" name="view_list_email_subject" placeholder="Subject"/>
					</div>
					<div class="form-group">
						<label>Message/Text</label>
						<textarea id="view_list_email_message" name="view_list_email_message" class="form-control" rows="4" placeholder="Message"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="view_list_email_button" data-loading-text="Please Wait..." onclick="send_email();">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
						$(function () {
							$('#user_datatable').dataTable({
								"aaSorting": [['0', 'asc']],
								"sAjaxSource": base_url + "user/view_list_datatable/<?php echo $list_array['list_id']; ?>",
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
										"bVisible": false,
										"bSearchable": false,
										"bSortable": false,
										"mRender": function (data, type, full) {
											return '<div><input type="checkbox" id="select_' + full[0] + '" name="select_' + full[0] + '"/></div>';
										}
									}, {
										"aTargets": [9],
										"bVisible": true,
										"mRender": function (data, type, full) {
											return '<a href="mailto:' + data + '">' + data + '</a>';
										}
									},
									{
										"aTargets": [13],
										"bSearchable": false,
										"mRender": function (data, type, full) {
											return '<div class="text-center"><a href="' + data + '" target="_blank"><i class="fa fa-user"></i> View</a></div>';
										}
									},
									{
										"aTargets": [14],
										"bSearchable": false,
										"bSortable": false,
										"mRender": function (data, type, full) {
											return '<div class="text-center"><a href="' + base_url + 'edit-profile/' + data + '" target="_blank"><i class="fa fa-pencil-square-o"></i> Edit</a></div>';
										}
									},
									{
										"aTargets": [15],
										"bSearchable": false,
										"bSortable": false,
										"mRender": function (data, type, full) {
											return '<div class="text-center"><a href="' + base_url + data + '" target="_blank">View</a></div>';
										}
									},
									{
										"aTargets": [16],
										"bSearchable": false,
										"bSortable": false,
										"mRender": function (data, type, full) {
											return '<div class="text-center"><a href="' + base_url + data + '" target="_blank">View</a></div>';
										}
									},
									{
										"aTargets": [17],
										"bSearchable": false,
										"bSortable": false,
										"mData": null,
										"mRender": function (data, type, full) {
											return '<div class="text-center"><button role="button" class="btn btn-danger btn-sm" onclick="confirm_delete(' + full[0] + ');">Remove</button></div>';
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

						function confirm_delete(user_list_id) {
							bootbox.confirm("Are you sure you want to proceed ?", function (result) {
								if (result) {
									$.post(base_url + 'user/remove_from_list', {user_list_id: user_list_id}, function (data) {
										if (data === '1') {
											bootbox.alert("Removed from list successfully.", function () {
												document.location.href = '';
											});
										} else {
											bootbox.alert(data);
										}
									});
								}
							});
						}

						function send_email() {
							$("#view_list_email_button").button("loading");
							$("#send_mail_form").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Sending...'});
							$.post(base_url + 'user/send_email_to_list_users', $("#send_mail_form").serialize(), function (data) {
								if (data === '1') {
									bootbox.alert('Email Sent Successfully.', function () {
										document.location.href = '';
									});
								} else if (data === '0') {
									bootbox.alert('Error Sending Email.');
								} else {
									bootbox.alert(data);
								}
								$("#view_list_email_button").button("reset");
								$("#send_mail_form").unblock();
							});
						}
</script>