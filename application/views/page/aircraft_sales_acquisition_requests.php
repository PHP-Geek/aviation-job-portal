<div class="content-wrapper">
    <section class="content-header">
        <h1>Aircraft Sales & Acquisition Requests<small>listing of all sales & acquisition requests</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Sales & Acquisition Requests</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="contact_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
							<th>Request Date</th>
							<th>Action</th>
							<th>Delete</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript">
	$('.select2_contact_us').select2();
	$(function () {
		$('#contact_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "page/aircraft_sales_acquisition_datatable",
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
					"bVisible": true,
					"bSearchable": false
				},
				{
					"aTargets": [4],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				},
				{
					"aTargets": [2],
					"bSearchable": true,
					"bSortable": true,
					"mRender": function (data, type, full) {
						return '<a href="mailto:' + data + '">' + data + '</a>';
					}
				}, {
					"aTargets": [2],
					"bSearchable": true,
					"bSortable": false,
				},
				{
					"aTargets": [6],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><select class="select2_contact_us" id="contact_us_feed_status_' + full[0] + '" onchange="change_contact_feed_status(' + full[0] + ')"><option value="0">Not Contacted</option><option value="1" selected="selected">Contacted</option><option value="2">Ignore</option></select></div>';
								break;
							case '2':
								return '<div class="text-center"><select class="select2_contact_us" id="contact_us_feed_status_' + full[0] + '" onchange="change_contact_feed_status(' + full[0] + ')"><option value="0">Not Contacted</option><option value="1">Ignore</option><option value="2" selected="selected">Ignore</option></select></div>';
								break;
							default:
								return '<div class="text-center"><select class="select2_contact_us" id="contact_us_feed_status_' + full[0] + '" onchange="change_contact_feed_status(' + full[0] + ')"><option value="0" selected="selected">Not Contacted</option><option value="1">Contacted</option><option value="2">Ignore</option></select></div>';
						}
					}
				}, {
					"aTargets": [7],
					"bSearchable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<a href="javascript:;" onclick="confirm_delete(' + full[0] + ');" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</a>';
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
			},
		}).fnSetFilteringDelay(700);
	});
	function confirm_delete(contact_feed_id) {
		bootbox.confirm('Are you sure to delete contact feed ?', function (result) {
			if (result) {
				$.post(base_url + 'page/delete_contact_feed', {contact_us_feed_id: contact_feed_id}, function (data) {
					if (data === '1') {
						bootbox.alert('Contact feed deleted successfully.', function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert('Error deleting contact feed');
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}
	function change_contact_feed_status(contact_us_feed_id) {
		$.post(base_url + 'page/change_contact_feed_status', {contact_us_feed_id: contact_us_feed_id, contact_us_feed_status: $('#contact_us_feed_status_' + contact_us_feed_id).val()}, function (data) {
			if (data === '1') {
				bootbox.alert('Status changed successfully.');
			} else if (data === '0') {
				bootbox.alert('Error changing status');
			} else {
				bootbox.alert(data);
			}
		});
	}
</script>
