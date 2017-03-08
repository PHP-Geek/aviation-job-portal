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
        <h1 style="display:inline-block">Aircraft Management</h1>
		<a class="btn btn-primary" href="<?php echo base_url(); ?>aircraft/add_aircraft_management"><i class="fa fa-plus-circle"></i> Add Aircraft Management</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
				<form id="aircraft_management_form" method="post">
					<table id="aircraft_management_datatable" class="table table-bordered">
						<thead>
							<tr>
								<th>Title</th>
								<th>Content</th>
								<th>Image</th>
								<th>Status</th>
								<th>Action</th>
								<th class="hidden_table_col">ID</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($aircraft_management_array as $aircraft_management) { ?>
								<tr id="aircraft_management_<?php echo $aircraft_management['aircraft_management_id']; ?>">
									<td><?php echo $aircraft_management['aircraft_management_title']; ?></td>
									<td><a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo $aircraft_management['aircraft_management_content'] ?>" data-trigger="hover"><?php echo substr($aircraft_management['aircraft_management_content'], 0, 80); ?></a></td>
									<td><a href="<?php echo base_url() . 'uploads/pages/aircraft_management/' . date('Y/m/d/H/i/s/', strtotime($aircraft_management['aircraft_management_created'])) . $aircraft_management['aircraft_management_image']; ?>" target="_blank"><img src="<?php echo base_url() . 'uploads/pages/aircraft_management/' . date('Y/m/d/H/i/s/', strtotime($aircraft_management['aircraft_management_created'])) . $aircraft_management['aircraft_management_image']; ?>" style="width:50%;"/></a></td>
									<td><?php echo $aircraft_management['aircraft_management_status'] == '1' ? '<input type="checkbox" id="id_' . $aircraft_management['aircraft_management_id'] . '" checked="true" onchange="aircraft_management_status(' . $aircraft_management['aircraft_management_id'] . ')"/>' : '<input type="checkbox" id="id_' . $aircraft_management['aircraft_management_id'] . '" onchange="aircraft_management_status(' . $aircraft_management['aircraft_management_id'] . ')"/>'; ?></td>
									<td><a href="<?php echo base_url(); ?>aircraft/edit_aircraft_management/<?php echo $aircraft_management['aircraft_management_id']; ?>"><i class="fa fa-pencil-square-o"></i> Edit</a></td>
									<td class="hidden_table_col"><input type="hidden" name="aircraft_management_id[]" id="aircraft_management_id" value="<?php echo $aircraft_management['aircraft_management_id']; ?>"/></td>
								</tr>
							<?php } ?>
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
	$(".popover_link").popover({html: true, placement: 'auto right'});
	function aircraft_management_status(aircraft_management_id) {
		$.post(base_url + 'aircraft/change_aircraft_management_status', {aircraft_management_id: aircraft_management_id, aircraft_management_status: $("#id_" + aircraft_management_id).is(':checked')}, function (data) {
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