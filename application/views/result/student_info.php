<!DOCTYPE html>
<html>
  <title>Student Information</title>
  <link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<head>
<body>
  <?php $this->load->view('result/header') ?>
  <br> <br>
  <div class="container" align="center">

    <?php echo form_open('Result_Controller/modified_session_list'); ?>
    <br>
  <input list="sessions" value="" name = "session" placeholder= "Give Session">
    <datalist id="sessions">
     <?php for($i = 0; $i < count($session_search); $i++) { ?>
        <option value="<?php echo $session_search[$i]; ?>"> 
    <?php } ?>
  </datalist>
  <input type="submit" value="Search">
  </form>

  <?php echo form_open('Result_Controller/modified_subject_list'); ?>
    <br>
  <input list="subjects" value="" name = "subject" placeholder= "Give Subject Name">
    <datalist id="subjects">
     <?php for($i = 0; $i < count($subject_search); $i++) { ?>
        <option value="<?php echo $subject_search[$i]; ?>"> 
    <?php } ?>
  </datalist>
  <input type="submit" value="Search">
  </form>

    <?php echo form_open('Result_Controller/modified_id_list'); ?>
    <br>
  <input type="text" name="id" placeholder="Give ID">
  <input type="submit" value="Search">
  </form>

    <?php echo form_open('Result_Controller/modified_name_list'); ?>
    <br>
  <input type="text" name="name" placeholder="Give Student Name">
  <input type="submit" value="Search">
  </form>


<br>
</div>

<div class = "container" align = "center">
	<table class="table table-striped">
  <thead>
  <tr>
    <th scope = "col">ID</th>
    <th scope = "col">Registration</th>
    <th scope = "col">Name</th>
    <th scope = "col">Session</th>
    <th scope = "col">Subject</th>
    <th scope = "col">Degree</th>
    <th scope = "col">Profile</th>
  </tr>
</thead>


  <?php foreach ($values as $value) : ?>
  <tbody>
  <tr>
  <td><?php echo $value['id'];  ?></td>
  <td><?php echo $value['registration']; ?></td>
  <td><?php echo $value['name']; ?></td>
  <td><?php echo $value['session']; ?></td>
  <td><?php echo $value['subject']; ?></td>
  <td><?php echo $value['degree']; ?></td>

 <td>
  <?php echo form_open('Result_Controller/syllabus_view_from_student_table_controller'); ?>
    <input type = "submit" name = "profile" value="<?php echo $value['profile']; ?>">
  </form>
  </td>

  <td>
  <?php echo form_open('Result_Controller/delete_student'); ?>
    <input type="hidden" name = "id" value = "<?php echo $value['id']; ?>">
    <input type="submit" value = "Delete">
  </form>
  </td>
</tr>
</tbody>
  <?php endforeach ?>
  </table>
  <?php echo form_open('Result_Controller/insert_student_new'); ?>
  <input type="submit" value="Insert">
</form>
<br><br><br><br>
</div>



<script src = "bootstrap/js/jquery.min.css"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>

</body>
<!--<?php// $this->load->view('result/footer') ?> -->
<script type="text/javascript">

  $(document).ready(function(){   

    $("#send").click(function()
    {       
     $.ajax({
         type: "POST",
         url: base_url + "Result_Controller/pre_syllabus", 
         data: {profile: $("#profile").val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
              //  console.log('worky');
                alert(data);  //as a debugging message.
              }
          });// you have missed this bracket
     return false;
 });
 });

</script>


</html>