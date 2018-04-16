    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-12">

          <div id="carouselExampleIndicators" >
            <h2 class="table-text">Oferta Pracy</h2>
          </div>
          <div class="line">
			     <div class="red-line"></div>
		      </div>

          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="offer-page animated zoomIn">
                <div class="header">
                #Sektor-IT.pl - Znajdź Ofertę Pracy Dla Siebie!
                </div>
                <div class="offer-border">
                  <div class="offer-container">
                    <div class="title"><i class="fas fa-bullhorn"></i> Nazwa wakatu:</div>
                    <div class="title"><i class="fas fa-dollar-sign"></i> Wynagrodzenie:</div>
                    <div class="title"><i class="fab fa-wpforms"></i> Forma zatrudnienia:</div>
                    <div class="title"><i class="fab fa-elementor"></i> Kategoria:</div>
                    <div class="title"><i class="fas fa-location-arrow"></i> Miejscowość:</div>
                  </div>
                  <div class="offer-container">
                    <p><?php echo $offer->title; ?></p>
                    <p><?php echo $offer->salary; 
                             echo ($offer->maxsalary ? ' - '.$offer->maxsalary.' '.$offer->currency : ' '.$offer->currency); 
                             echo ($offer->manhour ? " (roboczogodzina $offer->vat)" : " ($offer->vat)"); ?></p>
                    <p><?php echo $offer->form; ?></p>
                    <p><?php echo $offer->category; ?></p>
                    <p><?php echo "$offer->city, $offer->state, $offer->country"; ?></p>
                  </div>
                  <div class="offer-line"></div>
                  <div class="offer-container col-md-12 col-lg-12 col-sm-12">
                    <div class="content editor"><?php echo nl2br($offer->content); ?></div>
                    <div class="apply col-lg-4 offset-4"><a target="_blank" href="http://www.facebook.com/<?php echo $offer->post_id; ?>"><button class="btn btn-primary">Aplikuj na stanowisko!</button></a></div>
                  </div>
                  <div>
                    <span class="offer-id">Zgłoś ofertę</span></div>
                  </div>
              </div>
		  		  </div>
          </div>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->


    </div>
    <!-- /.container -->
    </div>
    </div>
    </div>
    </div>
    </div>

