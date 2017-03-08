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
        <h1 style="display:inline-block">Increw Services</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Increw Services</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
				<div>
					<h4 class="text-info"><i class="fa fa-info-circle"></i> Page items are shown in the following order. To change the order please drag and drop row.</h4></div>
				<form id="increw_service_form" method="post">
					<table id="increw_services_datatable" class="table table-bordered">
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
							<?php foreach ($increw_services_array as $service) { ?>
								<tr id="our_service_<?php echo $service['increw_service_id']; ?>">
									<td><?php echo $service['increw_service_title']; ?></td>
									<td><a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo $service['increw_service_content'] ?>" data-trigger="hover"><?php echo substr($service['increw_service_content'], 0, 80); ?></a></td>
									<td><a href="<?php echo base_url() . 'uploads/pages/increw_services/' . date('Y/m/d/H/i/s/', strtotime($service['increw_service_created'])) . $service['increw_service_image']; ?>" target="_blank"><img src="<?php echo base_url() . 'uploads/pages/increw_services/' . date('Y/m/d/H/i/s/', strtotime($service['increw_service_created'])) . $service['increw_service_image']; ?>" style="width:50%;"/></a></td>
									<td><?php echo $service['increw_service_status'] == '1' ? '<input type="checkbox" id="id_' . $service['increw_service_id'] . '" checked="true" onchange="increw_service_status(' . $service['increw_service_id'] . ')"/>' : '<input type="checkbox" id="id_' . $service['increw_service_id'] . '" onchange="increw_service_status(' . $service['increw_service_id'] . ')"/>'; ?></td>
									<td><a href="<?php echo base_url(); ?>page/edit_our_service/<?php echo $service['increw_service_id']; ?>"><i class="fa fa-pencil-square-o"></i> Edit</a></td>
									<td class="hidden_table_col"><input type="hidden" name="increw_service_id[]" id="increw_service_id" value="<?php echo $service['increw_service_id']; ?>"/></td>
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
	$(document).ready(function () {
		$("#increw_services_datatable").tableDnD({
			onDragClass: "table-drag",
			onDrop: function (table, row) {
				$("#increw_service_form").block();
				$.post(base_url + 'page/update_our_service_order', $("#increw_service_form").serialize(), function (data) {
					if (data === '1') {
						console.log('done');
					} else {
						console.log('Error');
					}
					$("#increw_service_form").unblock();
				});
			}
		});
	});
	$(".popover_link").popover({html: true, placement: 'auto right'});
	function increw_service_status(increw_service_id) {
		$.post(base_url + 'page/change_increw_service_status', {increw_service_id: increw_service_id, increw_service_status: $("#id_" + increw_service_id).is(':checked')}, function (data) {
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