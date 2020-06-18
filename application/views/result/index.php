<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel = "stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
	<script src = "<?php echo base_url('bootstrap/js/jquery.min.css'); ?>"></script>
	
	<style>

* {box-sizing:border-box}
 
/* Slideshow container */
.slideshow-container {
  max-width: 1100px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
} 

.card {
	display: inline-block;
}




/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */


.active {
  background-color: #717171;
}

/* Fading animation */
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

	</style>
</head>
<body style="background-color: grey">

	<?php $this->load->view('result/header') ?>

	<div class="slideshow-container">
  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 4</div>
    <img src="<?php echo base_url();?>/images/pstu_8.jpg" style="width:100%" height = "500">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 4</div>
    <img src="<?php echo base_url();?>/images/pstu_7.jpg" style="width:100%" height = "500">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 4</div>
    <img src="<?php echo base_url();?>/images/pstu_9.jpg" style="width:100%" height = "500">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">4 / 4</div>
    <img src="<?php echo base_url();?>/images/pstu_10.jpg" style="width:100%" height = "500">
  </div>


</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>
<br><br>



<div class="card" style = "width:300px; margin-left: 100px; background-color: #93132D;color: white;display: inline-block;">
  	<div class="card-header" style="visibility: hidden;">Hello</div>
    <div class="card-body">
    	<p> Number of Faculties : 9 </p>
    <!--	<p> Number of Students: <?php //echo $all_student; ?> </p> -->
      <p> Number of Students: 4500 </p>
    	<p> Number of Gold Medalist : 40 </p>
    	<p> Passing Rate : 80% </p>
    	<p> Number of Faculty Members: 120 </p>
     </div>
    </div>

<div class="card" style = "width:300px; margin-left: 100px; background-color: #93132D;color: white;display: inline-block;">
    
    	<div class="card-header">Total Dean's Merit</div>
    	<div class="card-body">
    	<p> CSE : 6</p>
    	<p> Agriculture : 20</p>
    	<p> Fisheries : 15</p>
    	<p> NFS : 18</p>
    	<p> DM : 25</p> 	
     </div>
  </div>

  <div class="card" style = "width:300px; margin-left: 100px; background-color: #93132D;color: white;display: inline-block;">
  	<div class="card-header">Total Dean's Merit</div>
    <div class="card-body">
    	<p> DVM : 16</p>
    	<p> Animal Husbandry : 12</p>
    	<p> Land Management : 16</p>
    	<p> BAM : 8</p>
     </div>
    </div>

    

<br><br><br><br>
  <?php $this->load->view('result/footer');?>


  <script src = "<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>

<script type="text/javascript">

var slideIndex = 0;
showSlides();

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

   for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000);
}

</script>
</body>
</html>