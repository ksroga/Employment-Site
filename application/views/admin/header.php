<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- BOOTSTRAP STYLES-->
    <link href=<?php echo assets_url().'admin/css/bootstrap.css'; ?> rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href=<?php echo assets_url().'admin/css/font-awesome.css'; ?> rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href=<?php echo assets_url().'admin/css/custom.css'; ?> rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=<?php echo site_url('/admin/posts'); ?>>
                        <img style="height:60px;margin-top:-5px;" src=<?php echo assets_url().'admin/img/pa_logo.png'; ?> />

                    </a>
                    
                </div>
              
                <span class="logout-spn" >
                  <a href=<?php echo site_url('/admin/auth/logout'); ?> style="color:#fff;">WYLOGUJ</a>  

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->

                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href=<?php echo site_url('/admin/posts/newest/'); ?>><i class="fa fa-plus-circle" aria-hidden="true"></i>Nowe posty <span class="badge"><?php echo $new_posts; ?></span></a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/offers/newest/'); ?>><i class="fa fa-list" aria-hidden="true"></i>Aktualne oferty <span class="badge"><?php echo $offers_count; ?></span></a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/groups'); ?>><i class="fa fa-book" aria-hidden="true"></i>Grupy <span class="badge"><?php echo $groups_count; ?></span></a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/groups/add'); ?>><i class="fa fa-plus-square" aria-hidden="true"></i>Dodaj grupę</a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/users'); ?>><i class="fa fa-users" aria-hidden="true"></i>Użytkownicy</a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/users/add'); ?>><i class="fa fa-user-plus" aria-hidden="true"></i>Dodaj użytkownika</a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/settings'); ?>><i class="fa fa-cogs" aria-hidden="true"></i>Ustawienia</a>
                    </li>
                    <li>
                        <a href=<?php echo site_url('/admin/newsletter'); ?>><i class="fa fa-envelope" aria-hidden="true"></i>Newsletter</a>
                    </li>
                    
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->