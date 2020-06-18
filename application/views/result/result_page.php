<!DOCTYPE html>
<html>
<head>
  <title>Result Sheet</title>
  <link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">

  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
</head>


<body>
<?php echo form_open('Result_Controller/pdfdetails'); ?>
<?php $k = 0; $f = 0; ?>
<?php for($i = 0; $i < $num_of_rows; $i++) { ?>
   <?php $p = 0; $q = 0; ?>
   <div align = "left">
    <?php foreach($name as $value) : ?>
    <tr>
      <?php if($p == $i) { ?> <h5> Name: <?php echo $value['name'];  ?> </h5>
       <input type = "hidden" name = "names[]" value = "<?php echo $value['name']; ?>">
     <?php } ?>

      <?php $p++; ?>
    </tr>

    <?php endforeach ?>

    <?php foreach($reg as $values) : ?>
    
      <?php if($q == $i) { ?> <h5> Registration No. : <?php echo $values['registration']; ?> </h5>
      <input type = "hidden" name = "regs[]" value = "<?php echo $values['registration']; ?>">
    <?php } ?>
      <?php $q++; ?>
    
    <?php endforeach ?>

    </div>

  <div class = "container" align = "center">
    <table class = "table table-striped" border="2">
       <tr>
    <th>Code</th>
    <th>Subject</th>
    <th>Credit Hour</th>
    <th>Total Marks</th>
    <th>Letter Grade</th>
    <th>Grade Point</th>
    <th>GPA</th>
    <th>CGPA</th>
    <th>CCH</th>
    <th>PGPA</th>
    <th>PCGPA</th>
    <th>PCCH</th>
    <th>Remarks</th>
    </tr>

     <input type = "hidden" name = "temp_mark_size[]" value = "<?php echo $temp_mark_size[$i]; ?>">
    <input type = "hidden" name = "num_of_rows" value = "<?php echo $num_of_rows; ?>">


    <?php for( ; ; ) { ?>
            <?php if($temp_mark_size[$i] == 0) { break; }; ?>
          <tr>
          <td><?php echo $mark_lg_gpa_co_code[$f]['course_code']; ?></td>
          <td><?php echo $course_title_hour[$f]['course_title']; ?></td>
          <td><?php echo $course_title_hour[$f]['credit_hour']; ?></td>
          <td><?php echo $mark_lg_gpa_co_code[$f]['marks']; ?></td>
          <td><?php echo $mark_lg_gpa_co_code[$f]['letter_grade']; ?></td>
          <td><?php echo $mark_lg_gpa_co_code[$f]['grade_point']; ?></td>

         <input type = "hidden" name = "co_codes[]" value = "<?php echo $mark_lg_gpa_co_code[$f]['course_code']; ?>">
          <input type = "hidden" name = "marks[]" value = "<?php echo $mark_lg_gpa_co_code[$f]['marks']; ?>">
          <input type = "hidden" name = "lg[]" value = "<?php echo $mark_lg_gpa_co_code[$f]['letter_grade']; ?>">
          <input type = "hidden" name = "gp[]" value = "<?php echo $mark_lg_gpa_co_code[$f]['grade_point']; ?>">
          <input type = "hidden" name = "cre_hr[]" value = "<?php echo $course_title_hour[$f]['credit_hour']; ?>">
          <input type = "hidden" name = "co_title[]" value = "<?php echo $course_title_hour[$f]['course_title']; ?>">
                      
          <?php $f++; ?>

          <?php  
            $k++;
            if($k == $temp_mark_size[$i]) { $k = 0; break; }  

            continue;
          ?>
          </tr>

    <?php } ?>

          
          <?php if($i < $gpa_count) { ?>
          <td><?php echo $temp_gpa_cgpa_cch[$i]['gpa']; ?></td> 
          <td><?php echo $temp_gpa_cgpa_cch[$i]['cgpa']; ?></td> 
          <td><?php echo $temp_gpa_cgpa_cch[$i]['cch']; ?></td>
          <?php } ?>
          <?php if($i < $pgpa_count) { ?>
          <td><?php echo $temp_pgpa_pcgpa_pcch[$i]['gpa']; ?></td> 
          <td><?php echo $temp_pgpa_pcgpa_pcch[$i]['cgpa']; ?></td> 
          <td><?php echo $temp_pgpa_pcgpa_pcch[$i]['cch']; ?></td>
        <?php } ?>
          <td><?php $c = count($total_fail[$i]);
                  $s = $c; ?>

          <input type = "hidden" name = "save[]" value = "<?php echo $s; ?>">

              

              <?php if($c == 0) {
              if($req_num_of_rows[$i] == 0) {
                echo "";
              }
              else {
              echo "Passed";
                }
              }

                  else {
              ?>
             

            F in <?php for($m = 0; $m < count($total_fail[$i]);$m++) { ?>
                <input type = "hidden" name = "total_fail[]" value = "<?php echo $total_fail[$i][$m]['course_code']; ?>">
                         <?php  echo $total_fail[$i][$m]['course_code'];
                              if($m == count($total_fail[$i]) - 1) { break; }
                              echo ",";
              } 
              $c = 0;
            }
          ?></td>
          <?php if($i >= $gpa_count) { 
                $temp_gpa_cgpa_cch[$i]['gpa'] = NULL;
                $temp_gpa_cgpa_cch[$i]['cgpa'] = NULL;
                $temp_gpa_cgpa_cch[$i]['cch'] = NULL;
              }
            ?>
           <input type = "hidden" name = "gpa[]" value = "<?php echo $temp_gpa_cgpa_cch[$i]['gpa']; ?>">
        <input type = "hidden" name = "cgpa[]" value = "<?php echo $temp_gpa_cgpa_cch[$i]['cgpa']; ?>">
          <input type = "hidden" name = "cch[]" value = "<?php echo $temp_gpa_cgpa_cch[$i]['cch']; ?>">
        
          <?php if($i >= $pgpa_count) { 
                $temp_pgpa_pcgpa_pcch[$i]['gpa'] = NULL;
                $temp_pgpa_pcgpa_pcch[$i]['cgpa'] = NULL;
                $temp_pgpa_pcgpa_pcch[$i]['cch'] = NULL;
            ?>
          <?php } ?>
      <input type = "hidden" name = "pgpa[]" value = "<?php echo $temp_pgpa_pcgpa_pcch[$i]['gpa']; ?>">
    <input type = "hidden" name = "pcgpa[]" value = "<?php echo $temp_pgpa_pcgpa_pcch[$i]['cgpa']; ?>">
       <input type = "hidden" name = "pcch[]" value = "<?php echo $temp_pgpa_pcgpa_pcch[$i]['cch']; ?>">
     

    </table>

    <input type = "hidden" name = "session" value = "<?php echo $session; ?>">
 <input type = "hidden" name = "subject" value = "<?php echo $subject; ?>">
 <input type = "hidden" name = "semester" value = "<?php echo $semester; ?>" id = "semester">
 <input type = "hidden" name = "level" value = "<?php echo $level; ?>" id = "level">
  <input type = "hidden" name = "num_of_rows" value = "<?php echo $num_of_rows; ?>">

  </div>

 <?php } ?>

 <input type="submit" value = "Convert" name = "sub">
 <br><br><br><br><br>
 
</form>

<script src = "bootstrap/js/jquery.min.css"></script>
<script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>

<script>

</script>