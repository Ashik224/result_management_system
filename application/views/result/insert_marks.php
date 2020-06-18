<!DOCTYPE html>
<html>
<head>
	<title>Marks Insertion</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>"> 

  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
</head>
<body>
<!--<?php// $this->load->view('result/header') ?> -->

<div class = "container" align = "center">
  <br>
  <div id = "content" class="container" align="center">
  <input id="fileUpload" type=file   accept="" name="files[]" size="30">
  <input type = "button" class="btn btn-primary" align="left" name = "pdf" value="Parse Excel" onclick="handle_excel(event)" id = "button">
</div> <br><br>

	<table  class = "table table-striped">
  <thread>
  <tr>
    <th width = "40%">ID</th>
    <th width="40%">Marks</th>
    <th width="5%">Repeat</th>
    <th width="15%"></th>
  </tr>
</thread>

<tbody>
  <tr>
    <?php $j = 0; ?>
    <?php $temp = 0; ?>
  <!-- <?php// foreach ($id as $value) : ?> -->
    <?php for($k = 0; $k < $total_students; $k++) { ?>

  <td width = "40%"> <?php echo $id[$k]['id'];  ?> </td>
  <input type = "hidden" name="id[]" value = "<?php echo $id[$k]['id']; ?>" id = "hello">
  <input type="hidden" name="session" value = "<?php echo $id[$k]['session'];  ?>">
  <input type="hidden" name="subject" value = "<?php echo $id[$k]['subject'];  ?>">

  <?php foreach ($profile as $values) : ?>
  
  <input type="hidden" name="profile[]" value = "<?php echo $values['profile'];  ?>">

 

 <?php endforeach ?>
  


  <?php foreach ($co_code_sem_lev as $val) : ?>
  
  <input type="hidden" name="semester" value = "<?php echo $val['semester'];  ?>" id = "semester">
<!--  <input type="hidden" name="level" value = "<?php// echo $val['level'];  ?>" id = "level"> -->
  <input type="hidden" name="course_code" value = "<?php echo $val['course_code'];  ?>" id = "co_code">
  <input type="hidden" name="cre_hour" value = "<?php echo $val['credit_hour'];  ?>" id = "cre_hr">
  
 <!-- <input type="hidden" name="cre" value = "cre" id = "cre"> -->


 <?php endforeach ?>

 <?php foreach ($active_session as $session) : ?>

    <input type="hidden" name="active_session[]" value = "<?php echo $session['active_session'];  ?>" id = "active_session">

  <?php endforeach ?>

  <td width = "40%"> 
     <?php 
      if($j >= $total_elements && $total_elements > 0) {
        $j = $total_elements - 1;
        $mark[$j]['marks'] = NULL;
      }
      else if($total_elements == 0) {
          if($j != 0) {$j = 0;}
          $mark[$j]['marks'] = NULL;
        }
        ?>   

      <input type="text" name="mark[]" id = "<?php echo $id[$k]['id'] ?>" value = "<?php echo $mark[$j]['marks']; ?>">
    
  
  
  </td>

      <td width = "5%">
        <?php 
      if($j >= $total_elements && $total_elements > 0) {
        $j = $total_elements - 1;
        $repeat_course[$j]['repeat_course'] = NULL;
      }
      else if($total_elements == 0) {
          if($j != 0) {$j = 0;}
          $repeat_course[$j]['repeat_course'] = NULL;
        }
        ?>
     <input type="checkbox" name="check[]" class = "checking" id = "active_banner" value = "<?php echo $id[$k]['id'];?>" <?php if($repeat_course[$j]['repeat_course'] == 1) { ?>  checked = "checked" <?php } ?>> 
     </td>
   
     <td width="15%">
     <button style="margin-left: 32px" class="btn btn-secondary" name = "update" value = "<?php echo $mark[$j]['marks']; ?>" id = "<?php echo $id[$k]['id']; ?>">Update</button>
     </td>

</tr>
  <?php $j++; $temp++; ?>
<?php } ?>
   <!-- <?php// endforeach ?> -->
</tbody>  

</table>
  <!-- <input type = "file" name = "file"> -->
  
<!--  <input type = "button" name = "submit_button" value="CONV" id = "hellow"> -->

   

  <button id = "submit_button" class="btn btn-success" value="" onclick="" align = "center" disabled="disabled">Submit</button> <br><br>

  


 <!-- <input type = "submit" name = "hii" value="yoo"> -->

<!--   <input type = "submit" name = "pdf" value="Submit" onclick="handle_excel(event)"> --> 
<!--   <input type = "submit" name = "pdf" value="Convert to PDF" onclick="handle_excel(event)"> -->
   
	
<!-- </form> --> 


<div id="dvExcel"></div>

</div>
 <form action = "<?php echo base_url();?>/Result_Controller/convert_to_pdf" method = "post"> 
    <?php $j = 0; ?>
      <?php for($k = 0; $k < $total_students; $k++) { ?>
      <?php 
      if($j >= $total_elements && $total_elements > 0) {
        $j = $total_elements - 1;
        $mark[$j]['marks'] = NULL;
      }
      else if($total_elements == 0) {
          if($j > 0) {$j = 0;}
          $mark[$j]['marks'] = NULL;
        }
        ?>
        <input type="hidden" name = "pdf_id[]" value="<?php echo $id[$k]['id']; ?>">
        <input type="hidden" name="pdf_mark[]" value="<?php echo $mark[$j]['marks']; ?>">
        <?php $j++; ?>
      <?php } ?>

     <?php foreach ($co_code_sem_lev as $val) : ?>  
  <input type="hidden" name="semester" value = "<?php echo $val['semester'];  ?>" id = "semester">
  <input type="hidden" name="level" value = "<?php echo $val['level'];  ?>" id = "level"> 
  <input type="hidden" name="course_code" value = "<?php echo $val['course_code'];  ?>" id = "co_code">
  <input type="hidden" name="cre_hour" value = "<?php echo $val['credit_hour'];  ?>" id = "cre_hr">
 <?php endforeach ?>

          <input type="submit" name="pdf_convert" value = "Convert to PDF" class="btn btn-danger"> 
 </form> 
<br><br><br><br><br><br>

<script src = "bootstrap/js/jquery.min.css"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>



<script>

   $('input:text').keyup(function() {

        var empty = false;
        $('input:text').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#submit_button').attr('disabled', 'disabled');
        } else {
            $('#submit_button').removeAttr('disabled');
        }
    });




  $('body').on('click', 'button', function(e) {
        req_id = e.target.id;
        var level = $('#level').val();
        var semester = $('#semester').val();
        var credit_hour = $('#cre_hr').val();
        var co_code = $('#co_code').val();
        var credit_hour = $('#cre_hr').val();
        var req_mark = 0;

        var id_for_update = [];
        var mark_for_update = [];
        var i = 0;

        $('input:text').each(function(){                
              var temp_mark = $(this).val();
              var temp_id = $(this).attr('id');

              if(req_id == temp_id) {
                req_mark = temp_mark;
              }
             

              mark_for_update[i] = temp_mark;
              id_for_update[i] = temp_id;
              i += 1; 
        });  

         check = [];
         var f = 0;
         var req_check = 0;
         $("input:checkbox").each(function() {
            var active = $(this).is(":checked");
            if(active == true) { check[f] = 1; }
            else { check[f] = 0; }
            var temp_check = $(this).val();
            if(req_id == temp_check) {
              req_check = check[f];
            }
           f += 1;
          });   
        //  var req_check  = 0;
        
  $.ajax({
    url: "<?php echo base_url();?>/Result_Controller/get_mark",
    type: 'POST',
    data: {req_id:req_id,co_code:co_code,level:level,semester:semester,credit_hour:credit_hour,id_for_update:id_for_update,mark_for_update:mark_for_update,req_mark:req_mark,check:check,req_check:req_check},
    dataType: 'html',    
    success: function(data) {
      $('#content').html(data);
    } 
 });

   }); 

function handle_excel() {
  var fileUpload = document.getElementById("fileUpload");
  var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;


  if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
 
                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (event) {
                        ProcessExcel(event.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (event) {
                        var data = "";
                        var bytes = new Uint8Array(event.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }
    };


    function ProcessExcel(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
 
        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
 
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

        var id = [];
        var marks = [];
        var repeat_course = [];
        var p = 0;
 
        //Add the data rows from Excel file.
        for (var i = 0; i < excelRows.length; i++) {
            id[i] = excelRows[i].ID;
            if(id[i] == undefined) {
              alert('Invalid Excel File');
              p++; 
              break;
            }
            marks[i] = excelRows[i].Marks;
            if(marks[i] == undefined) {
              alert('Invalid Excel File');
              p++; 
              break;
            }
            repeat_course[i] = excelRows[i].Repeat_Course;
            if(repeat_course[i] == undefined) {
              alert('Invalid Excel File');
              p++; 
              break;
            }

        }
        if(p == 0) {
          p = 0;
  var level = $('#level').val();
  var semester = $('#semester').val();
  var course_code = $('#co_code').val();
  var credit_hour = $('#cre_hr').val();

  $.ajax({
    url: "<?php echo base_url();?>/Result_Controller/parse_excel",
    type: 'POST',
    data: {id:id,marks:marks,repeat_course:repeat_course,level:level,semester:semester,course_code:course_code,credit_hour:credit_hour},
    dataType: 'html',    
    success: function(data) {
      $('#content').html(data);
    }   
 });
}

    };

</script>

