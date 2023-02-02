
<div class="col-12">
  <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Nombre de Visiteurs</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $result = $conn->query("SELECT total_views FROM `pages` where  id=1");
                            while($row = mysqli_fetch_array($result)) {
                            $total=$row['total_views'];
                              }
                            echo $total > 0 ? number_format($total) : 0 ;
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
                              Total Commandes</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $result = $conn->query("SELECT COUNT(DISTINCT id_commande) as 'nb_cmd' FROM `commande`");
                            while($row = mysqli_fetch_array($result)) {
                            $nb_cmd=$row['nb_cmd'];
                              }
                            echo $nb_cmd > 0 ? number_format($nb_cmd) : 0 ;
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
                            Nombre Client Inscrit
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php
                                    $result = $conn->query("SELECT COUNT(Id_client) as 'nb_cl' FROM `client`");
                                    while($row = mysqli_fetch_array($result)) {
                                    $nb_cl=$row['nb_cl'];
                                      }
                                    echo $nb_cl > 0 ? number_format($nb_cl) : 0 ;
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
