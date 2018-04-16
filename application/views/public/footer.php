<!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-6 offset-3">
            <div class="col-lg-6 col-md-6 col-sm-6 column">
                <ul>
                    <li><a href=<?php echo site_url('oferty'); ?>>Oferty Pracy</a></li>
                    <li>Blog</li>
                    <li>Jak działa Sektor-IT.pl</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 column">
              <ul>
                    <li><a href=<?php echo site_url('kontakt'); ?>>Kontakt</a></li>
                    <li>Dla Pracodawcy</li>
                    <li>Regulamin serwisu</li>
                </ul>
            </div>
            <p class="m-0 text-center text-white">
              Copyright &copy; 2017 - 2018 by Sektor-IT.pl Group
            </p>
        </div>
      </div>
      <!-- /.container -->
    </footer>

    <div class="cookiesNotify">
      <div class="col-lg-12 col-md-12 col-sm-12 row">
        <div class="col-lg-2 col-md-2 col-sm-2 text-right">
          <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <h6>Ta strona wykorzystuje pliki cookies.</h6>
          <p>Używamy informacji zapisanych za pomocą plików cookies w celu zapewnienia maksymalnej wygody w korzystaniu z naszego serwisu. 
          Jeżeli wyrażasz zgodę na zapisywanie informacji zawartej w cookies kliknij na przycisk 'Rozumiem' po prawej stronie tej informacji. 
          Jeśli nie wyrażasz zgody, ustawienia dotyczące plików cookies możesz zmienić w swojej przeglądarce.</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
        <button class="btn" id="acceptCookies">Rozumiem</button>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo assets_url();?>public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo assets_url();?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo assets_url(); ?>public/js/bootstrap-notify.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&components=country:PL&types=locality&key=AIzaSyD7VF-AV_KA5tRzga6RLAdk1hCGsIkbDQE"></script>
    <script src="<?php echo assets_url();?>js/jquery.geocomplete.js"></script>
    <script src="<?php echo assets_url();?>public/js/nanobar.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="<?php echo assets_url();?>public/js/notify.min.js"></script>
    <script src="<?php echo assets_url();?>public/js/js.cookie.js"></script>
    <script src="<?php echo assets_url();?>public/js/sektorit.js"></script>

    <script type="text/javascript">
    	$(document).ready(function() {
    		<?php if($this->session->flashdata('alert')){ ?>
    		$.notify({
    			message: "<?php echo $this->session->flashdata('alert')['message'] ?>"
    		},{
				offset: {
					x: 50,
					y: 60
				},
				type: "<?php echo $this->session->flashdata('alert')['type'] ?>"
			});
			<?php } ?>
    	});
    </script>

    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myModalLabel">Logowanie</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
          <?php echo form_open('Auth/login'); ?>  
	      	<div class="col-lg-10 col-md-10 col-sm-10 offset-1">
	      		<div class="form-group">
	      			<label><i class="fas fa-user"></i> Nazwa Użytkownika:</label>
	         		<input type="text" class="form-control" placeholder="Nazwa użytkownika" name="username" autofocus>
	         	</div>
	         	<div class="form-group">
	         		<label><i class="fas fa-key"></i> Hasło:</label>
             	<input type="password" class="form-control" placeholder="Hasło" name="password">
            </div>
            <div class="col-xs-12 col-md-12">
              <div class="form-check" style="padding-left:2%;">
                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="..."> Zapamiętaj mnie
              </div>
            </div>
          </div>
	      </div>
	      <div class="modal-footer">
          <div class="loginModal-link">
            <a href="">Zapomniałeś hasła?</a>
            <a href="">Zarejestruj się</a>
          </div>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
	        <button type="submit" class="btn btn-primary">Zaloguj się</button>
	      </div>
        </form>
	    </div>
	  </div>
	</div>

  </body>

</html>