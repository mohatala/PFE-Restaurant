
<div class="col-12">
  <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Nouveaux Reservations</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                          //  $reservation = $conn->query("SELECT count(reservation_id) as `count` FROM `reservation_list` where   `status` = 0")->fetchArray()['count'];
                            $result = $conn->query("SELECT count(reservation_id) as `count` FROM `reservation_list` where   `status` = 0");
                            while($row = mysqli_fetch_array($result)) {
                            $reservation=$row['count'];
                              }
                            echo $reservation > 0 ? number_format($reservation) : 0 ;
                            ?>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fa-solid fa-bell-concierge fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Commandes Enregistrer</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                          //  $reservation = $conn->query("SELECT count(reservation_id) as `count` FROM `reservation_list` where   `status` < 2")->fetchArray()['count'];
                            $result = $conn->query("SELECT COUNT(DISTINCT id_commande) as 'count' FROM `commande` WHERE Etat='Enregistrer'");
                            while($row = mysqli_fetch_array($result)) {
                            $cmd=$row['count'];
                              }
                            echo $cmd > 0 ? number_format($cmd) : 0 ;
                            ?>
                          </div>
                      </div>
                      <div class="col-auto">

                          <i class="fa-solid fa-basket-shopping fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Reservations d'aujourd'hui
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">

                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php
                                    $result = $conn->query("SELECT count(*) as 'count' FROM `reservation_list` WHERE Day(datetime)=".date('d')." AND Month(datetime)=".date('m')." AND Year(datetime)=".date('Y')."");
                                    while($row = mysqli_fetch_array($result)) {
                                    $cmd=$row['count'];
                                      }
                                    echo $cmd > 0 ? number_format($cmd) : 0 ;
                                    ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>


  </div>

  <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Commande En cours Livraison</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $result = $conn->query("SELECT COUNT(DISTINCT id_commande) as 'count' FROM `commande` WHERE Etat='En Cours Livraison'");
                            while($row = mysqli_fetch_array($result)) {
                            $cmd=$row['count'];
                              }
                            echo $cmd > 0 ? number_format($cmd) : 0 ;
                            ?>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fa-solid fa-bell-concierge fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Commande Livree</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">  <?php
                            $result = $conn->query("SELECT COUNT(DISTINCT id_commande) as 'count' FROM `commande` WHERE Etat='Livree'");
                            while($row = mysqli_fetch_array($result)) {
                            $cmd=$row['count'];
                              }
                            echo $cmd > 0 ? number_format($cmd) : 0 ;
                            ?></div>
                      </div>
                      <div class="col-auto">

                          <i class="fa-solid fa-basket-shopping fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Table
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php
                                    //$table = $conn->query("SELECT count(table_id) as `count` FROM `table_list`")->fetchArray()['count'];
                                    $result = $conn->query("SELECT count(table_id) as `count` FROM `table_list` WHERE type=1");

                                    while($row = mysqli_fetch_array($result)) {

                                    $table=$row['count'];

                                      }
                                    echo $table > 0 ? number_format($table) : 0 ;
                                    ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Salle
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php
                                    //$table = $conn->query("SELECT count(table_id) as `count` FROM `table_list`")->fetchArray()['count'];
                                    $result = $conn->query("SELECT count(table_id) as `count` FROM `table_list` WHERE type=0");

                                    while($row = mysqli_fetch_array($result)) {

                                    $table=$row['count'];

                                      }
                                    echo $table > 0 ? number_format($table) : 0 ;
                                    ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
