        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Użytkownicy</small>
                       <hr>   
                    </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <h4>Lista użytkowników:</h5>
                  <form method="post" accept-charset="utf-8" action="groups/delete">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th width='5%'>ID</th>
                          <th width='15%'>Nazwa użytkownika</th>
                          <th width='15%'>E-Mail</th>
                          <th width='10%'>Rejestracja</th>
                          <th width='10%'>Ostatnie logowanie</th>
                          <th width='10%'>Uprawnienia</th>
                          <th width='5%'>Status</th>
                          <th width='20%'>Akcja</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($users as $key => $user) {
                          echo '<tr id="post-'.$user->id.'">';
                          echo '<td>'.($key+$page+1).'</td>';
                          echo '<td>'.$user->username.'</td>';
                          echo '<td>'.$user->email.'</td>';
                          echo '<td>'.$user->created.'</td>';
                          echo '<td>'.$user->last_logon.'</td>';
                          echo '<td>'.$user->permissions.'</td>';
                          echo '<td>'.($user->active == 1 ? 'Aktywny' : 'Nieaktywny').'</td>';
                          //echo '<td><a type="button" href="'.site_url('admin/posts/show/').$post->id.'" class="btn btn-success" id="activate" value="'.$post->id.'">Zatwierdź</a> <button type="button" class="btn btn-danger" id="deactivate" value="'.$post->id.'" data-toggle="modal" data-target="#deactivateModal">Dezaktywuj</button></td>';
                          echo '<td><a type="button" href="'.site_url('admin/users/edit/').$user->id.'" class="btn btn-warning" id="edit" value="'.$user->id.'">Edytuj</a> '.($user->active == 1 ? '<button type="button" class="btn btn-danger" id="deactivate" value="'.$user->id.'" data-toggle="modal" data-target="#deactivateModal">Zablokuj</button>' : '<button type="button" class="btn btn-success" id="unblock" value="'.$user->id.'" data-toggle="modal" data-target="#unblockModal">Odblokuj</button>').'</td>';
                          echo '</tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                    <div style="width:100%; text-align:center;font-size:2rem;">
                      <?php
                          echo $link;
                      ?>
                    </div>
                  </div>
              </div>
              </form>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

        <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Blokada konta użytkownika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 200px);">
                Pomyślnie zablokowano konto użytkownika o id <span id="user-id"></span>!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="unblockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Blokada konta użytkownika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 200px);">
                Pomyślnie odblokowano konto użytkownika o id <span id="unblock-user-id"></span>!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
             $(document).ready(function() {

              $('button[id*=deactivate ]').click(function() {
                var link = '<?php echo site_url("admin/users/edit/"); ?>',
                    user_id = $(this).attr('value'),
                    status = link + user_id + '/block',
                    button = this;
                $.ajax({url: status, success: function(result){
                    $('#user-id').html(user_id);
                    $('#deactivateModal').modal('show');
                    $(button).fadeOut("slow");
                    
                  }});
              });

              $('button[id*=unblock ]').click(function() {
                var link = '<?php echo site_url("admin/users/edit/"); ?>',
                    user_id = $(this).attr('value'),
                    status = link + user_id + '/unblock',
                    button = this;
                $.ajax({url: status, success: function(result){
                    $('#unblock-user-id').html(user_id);
                    $('#activateModal').modal('show');
                    $(button).fadeOut("slow");
                  }});
              });
            });
        </script>

