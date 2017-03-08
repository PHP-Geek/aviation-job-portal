<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Page Blue Box</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Page Blue Box</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="location_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Page</th>
							<th>Title</th>
							<th>Content</th>
							<th>Button Text</th>
							<th>Button Link</th>
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
		$('#location_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "page/page_blue_box_datatable",
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
				}, {
					"aTargets": [3],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				},
				{
					"aTargets": [6],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'page/edit_page_blue_box/' + full[0] + '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a></div>'
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
			},
		}).fnSetFilteringDelay(700);
	});
</script>