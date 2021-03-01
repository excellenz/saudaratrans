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
<link href="css/wa-widget.css" rel="stylesheet">
 
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
                        <li class="<?php if($_GET['page'] === "armada") {echo "active";}?>"><a href="index.php?page=armada">Armada</a></li>
                        <li class="<?php if($_GET['page'] === "rental") {echo "active";}?>"><a href="index.php?page=rental">Rental Mobil</a></li>
                        <li class="<?php if($_GET['page'] === "travel") {echo "active";}?>"><a href="index.php?page=travel">Travel</a></li>
                        <li class="<?php if($_GET['page'] === "pariwisata") {echo "active";}?>"><a href="index.php?page=pariwisata">Pariwisata</a></li>
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

<div class="wa__btn_popup" aria-hidden="false">
        <div class="wa__btn_popup_txt">Perlu bantuan? chat kami !</div>
        <div class="wa__btn_popup_icon"></div>
    </div>
    <div class="wa__popup_chat_box" aria-hidden="false">
        <div class="wa__popup_heading">
            <div class="wa__popup_title">Pusat Bantuan Saudara Trans</div>
            <div class="wa__popup_intro"><strong>saudaratrans.com</strong></div>
        </div>
        <div class="wa__popup_content wa__popup_content_left">
            <div class="wa__popup_notice"></div>
            <div class="nta-wa-gdpr"><input id="nta-wa-gdpr" type="checkbox" value="accept"> <label
                    for="nta-wa-gdpr">Dengan ini saya menyetujui bahwa percakapan akan disimpan di sistem kami.</label>
            </div>
            <div class="wa__popup_content_list">
                <div class="wa__popup_content_item pointer-disable"> <a target="_blank"
                        href="https://api.whatsapp.com/send?phone=6285220489206.&amp;text=Salam%20Saudara%20Trans.%20Saya%20ingin%20menanyakan%20tentang%20"
                        class="wa__stt wa__stt_online">
                        <div class="wa__popup_avatar nta-default-avt"> <img src="img/whatsapp_logo.svg" alt=""></div>
                        <div class="wa__popup_txt">
                            <div class="wa__member_name">CS 1</div>
                            <div class="wa__member_duty">Bapak ...</div>
                        </div>
                    </a></div>
            </div>
        </div>
    </div>

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
<script src="js/wa-widget.js"></script>
</body>
</html>
