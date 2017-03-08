<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
		<meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ''; ?>"/>
		<meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ''; ?>"/>
        <title><?php echo isset($title) ? ucwords($title) : (($this->router->method === 'index') ? '' : ucwords(str_replace('_', ' ', $this->router->method))); ?></title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker3.standalone.min.css" />
        <link href="<?php echo base_url(); ?>assets/css/style.css?ts=<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<script src="//code.jquery.com/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
		<style type="text/css">
			#accept_cookie_alert{
				margin-bottom: 0px;
				padding:5px;
			}
			#alert_link{
				text-decoration: underline;
			}
			#cookies_accept_button{
				padding: 1px 15px;
			}
			.main-footer-right li i {
				cursor:pointer;
			}
		</style>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>var base_url = '<?php echo base_url(); ?>';
			function refresh_captcha(t) {
				$.get(base_url + 'page/refresh_captcha', function (data) {
					$(t).parent('div').html(data + ' &nbsp; <a href="javascript:;" onclick="refresh_captcha(this);"><i class="fa fa-refresh"></i></a>');
				});
			}
		</script>
    </head>
    <body>
		<?php
		if (isset($_SESSION['cookies_accept']) && $_SESSION['cookies_accept'] === '1') {
			
		} else {
			?>
			<div class="alert alert-info text-right" id="accept_cookie_alert">
				By continuing to use this website, you agree to our cookie <a href="<?php echo base_url(); ?>privacy-policy" id="alert_link">policy</a>.
				<button type="button" id="cookies_accept_button" class="btn btn-info btn-xs">OK</button>
			</div>
		<?php }
		?>
		<script>
			$("#cookies_accept_button").click(function () {
				$.post(base_url + 'page/accept_cookies', {success: 'true'}, function (data) {
					if (data === '1') {
						$("#accept_cookie_alert").fadeOut();
					} else {
						bootbox.alert(data);
					}
				});
			});
		</script>