<!DOCTYPE html>
<html>
<head>
	<title>Search Condition for getting individual student result</title>
</head>
<body>
	<br> <br>
	<div class = "container" align="center">
	 <?php echo form_open('Result_Controller/search_response_for_displaying_result_controller'); ?>
    <br>
    <label>Subject</label>
  <input list="subjects" value="" name = "subject" class="col-sm-2 custom-select custom-select-sm">
    <datalist id="subjects">
    <option value="CSE">
  </datalist>
  <br><br>

    <label>ID</label>
  <input type="text" name = "id" class="">
  <br><br>

   <label>Session</label>
  <input list="sessions" value="" name = "session" class="col-sm-2 custom-select custom-select-sm">
    <datalist id="sessions">
    <option value="2015-16">
  </datalist>
  <br><br>

  <label>Semester</label>
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
</div>
</body>
</html>