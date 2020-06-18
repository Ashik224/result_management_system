<!DOCTYPE html>
<html>
<head>
	<title>Faculty Insertion</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>"> 

  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
</head>

<body>
<?php $this->load->view('result/header') ?>
<br><br><br>
<div align="center" id = "content">
	<h2><b>Search by Profile</b></h2><br>
	<label>Faculty</label>
	<select class="col-sm-2 custom-select custom-select-sm" name="subjects" id="subjects">
            <option value = "">---Select Faculty---</option>
            <option value = "CSE">CSE</option>
            <option value = "Fisheries">Fisheries</option>
            <option value = "Agriculture">Agriculture</option>
            <option value = "NFS">NFS</option>
    </select>
    <br><br>

    <label>Profile</label>
    <select class="col-sm-2 custom-select custom-select-sm" name="profile" id="profile">
            <option value = "">---Select Profile---</option>
    </select> 
    <br><br>
    <input type="submit" id = "submitbtn" name = "submitbtn" value="Submit" class="btn btn-primary">
</div>
</body>

<script type="text/javascript">
	$(document).ready(function() {
		$('#subjects').change(function() {
			var faculty = $('#subjects').val();
			if(faculty != '') {
				$.ajax({
					url:"<?php echo base_url();?>/Result_Controller/fetch_profile_for_syllabus",
	        		type: "POST",
	        		data: {faculty:faculty},
	        		success:function(data)
	        		{
	        			$('#profile').html(data);
	        		}
				});
			}
			});
			
		$('#submitbtn').click(function() {
			var faculty = $('#subjects').val();
			var profile = $('#profile').find(':selected').text();
			//alert(profile);
			if(faculty == '' || profile == '---Select Profile---') {

				window.location.href('<?php echo base_url()?>/Result_Controller/syllabus_condition_faculty_controller');
				//alert('yo');
			}

			else {
			$.ajax({
				url:"<?php echo base_url();?>/Result_Controller/show_syllabus_controller",
        		type: "POST",
        		data: {faculty:faculty,profile:profile},
        		success:function(data)
        		{
        			$('#content').html(data);
        		}
			});
	}
		}); 
	});

</script>

</html>