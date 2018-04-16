        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Grupy</small>
                       <hr>   
                    </div>
              </div>

              <form method="post" accept-charset="utf-8" action="delete">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <h4>Lista grup w systemie:</h5>
                  <form method="post" accept-charset="utf-8" action="groups/delete">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th width='5%'>#</th>
                          <th width='35%'>Nazwa grupy</th>
                          <th width='30%'>ID grupy</th>
                          <th width='20%'>Akcja</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($groups as $key => $group) {
                          echo '<tr id='.$group->id.'>';
                          echo '<td>'.($key+1).'</td>';
                          echo '<td>'.$group->group_name.'</td>';
                          echo '<td>'.$group->group_id.'</td>';
                          echo '<td><button type="button" class="btn btn-danger" id="delete" value="'.$group->id.'" data-toggle="modal" data-target="#exampleModal">Usuń grupę</button> <a href="https://www.facebook.com/groups/'.$group->group_id.'" target="_blank" class="btn btn-default">Odwiedź</a> <button type="button" class="btn btn-default" id="statusBtn" value="'.$group->group_id.'" data-toggle="modal" data-target="#statusModal">Status</button></td>';
                          echo '</tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
              </div>
              </form>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Usuń grupę</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modal-text"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
        <button type="button" id="delSubmit" class="btn btn-danger">Usuń grupę</button>
      </div>
    </div>
  </div>
</div>
</form>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content alert alert-success">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Akcja zakończona powodzeniem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body alert alert-success">
        Pozytywnie usunięto grupę!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Akceptuj</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logi Statusu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 200px);">
        <div id="statusModal-Text"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('button[id*=delete]').click(function() {
          var link = '<?php echo site_url("admin/groups/delete/"); ?>',
              group_id = $(this).attr('value'),
              del = link + group_id;
          $("#modal-text").html("Czy na pewno chcesz usunąć grupę o identyfikatorze " +  $(this).attr('value') + "?");
          $('#delSubmit').click(function() {
            $.ajax({url: del, success: function(result){
              $('#exampleModal').modal('hide');
              $('#successModal').modal('show');
              $('#' + group_id).fadeOut("slow");
            }});
          });
        });

        $('button[id*=statusBtn]').click(function() {
          var link = '<?php echo site_url("admin/groups/status/"); ?>',
              group_id = $(this).attr('value'),
              status = link + group_id;
          $.ajax({url: status, success: function(result){
              $('#statusModal-Text').html(result);
              $('#statusModal').modal('show');
            }});
        });
    });
</script>