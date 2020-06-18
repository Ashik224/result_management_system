<!DOCTYPE html>
<html>
<head>
	<title>Insert Marks</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
	<div class = "container" align = "center">
	<table class="table table-striped">
		<thread>
  <tr>
    <th>ID</th>
    <th>Registration</th>
    <th>Name</th>
    <th>Session</th>
    <th>Faculty</th>
    <th>Course Code</th>
    <th>Course Title</th>
    <th>Number</th>
  </tr>
</thread>

  <?php foreach ($values as $value) : ?>
  	<tbody>
  <tr>
  <td><?php echo $value['id'];  ?></td>
  <td><?php echo $value['registration'];  ?></td>
  <td><?php echo $value['name'];  ?></td>
  <td><?php echo $value['session'];  ?></td>
  <td><?php echo $value['faculty'];  ?></td>
  <td><?php echo $value['course_code'];  ?></td>
  <td><?php echo $value['course_title'];  ?></td>
  </tr>
</tbody>
  <?php endforeach ?>
</table>
</div>

<script src = "bootstrap/js/jquery.min.css"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>