<!DOCTYPE html>
<html>
<head>
	<title>Conditoinal Syllabus</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
	<div class = "container" align = "center">
	<table class="table table-striped">
		<thread>
  <tr>
    <th scope = "col">Semester</th>
    <th scope = "col">Level</th>
    <th scope = "col">Course Code</th>
    <th scope = "col">Course Title</th>
    <th scope = "col">Credit Hour</th>
    <th scope = "col">Subject</th>
    <th scope = "col">Degree</th>
  </tr>
</thread>

   <?php foreach ($values as $value) : ?>
   	<tbody>
  <tr>
  <td><?php echo $value['profile']; ?></td>
  <td><?php echo $value['level']; ?></td>
  <td><?php echo $value['course_code']; ?></td>
  <td><?php echo $value['course_title']; ?></td>
  <td><?php echo $value['credit_hour']; ?></td>
  <td><?php echo $value['subject']; ?></td>
  <td><?php echo $value['degree']; ?></td>
</tr>
</tbody>
  <?php endforeach ?>
</table>
</div>

<script src = "bootstrap/js/jquery.min.css"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>