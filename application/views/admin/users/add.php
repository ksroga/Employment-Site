        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Dodawanie nowego użytkownika</small>
                       <hr>   
                    </div>
              </div>
              <?php echo form_open('admin/users/accept'); ?>

              <div class="row">
                <div class="col-lg-12 col-md-12">

                <?php 
                if(validation_errors()) {
                  echo '<div class="col-lg-12 col-md-12 alert alert-danger"><strong> '.validation_errors().'</strong></div>';
                } ?>
                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Nazwa nowego użytkownika:</label>
                      <input class="form-control" name="nickname" id="nickname" maxlength="32" <?php echo (isset($_POST['nickname']) ? 'value='.$_POST['nickname'] : ''); ?>>
                      <p class="help-block">Pozostało <span id="charsLeft">32</span> znaków</p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Hasło:</label>
                      <input type="password" class="form-control" name="password" id="password" <?php echo (isset($_POST['password']) ? 'value='.$_POST['password'] : ''); ?>>
                      <p class="help-block"><a id="showPass"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span id="passText">Pokaż hasło</span></a></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                      <label>Email:</label>
                      <input type="email" class="form-control" name="email" id="email" <?php echo (isset($_POST['email']) ? 'value='.$_POST['email'] : ''); ?>>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <div class="form-group permissions">
                      <label>Uprawnienia administratora:</label><br>
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
                                        <td><input type="checkbox" value="a" name="perms[]"></td>
                                        <td>Dostęp do panelu administracyjnego</td>
                                    </tr>
                                    <tr>
                                        <td>b</td>
                                        <td><input type="checkbox" value="b" name="perms[]"></td>
                                        <td>Zarządzanie postami</td>
                                    </tr>
                                    <tr>
                                        <td>c</td>
                                        <td><input type="checkbox" value="c" name="perms[]"></td>
                                        <td>Zarządzanie ofertami</td>
                                    </tr>
                                    <tr>
                                        <td>d</td>
                                        <td><input type="checkbox" value="d" name="perms[]"></td>
                                        <td>Zarządzanie grupami</td>
                                    </tr>
                                    <tr>
                                        <td>e</td>
                                        <td><input type="checkbox" value="e" name="perms[]"></td>
                                        <td>Zarządzanie użytkownikami</td>
                                    </tr>
                                    <tr>
                                        <td>f</td>
                                        <td><input type="checkbox" value="f" name="perms[]"></td>
                                        <td>Zmiana ustawień</td>
                                    </tr>
                                    <tr>
                                        <td>g</td>
                                        <td><input type="checkbox" value="g" name="perms[]"></td>
                                        <td>Edycja ofert (bez PA)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a id="selectAll">Zaznacz wszystkie</a> | <a id="unselectAll">Odznacz wszystkie</a>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4">
                    <button type="submit" class="btn btn-default">Dodaj użytkownika</button>
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

            $("#nickname").on("keyup", function() {
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

            $("#showPass").on("click", function() {
                if($("#password").is(":password")) {
                  $("#password").prop("type", "text");
                  $("#passText").html("Ukryj hasło");
                } else {
                  $("#password").prop("type", "password");
                  $("#passText").html("Pokaż hasło");
                }

            });

          });
        </script>