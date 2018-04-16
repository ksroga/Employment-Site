        <div id="page-wrapper" >
            <div id="page-inner">
               
              <div class="row">
                    <div class="col-lg-12">
                       <h2>ADMIN DASHBOARD</h2>
                       <small>Panel Administratora &rarr; Aktualne oferty</small>
                       <hr>   
                    </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <h4>Aktywnych ofert pracy (<?php echo $offers_count; ?>):</h5>
                  <form method="post" accept-charset="utf-8" action="groups/delete">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th width='5%'>#</th>
                          <th width='55%'>Treść posta</th>
                          <th width='15%'>Data</th>
                          <th width='25%'>Akcja</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($offers as $key => $offer) {
                          echo '<tr id="offer-'.$offer->id.'">';
                          echo '<td>'.($key+$page+1).'</td>';
                          echo '<td>'.substr($offer->content, 0, 150).'...</td>';
                          echo '<td>'.$offer->date.'</td>';
                          echo '<td><a type="button" href="'.site_url('admin/offers/edit/').$offer->id.'" class="btn btn-warning" id="edit">Edytuj</a> <button type="button" class="btn btn-danger" id="deactivate" value="'.$offer->id.'" data-toggle="modal" data-target="#deactivateModal">Zakończ ofertę</button></td>';
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
                <h5 class="modal-title" id="exampleModalLabel">Oferta zakończona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 200px);">
                Pomyślnie zakończono ofertę o id <span id="offer-id"></span>!
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
                var link = '<?php echo site_url("admin/offers/status/"); ?>',
                    offer_id = $(this).attr('value'),
                    status = link + offer_id + '/deactivate';
                $.ajax({url: status, success: function(result){
                    $('#offer-id').html(offer_id);
                    $('#deactivateModal').modal('show');
                    $("#offer-" + offer_id).fadeOut("slow");
                    
                  }});
              });
            });

        </script>



