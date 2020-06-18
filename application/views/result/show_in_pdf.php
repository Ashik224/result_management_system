<!DOCTYPE html>
<html>
<head>
  <title>Result Sheet</title>
  <link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">

  <script type = "text/javascript" src="<?php echo base_url('/js/jquery-3.js') ?>" > </script>
</head>

<body>
  <?php $k = 0; $f = 0; ?>
 <?php for($i = 0; $i < $num_of_rows; $i++) { ?>
 <?php $p = 0; $q = 0; ?>

<div align = "left">
  <?php foreach($name as $value) : ?>

      <?php if($p == $i) { ?> <h2> Name: <?php echo $value['name']; } ?> </h2>
      <?php $p++; ?>
  <?php endforeach ?>

  <?php foreach($reg as $values) : ?>
    
      <?php if($q == $i) { ?> <h2> Registration No. : <?php echo $values['registration']; } ?> </h2>
      <?php $q++; ?>
    
    <?php endforeach ?>
  </div>
   
   <div class = "container" align = "center">
   <table class = "table table-striped" border="2" width = "100%" cellspacing="5" cellpadding="5">

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

    </tr>

    <?php for( ; ; ) { ?>
        <?php if($temp_mark_size == 0) break; ?>
      <tr>
          <td><?php echo $mark_lg_gpa_co_code[$f]['course_code']; ?></td>
          <td><?php echo $course_title_hour[$f]['course_title']; ?></td>
          <td><?php echo $course_title_hour[$f]['credit_hour']; ?></td>
          <td><?php echo $mark_lg_gpa_co_code[$f]['marks']; ?></td>
          <td><?php echo $mark_lg_gpa_co_code[$f]['letter_grade']; ?></td>
          <td><?php echo $mark_lg_gpa_co_code[$f]['grade_point']; ?></td>  
          
          <?php $f++; ?>

          <?php $k++; 
            if($k == $temp_mark_size) { $k = 0; break; }
            continue;
          ?>

          </tr>

    <?php } ?>

    <td><?php echo $temp_gpa_cgpa_cch[$i]['gpa']; ?></td> 
    <td><?php echo $temp_gpa_cgpa_cch[$i]['cgpa']; ?></td> 
    <td><?php echo $temp_gpa_cgpa_cch[$i]['cch']; ?></td>

    <td><?php echo $temp_pgpa_pcgpa_pcch[$i]['gpa']; ?></td> 
    <td><?php echo $temp_pgpa_pcgpa_pcch[$i]['cgpa']; ?></td> 
    <td><?php echo $temp_pgpa_pcgpa_pcch[$i]['cch']; ?></td>

  </table>
</div>

 <?php } ?>

</body>
</html>