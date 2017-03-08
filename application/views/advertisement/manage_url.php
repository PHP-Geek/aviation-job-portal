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
        <h1 style="display:inline-block">Popup Ads URLs <small>listing of Popup Ads URLs</small></h1>
		<button type="button" class="btn btn-sm btn-primary" data-target="#popup_ad_modal" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add New URL</button>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Popup Ads URLs</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="well text-center">
				<strong> PopUp Ads :</strong> <?php echo $popup_ad_array['popup_ad_label']; ?>
			</div>
			<div class="box-body table-responsive">
				<form method="post" id="advertisement_form">
					<table id="popup_ad_table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Link (Ad to be displayed on)</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (count($pop_ad_url_array) > 0) {
								foreach ($pop_ad_url_array as $url) {
									?>
									<tr>
										<td><?php echo $url['popup_ad_url_id']; ?></td>
										<td><?php echo $url['popup_ad_url']; ?></td>
										<td><button type="button" class="btn btn-danger btn-sm" onclick="confirm_delete(<?php echo $url['popup_ad_url_id']; ?>);"><i class="fa fa-times"></i> Delete</button></td>
									</tr>
									<?php
								}
							} else {
								echo '<tr><td colspan="3"><h4 class="text-info text-left">No Links Added.</h4></td></tr>';
							}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</section>
</div>
<!-- Modal -->
<div id="popup_ad_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New URL</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" id="add_popup_ad_url_form" class="form-group" role="form">
					<div class="form-group">
						<label for="popup_ad_url">URL</label>
						<input type="text" class="form-control" name="popup_ad_url" id="popup_ad_url" placeholder="Paste URL here"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-angle-left"></i> Cancel</button>
				<button type="button" class="btn btn-primary" onclick="add_popup_ad_url();">Submit <i class="fa fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function add_popup_ad_url() {
		$.post('', $("#add_popup_ad_url_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert('URL Added Successfully', function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert('Error!.');
			} else {
				bootbox.alert(data);
			}
		});
	}

	function confirm_delete(popup_ad_url_id) {
		bootbox.confirm('Are you sure to delete Link ?', function (result) {
			if (result) {
				$.post(base_url + 'advertisement/delete_popup_ad_url', {popup_ad_url_id: popup_ad_url_id}, function (data) {
					if (data === '1') {
						bootbox.alert('Popup Ad URL Deleted Successfully.', function () {
							document.location.href = '';
						});
					} else if (data === '0') {
						bootbox.alert('Error Deleting Ad');
					} else {
						bootbox.alert(data);
					}
				});
			}
		});
	}

</script>
