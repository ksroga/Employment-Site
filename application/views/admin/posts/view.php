        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Zatwierdzanie Oferty</small>
                       <hr>   
                    </div>
              </div>
              <?php echo form_open('admin/posts/accept'); ?>
              <input type="hidden" id="post_id" name="post_id" value=<?php echo $post->id; ?>>
              <input type="hidden" id="fb_post_id" name="fb_post_id" value=<?php echo $post->post_id; ?>>
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="offer">Treść oferty:</label>
                    <div class="editor">
                      <button type="button" class="btn btn-primary" id="deleteqm">Usuń znaki zapytania</button>
                    </div>
                    <textarea class="form-control" id="offer" name="offer" rows="30"><?php echo $post->message; ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">

                <?php 
                if(validation_errors()) {
                  echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';
                } ?>

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Tytuł oferty:</label>
                      <input class="form-control" name="title" id="title" maxlength="64">
                      <p class="help-block">Pozostało <span id="charsLeft">64</span> znaków</p>
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                      <label>Forma zatrudnienia:</label>
                      <select class="form-control" name="form">
                        <?php
                        foreach($employment_forms as $key => $form)
                          echo '<option '.($key == 0 ? 'selected' : '').' value="'.$form->id.'">('.$form->short_name.') '.$form->name.'</option>';
                        ?>
                      </select>
                    </div>
                  </div>

                   <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                      <label>Wynagrodzenie:</label>
                      <input class="form-control" id="salary" name="salary">
                      <p class="help-block"><input class="form-check-input" type="checkbox" name="manhour" value="1"> za godzinę</p>
                    </div>
                  </div>

                  <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                      <label><input class="form-check-input" id="checkboxMaxSalary" type="checkbox"> do:</label>
                      <input id="maxsalary" name="maxsalary" class="form-control" readonly>
                    </div>
                  </div>

                   <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                      <label>Waluta:</label>
                      <select class="form-control" name="currency">
                      <?php
                        foreach($currencies as $key => $currency)
                          echo '<option '.($key == 0 ? 'selected' : '').' value="'.$currency->id.'">'.$currency->short_name.'</option>';
                      ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                      <label>VAT:</label>
                      <select class="form-control" name="vat">
                        <option default value="0">Nie określono</option>
                        <option value="1">Brutto</option>
                        <option value="2">Netto</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                      <label>Kategoria:</label>
                      <select class="form-control" name="category">
                        <option value="-1" selected>Nie określono</option>
                        <?php
                        foreach($categories as $category)
                          echo '<option value="'.$category->id.'">'.$category->name.'</option>';
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                      <label>Lokalizacja:</label>
                      <input type="text" class="form-control" id="city" name="city" maxlength="64">
                      <input type="hidden" id="state" name="administrative_area_level_1">
                      <input type="hidden" id="locality" name="locality">
                      <input type="hidden" id="country" name="country">
                    </div>
                  </div>

                   <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                      <label>Tagi:</label>
                      <input type="text" class="form-control" id="tags" name="tags" maxlength="128">
                      <p class="help-block">Tagi oddzielaj spacją.</p>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label>Akcja:</label><br>
                      <button type="submit" class="btn btn-success">Zatwierdź Ofertę</button>
                      <a class="btn btn-danger" href=<?php echo site_url('admin/posts/decline/'.$post->id); ?>>Odrzuć Ofertę</a>
                    </div>
                  </div>
                  </form>
              </div>
              </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

        <script type="text/javascript">
          $(document).ready(function() {

            $("#checkboxMaxSalary").click(function(event) {
              if($(this).is(":checked")) {
                $("#maxsalary").removeAttr("readonly");
              } else {
                $("#maxsalary").attr("readonly", "");
                $("#maxsalary").val("");
              }
            });
            $("#title").on("keyup", function() {
              $("#charsLeft").html(64 - $(this).val().length);
            });
       
            $("#city").geocomplete({
              details: "form"
            });

            $("#city").focusout(function(){
              $("#city").trigger("geocode");
            });

            $("#deleteqm").click(function(event) {
              var qm = "[?-]{2,}";
              var offer = $("#offer").val();

              for(var i = 1; i <= 30; i++) {
                offer = $("#offer").val();
                offer = offer.replace("??", '');
                //qm = qm.slice(0, -1);
                $("#offer").val(offer);
              }
            });

          });
        </script>

