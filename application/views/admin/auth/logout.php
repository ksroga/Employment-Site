<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wylogowano</title>

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
             
<div class="col-lg-4 col-md-4 col-md-offset-4 pa-login">
  <div class="panel panel-success">
    <div class="panel-heading">
      Logowanie
    </div>
    <div class="panel-body" style="text-align:center;">
      Pomyślnie się wylogowałeś!<br><br>
      Za chwilę nastąpi przekierowanie na Stronę Główną<br>
      <a href=<?php echo site_url('/'); ?>>Naciśnij tutaj, jeśli przeglądarka Cię nie przekierowała</a>.
      <?php
        header('Refresh: 2; url='.site_url('/'));
      ?>        
    </div>
    <div class="panel-footer">
      &copy; 2017 - 2018 by Sektor-IT.pl
    </div>
  </div>
</div>

</body>
</html>             
           
