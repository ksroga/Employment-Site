        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Wyślij E-Mail</small>
                       <hr>   
                    </div>
              </div>
              <?php echo form_open('admin/newsletter/send'); ?>

              <div class="row">
                <div class="col-lg-12 col-md-12">

                <?php 
                if(validation_errors()) {
                  echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';
                } ?>

                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Odbiorca:</label>
                      <input type="text" class="form-control" name="newsletter-receiver">
                      <small>Pozostaw puste, aby wysłać newsletter do wszystkich!</small>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Temat Wiadomości:</label>
                      <input type="text" class="form-control" name="newsletter-topic">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Treść Wiadomości:</label>
                      <textarea class="form-control" name="newsletter-message" rows="20"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Szablon:</label>
                      <select class="form-control" name="newsletter-template">
                        <option value="newsletter">Newsletter (Newsletter@Sektor-IT.pl)</option>
                        <option value="contact">Kontakt (Kontakt@Sektor-IT.pl)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <button type="submit" class="btn btn-default">Wyślij Wiadomość</button>
                  </div>
                </div>

                  </form>
              </div>
              </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>