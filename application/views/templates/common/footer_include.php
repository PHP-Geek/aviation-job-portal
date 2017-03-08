<style>
	.fancybox-skin {
		padding:0 !important;
	}
	.fancybox-overlay{
		background-color: rgba(255, 255, 255, 0.7) !important;
		background: rgba(255, 255, 255, 0.7) !important;
		color: rgba(255, 255, 255, 0.7) !important;
	}
	.fancybox-wrap {
		-moz-box-shadow: -1px 0px 8px #000000;
		-webkit-box-shadow: -1px 0px 8px #000000;
		box-shadow: -1px 0px 8px #000000;
	}



	@media only screen and (min-width:768px) and (max-width: 980px){
		.fancybox-wrap {
			left: 15%;
			width: auto !important;
		}
	}

</style>
<script src="//npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" type="text/css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js" type="text/javascript"></script>
<?php
$page_view_link = base_url(uri_string());
if (isset($title) && $title !== '') {
	$this->db->insert('page_views', array(
		'page_view_link' => $page_view_link,
		'page_view_title' => ucwords($title),
		'users_id' => isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '0',
		'page_view_ip' => $this->input->server('REMOTE_ADDR'),
		'page_view_user_agent' => $this->input->server('HTTP_USER_AGENT'),
		'page_view_created' => date('Y-m-d H:i:s')
	));
}
$pop_ad = $this->Advertisement_model->get_popup_ad_url_by_url($page_view_link);
if (count($pop_ad) > 0) {
	if (isset($_SESSION['popup_array'][$page_view_link]) && is_numeric($_SESSION['popup_array'][$page_view_link]) && $_SESSION['popup_array'][$page_view_link] > time() - 1800) {
		//do nothing
	} else if (isset($_SESSION['popup_array'][$page_view_link]) && is_numeric($_SESSION['popup_array'][$page_view_link]) && $_SESSION['popup_array'][$page_view_link] > time() - 1800) {
		unset($_SESSION['popup_array'][$page_view_link]);
		$_SESSION['popup_array'][$page_view_link] = time();
		?>
		<div id="popup_ad_box" style="display: none;">
			<a href="<?php
			if (isset($pop_ad['popup_ad_link']) && $pop_ad['popup_ad_link'] !== '') {
				echo $pop_ad['popup_ad_link'];
			} else {
				echo 'javascript:;';
			}
			?>" target="_blank"><img src="<?php echo base_url() . 'uploads/advertisements/popup_ads/' . date('Y/m/d/H/i/s/', strtotime($pop_ad['popup_ad_created'])) . $pop_ad['popup_ad_image']; ?>" class="img-responsive center-block" alt="Popup Ad" id="popup_ad_image" onclick="popup_ad_click(<?php echo $pop_ad['popup_ad_id']; ?>);"/></a>
		</div>
		<script type="text/javascript">
			$(function () {
				$('body').imagesLoaded(function () {
					setTimeout(function () {
						$("#popup_ad_box").show();
						$.fancybox.helpers.overlay.open({parent: $('body')});
						$.fancybox("#popup_ad_box", {
							'hideOnContentClick': true,
							autoSize: true
						});
					}, 100);
				});
			});
		</script>
		<?php
	} else {
		$_SESSION['popup_array'][$page_view_link] = time();
		?>
		<div id="popup_ad_box" style="display: none;">
			<a href="<?php
			if (isset($pop_ad['popup_ad_link']) && $pop_ad['popup_ad_link'] !== '') {
				echo $pop_ad['popup_ad_link'];
			} else {
				echo 'javascript:;';
			}
			?>" target="_blank"><img src="<?php echo base_url() . 'uploads/advertisements/popup_ads/' . date('Y/m/d/H/i/s/', strtotime($pop_ad['popup_ad_created'])) . $pop_ad['popup_ad_image']; ?>" class="img-responsive center-block" alt="Popup Ad" id="popup_ad_image" onclick="popup_ad_click(<?php echo $pop_ad['popup_ad_id']; ?>);"/></a>
		</div>
		<script type="text/javascript">
			$(function () {
				$('body').imagesLoaded(function () {
					setTimeout(function () {
						$("#popup_ad_box").show();
						$.fancybox.helpers.overlay.open({parent: $('body')});
						$.fancybox("#popup_ad_box", {
							'hideOnContentClick': true,
							autoSize: true
						});
					}, 100);
				});
			});
		</script>
		<?php
	}
}
?>
<script>
	function popup_ad_click(popup_ad_id) {
		$.post(base_url + 'advertisement/count_popup_ad_click', {popup_ad_id: popup_ad_id}, function (data) {
			$.fancybox.close();
		});
	}
</script>