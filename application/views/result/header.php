<!DOCTYPE html>
<html>
<head>
	
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>">
  <script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
 <!-- <script type = "text/javascript" src="<?php// echo base_url('/js/jquery-3.js') ?>"> </script> -->
</head>
<style type="text/css">


.topnav {
  background-color: #57B6F7;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  font-family: arial;
}

.topnav input[type="submit"] {
  float: left;
  color: #f2f2f2;
  background-color: #57B6F7;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  font-family: arial;
}


/* Change the color of links on hover */
.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #1E1E1E;
  color: white;
}
	


* {box-sizing:border-box}
 

.slideshow-container {
  max-width: 1100px;
  position: relative;
  margin: auto;
}


.mySlides {
  display: none;
}


.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}


.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}


.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}


.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}


.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}


.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}


.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

h1 {
	font-size: 50px;
}  


.header {
  padding: 5px;
  text-align: center;
 /* background: #661E1E; */
 background: #93132D;
  color: white;
  font-size: 20px;
}
 

.navbar {
  overflow: hidden;
  background-color: red;
 /* font-family: Arial; */
}

/* Links inside the navbar */
.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown button */ 
.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: arial;  
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
} 

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content input[type=submit] {
  float: none;
  color: black;
  padding: 14px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.topnav input[type="submit"]:hover {
  background-color: #ddd;
  color: black;
}

</style>
<body>
<div class="header">
<h1><img align = "top" src = "<?php echo base_url();?>/images/logo_transparent.png" alt = "logo" width="80" height="90"/> <b> PSTU RESULT MANAGEMENT SYSTEM </b> </h1>
</div>




<div class="topnav">
	<a class="active" href="<?php echo base_url();?>Result_Controller/index">Home</a>

    <a href="<?php echo base_url();?>Result_Controller/syllabus_condition_faculty_controller">View Syllabus</a>  

      <a href="<?php echo base_url();?>Result_Controller/assign_syllabus">Assign Syllabus</a>
 

   <form action = "<?php echo base_url();?>/Result_Controller/student" method = "post"> 
      <?php foreach($all_session as $value) : ?>
      <input type = "hidden" name = "session_val[]" value = "<?php echo $value['session']; ?>" 
      class = "users" id = "my">
      <?php endforeach ?>
      
      <?php foreach($all_subject as $value) : ?>
      <input type = "hidden" name = "subject_val[]" value = "<?php echo $value['subject']; ?>">
      <?php endforeach ?>

    <input type="submit" class = "student" value = "Student" style="border:none;padding: 14px 16px;"> 
    </form> 
  
  <a href="<?php echo base_url();?>Result_Controller/marks">Insert Marks</a>
  <a href="<?php echo base_url();?>Result_Controller/view_result_controller">View Result</a>
  <!--  <a href="<?php// echo base_url();?>Result_Controller/login_page">Login</a> -->
</div>

  <script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>



</body>

<script type="text/javascript"> 

  var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}	

</script>

</html>