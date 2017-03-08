<link href="<?php echo base_url(); ?>assets/js/plugins/select2-3.5.4/select2.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/js/plugins/select2-3.5.4/select2-bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/select2-bootstrap.css" rel="stylesheet" />
<style>
	.select2-result-selectable.active {
		background-color: #bdbdbd;
		color: #a86749;
	}
	.aircraft-sales-dropdown {
		background-color: #26355f;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
		display: block;
		font-size: 18px;
		height: 40px;
		line-height: 1.42857;
		padding: 6px 12px;
		text-align: center;
		transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
		width: 100%;
		color:#fff;
	}
	.aircraft-sales-dropdown::-moz-placeholder {
		color: #999;
		opacity: 1;
	}
    .sale-sheet{
        border:1px solid #dadfdf;
        margin-top: 27px;
		background:  #F5F5F5;
    }
	.little-banner{
		margin-bottom: 22px;
	}
	.footer{
		margin-top:20px;
	}
    .sale-sheet h4{
        color:#626262;
		font-size:15px;
    }
    .sale-sheet li {
        font-size: 13px;
    }
	.select2-chosen {
		background-color: #fff;
		color:#273762;
		border:1px solid #273762;
	}
	.select2-container .select2-choice > .select2-chosen {
		margin-right: 0px !important;
	}
	.select2-container-active .select2-choice, .select2-container-multi.select2-container-active .select2-choices {
		box-shadow: none !important;
	}
	.select2-container.input-lg .select2-choice, .input-group-lg .select2-container .select2-choice {
		height: 37px !important;
		border-radius: 0 !important;
	}
	.select2-container .select2-choice .select2-arrow{
		background: #273762 !important;
	}
	.select2-container .select2-choice .select2-arrow {
		right: 0 !important;
		top: -1px;
	}
	#imaginary_container a{
		text-decoration: none;
		color:#808080;
	}
	.stylish-input-group .input-group-addon{
		background: white !important;
	}
	.stylish-input-group .form-control{
		border-right:0;
		box-shadow:0 0 0;
		border-color:#ccc;
	}
	.stylish-input-group button{
		border:0;
		background:transparent;
	}
	.new-image{
		position: relative;
	}
	.new-image img {
		left: -4px;
		position: absolute;
		top: -4px;
		z-index: 1000;
	}
	.select-hr{
		border-top: dotted 1px #999;
	}
	@media only screen and (max-width:1024px) and (min-width:767px) and (orientation: portrait){
		.sale-sheet li {
			font-size: 16px;
		}
		.sale-sheet {
			min-height: 355px;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Aircraft Sales</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="little-banner-text">
                    <h1><span style="font-weight: 400">Aircraft Sales </span></h1>
                    <p>InCrew’ s Aircraft Sales team has the experience, expertise and relationships to advise you throughout the sale and related services of your new or pre-owned aircraft to meet your requirements. Our team will search and attract potential buyers ensuring you obtain an optimal return on your asset in a timely manner. InCrew will market and negotiate on your behalf ensuring minimal time and effort is required at a competitive margin. Our industry knowledge and extensive network will provide you with a competitive advantage whether it’s your first time or you are experienced seller. Engage us today for the latest market information on listed and unlisted private jets.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-lg-offset-8">
                <div id="imaginary_container">
					<div class="input-group stylish-input-group">
						<input type="text" class="form-control" required="required" placeholder="Search" name="search_text" id="search_text" onkeypress="return search(event)" value="<?php echo isset($search_text) ? $search_text : ''; ?>">
						<span class="input-group-addon">
							<button type="submit" id="search_button" onclick="search(13)">
								<span class="glyphicon glyphicon-search"></span>
							</button>							                          
							<a href="<?php echo base_url(); ?>aircraft-sales"><span class="fa fa-refresh"></span></a>
						</span>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <form id="search_aircraft_form" method="post" class="form-group">
			<div class="col-md-3 col-sm-3 col-lg-3">
                <div class="form-group">
                    <select class="select2select form-control input-lg"  placeholder="Sort By" id="aircraft_order" name="aircraft_order">
						<option></option>
                        <option value="1">By Alphabets (A - Z)</option>
						<option value="2">By Alphabets (Z- A)</option>
                        <option value="3">By Price (Low - High)</option>
						<option value="4">By Price (High - Low)</option>
                        <option value="5">By Year (Newest - Oldest)</option>
						<option value="6">By Year (Oldest - Newest)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3">
                <div class="form-group">
                    <select class="select2select form-control input-lg"  placeholder="Manufacturer" id="manufacturers_id" name="manufacturers_id">
                        <option></option>
						<?php foreach ($manufacturer_array as $manufacturer) { ?>
							<option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['manufacturer_name']; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3">
                <div class="form-group">
                    <select class="select2select form-control input-lg"  placeholder="Model" id="models_id" name="models_id">
                        <option></option>
						<?php foreach ($model_array as $model) { ?>
							<option value="<?php echo $model['model_id']; ?>"><?php echo $model['model_name']; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3">
                <div class="form-group">
                    <select class="select2select form-control input-lg"  placeholder="Year" id="aircraft_year" name="aircraft_year">
                        <option></option>
						<?php foreach ($aircraft_year_array as $year) { ?>
							<option value="<?php echo $year['aircraft_year']; ?>"><?php echo $year['aircraft_year']; ?></option>
						<?php } ?>
					</select>
                </div>
            </div>
		</form>
    </div>
</div>
<div class="container" id="search_data">
	<div class="row">
		<?php
		if (count($aircraft_array) > 0) {
			foreach ($aircraft_array as $key => $aircraft) {
//			if ($key % 3 === 0) {
//				echo '<div class="row">';
//			}
				?>
				<div class="col-md-4 col-sm-6 col-lg-4">
					<div class="sale-sheet">
						<div class="new-image">
							<?php if ($aircraft['aircraft_is_new'] === '1') { ?>
								<img src="<?php echo base_url(); ?>assets/img/new-plane.png" alt="pilot" class="img-responsive"/> <?php } ?>
							<?php if ($aircraft['aircraft_is_sold'] === '1') { ?>
								<img src="<?php echo base_url(); ?>assets/img/sold-plane.png" alt="pilot" class="img-responsive"/> <?php } ?>
						</div>
						<a href="<?php echo base_url(); ?>aircraft-sales-open/<?php echo $aircraft['aircraft_slug'] . '/' . $aircraft['aircraft_id']; ?>">
							<img src="<?php
							if (is_file(FCPATH . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft['aircraft_created']))) . $aircraft['aircraft_image']) {
								echo base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft['aircraft_created'])) . $aircraft['aircraft_image'];
							} else {
								echo base_url() . 'assets/img/sales-1.jpg';
							}
							?>" alt="image" style="height:188px" class="img-responsive center-block"/></a>
						<h4 class="text-center"><a href="<?php echo base_url(); ?>aircraft-sales-open/<?php echo $aircraft['aircraft_slug'] . '/' . $aircraft['aircraft_id']; ?>"><?php echo $aircraft['aircraft_name']; ?></a></h4>
							<?php if (isset($aircraft['aicraft_highlights']) && count($aircraft['aicraft_highlights']) > 0) { ?>
							<ul>
								<?php foreach ($aircraft['aicraft_highlights'] as $highlight) { ?>
									<li><?php echo $highlight['aircraft_highlight_value']; ?></li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
				</div>
				<?php
//			if ($key === count($aircraft_array) - 1 || ($key + 1) % 3 === 0) {
//				echo '</div>';
//			}
			}
		} else {
			echo '<div class="col-md-12"><div class="well">Presently we have no Aircraft that are on market matching your request. Please contact us to find out what off market Aircraft we have available. It is highly likely that we have the perfect Aircraft available for you, but it is not listed at the request of the seller.</div>'
			. '<div class="text-center"><a href="' . base_url() . 'contact-us" class="btn btn-success">Contact Us <i class="fa fa-plane"></i></a></div>'
			. '</div>';
		}
		?> 
	</div>
</div> 
<script src="<?php echo base_url(); ?>assets/js/plugins/select2-3.5.4/select2.min.js"></script>
<script type="text/javascript">
								$(function () {
									$('.select2select').select2();
								});
								function search(e) {
									if (e.keyCode == 13) {
										var search_text = $("#search_text").val().split("/").join("_");
										document.location.href = base_url + 'aircraft-sales/' + search_text.split(" ").join("-");
									}
								}
								$("#aircraft_year").on('change', function () {
									if ($("#aircraft_year").val() == 'reset') {
										$("#aircraft_year option[value='reset']").remove();
										$("#aircraft_year option[value='reset']").css('display', 'none');
										$(this).val('');
										$(this).select2();
									}
									$("#aircraft_year option[value='reset']").remove();
									$("#aircraft_year").append('<option class="select-hr" value="reset">Reset Filter</option>');
								});
								$("#models_id").on('change', function () {
									if ($("#models_id").val() == 'reset') {
										$("#models_id option[value='reset']").remove();
										$("#models_id option[value='reset']").css('display', 'none');
										$(this).val('');
										$(this).select2();
									}
									$("#aircraft_year").val('');
									$("#models_id option[value='reset']").remove();
									$.post(base_url + 'aircraft/get_aircrafts', {models_id: $("#models_id").val()}, function (data) {
										$("#aircraft_year").empty();
										$("#aircraft_year").append('<option></option>');
										$("#aircraft_year").select2({placeholder: "Year"});
										for (var i = 0; i < (data.aircraft_years).length; i++) {
											$("#aircraft_year").append('<option value="' + data.aircraft_years[i].aircraft_year + '">' + data.aircraft_years[i].aircraft_year + '</option>');
										}
										$("#models_id").append('<option class="select-hr" value="reset">Reset Filter</option>');
									});
								});

								$("#manufacturers_id").on('change', function () {
									if ($(this).val() == 'reset') {
										document.location.href = base_url + 'aircraft-sales';
									}
									$("#manufacturers_id option[value='reset']").remove();
									$("#aircraft_years option[value='reset']").remove();
									$("#models_id").val('');
									$("#aircraft_year").val('');
									$.post(base_url + 'aircraft/get_aircrafts', {manufacturers_id: $("#manufacturers_id").val()}, function (data) {
										$("#aircraft_year").empty();
										$("#aircraft_year").append('<option></option>');
										$("#aircraft_year").select2({placeholder: "Year"});
										$("#models_id").empty();
										$("#models_id").append('<option></option>');
										$("#models_id").select2({placeholder: "Model"});
										for (var i = 0; i < (data.model_array).length; i++) {
											$("#models_id").append('<option value="' + data.model_array[i].model_id + '">' + data.model_array[i].model_name + '</option>');
										}
										$("#manufacturers_id").append('<option class="select-hr" value="reset">Reset Filter</option>');
										for (var i = 0; i < (data.aircraft_year_array).length; i++) {
											$("#aircraft_year").append('<option value="' + data.aircraft_year_array[i].aircraft_year + '">' + data.aircraft_year_array[i].aircraft_year + '</option>');
										}
									});
								});

								$("#search_aircraft_form .select2select").on('change', function () {
									$("#search_text").val('');
									$.post(base_url + 'aircraft/get_aircrafts', {aircraft_order: $("#aircraft_order").val(), manufacturers_id: $("#manufacturers_id").val(), models_id: $("#models_id").val(), aircraft_year: $("#aircraft_year").val()}, function (data) {
										$("#search_data").html(data.string);
									});
								});

								$("#search_button").click(function () {
									var search_text = $("#search_text").val().split("/").join("_");
									document.location.href = base_url + 'aircraft-sales/' + search_text.split(" ").join("-");
								});
</script>