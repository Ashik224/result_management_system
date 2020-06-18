<!DOCTYPE html>
<html>
<head>
	<title>Course Choice</title>
</head>
<body>
	<br>
	<div class = "container" align = "center">
		
	<?php echo form_open('Result_Controller/mark_insert'); ?>

	<?php foreach ($profile_session as $value) : ?>
  <input type = "hidden" name = "session[]" value="<?php echo $value['session']; ?>">
  <?php endforeach ?>
  <br><br>

 <!-- <input type = "hidden" name = "sem" value="<?php// echo $va['semester']; ?>">  -->

	<label>Select Course Code</label>
  <input list="course_codes" value="" name = "course_code" class="col-sm-2 custom-select custom-select-sm">
  
	<select class="col-sm-2 custom-select custom-select-sm">
	<?php foreach ($co_code_lev_sem as $value) : ?>
    <option value="<?php echo $value['course_code']; ?>"> <?php echo $value['course_code']; ?> </option>
    	<?php endforeach ?>
    </select>
  <br><br>
  <?php foreach ($co_code_lev_sem as $value) : ?>
  <input type = "hidden" name = "level[]" value = "<?php echo $value['level']; ?>">
 
	 <?php endforeach ?>
  
  <?php foreach ($co_code_lev_sem as $value) : ?>
  	<input type = "hidden" name = "semester[]" value = "<?php echo $value['semester']; ?>">
  	<?php endforeach ?>
  <input type="submit" value="Submit">
  
</form>
 
</div>

</body>
</html>