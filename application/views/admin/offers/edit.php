        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Edycja Oferty</small>
                       <hr>   
                    </div>
              </div>
              <?php 
                echo form_open('admin/offers/accept');
                if(validation_errors()) {
                  echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';
                } 
              ?>
              <input type="hidden" id="offer_id" name="offer_id" value=<?php echo $offer->id; ?>>
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="offer">Treść oferty:</label>
                    <textarea class="form-control" id="offer" name="offer" rows="30"><?php echo $offer->content; ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Tytuł oferty:</label>
                      <input class="form-control" name="title" id="title" maxlength="64" value='<?php echo $offer->title; ?>'>
                      <p class="help-block">Pozostało <span id="charsLeft">64</span> znaków</p>
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                      <label>Forma zatrudnienia:</label>
                      <select class="form-control" name="form">
                        <?php
                        foreach($employment_forms as $key => $form)
                          echo '<option '.($offer->form == $form->id ? "selected" : "").' value="'.$form->id.'">('.$form->short_name.') '.$form->name.'</option>';
                        ?>
                      </select>
                    </div>
                  </div>

                   <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                      <label>Wynagrodzenie:</label>
                      <input class="form-control" id="salary" name="salary" value='<?php echo $offer->salary; ?>'>
                      <p class="help-block"><input class="form-check-input" type="checkbox" name="manhour" value="1" <?php echo ($offer->manhour == 1 ? 'checked' : '')?>> za godzinę</p>
                    </div>
                  </div>

                  <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                      <label><input class="form-check-input" id="checkboxMaxSalary" type="checkbox" <?php echo (!empty($offer->maxsalary) ? 'checked' : '')?>> do:</label>
                      <input id="maxsalary" name="maxsalary" class="form-control" <?php echo (empty($offer->maxsalary) ? 'readonly' : 'value='.$offer->maxsalary); ?>>
                    </div>
                  </div>

                   <div class="col-lg-1 col-md-1">
                    <div class="form-group">
                      <label>Waluta:</label>
                      <select class="form-control" name="currency">
                      <?php
                        foreach($currencies as $key => $currency)
                          echo '<option '.($offer->currency == $currency->id ? "selected" : "").' value="'.$currency->id.'">'.$currency->short_name.'</option>';
                      ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-2">
                    <div class="form-group">
                      <label>VAT:</label>
                      <select class="form-control" name="vat">
                        <option value="0" <?php echo ($offer->vat == 0 ? 'selected' : ''); ?>>Nie określono</option>
                        <option value="1" <?php echo ($offer->vat == 1 ? 'selected' : ''); ?>>Brutto</option>
                        <option value="2" <?php echo ($offer->vat == 2 ? 'selected' : ''); ?>>Netto</option>
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
                          echo '<option '.($offer->category == $category->id ? "selected" : "").' value="'.$category->id.'">'.$category->name.'</option>';
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                      <label>Lokalizacja:</label>
                      <input type="text" class="form-control" id="city" name="city" maxlength="64" value='<?php echo $offer->city.', '.$offer->country; ?>'>
                      <input type="hidden" id="state" name="administrative_area_level_1" value='<?php echo $offer->state; ?>'>
                      <input type="hidden" id="locality" name="locality" value='<?php echo $offer->city; ?>'>
                      <input type="hidden" id="country" name="country" value='<?php echo $offer->country; ?>'>
                    </div>
                  </div>

                   <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                      <label>Tagi:</label>
                      <input type="text" class="form-control" id="tags" name="tags" maxlength="128" value='<?php echo $offer->tags; ?>'>
                      <p class="help-block">Tagi oddzielaj spacją.</p>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label>Akcja:</label><br>
                      <button type="submit" class="btn btn-success">Zatwierdź Ofertę</button>
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
            $("#charsLeft").html(64 - $("#title").val().length);

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
          });
        </script>

