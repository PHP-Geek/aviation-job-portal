<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Companies <small>listing of all companies</small></h1>
		<a href="<?php echo base_url(); ?>company/add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Company</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Companies</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="quote_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Company Name</th>
							<th>Description</th>
							<th>Company Logo</th>
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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>
<script type="text/javascript">
	$(function () {
		$('#quote_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "company/datatable",
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
					"bSortable": false,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + data + '" target="_blank"><img src="' + data + '" class="img-responsive center-block" style="max-width:80px;max-height:80px" alt="Company Logo"/></a>';
					}
				},
				{
					"aTargets": [4],
					"bSearchable": false,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="company_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked"/></div>';
								break;
							default:
								return '<div class="text-center"><input onchange="company_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox"/></div>';
								break;
						}
					}
				},
				{
					"aTargets": [5],
					"bSearchable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'company/edit/' + full[0] + '" class="btn btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a></div>';
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
			},
		}).fnSetFilteringDelay(700);
	});
	function company_status(company_id) {
		$.post(base_url + 'company/change_status', {company_id: company_id, company_status: $("#id_" + company_id).is(':checked')}, function (data) {
			if (data === '1') {
				bootbox.alert('Status Updated Successfully', function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert('Error updating status.');
			} else {
				bootbox.alert(data);
			}
		});
	}

</script>