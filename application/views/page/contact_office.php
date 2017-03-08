<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Offices</h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contact_office_modal"><i class="fa fa-plus-circle"></i> Add Office</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Offices</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="location_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Office Type</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Address</th>
							<th>Status</th>
							<th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="contact_office_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Office</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" id="add_office_form" class="form-group" role="form">
					<div class="form-group">
						<label for="contact_office_name">Office Type</label>
						<input type="text" class="form-control" name="contact_office_name" id="contact_office_name" placeholder="Office Type (e.g. - Head Office,Singapore Office)"/>
					</div>
					<div class="form-group">
						<label for="contact_office_phone">Phone</label>
						<input type="text" class="form-control" name="contact_office_phone" id="contact_office_phone" placeholder="+61-123456789"/>
					</div>
					<div class="form-group">
						<label for="contact_office_email">Email</label>
						<input type="text" class="form-control" name="contact_office_email" id="contact_office_email" placeholder="info@increw.com.au"/>
					</div>
					<div class="form-group">
						<label for="contact_office_name">Complete Address</label>
						<textarea class="form-control" name="contact_office_address" id="contact_office_address" placeholder="Complete Office Address with Zip Code"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" data-loading-text="Please wait..." id="add_office_button" onclick="add_contact_office();">Add Office</button>
			</div>
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
<script type="text/javascript">
					$(function () {
						$('#location_datatable').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "page/contact_office_datatable",
							"oLanguage": {
								"sEmptyTable": '<span class="text-info pull-left">No Data.</span>'
							},
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
									"bVisible": false,
									"bSearchable": false
								},
								{
									"aTargets": [5],
									"bSearchable": true,
									"mRender": function (data, type, full) {
										switch (data) {
											case '1':
												return '<div class="text-center"><input onchange="contact_office_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="contact_office_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}, {
									"aTargets": [6],
									"bSearchable": false,
									"bSortable": false,
									"mData": null,
									"mRender": function (data, type, full) {
										return '<div class="text-center"><a href="' + base_url + 'page/edit_contact_office/' + full[0] + '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a></div>'
									}
								}
							]
						}).fnSetFilteringDelay(700);
					});
					function contact_office_status(contact_office_id) {
						$.post(base_url + 'page/change_contact_office_status', {contact_office_id: contact_office_id, contact_office_status: $("#id_" + contact_office_id).is(':checked')}, function (data) {
							if (data === '1') {
								bootbox.alert('Status Changed Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error changing status');
							} else {
								bootbox.alert(data);
							}
						});
					}
					function add_contact_office() {
						$('#add_office_button').button('loading');
						$.post(base_url + 'page/add_contact_office', $("#add_office_form").serialize(), function (data) {
							if (data === '1') {
								bootbox.alert('Office Added Successfully', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Saving Data');
							} else {
								bootbox.alert(data);
							}
						$('#add_office_button').button('reset');
						});
					}

</script>