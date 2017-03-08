<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Approval Rating <small>listing of all approval ratings</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#approval_rating_modal"><i class="fa fa-plus-circle"></i> Add Approval Rating</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Approval Rating</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="approval_rating_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Approval Rating Name</th>
							<th>Approval Rating Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="approval_rating_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Approval Rating</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" id="approval_rating_form" role="form">
					<div class="form-group">
						<label for="type_rating_name">Approval Rating Name</label>
						<input type="text" class="form-control" name="approval_rating_name" id="approval_rating_name" placeholder="Approval Rating Name"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" id="add_approval_rating_button" data-loading-text="Please wait..." onclick="add_approval_rating();">Add Approval Rating <i class="fa fa-angle-right"></i></button>
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
						$('#approval_rating_table').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/approval_rating_datatable",
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
										switch (data) {
											case '1':
												return '<div class="text-center"><input onchange="approval_rating_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="approval_rating_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function approval_rating_status(approval_rating_id){
						$.post(base_url + 'configuration/approval_rating_status',{approval_rating_id:approval_rating_id,approval_rating_status: $("#id_" + approval_rating_id).is(':checked')},
							function(data){
								if (data === '1') {
								bootbox.alert("Status Changed Successfully", function () {
									document.location.href = '';
								});
								} else if (data === '0') {
									bootbox.alert("Error Updating User Status !!!");
								} else {
									bootbox.alert(data);
							}
						});
					}
					function add_approval_rating() {
						$('#add_approval_rating_button').button('loading');
						$.post(base_url + 'configuration/add_approval_rating', $("#approval_rating_form").serialize(), function (data) {
							if (data === '1') {
								bootbox.alert('Approval Rating Added Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding Approval Rating');
							} else {
								bootbox.alert(data);
							}
							$('#add_approval_rating_button').button('reset');
						});
					}						
</script>
