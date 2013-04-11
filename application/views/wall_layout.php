<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script type="text/javascript">
		var Test ={
			baseUrl:'<?php echo $this->uri->config->item('base_url') ?>'
		}
	</script>
	<script src="<?php echo $this->uri->config->item('base_url'); ?>layout/js/jquery.min.js"></script>
	<link href="<?php echo $this->uri->config->item('base_url'); ?>layout/js/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $this->uri->config->item('base_url'); ?>layout/js/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $this->uri->config->item('base_url'); ?>layout/js/app/wall/index.js"></script>
</head>
<body>
<div class="row">

<div class="span12">
<?php if(false!==($name=_if_auth($this))){?>
<p><a href="logout">Logout(<?php echo $name;?>)</a></p>
<?php }else{ ?>
<p><a href="auth">Login(<?php echo $a=_find_user_from_id_auth($this,_get_id_guest_auth($this)); ?>)</a></p>
<?php }?>
</div>

</div>

<?php echo (isset($content)?$content:''); ?>

</body>
</html>