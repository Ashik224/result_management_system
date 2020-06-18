<!DOCTYPE html>
<html>
<head>
	<title>Search response for displaying result.</title>
</head>
<body>
	<br> <br>
	<div align = "center">
		<?php foreach ($get_id_name_reg as $value) : ?>
		<p value = "">Reg :  <?php echo $value['registration']; ?></p>
		<p value = "">Name :  <?php echo $value['name']; ?></p>
		<p value = "">ID :  <?php echo $value['id']; ?></p>
	<?php endforeach ?>
		<table border="1">
			<tr>
			<th>Course Code</th>
			<th>Course Title</th>
			<th>Credit Hour</th>
			<th>GPA</th>
			</tr>

			<?php foreach ($get_course_code_title_credit as $roll) : ?>
			
				
			<tr>
				<td> <?php echo $roll['course_code']; ?>  </td>
				<td> <?php echo $roll['course_title']; ?>  </td>
				<td> <?php echo $roll['credit_hour']; ?>  </td>
				<?php foreach ($get_gpa as $lol) : ?>
					<td> <?php echo $lol['gpa']; ?>  </td>
				<?php endforeach ?>

				<?php foreach ($get_student_marks as $lolo) : ?>
					<td> <?php echo $lolo['marks']; ?>  </td>
				<?php endforeach ?>

			</tr>
			
			<?php endforeach ?>
			
		</table>
	</div>
</body>
</html>