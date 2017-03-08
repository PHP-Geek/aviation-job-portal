<?php
$file_icon = '';
switch (pathinfo($conditional_email_array['conditional_email_attachment'])['extension']) {
	case 'pdf':
		$file_icon = 'fa-file-pdf-o';
		break;
	case 'doc':
	case 'docx':
		$file_icon = 'fa-file-word-o';
		break;
	case 'xls':
	case 'xlsx':
		$file_icon = 'fa-file-excel-o';
		break;
	default :
		$file_icon = 'fa-file-word-o';
		break;
}
?>
<?php echo $conditional_email_body; ?>
<br>
<a href="<?php echo base_url() . 'uploads/emails/newsletters' . date('/Y/m/d/H/i/s/', strtotime($conditional_email_created)) . $conditional_email_attachment; ?>" target="_blank"><i class="fa <?php echo $file_icon; ?> fa-4x"></i></a>