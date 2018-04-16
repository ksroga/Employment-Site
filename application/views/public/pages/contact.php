    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-12">

          <div id="carouselExampleIndicators" >
            <h2 class="table-text">Kontakt</h2>
          </div>
          <div class="line">
			     <div class="red-line"></div>
		      </div>

          <div class="row">
            <p>Jeśli chcesz się z nami skontaktować wypełnij formularz poniżej, uzupełniając Adres E-Mail, swoje imię, temat oraz treść! 
            Odpowiemy Ci najszybciej jak to jest możliwe!</p>
            <div class="col-lg-6 col-md-6 col-sm-6 offset-3" style="padding-bottom:5rem;">

                <?php if(validation_errors())
                          echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                <div class="form-group">
                  <?php echo form_open('ticket/send'); ?>
                  <label for="email">Adres E-Mail:</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Wprowadź E-Mail">
                  <small id="emailHelp" class="form-text text-muted">Adres E-Mail, na który odpowiemy.</small>
                </div>
                <div class="form-group">
                  <label for="fname">Twoje Imię:</label>
                  <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fname" placeholder="Wprowadź Imię">
                </div>
                <div class="form-group">
                  <label for="category">Temat:</label>
                  <select class="form-control" name="category">
                  <?php 
                    foreach($categories as $category)
                      echo "<option value='$category->id'>$category->name</option>";
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="message">Treść:</label>
                  <textarea class="form-control" id="message" name="message" rows="3" style="height:14rem"></textarea>
                </div>
                <div class="form-group">
                  <?php echo $this->recaptcha->getWidget(); ?>
                  <input type="hidden" id="captcha" name="captcha" value="">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Wyślij!</button>
                </div>
                </form>
		  		  </div>
          </div>
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->


    </div>
    <!-- /.container -->
    </div>
    </div>
    </div>
    </div>
    </div>
    <?php echo $this->recaptcha->getScriptTag(); ?>
    <script type="text/javascript"> 
      function onHuman(response) { 
        document.getElementById('captcha').value = response; 
      } 
    </script>
