<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Home Page Testimonials</h1>
		<a href="<?php echo base_url(); ?>page/add_home_page_testimonial" class="btn btn-primary btn-md">
			<i class="fa fa-plus-circle"></i> Add Testimonial
		</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">About Increw Posts</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="location_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Content</th>
							<th>Person</th>
							<th>Image</th>
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
		$('#location_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "page/home_page_testimonial_datatable",
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
					"aTargets": [1],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="' + data + '" data-trigger="hover">' + data.substring(0, 50) + '</a>';
					}
				},
				{
					"aTargets": [3],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						return '<a href="' + data + '" target=_blank"><img src="' + data + '" style="max-width:120px;max-height:120px"/></a>';
					}
				},
				{
					"aTargets": [4],
					"bSearchable": true,
					"mRender": function (data, type, full) {
						switch (data) {
							case '1':
								return '<div class="text-center"><input onchange="home_page_testimonial_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
								break;
							default:
								return '<div class="text-center"><input onchange="home_page_testimonial_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
								break;
						}
					}
				}, {
					"aTargets": [5],
					"bSearchable": false,
					"bSortable": false,
					"mData": null,
					"mRender": function (data, type, full) {
						return '<div class="text-center"><a href="' + base_url + 'page/edit_home_page_testimonial/' + full[0] + '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a></div>'
					}
				}
			], "fnDrawCallback": function (oSettings) {
				$(".popover_link").popover({html: true, placement: 'auto right'});
			},
		}).fnSetFilteringDelay(700);
	});
	function home_page_testimonial_status(home_page_testimonial_id) {
		$.post(base_url + 'page/change_home_page_testimonial_status', {home_page_testimonial_id: home_page_testimonial_id, home_page_testimonial_status: $("#id_" + home_page_testimonial_id).is(':checked')}, function (data) {
			if (data === '1') {
				bootbox.alert('Status Changed Successfully.');
			} else if (data === '0') {
				bootbox.alert('Error changing status');
			} else {
				bootbox.alert(data);
			}
		});
	}

</script>