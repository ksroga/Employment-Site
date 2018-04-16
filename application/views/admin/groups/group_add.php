        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Dodaj grupę</small>
                       <hr>   
                    </div>
              </div>

              <div class="row">
                <div class="col-lg-12 ">
                  <div class="alert alert-warning">
                    <strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Grupa, którą dodajesz powinna być otwarta!</strong>
                  </div>
                </div>
              </div>
              <form method="post" accept-charset="utf-8" action="add/new">
              <div class="row">
                <div class="col-lg-4">
                  <div class="input-group center">
                    <span class="input-group-addon">ID Grupy</span>
                    <input type="text" name="groupid" id="groupid" class="form-control" placeholder="ex. 123456789">
                  </div>
                  <div id="result">Wprowadź ID grupy</div>
                </div>
              </div>
              <div id="addbutton"></div>
              </form>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

        <script>
        $(document).ready(function(){
            var check = "<?php echo base_url().'index.php/admin/groups/check/' ?>";
            $("#groupid").change(function(){
                $.ajax({url: check + $("#groupid").val(), success: function(result){
                    var key = "Graph returned an error:",
                        search = result.indexOf(key),
                        data = result.split("|");
                    if(search != -1) {
                      $("#result").html('<span style="color:darkred;font-weight:700;">ID Grupy jest niepoprawne bądź grupa jest zamknięta!</span>');
                    } else {
                      $("#result").html('<span style="color:darkgreen;font-weight:700;">ID Grupy jest poprawne.</span> <div>Nazwa grupy: ' + data[0] + '<br>Status: ' + data[1] + '</div>');
                      $("#addbutton").html('<input type="hidden" name="groupname" value="' + data[0] + '"><button type="submit" class="btn btn-default" value="add">Dodaj grupę</button>');
                    }
                }});
            });
        });
        </script>
