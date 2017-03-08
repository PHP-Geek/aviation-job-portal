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
	.medwidth {
		width:120px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Sales And Acquisitions</h1>
		<a href="<?php echo base_url(); ?>aircraft/add_sales_and_acquisition">
			<button class="btn btn-primary" type="button">
				<i class="fa fa-plus-circle"></i> Add New Post
			</button>
		</a>		
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Sales And Acquisitions</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
				<form id="sales_and_acquisitions_form" method="post">
					<table id="sales_and_acquisitions_datatable" class="table table-bordered">
						<thead>
							<tr>
								<th>Title</th>
								<th>Content</th>
								<th class="medwidth">Button Text</th>
								<th>Image</th>
								<th>Status</th>
								<th>Action</th>
								<th class="hidden_table_col">ID</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($sales_and_acquisition_array as $sales_and_acquisition) { ?>
								<tr id="sales_and_acquisitions_<?php echo $sales_and_acquisition['sales_and_acquisition_id']; ?>">
									<td><?php echo $sales_and_acquisition['sales_and_acquisition_title']; ?></td>
									<td><a class="popover_link" href="javascript:;" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo $sales_and_acquisition['sales_and_acquisition_content'] ?>" data-trigger="hover"><?php echo substr($sales_and_acquisition['sales_and_acquisition_content'], 0, 80); ?></a></td>
									<td><?php echo $sales_and_acquisition['sales_and_acquisition_button_text']; ?></td>
									<td><a href="<?php echo base_url() . 'uploads/pages/sales_and_acquisitions/' . date('Y/m/d/H/i/s/', strtotime($sales_and_acquisition['sales_and_acquisition_created'])) . $sales_and_acquisition['sales_and_acquisition_image']; ?>" target="_blank"><img src="<?php echo base_url() . 'uploads/pages/sales_and_acquisitions/' . date('Y/m/d/H/i/s/', strtotime($sales_and_acquisition['sales_and_acquisition_created'])) . $sales_and_acquisition['sales_and_acquisition_image']; ?>" style="width:50%;"/></a></td>
									<td><?php echo $sales_and_acquisition['sales_and_acquisition_status'] == '1' ? '<input type="checkbox" id="id_' . $sales_and_acquisition['sales_and_acquisition_id'] . '" checked="true" onchange="sales_and_acquisition_status(' . $sales_and_acquisition['sales_and_acquisition_id'] . ')"/>' : '<input type="checkbox" id="id_' . $sales_and_acquisition['sales_and_acquisition_id'] . '" onchange="sales_and_acquisition_status(' . $sales_and_acquisition['sales_and_acquisition_id'] . ')"/>'; ?></td>
									<td><a href="<?php echo base_url(); ?>aircraft/edit_sales_and_acquisitions/<?php echo $sales_and_acquisition['sales_and_acquisition_id']; ?>"><i class="fa fa-pencil-square-o"></i> Edit</a></td>
									<td class="hidden_table_col"><input type="hidden" name="sales_and_acquisition_id[]" id="sales_and_acquisition_id" value="<?php echo $sales_and_acquisition['sales_and_acquisition_id']; ?>"/></td>
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
	function sales_and_acquisition_status(sales_and_acquisition_id) {
		$.post(base_url + 'aircraft/change_sales_and_acquisitions_status', {sales_and_acquisition_id: sales_and_acquisition_id, sales_and_acquisition_status: $("#id_" + sales_and_acquisition_id).is(':checked')}, function (data) {
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