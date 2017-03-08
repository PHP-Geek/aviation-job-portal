<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Email Contact List<small>listing InCrew emails</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Email Contact List</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="location_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>Email</th>
							<th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						foreach ($aircraft_sales_interest_email as $emails) {
							if ($emails !== 'info@increw.com.au') {
								?>
								<tr>
									<td><?php echo $emails; ?></td>
									<td>Aircraft Sales Interest</td>
								</tr>
								<?php
							}
						}
						foreach ($aircraft_quote_email as $emails) {
							if ($emails !== 'info@increw.com.au') {
								?>
								<tr>
									<td><?php echo $emails; ?></td>
									<td>Aircraft Quote</td>
								</tr>
								<?php
							}
						}
						foreach ($crew_support_email as $emails) {
							if ($emails !== 'info@increw.com.au') {
								?>
								<tr>
									<td><?php echo $emails; ?></td>
									<td>Crew Support</td>
								</tr>
								<?php
							}
						}
						foreach ($invitation_email_recipient as $emails) {
							if ($emails !== 'info@increw.com.au') {
								?>
								<tr>
									<td><?php echo $emails; ?></td>
									<td>Invitation Recipient</td>
								</tr>
								<?php
							}
						}
						foreach ($contact_us_feed_email as $emails) {
							if ($emails !== 'info@increw.com.au') {
								?>
								<tr>
									<td><?php echo $emails; ?></td>
									<td>Contact Us Feeds</td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>-->



<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.9.4/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.9.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.delay.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datatables/DT_custom.js"></script>-->
<script type="text/javascript">
	$(function () {
		$('#location_datatable').dataTable({
			"aaSorting": [['0', 'asc'], ['1', 'asc']],
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
						"mColumns": [1]
					}, {
						"sExtends": "csv",
						"sButtonText": "<i class='fa fa-save'></i> CSV",
						"mColumns": [1]
					}]
			}, });
	});
</script>
