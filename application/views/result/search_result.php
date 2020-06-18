<!DOCTYPE html>
<html>
<head>
	<title>Search the result</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
	<div class = "container" align="center">
	<?php echo form_open('Result_Controller/get_result'); ?>
		<br>
	  <div class="col-sm-2">
	    <label>ID: </label>
	    <input type="text" class="form-control" name = "id" placeholder="Add ID">
	</div>
	<br>

	<label>Session: </label>
  	<input list="sessions" value="" name = "session" class="col-sm-2 custom-select custom-select-sm">
    <datalist id="sessions">
    <option value="2015-16">
  </datalist>
	<br> <br>

	<label>Semester: </label>
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
	<br>

	<input type="submit" value="Submit">
</form>
</div>
</body>
</html>