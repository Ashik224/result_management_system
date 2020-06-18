<!DOCTYPE html>
<html>
<head>
	<title>Insert Syllabus</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
	<div class="container" align = "center">
		<?php echo form_open('Result_Controller/get_to_syllabus'); ?>
		<br><br>
  <div class="col-sm-2">
    <label>Profile</label>
    <input type="text" class="form-control" name = "profile" placeholder="Add Profile">
</div>
<br>

	<div class="col-sm-2">
    <label>Semester</label>
    <input type="text" class="form-control" name = "semester" placeholder="Add Semester">
</div>
<br>
<div class="col-sm-2">
    <label>Level</label>
    <input type="text" class="form-control" name = "level" placeholder="Add Level">
</div>
<br>
<div class="col-sm-2">
    <label>Course Code</label>
    <input type="text" class="form-control" name = "course_code" placeholder="Add Couse Code">
</div>
<br>
<div class="col-sm-2">
    <label>Course Title</label>
    <input type="text" class="form-control" name = "course_title" placeholder="Add Course Title">
  </div>
<br>
  <div class="col-sm-2">
    <label>Credit Hour</label>
    <input type="text" class="form-control" name = "credit_hour" placeholder="Add Credit Hour">
  </div>
<br>
  <div class="col-sm-2">
    <label>Subject</label>
    <input type="text" class="form-control" name = "subject" placeholder="Add Subject">
  </div>
<br>
  <div class="col-sm-2">
    <label>Degree</label>
    <input type="text" class="form-control" name = "degree" placeholder="Add Degree">
  </div>  
 <br>
  <button type="submit" class="btn btn-primary">Insert</button>
</form>
</div>


<script src = "bootstrap/js/jquery.min.css"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>