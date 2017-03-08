<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Aircraft Highlights : <?php echo $aircraft_array['aircraft_name']; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aircraft Highlights</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Aircraft Highlights</h3>
                    </div>
                    <form id="aircraft_highlight_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-10">
										<input type="text" name="aircraft_highlight[]" id="aircraft_highlight_1" value="<?php echo isset($aircraft_highlight_array[0]['aircraft_highlight_value']) ? $aircraft_highlight_array[0]['aircraft_highlight_value'] : ''; ?>" class="form-control" placeholder="Aircraft Highlight - 1"/>
									</div>
									<div class="col-md-2">
										<?php if (isset($aircraft_highlight_array[0]['aircraft_highlight_value']) && $aircraft_highlight_array[0]['aircraft_highlight_value'] !== '') { ?>
											<a href="javascript:;" class="btn btn-danger btn-sm" onclick="clear_highlight('aircraft_highlight_1');"><i class="fa fa-times"></i></a>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-10">
										<input type="text" name="aircraft_highlight[]" id="aircraft_highlight_2" value="<?php echo isset($aircraft_highlight_array[1]['aircraft_highlight_value']) ? $aircraft_highlight_array[1]['aircraft_highlight_value'] : ''; ?>" class="form-control" placeholder="Aircraft Highlight - 2"/>
									</div>
									<div class="col-md-2">
										<?php if (isset($aircraft_highlight_array[1]['aircraft_highlight_value']) && $aircraft_highlight_array[1]['aircraft_highlight_value'] !== '') { ?>
											<a href="javascript:;" class="btn btn-danger btn-sm" onclick="clear_highlight('aircraft_highlight_2');"><i class="fa fa-times"></i></a>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-10">
										<input type="text" name="aircraft_highlight[]" id="aircraft_highlight_3" value="<?php echo isset($aircraft_highlight_array[2]['aircraft_highlight_value']) ? $aircraft_highlight_array[2]['aircraft_highlight_value'] : ''; ?>" class="form-control" placeholder="Aircraft Highlight - 3"/>
									</div>
									<div class="col-md-2">
										<?php if (isset($aircraft_highlight_array[2]['aircraft_highlight_value']) && $aircraft_highlight_array[2]['aircraft_highlight_value'] !== '') { ?>
											<a href="javascript:;" class="btn btn-danger btn-sm" onclick="clear_highlight('aircraft_highlight_3');"><i class="fa fa-times"></i></a>
										<?php } ?>
									</div></div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-10">
										<input type="text" name="aircraft_highlight[]" id="aircraft_highlight_4" value="<?php echo isset($aircraft_highlight_array[3]['aircraft_highlight_value']) ? $aircraft_highlight_array[3]['aircraft_highlight_value'] : ''; ?>" class="form-control" placeholder="Aircraft Highlight - 4"/>
									</div>
									<div class="col-md-2">
										<?php if (isset($aircraft_highlight_array[3]['aircraft_highlight_value']) && $aircraft_highlight_array[3]['aircraft_highlight_value'] !== '') { ?>
											<a href="javascript:;" class="btn btn-danger btn-sm" onclick="clear_highlight('aircraft_highlight_4');"><i class="fa fa-times"></i></a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer text-center">
							<button id="aircraft_highlight_button" type="button" class="btn btn-primary" data-loading-text="Please wait...">Update Highlights</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	function clear_highlight(highlight_id) {
		bootbox.confirm('Are you sure to delete highlight', function (result) {
			if (result) {
				$("#" + highlight_id).val('');
			}
		});
	}
	$("#aircraft_highlight_button").click(function () {
		$("#aircraft_highlight_button").button('loading');
		$.post('', $("#aircraft_highlight_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert('Hightlight Updated Successfully', function () {
					document.location.href = base_url + 'aircraft';
				});
			} else if (data === '0') {
				bootbox.alert('Error Updating Highlights.');
			} else {
				bootbox.alert(data);
			}
			$("#aircraft_highlight_button").button('reset');
		});
	});
</script>
