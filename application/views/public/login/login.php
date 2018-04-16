<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <h2 class="table-text">Logowanie</h2>
      </div>
      <div class="line">
			 <div class="red-line"></div>
		  </div>

      <div class="row">
        <div class="col-lg-6 col-md-6 mb-6 offset-3">
          <?php echo form_open(); ?>    
          <div class="form-signin mg-btm">
            <div class="social-box">
              <div class="row mg-btm">
                <div class="col-md-12">
                  <a href="<?php echo $fb_login; ?>" class="btn btn-primary btn-block">
                    <i class="icon-facebook"></i>    Zaloguj się przez Facebooka
                  </a>
                </div>
              </div>
            </div>
            <div class="main">  
              <?php
               if(validation_errors())
                echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';

              if(!empty($error))
                echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.$error.'</strong></div>';
              ?>  
              <input type="text" class="form-control" placeholder="Nazwa użytkownika" name="username" autofocus>
              <input type="password" class="form-control" placeholder="Hasło" name="password">
             
              <span class="clearfix"></span>  
            </div>
            <div class="login-footer">
              <div class="row">
                <div class="col-xs-6 col-md-6">
                  <div class="left-section">
                    <a href="">Zapomniałeś hasła?</a><br>
                    <a href="">Zarejestruj się</a>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6 pull-right">
                  <button type="submit" class="btn btn-large btn-danger pull-right">Login</button>
                </div>
              </div>
          
            </div>
          </div>
          </form>
		  	</div>
      </div>

    </div>
  </div>
  <!-- /.row -->

</div>
        <!-- /.col-lg-9 -->
