        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Edycja użytkownika</small>
                       <hr>   
                    </div>
              </div>
              <?php  echo form_open(); 
                  if(validation_errors()) 
                    echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>'; ?>
              <input type="hidden" id="user_id" name="user_id" value=<?php echo $user->id; ?>>
              <div class="row">
                <div class="col-lg-12 col-md-12">

                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Nazwa użytkownika:</label>
                      <input class="form-control" name="username" id="username" maxlength="32" value='<?php echo $user->username; ?>'>
                      <p class="help-block">Pozostało <span id="charsLeft">32</span> znaków</p>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Imię:</label>
                      <input class="form-control" name="first_name" id="first_name" maxlength="32" value='<?php echo @$user->first_name; ?>'>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>E-Mail:</label>
                      <input class="form-control" type="email" name="email" id="email" maxlength="64" value='<?php echo @$user->email; ?>'>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Nazwisko:</label>
                      <input class="form-control" name="last_name" id="last_name" maxlength="32" value='<?php echo @$user->last_name; ?>'>
                    </div>
                  </div>
                </div>
              </div>

               <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Nowe hasło:</label>
                      <input class="form-control" name="password" id="password" maxlength="64">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Powtórz nowe hasło:</label>
                      <input class="form-control" name="repeatpassword" id="repeatpassword" maxlength="64">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Użytkownik zarejestrowany:</label>
                      <input class="form-control" name="created" id="created" disabled value='<?php echo @$user->created; ?>'>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Ostatnie logowanie:</label>
                      <input class="form-control" name="last_logon" id="last_logon" disabled value='<?php echo @$user->last_logon; ?>'>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group permissions">
                      <label>Uprawnienia:</label><br>
                      <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="20%;">#</th>
                                        <th width="10%">Zaznacz</th>
                                        <th>Uprawnienie</th>
                                    </tr>
                                </thead>
                                <tbody id="permTable">
                                    <tr class="warning">
                                        <td>a</td>
                                        <td><input type="checkbox" value="a" name="perms[]" <?php echo (strstr($user->permissions, 'a')) ? 'checked' : ''; ?>></td>
                                        <td>Dostęp do panelu administracyjnego</td>
                                    </tr>
                                    <tr>
                                        <td>b</td>
                                        <td><input type="checkbox" value="b" name="perms[]" <?php echo (strstr($user->permissions, 'b')) ? 'checked' : ''; ?>></td>
                                        <td>Zarządzanie postami</td>
                                    </tr>
                                    <tr>
                                        <td>c</td>
                                        <td><input type="checkbox" value="c" name="perms[]" <?php echo (strstr($user->permissions, 'c')) ? 'checked' : ''; ?>></td>
                                        <td>Zarządzanie ofertami</td>
                                    </tr>
                                    <tr>
                                        <td>d</td>
                                        <td><input type="checkbox" value="d" name="perms[]" <?php echo (strstr($user->permissions, 'd')) ? 'checked' : ''; ?>></td>
                                        <td>Zarządzanie grupami</td>
                                    </tr>
                                    <tr>
                                        <td>e</td>
                                        <td><input type="checkbox" value="e" name="perms[]" <?php echo (strstr($user->permissions, 'e')) ? 'checked' : ''; ?>></td>
                                        <td>Zarządzanie użytkownikami</td>
                                    </tr>
                                    <tr>
                                        <td>f</td>
                                        <td><input type="checkbox" value="f" name="perms[]" <?php echo (strstr($user->permissions, 'f')) ? 'checked' : ''; ?>></td>
                                        <td>Zmiana ustawień</td>
                                    </tr>
                                    <tr>
                                        <td>g</td>
                                        <td><input type="checkbox" value="g" name="perms[]" <?php echo (strstr($user->permissions, 'g')) ? 'checked' : ''; ?>></td>
                                        <td>Edycja ofert (bez PA)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a id="selectAll">Zaznacz wszystkie</a> | <a id="unselectAll">Odznacz wszystkie</a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label>Akcja:</label><br>
                      <button type="submit" class="btn btn-success">Zatwierdź Ofertę</button>
                    </div>
                  </div>
              </div>
              </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

        <script type="text/javascript">
        $(document).ready(function() {
          $("#charsLeft").html(32 - $("#username").val().length);

          $("#username").on("keyup", function() {
              $("#charsLeft").html(32 - $(this).val().length);
          });

          $("#permTable").on("click", function (event) {

              if($(event.target).is(":checkbox") && $(event.target).val() != "g") {
                if(!$("input[type=checkbox][value=a]").is(":checked"))
                  $("input[type=checkbox][value=a]").attr("checked", 1);
              }

              if($(event.target).is(":checkbox") && $(event.target).val() == "a") {
                  $("input[type=checkbox][value!=g]").attr("checked", 1);
              }
            });

            $("#selectAll").on("click", function() {
                $("input[type=checkbox]").attr("checked", 1);
            });

            $("#unselectAll").on("click", function() {
                $("input[type=checkbox]").removeAttr("checked");
            });
        });
        </script>

