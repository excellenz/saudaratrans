<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Saudara Trans : Rental Mobil, Tour & Travel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://webthemez.com" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="js/owl-carousel/owl.carousel.css" rel="stylesheet"> 
<link href="css/style.css" rel="stylesheet" />
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
  <!-- start header -->
  <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="<?php if(!isset($_GET['page'])) {echo "active";}?>"><a href="index.php">Home</a></li> 
                        <li class="<?php if($_GET['page'] === "rental") {echo "active";}?>"><a href="index.php?page=rental">Rental Mobil</a></li>
                        <li class="<?php if($_GET['page'] === "travel") {echo "active";}?>"><a href="index.php?page=travel">Travel</a></li>
                        <li class="<?php if($_GET['page'] === "pariwisata") {echo "active";}?>"><a href="index.php?page=pariwisata">Pariwisata</a></li>
                        <li class="<?php if($_GET['page'] === "login") {echo "active";}?>"><a href="https://saudaratrans.com/manager/tamu">LOGIN</a></li>
                    </ul>
                </div>
            </div>
        </div>
  </header>
  <!-- end header -->

<?php 
if(!isset($_GET['page'])) {
include "page/home.php";
} else {
$page = $_GET['page'];
include "page/".$page.".php";
}
?>

  <footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">ALAMAT KAMI</h5>
          <address>
          <strong>Jl Raya Nanggerang - Ciawigebang</strong><br>
          Desa Nanggerang, Kec Jalaksana, Kabupaten Kuningan<br>
          Depan Masjid Al-Karomah</address>
          <p>
            <i class="icon-phone"></i> 085220489206/085224946826 <br>
            <i class="icon-envelope-alt"></i> transsaudara@gmail.com
          </p>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">PRODUK DAN LAYANAN</h5>
          <ul class="link-list">
            <li><a href="#">+ Rental Mobil</a></li>
            <li><a href="#">+ Travel</a></li>
            <li><a href="#">+ Biro Pariwisata</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">FASILITAS RENTAL</h5>
          <ul class="link-list">
            <li><a href="#">+ Mobil Bersih, Nyaman dan Terawat</a></li>
            <li><a href="#">+ Driver Ramah</a></li>
            <li><a href="#">+ Antar Jemput Mobil</a></li>
            <li><a href="#">+ Gratis Softdrink</a></li>
            <li><a href="#">+ Diskon Menarik</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">LAYANAN RENTAL</h5>
          <ul class="link-list">
            <li><a href="#">+ Rental Mobil Harian</a></li>
            <li><a href="#">+ Rental Mobil Korporat</a></li>
            <li><a href="#">+ Antar Jemput Stasiun</a></li>
            <li><a href="#">+ Antar Jemput Bandara</a></li>
            <li><a href="#">+ Rental Mobil Gratis</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="copyright">
            <p>
              <span>&copy; Saudara Trans 2021 All right reserved. | Design by <a href="https:/excellenz.id/" target="_blank" >Excellenz.ID</a>
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="social-network">
            <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script> 
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script src="js/owl-carousel/owl.carousel.js"></script>

<button style="position: fixed;bottom: 80px;right: 24px;box-shadow: 5px 5px 15px -4px rgba(0,0,0,0.5);">Perlu Bantuan? Chat Kami!</button>  
<a href="https://api.whatsapp.com/send?phone=6285220489206.&amp;text=Salam%20Saudara%20Trans.%20Saya%20ingin%20menanyakan%20tentang%20" style="border-radius: 100%;position: fixed;bottom: 24px;right: 24px;box-shadow: 5px 5px 15px -4px rgba(0,0,0,0.5);">
  <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F2.bp.blogspot.com%2F-QfS1hyElLFk%2FXDdD551JV7I%2FAAAAAAAAGu0%2FZwfoMBwMoiUAzSCHhP4QvHn_KyjaeecWQCK4BGAYYCw%2Fs640%2Flogo%252Bwhatsapp.png&amp;f=1&amp;nofb=1" style="height: 48px;width: 48px;">
</a>
</body>
</html>
