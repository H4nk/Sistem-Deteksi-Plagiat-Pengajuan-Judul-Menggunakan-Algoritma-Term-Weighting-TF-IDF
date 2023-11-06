<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from resptheme.com/tf/asiapp/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jan 2020 12:42:37 GMT -->
<head>
<meta charset="UTF-8">
<title>Asiapp - Shop & Medical Mobile Template </title> 
<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="HandheldFriendly" content="True">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- CSS  -->
<link rel="stylesheet" href="<?= base_url('mobile');?>/lib/font-awesome/web-fonts-with-css/css/fontawesome-all.css">
<link rel="stylesheet" href="<?= base_url('mobile');?>/css/materialize.min.css">
<link rel="stylesheet" href="<?= base_url('mobile');?>/css/normalize.css">
<link rel="stylesheet" href="<?= base_url('mobile');?>/css/style.css">
<!-- materialize icon -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Owl carousel -->
<link rel="stylesheet" href="<?= base_url('mobile');?>/lib/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?= base_url('mobile');?>/lib/owlcarousel/assets/owl.theme.default.min.css">
<!-- Slick CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url('mobile');?>/lib/slick/slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('mobile');?>/lib/slick/slick/slick-theme.css">
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?= base_url('mobile');?>/lib/Magnific-Popup-master/dist/magnific-popup.css">
</head>
<body id="homepage">
<!-- BEGIN PRELOADING 
<div class="preloading">
  <div class="wrap-preload">
    <div class="cssload-loader"></div>
  </div>
</div>
-->
<!-- END PRELOADING -->
<!-- HEADER -->
<?php $this->load->view('mobile/header');?>


<nav>

<!-- LEFT SIDENAV-->
<?php $this->load->view('mobile/left');?>



</nav>
<!-- END SIDENAV-->
<!-- MAIN SLIDER -->


<?php $this->load->view('mobile/'.$view.'');?>
<?php $this->load->view('mobile/footer');?>

<script src="<?= base_url('mobile');?>/js/jquery.min.js"></script>
<script src="<?= base_url('mobile');?>/js/materialize.min.js"></script>
<script src="<?= base_url('mobile');?>/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= base_url('mobile');?>/lib/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
<script src="<?= base_url('mobile');?>/lib/slick/slick/slick.min.js"></script>
<script src="<?= base_url('mobile');?>/js/custom.js"></script>
</body>

</html>