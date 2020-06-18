<!DOCTYPE html>
<html>
<head>
	<title>Syllabus Assign</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
	<script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
	<script type="text/javascript">
		$(document).ready(function() {
		//	alert('OK');
		});

	</script>
</head>
<body>
	<?php $this->load->view('result/header') ?>
	<div class = "container" align = "center">
	<br><br>

<!--	<form action="<?php// echo base_url('Result_Controller/fetch_session');?>" method="post">  -->

	<label>Subject</label>

	<select class="col-sm-2 custom-select custom-select-sm" name="subjects" id="subjects">
						<option value = "">Select Subject</option>
						<option value = "CSE">CSE</option>
						<option value = "Fisheries">Fisheries</option>
						<option value = "Agriculture">Agriculture</option>
						<option value = "NFS">NFS</option>
                    </select>                   
  <br><br>

  <label>Session</label>
	<select class="col-sm-2 custom-select custom-select-sm" name="session" id="session">
  		<option value="">Select Session</option>  
  </select>
	<br><br>

	  <label>Syllabus</label>
	  <select class="col-sm-2 custom-select custom-select-sm" name="syllabus" id="syllabus">
	    <option value="">Select Syllabus</option> 
	  </select>
	  <br><br>
	  <input type="submit" id = "submitbtn" value="Submit" class="btn btn-primary">
</div>

<script src = "<?php echo base_url('/js/jquery-3.js') ?>"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
<?php $this->load->view('result/footer');?>
</body>
</html>

<script>

function newPage() {
	alert('Value updated');
  	window.location.assign("<?php echo base_url();?>Result_Controller/assign_syllabus");
}



$(document).ready(function() {
	$('#subjects').change(function() {

		var subject = $('#subjects').val();
		
		if(subject != '')
		{
			$.ajax({
				url:"<?php echo base_url();?>/Result_Controller/fetch_session",
				type: "POST",
				datatype: "html",
				data:{subject:subject},
				success:function(data)
				{
					$('#session').html(data);
				}
			})

			$.ajax({
				url:"<?php echo base_url();?>/Result_Controller/fetch_profile",
				type: "POST",
				data:{subject:subject},
				success:function(data)
				{
					 var h = $('#syllabus').html(data);
				}
			})

		}  

	});

	$('#session').change(function() {
		var session = $('#session').find(":selected").text();
		//alert(session);
	});  

	$('#syllabus').change(function() {
		var subject = $('#subjects').val();
		var profile = $('#syllabus').find(":selected").text();
	}); 

	$('#submitbtn').click(function() {

		var subject = $('#subjects').val();
		var session = $('#session').find(":selected").text();
		var profile = $('#syllabus').find(":selected").text();

		if(subject != '' && session != 'Select Session' && profile != 'Select Syllabus')
		{
			$.ajax({
				url:"<?php echo base_url();?>/Result_Controller/update_profile",
				method: "POST",
				data:{subject:subject,session:session,profile:profile},
				success:function(data)
				{
					alert('Value Updated');
				}
			})

		}

	}); 

});

</script>