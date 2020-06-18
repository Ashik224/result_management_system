<!DOCTYPE html>
<html>
<head>
	<title>Syllabus view from student table</title>
</head>
<body>
	<div class = "container" align="center">
	<table border = 1>
		<tr>
		<th>Profile</th>
		<th>Semester</th>
		<th>Level</th>
		<th>Course Code</th>
		<th>Course Title</th>
		<th>Credit Hour</th>
		<th>Subject</th>
		<th>Degree</th>
	</tr>

	<?php	foreach($all_data_for_this_profile as $value) : ?>
	<tr>
		<td><?php echo $value['profile']; ?></td>
		<td><?php echo $value['semester']; ?></td>
		<td><?php echo $value['level']; ?></td>
		<td><?php echo $value['course_code']; ?></td>
		<td><?php echo $value['course_title']; ?></td>
		<td><?php echo $value['credit_hour']; ?></td>
		<td><?php echo $value['subject']; ?></td>
		<td><?php echo $value['degree']; ?></td>
	</tr>
	<?php endforeach ?>
	</table>
	</div>
</body>
</html>