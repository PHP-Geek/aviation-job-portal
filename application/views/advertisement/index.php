<style>
	.table-responsive {
		width: 100%;
		margin-bottom: 15px;
		overflow-y: hidden;
		-ms-overflow-style: -ms-autohiding-scrollbar;
		border: 1px solid #ddd;
	}
	.table-responsive > .table {
		margin-bottom: 0;
	}
	.table-responsive > .table > thead > tr > th,
	.table-responsive > .table > tbody > tr > th,
	.table-responsive > .table > tfoot > tr > th,
	.table-responsive > .table > thead > tr > td,
	.table-responsive > .table > tbody > tr > td,
	.table-responsive > .table > tfoot > tr > td {
		white-space: nowrap;
	}
	.table-responsive > .table-bordered {
		border: 0;
	}
	.table-responsive > .table-bordered > thead > tr > th:first-child,
	.table-responsive > .table-bordered > tbody > tr > th:first-child,
	.table-responsive > .table-bordered > tfoot > tr > th:first-child,
	.table-responsive > .table-bordered > thead > tr > td:first-child,
	.table-responsive > .table-bordered > tbody > tr > td:first-child,
	.table-responsive > .table-bordered > tfoot > tr > td:first-child {
		border-left: 0;
	}
	.table-responsive > .table-bordered > thead > tr > th:last-child,
	.table-responsive > .table-bordered > tbody > tr > th:last-child,
	.table-responsive > .table-bordered > tfoot > tr > th:last-child,
	.table-responsive > .table-bordered > thead > tr > td:last-child,
	.table-responsive > .table-bordered > tbody > tr > td:last-child,
	.table-responsive > .table-bordered > tfoot > tr > td:last-child {
		border-right: 0;
	}
	.table-responsive > .table-bordered > tbody > tr:last-child > th,
	.table-responsive > .table-bordered > tfoot > tr:last-child > th,
	.table-responsive > .table-bordered > tbody > tr:last-child > td,
	.table-responsive > .table-bordered > tfoot > tr:last-child > td {
		border-bottom: 0;
	}
	.smallwidth{
		width:90px;
	}
	.medwidth{
		width:150px;
	}
	.largewidth{
		width:500px;
	}
	.table td,th{
		text-align:center;
	}
	.hidden_table_col{
		display:none;
	}
	.table-drag{
		opacity: 0.6;
		color:white;
		background-color:blue;
		cursor: crosshair;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Advertisements <small>listing of all advertisements on website</small></h1>
		<a href="<?php echo base_url(); ?>advertisement/add" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Add Advertisement</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Advertisements</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="text-center"><h4>
					<?php if (isset($configuration_array['configuration_value']) && $configuration_array['configuration_value'] === '1') { ?>
						Advertisement Status : <input type="checkbox" name="configuration_id" id="configuration_id" checked="checked" onchange="advertisement_status()"/> ON (Uncheck to turn off advertisements)
					<?php } else { ?>
						Advertisement Status : <input type="checkbox" name="configuration_id" id="configuration_id" onchange="advertisement_status()"/> OFF (check to turn on advertisements)
					<?php } ?>
				</h4>
			</div><hr/>
			<div>
				<h4 class="text-info"> <i class="fa fa-info-circle"></i> Advertisements are shown in the following order. To change the order please drag and drop row.</h4></div><br/>
			<div class="box-body table-responsive">
				<form method="post" id="advertisement_form">
					<table id="advertisement_table" class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Advertisement Image</th>
								<th>Link</th>
								<th>Status</th>
								<th>Action</th>
								<th class="hidden_table_col">ID</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (count($advertisement_array) > 0) {
								foreach ($advertisement_array as $advertisement) {
									?>
									<tr id="advertisement_<?php echo $advertisement['advertisement_id']; ?>">
										<td><?php echo $advertisement['advertisement_name']; ?></td>
										<td><img src="<?php echo base_url() . 'uploads/advertisements/' . date('Y/m/d/H/i/s/', strtotime($advertisement['advertisement_created'])) . $advertisement['advertisement_image']; ?>" class="img-responsive center-block" style="max-width:400px"/></td>
										<td><a href="<?php echo $advertisement['advertisement_link']; ?>"><?php echo $advertisement['advertisement_link']; ?></a></td>
										<td><?php
											switch ($advertisement['advertisement_status']) {
												case '1':
													?>
													<input type="checkbox" id="id_<?php echo $advertisement['advertisement_id']; ?>" checked="checked" onclick="change_advertisement_status(<?php echo $advertisement['advertisement_id']; ?>);"/>
													<?php
													break;
												default:
													?>
													<input type="checkbox" id="id_<?php echo $advertisement['advertisement_id']; ?>" onclick="change_advertisement_status(<?php echo $advertisement['advertisement_id']; ?>);"/>
											<?php } ?></td>
										<td><a href="<?php echo base_url(); ?>advertisement/edit/<?php echo $advertisement['advertisement_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
											<a href="javascript:;" class="btn btn-danger btn-sm" onclick="delete_advertisement(<?php echo $advertisement['advertisement_id']; ?>);"><i class="fa fa-times"></i> Delete</a></td>
										<td class="hidden_table_col"><input type="hidden" name="advertisement_id[]" id="advertisement_id" value="<?php echo $advertisement['advertisement_id']; ?>"/></td>
									</tr>
									<?php
								}
							} else {
								echo '<tr><td colspan="6"><h4 class="text-info">No Data.</h4></td></tr>';
							}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</section>
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.tablednd.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
												$(document).ready(function () {
													$("#advertisement_table").tableDnD({
														onDragClass: "table-drag",
														onDrop: function (table, row) {
															$("#advertisement_form").block();
															$.post('', $("#advertisement_form").serialize(), function (data) {
																console.log(data);
																$("#advertisement_form").unblock();
															});
														}
													});
												});
												function change_advertisement_status(advertisement_id) {
													$.post(base_url + 'advertisement/change_status', {advertisement_id: advertisement_id, advertisement_status: $("#id_" + advertisement_id).is(':checked')}, function (data) {
														if (data === '1') {
															bootbox.alert('Status Changed Successfully.');
														} else if (data === '0') {
															bootbox.alert('Error Changing Status');
														} else {
															bootbox.alert(data);
														}
													});
												}

												function advertisement_status() {
													$(".box").block("Please wait...");
													var conf_value = $("#configuration_id").is(':checked') ? '1' : '0';
													$.post(base_url + 'configuration/change_configuration', {configuration_id: '6', configuration_value: conf_value}, function (data) {
														if (data === '1') {
															if (conf_value === '1') {
																bootbox.alert("Advertisement will now be shown on website.", function () {
																	document.location.href = '';
																});
															} else {
																bootbox.alert("Advertisement will not be shown in website now.", function () {
																	document.location.href = '';
																});
															}
														} else {
															bootbox.alert("Error updating data");
														}
														$(".box").unblock();
													});
												}

												function delete_advertisement(advertisement_id) {
													bootbox.confirm("Are you sure to want  to delete.?", function (result) {
														if (result) {
															$.post(base_url + 'advertisement/delete', {advertisement_id: advertisement_id}, function (data) {
																if (data === '1') {
																	bootbox.alert("Advertisement Deleted Successfully", function () {
																		document.location.href = '';
																	});
																} else {
																	bootbox.alert("Error Deleting Advertisement");
																}
															});
														}
													});
												}
</script>