<style type="text/css">
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
	.hidden_table_col{
		display:none;
	}
	.table-drag{
		opacity: 0.6;
		color:white;
		background-color:blue;
	}
	.smallwidth{
		min-width: 85px;
	}
	.medwidth{
		min-width: 130px;
	}
	.largewidth{
		min-width: 200px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Aircrafts For Sale <small>listing of all aircrafts</small></h1>
		<a href="<?php echo base_url(); ?>aircraft/add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Aircraft For Sale</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircrafts</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
				<div>
					<h4 class="text-info"><i class="fa fa-info-circle"></i> Aircrafts to be shown in the following order. To change the order please drag and drop row.</h4>
				</div><br/>
				<form method="post" id="aircraft_form">
					<table id="aircraft_table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="medwidth">Aircraft Type</th>
								<th class="medwidth">Aircraft Name</th>
								<th class="smallwidth">Model</th>
								<th class="smallwidth">Year</th>
								<th class="smallwidth">Price</th>
								<th class="medwidth">Date of Origination</th>
								<th class="largewidth">About Aircraft</th>
								<th class="medwidth">No. of Views</th>
								<th class="medwidth">Sales Sheet Downloaded</th>
								<th class="smallwidth">Status</th>
								<th class="smallwidth">New Status</th>
								<th class="smallwidth">Sold Status</th>
								<th class="largewidth">Highlights</th>
								<th class="medwidth">Manage Highlights</th>
								<th class="medwidth">Sales Interests</th>
								<th class="medwidth">Manage Tabs</th>
								<th class="medwidth">Actions</th>
								<th class="hidden_table_col">ID</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (count($aircraft_array) > 0) {
								foreach ($aircraft_array as $aircraft) {
									?>
									<tr id="aircraft_<?php echo $aircraft['aircraft_id']; ?>">
										<td><?php echo $aircraft['aircraft_type_name']; ?></td>
										<td><?php echo $aircraft['aircraft_name']; ?></td>
										<td><?php echo $aircraft['model_name']; ?></td>
										<td><?php echo $aircraft['aircraft_year']; ?></td>
										<td><?php echo $aircraft['aircraft_price']; ?></td>
										<td><?php echo $aircraft['aircraft_origination_date'] !== '0000-00-00' ? date('d M Y', strtotime($aircraft['aircraft_origination_date'])) : ''; ?></td>
										<td><a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo $aircraft['aircraft_detail']; ?>" data-trigger="hover"><?php echo substr($aircraft['aircraft_detail'], 0, 50); ?></a></td>
										<td><?php echo $aircraft['aircraft_view_count']; ?></td>
										<td><?php echo $aircraft['aircraft_sales_sheet_download_count']; ?></td>
										<td><?php
											switch ($aircraft['aircraft_status']) {
												case '1':
													echo '<div class="text-center"><input onchange="aircraft_status(' . $aircraft['aircraft_id'] . ')" id="id_' . $aircraft['aircraft_id'] . '" type="checkbox" checked="checked"/></div>';
													break;
												default:
													echo '<div class="text-center"><input onchange="aircraft_status(' . $aircraft['aircraft_id'] . ')" id="id_' . $aircraft['aircraft_id'] . '" type="checkbox"/></div>';
											}
											?></td>
										<td>
											<?php
											switch ($aircraft['aircraft_is_new']) {
												case '1':
													echo '<div class="text-center"><input onchange="aircraft_change_new(' . $aircraft['aircraft_id'] . ')" id="is_new_' . $aircraft['aircraft_id'] . '" type="checkbox" checked="checked"/></div>';
													break;
												default:
													echo '<div class="text-center"><input onchange="aircraft_change_new(' . $aircraft['aircraft_id'] . ')" id="is_new_' . $aircraft['aircraft_id'] . '" type="checkbox"/></div>';
													break;
											}
											?></td>
										<td><?php
											switch ($aircraft['aircraft_is_sold']) {
												case '1':
													echo '<div class="text-center"><input onchange="aircraft_change_sold(' . $aircraft['aircraft_id'] . ')" id="is_sold_' . $aircraft['aircraft_id'] . '" type="checkbox" checked="checked"/></div>';
													break;
												default:
													echo '<div class="text-center"><input onchange="aircraft_change_sold(' . $aircraft['aircraft_id'] . ')" id="is_sold_' . $aircraft['aircraft_id'] . '" type="checkbox"/></div>';
													break;
											}
											?></td>
										<td><?php
											if ($aircraft['highlight'] == '' || $aircraft['highlight'] == null) {
												echo 'No Highlights.';
											} else {
												echo $aircraft['highlight'];
											}
											?></td>
										<td>
											<a href="<?php echo base_url() . 'aircraft/highlights/' . $aircraft['aircraft_id']; ?>" class="btn btn-sm btn-success">Manage</a>
										</td>
										<td><a href="<?php echo base_url(); ?>aircraft/sale_interests/<?php echo $aircraft['aircraft_id']; ?>" title="View Interested People for Aircraft"><i class="fa fa-eye"></i> View</a> </td>
										<td><div class="text-center"><a href="<?php echo base_url(); ?>aircraft/sale_tabs/<?php echo $aircraft['aircraft_id']; ?>" title="Manage Tabs"><i class="fa fa-arrows"></i> Manage</a> </div></td>
										<td><a href="<?php echo base_url(); ?>aircraft/edit/<?php echo $aircraft['aircraft_id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a>
											<button role="button" type="button" class="btn btn-danger btn-sm" onclick="confirm_delete(<?php echo $aircraft['aircraft_id']; ?>);"><i class="fa fa-times"> Delete</i></button></td>
										<td class="hidden_table_col"><input type="hidden" name="aircraft_id[]" id="aircraft_id" value="<?php echo $aircraft['aircraft_id']; ?>"/></td>
									</tr>
									<?php
								}
							} else {
								echo '<tr><td colspan="14"><h4 class="text-info">No Data.</h4></td></tr>';
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
													$("#aircraft_table").tableDnD({
														onDragClass: "table-drag",
														onDrop: function (table, row) {
															$("#aircraft_form").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
															$.post(base_url + 'aircraft/change_aircraft_order', $("#aircraft_form").serialize(), function (data) {
																if (data === '1') {
																	console.log('done');
																} else {
																	console.log(data);
																}
																$("#aircraft_form").unblock();
															});
														}
													});
												});
												$(".popover_link").popover({html: true, placement: 'auto right'});
												function aircraft_status(aircraft_id) {
													$("#aircraft_table").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
													$.post(base_url + 'aircraft/change_status', {aircraft_id: aircraft_id, aircraft_status: $("#id_" + aircraft_id).is(':checked')}, function (data) {
														if (data === '1') {
															bootbox.alert("Status Changed Successfully");
														} else if (data === '0') {
															bootbox.alert("Error Updating User Status !!!");
														} else {
															bootbox.alert(data);
														}
														$("#aircraft_table").unblock();
													});
												}
												function aircraft_change_new(aircraft_id) {
													$("#aircraft_table").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
													$.post(base_url + 'aircraft/aircraft_add_remove_new_symbol', {aircraft_id: aircraft_id, aircraft_is_new: $("#is_new_" + aircraft_id).is(':checked')}, function (data) {
														if (data === '1') {
															bootbox.alert("New Symbol Updated Successfully");
														} else if (data === '0') {
															bootbox.alert("Error Addin New Symbol!!!");
														} else {
															bootbox.alert(data);
														}
														$("#aircraft_table").unblock();
													});
												}
												function aircraft_change_sold(aircraft_id) {
													$("#aircraft_table").block({message: ' <i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br>Please wait...'});
													$.post(base_url + 'aircraft/aircraft_add_remove_sold_symbol', {aircraft_id: aircraft_id, aircraft_is_sold: $("#is_sold_" + aircraft_id).is(':checked')}, function (data) {
														if (data === '1') {
															bootbox.alert("Sold Symbol Updated Successfully");
														} else if (data === '0') {
															bootbox.alert("Error Addin New Symbol!!!");
														} else {
															bootbox.alert(data);
														}
														$("#aircraft_table").unblock();
													});
												}
												function confirm_delete(aircraft_id) {
													bootbox.confirm('Delete aircraft from sale list?', function (result) {
														if (result) {
															$.post(base_url + 'aircraft/delete', {aircraft_id: aircraft_id}, function (data) {
																if (data === '1') {
																	bootbox.alert('Aircraft deleted from sale list.', function () {
																		document.location.href = '';
																	});
																} else if (data === '0') {
																	bootbox.alert('Error deleting aircraft');
																} else {
																	bootbox.alert(data);
																}
															});
														}
													});
												}
</script>