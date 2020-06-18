<!DOCTYPE html>
<html>
<head>	
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>">
  <script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
</head>

<body>
	<div align="center">
	<!-- <?php echo validation_errors(); ?> -->
	<?php echo form_open('Result_Controller/login_successful') ?>
		<label>Username</label>
		<!--<?php echo form_error('username','<div class="error">', '</div>'); ?> -->
		<input type = "text" name = "username" value="<?php echo set_value('username'); ?>"/><div id="infoMessage"><?php echo form_error('username'); ?></div> <br><br>
		<label>Password</label>
		<input type="password" name="password"><br><br>

		<input type="submit" value="Submit">
	</form>
	</div>
</body>

</html>