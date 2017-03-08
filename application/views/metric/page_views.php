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
	#page_view_button{
		margin-top: 7px;
	}
	.page_view_select{
		padding:0px 0px !important;
		height:27px !important;
		border:0px;
	}
	.textbox_height{
		height:27px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Page Views <small>listing of page views.</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Page Views</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="well">
				<h4>Filter Page Views:</h4>
				<div class="row">
					<div class="col-md-4">From <input type="text" class="page_view_datepicker form-control textbox_height" id="from_date" placeholder="dd/mm/yyyy"/></div>
					<div class="col-md-4">To <input type="text" class="page_view_datepicker form-control textbox_height" id="to_date" placeholder="dd/mm/yyyy"/></div>
					<div class="col-md-4">Select By Page
						<select class="form-control page_view_select" name="page_view_title" id="page_view_title" data-placeholder="Page">
							<option></option>
							<?php foreach ($page_titles as $page_title) { ?>
								<option value="<?php echo $page_title['page_view_title']; ?>"><?php echo $page_title['page_view_title']; ?></option>
							<?php } ?>
						</select></div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="button" role="button" class="btn btn-primary" id="page_view_button">Filter</button></div>
				</div>
				<div class="text-center"><h4 class="text-info">Total Views: <?php echo $total_rows; ?></h4></div>
			</div>
            <div class="box-body table-responsive">
				<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
							<th>Page</th>
							<th>User</th>
							<th>Date</th>
							<th>IP</th>
							<th>User Agent</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						if (count($page_view_array) > 0) {
							foreach ($page_view_array as $page_view) {
								?>
								<tr>
									<td><?php echo $page_view['page_view_title']; ?></td>
									<td><?php
										if ($page_view['user_email'] != '') {
											echo $page_view['user_first_name'] . ' ' . $page_view['user_last_name'] . '< ' . $page_view['user_email'] . ' >';
										} else {
											echo 'Guest User';
										}
										?></td>
									<td><?php echo date('d M Y h:i a', strtotime($page_view['page_view_created'])); ?></td>
									<td><?php echo $page_view['page_view_ip']; ?></td>
									<td><?php echo $page_view['page_view_user_agent']; ?></td>
								</tr>
								<?php
							}
						} else {
							echo '<tr><td colspan="6"><h4 class="text-info">No Data.</h4></td></tr>';
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5" class="text-center"><?php echo $page_links; ?></td>
						</tr>
					</tfoot>
				</table>
            </div>
        </div>
    </section>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script><link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript">
	$(".page_view_datepicker").datepicker({
		clearBtn: true,
		autoclose: true,
			startView: 2,
			todayBtn: "linked"
	});
	$(function () {
		$("select").select2();
	});
	$("#page_view_button").click(function () {
		var start_date = new Date($("#from_date").val());
		var end_date = new Date($("#to_date").val());
		var page_view_title = $("#page_view_title").val();
		if ($("#from_date").val() === '' && $("#to_date").val() === '') {
			document.location.href = base_url + 'metric/page_views/' + '-/-' + '/' + $("#page_view_title").val();
		} else if ($("#from_date").val() !== '' && $("#to_date").val() === '') {
			document.location.href = base_url + 'metric/page_views/' + start_date.getFullYear() + '-' + (start_date.getMonth() + 1) + '-' + start_date.getDate() + '/-/' + page_view_title;
		} else {
			document.location.href = base_url + 'metric/page_views/' + start_date.getFullYear() + '-' + (start_date.getMonth() + 1) + '-' + start_date.getDate() + '/' + end_date.getFullYear() + '-' + (end_date.getMonth() + 1) + '-' + end_date.getDate() + '/' + page_view_title;
		}
	});
</script>