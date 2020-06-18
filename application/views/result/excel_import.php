<!DOCTYPE html>
<html>
<head>
	<title>Parse Excel File</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
	<script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>

</head>
<body>

	<form method="post" id = "import_form">
		<p><label>Select excel file</label>
		<input type="file" name="file" id = "file" required accept=".xls, .xlsx"/> </p>
		<br/>
		<input type="submit" name="import" value="Import" class="btn btn-info">
	</form>
	<div class="table-responsive" id = "customer_data">

	</div>

<script src = "<?php echo base_url('/js/jquery-3.js') ?>"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>

</body>
</html>

<script>
	$(document).ready(function() {
		load_data();

		function load_data() {
			$.ajax({
				url: "<?php echo base_url();?>/Result_Controller/fetch",
				method: "POST",
				success:function(data){
					$('#customer_data').html(data);
				}
			});
		}


	});
</script> 