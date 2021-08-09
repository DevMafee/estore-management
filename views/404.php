<!DOCTYPE html>
<html>
<head>
	<title>PAGE NOT FOUND</title>
	<link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/bootstrap/css/theme.min.css" data-skin="default">
	<script type="text/javascript" src="<?php echo url('assets/js/jquery/dist/'); ?>jquery.min.js"></script>
	<style type="text/css">
		body{
			background: url(<?php echo base_url("site_link"); ?>assets/images/404.png) no-repeat center center fixed;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    background-size: cover;
		}
	</style>
</head>
<body>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).click(function(){
			window.location="<?php echo url('dashboard'); ?>";
		});
	})
</script>