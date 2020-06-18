<!DOCTYPE html>
<html>
<head>
	<title>Syllabus</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
  <?php $this->load->view('result/header') ?>
	<div class = "container" align = "center">
	<table class="table table-striped">
	<thread>
  <tr>
    <th scope = "col">Profile</th>
    <th scope = "col">Semester</th>
    <th scope = "col">Level</th>
    <th scope = "col">Course Code</th>
    <th scope = "col">Course Title</th>
    <th scope = "col">Credit Hour</th>
    <th scope = "col">Subject</th>
    <th scope = "col">Degree</th>
    <th scope = "col"></th>
  </tr>
</thread>

  <?php foreach ($values as $value) : ?>
  <tbody>
  <tr>
  <td><?php echo $value['profile'];  ?></td>
  <td><?php echo $value['semester']; ?></td>
  <td><?php echo $value['level']; ?></td>
  <td><?php echo $value['course_code']; ?></td>
  <td><?php echo $value['course_title']; ?></td>
  <td><?php echo $value['credit_hour']; ?></td>
  <td><?php echo $value['subject']; ?></td>
  <td><?php echo $value['degree']; ?></td>
  <td>
  	<?php echo form_open('Result_Controller/delete_course'); ?>
  	<input type="hidden" name = "course_code" value = "<?php echo $value['course_code']; ?>">
  	<input type="submit" value = "Delete">
  </form>
  </td>
</tr>
</tbody>
  <?php endforeach ?>
</table>
	<?php echo form_open('Result_Controller/insert_syllabus'); ?>
	<input type="submit" value="Insert">
</form>
<br><br><br><br>
</div>
<?php $this->load->view('result/footer');?>

<script src = "bootstrap/js/jquery.min.css"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>