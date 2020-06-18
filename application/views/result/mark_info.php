<!DOCTYPE html>
<html>
<head>
	<title>Insert Condition for Mark</title>
	


</head>
<body>
<?php $this->load->view('result/header') ?>
	<div id = "content" class = "container" align = "center">
    <br>
    <h2><b> Insert Marks </b> </h2>
    <br>
    <label>Subject</label>
    <select class="col-sm-2 custom-select custom-select-sm" name="subjects" id="subjects">
            <option value = "">Select Subject</option>
            <option value = "CSE">CSE</option>
            <option value = "Fisheries">Fisheries</option>
            <option value = "Agriculture">Agriculture</option>
            <option value = "NFS">NFS</option>
    </select>
  <br><br>

  <label>Degree</label>
    <select class="col-sm-2 custom-select custom-select-sm" name="degree" id="degree">
            <option value = "">Select Degree</option>
            <option value = "B.Sc">B.Sc</option>
    </select>
    <br><br>

  <label>Semester</label>
    <select class="col-sm-2 custom-select custom-select-sm" name="semester" id="semester">
            <option value = "">Select Semester</option>
            <option value = "1">1</option>
            <option value = "2">2</option>
            <option value = "3">3</option>
            <option value = "4">4</option>
            <option value = "5">5</option>
            <option value = "6">6</option>
            <option value = "7">7</option>
            <option value = "8">8</option>
    </select>
  <br><br>

   <label>Session</label>
    <select class="col-sm-2 custom-select custom-select-sm" name="session" id="session">
            <option value = "">Select Session</option>
    </select>
    <br><br>

    <label>Course Code</label>
    <select class="col-sm-2 custom-select custom-select-sm" name="course" id="course">
            <option value = "">Select Course Code</option>
    </select>
    <br><br>

 <input type="submit" id = "submitbtn" name = "submitbtn" value="Submit" class="btn btn-primary">
</div>
   <?php $this->load->view('result/footer'); ?>
  <script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
<script src = "bootstrap/js/jquery.min.css"></script>
</body>
</html>


<script>
  
$(document).ready(function() {

  $('#subjects').change(function() {

    var subject = $('#subjects').val();
    var semester = $('#semester').val();
    var session = $('#session').find(":selected").text();
    
    if(subject != '')
    {
      $.ajax({
        url:"<?php echo base_url();?>/Result_Controller/fetch_session",
        type: "POST",
        //datatype: "html",
        data:{subject:subject},
        success:function(data)
        {
           $('#session').html(data);
        }
      })

    }

     if(subject != '' && semester != '' && session != '')
     {
      $.ajax({
        url:"<?php echo base_url();?>/Result_Controller/fetch_course_code",
        type: "POST",
        data:{subject:subject,session:session,semester:semester},
        success:function(data)
        {
           $('#course').html(data);
        }
      })

    }   

  });

   $('#semester').change(function() {
    var semester = $('#semester').val();
    var session = $('#session').find(":selected").text(); 
    var subject = $('#subjects').val();
   // alert(session);
     if(subject != '' && semester != '' && session != '')
     {
      $.ajax({
        url:"<?php echo base_url();?>/Result_Controller/fetch_course_code",
        type: "POST",
        //datatype: "html",
        data:{subject:subject,session:session,semester:semester},
        success:function(data)
        {
           $('#course').html(data);
        }
      })

    } 

  });

  $('#session').change(function() {
    var session = $('#session').find(":selected").text();
    var semester = $('#semester').val();
    var subject = $('#subjects').val();

     if(subject != '' && semester != '' && session != '')
     {
      $.ajax({
        url:"<?php echo base_url();?>/Result_Controller/fetch_course_code",
        type: "POST",
        //datatype: "html",
        data:{subject:subject,session:session,semester:semester},
        success:function(data)
        {
           $('#course').html(data);
           //  alert('He');
        }
      })

    } 
  });

  $('#course').change(function() {
    var course_code = $('#course').find(":selected").text();
  });  

  $('#submitbtn').click(function() {

    var subject = $('#subjects').val();
    var semester = $('#semester').val();
    var session = $('#session').find(":selected").text();
    var course_code = $('#course').find(":selected").text();
   // alert(course_code);

  if(subject != '' && semester != '' && session != 'Select Session' && course_code != 'Select Course Code') {

    $.ajax({
        url:"<?php echo base_url();?>/Result_Controller/get_courses",
        type: "POST",
        datatype: "html",
        data:{subject:subject,semester:semester,session:session,course_code:course_code},
        success:function(data)
        {
            $('#content').html(data);
        }

      })
  }

  });

});


</script>