<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Social Media Job Shares </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Social Media Job Shares</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="job_share_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>Job ID</th>
							<th>Job Title</th>
							<th>Job Type</th>
							<th>Facebook Shares</th>
							<th>Twitter Shares</th>
							<th>Google Shares</th>
							<th>LinkedIn Shares</th>
							<th>Pinterest Shares</th>
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
		$('#job_share_datatable').dataTable({
			"aaSorting": [['0', 'asc']],
			"sAjaxSource": base_url + "metric/job_share_datatable/<?php echo $job_id; ?>",
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
						"mColumns": [1, 2, 3, 4, 5, 6]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1, 2, 3, 4, 5, 6]
					}]
			},
			"aoColumnDefs": [
				{
					"aTargets": [0],
					"bVisible": false,
					"bSearchable": false
				}, ]
		}).fnSetFilteringDelay(700);
	});
</script>