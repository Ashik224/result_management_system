<!DOCTYPE html>
<html>
<head>
	<title>Show Syllabus</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>"> 

  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
</head>

<body>
	<h2> <b> Syllabus List </b> </h2>
	<?php $semester = 1; ?>
	<?php for($i = 2; $i <= 9; $i++) { ?> 
	<?php $level = floor($i / 2); ?>
	<div class="container" align="left">
	<h5>Level: <?php echo $level; ?> </h5> 
	<h5>Semester: <?php echo $semester; ?> </h5> <br>
	</div>
<div class="container">
<table class = "table table-striped" border="2">
<tr>
	<th> Course Code </th>
	<th> Course Title </th>
	<th> Credit Hour </th>
	<th> Degree </th>
</tr>
	<?php foreach($all_from_syllabus as $value) :  ?>
	 <?php if(($value['level'] == $level) && ($value['semester'] == $semester)) {   ?>
<tr>
	 <td>
	<?php echo $value['course_code']; ?>
	</td>

	<td>
	<?php echo $value['course_title']; ?>
	</td>

	<td>
	<?php echo $value['credit_hour']; ?>
	</td>

	<td>
	<?php echo $value['degree']; ?>
	</td>
</tr>
	<?php } ?>
	<?php endforeach; ?>

	<?php	if($semester == 1) {$semester = 2;}
		else if($semester == 2) {$semester = 1;}
	?>
</table>
<br>
</div>

	<?php } ?>
</body>