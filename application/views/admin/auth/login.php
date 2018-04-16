<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logowanie</title>

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
     
<?php echo form_open('admin/auth/login'); ?>           
<div class="col-lg-4 col-md-4 col-md-offset-4 pa-login">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Logowanie
    </div>
    <div class="panel-body">
      <?php 
      if(validation_errors())
        echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';

      if(!empty($error))
        echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.$error.'</strong></div>';
      ?>
      <div class="form-group col-lg-8">
        <label>Nazwa użytkownika:</label>
        <input class="form-control" name="username">
      </div>
      <div class="form-group col-lg-8">
        <label>Hasło:</label>
        <input class="form-control" type="password" name="password">
      </div>
      <div class="form-group col-lg-8">
        <input type="submit" class="btn btn-primary" value="Zaloguj się">
      </div>
    </div>
    <div class="panel-footer">
      &copy; 2017 - 2018 by Sektor-IT.pl
    </div>
  </div>
</div>
<?php echo form_close(); ?>

</body>
</html>             
           
