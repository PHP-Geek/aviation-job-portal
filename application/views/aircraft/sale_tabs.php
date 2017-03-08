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
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Manage Aircraft Tabs : <?php echo $aircraft_array['aircraft_name']; ?></h1>
		<a href="<?php echo base_url(); ?>aircraft/add_sale_tab/<?php echo $aircraft_array['aircraft_id']; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Tab</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Tabs</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive" id="sale_tab_div">
				<div>
					<h4 class="text-info"><i class="fa fa-info-circle"></i> Tab items are shown in the following order. To change the order please drag and drop row.</h4></div><br/>
				<form method="post" id="sale_tab_form">
					<table id="aircraft_tabs" class="table table-bordered">
						<thead>
							<tr>
								<th>Tab Header</th>
								<!--<th>Tab Content</th>-->
								<th>Status</th>
								<th>Action</th>
								<th class="hidden_table_col">ID</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (count($aircraft_tab_array) > 0) {
								foreach ($aircraft_tab_array as $tabs) {
									?>
									<tr id="sale_tab_<?php echo $tabs['aircraft_sale_tab_id']; ?>">
										<td><?php echo $tabs['aircraft_sale_tab_name']; ?></td>
										<td><?php echo $tabs['aircraft_sale_tab_status'] == '1' ? '<input type="checkbox" id="aircraft_sale_tab_status" checked="true" onchange="change_sale_tab_status(' . $tabs['aircraft_sale_tab_id'] . ')"/>' : '<input type="checkbox" id="aircraft_sale_tab_status_' . $tabs['aircraft_sale_tab_id'] . '" onchange="change_sale_tab_status(' . $tabs['aircraft_sale_tab_id'] . ')"/>'; ?></td>
										<td><a href="<?php echo base_url(); ?>aircraft/edit_sale_tab/<?php echo $tabs['aircraft_sale_tab_id']; ?>" class="btn btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a>
											<a href="javascript:;" class="btn btn-danger"  onclick="delete_sale_tab(<?php echo $tabs['aircraft_sale_tab_id']; ?>);"><i class="fa fa-times"></i> Delete</a></td>
										<td class="hidden_table_col"><input type="hidden" name="aircraft_sale_tab_id[]" id="aircraft_sale_tab_id" value="<?php echo $tabs['aircraft_sale_tab_id']; ?>"/></td>
									</tr>
									<?php
								}
							} else {
								echo '<tr><td><h4 class="text-info">No Tabs.</h4></td></tr>';
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
													$("#aircraft_tabs").tableDnD({
														onDragClass: "table-drag",
														onDrop: function (table, row) {
															$("#sale_tab_form").block();
															$.post(base_url + 'aircraft/change_tab_order', $("#sale_tab_form").serialize(), function (data) {
																if (data === '1') {
																	console.log('done');
																} else {
																	console.log(data);
																}
																$("#sale_tab_form").unblock();
															});
														}
													});
												});
												$("[data-toggle=popover]").popover({placement: 'auto right', html: true});
												function change_sale_tab_status(aircraft_sale_tab_id) {
													$.post(base_url + 'aircraft/change_sale_tab_status', {aircraft_sale_tab_id: aircraft_sale_tab_id, aircraft_sale_tab_status: $('#aircraft_sale_tab_status_' + aircraft_sale_tab_id).is(':checked')}, function (data) {
														if (data === '1') {
															bootbox.alert('Status changed successfully.');
														} else if (data === '0') {
															bootbox.alert('Error changing status.');
														} else {
															bootbox.alert(data);
														}
													});
												}
												function delete_sale_tab(aircraft_sale_tab_id) {
													bootbox.confirm('Are you sure to delete tab ?', function (result) {
														if (result) {
															$.post(base_url + 'aircraft/delete_sale_tab', {aircraft_sale_tab_id: aircraft_sale_tab_id}, function (data) {
																if (data === '1') {
																	bootbox.alert('Tab Deleted Successfully.', function () {
																		$("#sale_tab_" + aircraft_sale_tab_id).fadeOut();
																	});
																} else if (data === '0') {
																	bootbox.alert('Error deleting tab.');
																} else {
																	bootbox.alert(data);
																}
															});
														}
													});
												}

</script>