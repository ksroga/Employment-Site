  <section id="search">
	   <div class="container text-center">
	       <div class="row">
	           <div class="col-md-12">
	               <h1 class="search-header"><p>Sektor-IT to centrum
	               <br>ofert pracy w branży IT.
	               <br>Znajdź swoją wymarzoną pracę!
	               </p></h1>
	             </div>
	       </div>
	       <div class="row with_padding">
	           <div class="col-md-12">
		            <div class="search-text">
			               Zaznacz poniżej swoje kryteria i rozpocznij wyszukiwanie spośród tysięcy ofert pracy!
		            </div>
	           </div>
	       </div>
	</section>
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">
          <div class="search">
          	<div class="search-title">Znajdź ofertę<br>dla siebie</div>
          </div>
          <div class="search-container">
      <div class="form-group">
        <label for="city">Lokalizacja:</label>
        <input type="text" class="form-control" id="city" name="city" maxlength="64">
      </div>
      <?php echo form_open('szukaj', array('method' => 'get')); ?>
      <div class="form-group">
			  <label for="vac">Stanowisko:</label>
			  <input type="text" class="form-control" id="vac" name="vac" placeholder="Stanowisko">
			</div>
      <input type="hidden" id="locality" name="locality">
			<div class="form-group">
				<label for="category">Branża:</label>
				<select class="form-control category" id="category" name="cat">
			      <?php
            foreach($categories as $category)
              echo '<option value='.$category->id.'>'.$category->name.'</option>';
            ?>
			    </select>
			</div>
      <div class="form-group">
          <button type="submit" class="btn btn-secondary" style="width:100%;">Szukaj</button>
      </div>
      </form>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
           <h2 class="table-text">Najnowsze Oferty Pracy</h2>
          </div>
          <div class="line">
			<div class="red-line"></div>
		  </div>

          <div class="row">

            <div class="col-lg-12 col-md-12 mb-12">

            <?php 
              foreach($offers as $offer) {
                echo '<div class="offer">';
                echo '<a href="oferta/'.$offer->id.$offer->url.'">';
                echo '<div class="salary col-lg-3 col-md-3 mb-3">';
                echo $offer->salary;
                echo (!empty($offer->maxsalary) ? ' - '.$offer->maxsalary : '');
                echo " $offer->currency";
                echo '<div class="salary-fv">'.($offer->manhour ? 'ZA GODZINĘ ' : '').($offer->vat == 1 ? 'BRUTTO' : 'NETTO').'</div>';
                echo '<div class="salary-fv">'.$offer->form.'</div>';
                echo '</div>';
                echo '<div class="title col-lg-9 col-md-9 mb-9"><span class="title-text">'.$offer->title.'</span></div>';
                echo '<div class="location col-lg-7 col-md-7 mb-7"><i class="fas fa-location-arrow"></i> '.$offer->city.', '.$offer->state.'</div>';
                echo '<div class="date col-lg-7 col-md-7 mb-7"><i class="fas fa-clock"></i> '.substr($offer->date, 0, -8).'</div>';
                echo '</a></div>';
                echo '<div class="line"><div class="red-line"></div></div>';
              }


            ?>
		  		</div>
            </div>

          </div>
          <!-- /.row -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="newsletter container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3"></div>
      <div class="col-md-6 col-lg-6 animated bounceInLeft">
        <div class="col-md-10 col-lg-10">
          <div class="title">Zapisz się do Naszego Newslettera!</div>
          <p>Zapisz się do naszego Newslettera, aby co tydzień otrzymywać najciekawsze oferty pracy oraz informacje z branży IT!</p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <label for="email">Wprowadź swój adres E-Mail:</label>
          <div class="form-inline">
                  <?php echo form_open('newsletter/subscribe/'); ?>
                  <input type="email" class="form-control col-lg-7 col-md-7" id="email" name="email" placeholder="jan@kowalski.pl"> 
                  <button type="button" class="btn btn-secondary col-lg-4 col-md-4" id="send" style="margin-left:1rem;">Zapisz się!</button>
                  </form>
          </div>
        </div> 
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 animated bounceInLeft"><img src="<?php echo assets_url(); ?>public/images/Airplane.png"></div>
    </div>
    </div>
