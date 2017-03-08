<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Management Experience <small>listing of all management experiences</small></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#management_experience_modal"><i class="fa fa-plus-circle"></i> Add Management Experience</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Management Experience</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="management_experience_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>ID</th>
							<th>Management Experience Name</th>
							<th>Management Experience Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="management_experience_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Management Experience</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" class="form-group" id="management_experience_form" role="form">
					<div class="form-group">
						<label for="type_rating_name">Management Experience Name</label>
						<input type="text" class="form-control" name="management_experience_name" id="management_experience_name" placeholder="Management Experience Name"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" id="add_management_experience_button" data-loading-text="Please wait..." onclick="add_management_experience();">Add Management Experience <i class="fa fa-angle-right"></i></button>
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
						$('#management_experience_table').dataTable({
							"aaSorting": [['0', 'asc']],
							"sAjaxSource": base_url + "configuration/management_experience_datatable",
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
												return '<div class="text-center"><input onchange="management_experience_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" checked="checked" /></div>';
												break;
											default:
												return '<div class="text-center"><input onchange="management_experience_status(' + full[0] + ')" id="id_' + full[0] + '" type="checkbox" /></div>';
												break;
										}
									}
								}
							],
						}).fnSetFilteringDelay(700);
					});
					function management_experience_status(management_experience_id){
						$.post(base_url + 'configuration/management_experience_status',{management_experience_id:management_experience_id,management_experience_status: $("#id_" + management_experience_id).is(':checked')},
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
					function add_management_experience() {
						$('#add_management_experience_button').button('loading');
						$.post(base_url + 'configuration/add_management_experience', $("#management_experience_form").serialize(), function (data) {
							if (data === '1') {
								bootbox.alert('Management Experience Added Successfully.', function () {
									document.location.href = '';
								});
							} else if (data === '0') {
								bootbox.alert('Error Adding Management Experience');
							} else {
								bootbox.alert(data);
							}
							$('#add_management_experience_button').button('reset');
						});
					}						
</script>