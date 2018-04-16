<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title><?php echo $title; ?></title>
    <script src="https://use.fontawesome.com/f7ab8fce27.js"></script>
    <link href=<?php echo assets_url().'public/vendor/bootstrap/css/bootstrap.min.css'; ?> rel="stylesheet">
    <link href=<?php echo assets_url().'public/css/shop-homepage.css'; ?> rel="stylesheet">
    <link href=<?php echo assets_url().'public/css/animate.css'; ?> rel="stylesheet">
    <!-- Google AdSense / Analytics -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "xxxxxxxxxxxx",
        enable_page_level_ads: true
      });
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=xxxxxxxxxxxx"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'xxxxxxxxxxxxxxx');
    </script>


  </head>

  <body class="animated fadeIn">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top">
      <div class="container">
        <a class="navbar-brand animated flipInX" href="<?php echo site_url('/'); ?>">
        <img class="nav-logo" alt="Sektor-IT.pl" src="<?php echo assets_url(); ?>public/images/logoIt.png" style="height:40px; width:200px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" id="jobs" href="#">Oferty pracy
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="blog" href="#">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="kontakt" href="<?php echo site_url('/kontakt'); ?>">Kontakt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="" href="#">Dla pracodawcy</a>
            </li>
            <?php 
              if(empty($this->session->user_logged_in['id'])) { 
            ?>
            <li class="nav-item">
              <a class="nav-link" id="register" href="#">Zarejestruj się</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="login" data-toggle="modal" data-target="#LoginModal" href="#LoginModal">Zaloguj się</a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('/profile'); ?>">Twój Profil</a>
            </li>
            <?php if(strstr($this->session->user_logged_in['perms'], 'a')) { ?>
            <li class="nav-item">
              <a class="nav-link" target="_blank" href="<?php echo site_url('/admin'); ?>">ACP</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('/auth/logout'); ?>">Wyloguj się</a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>