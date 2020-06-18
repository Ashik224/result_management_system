<!DOCTYPE html>
<html>
<head>
	<title>Grade Conditions</title>
</head>
<body>
	<div class = "container" align="center">
	<?php echo form_open('Result_Controller/total_grade'); ?>

	<label>Select Subject</label>
  <input list="subjects" value="" name = "subject" class="col-sm-2 custom-select custom-select-sm">
  
	<datalist id="subjects">
    <option value="CSE">
  </datalist>
  <br><br>

  <label>Select Degree</label>
  <input list="degrees" value="" name = "degree" class="col-sm-2 custom-select custom-select-sm">
  
	<datalist id="degrees">
    <option value="B.Sc">
  </datalist>
  <br><br>

  <label>Select Session</label>
  <input list="sessions" value="" name = "session" class="col-sm-2 custom-select custom-select-sm">
  
	<datalist id="sessions">
    <option value="2015-16">
  </datalist>
  <br><br>

  <label>Select Semester</label>
  <input list="semesters" value="" name = "semester" class="col-sm-2 custom-select custom-select-sm">
  
	<datalist id="semesters">
    <option value="1">
    <option value="2">
    <option value="3">
    <option value="4">
    <option value="5">
    <option value="6">
    <option value="7">
    <option value="8">
  </datalist>
  <br><br>
  <input type="submit" value="Submit">
</body>
</html>