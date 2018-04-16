        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Ustawienia</small>
                       <hr>   
                    </div>
              </div>
              <?php echo form_open('admin/settings/update'); ?>

              <div class="row">
                <div class="col-lg-12 col-md-12">

                <?php 
                if(validation_errors()) {
                  echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';
                } ?>
                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="disabled" name="disabled" <?php if($settings[0]->value == 'on') echo 'checked'; ?>>
                      <label class="form-check-label" for="disabled">Wyłącz portal</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Powód wyłączenia:</label>
                      <textarea class="form-control" name="disabled-reason" id="disabled-reason"><?php echo $settings[1]->value; ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <button type="submit" class="btn btn-default">Aktualizuj ustawienia</button>
                  </div>
                </div>

                  </form>
              </div>
              </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>