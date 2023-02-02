<div class="cmddetails">
  <h2><a href="Compte.php?p=Vcmd"><-</a> Détails de la commande</h2>

  <hr>
  <?php
  $sql = "SELECT commande.*,SUM(prix) as 'prixt' FROM commande where id_commande=".$_GET['idcmd']." GROUP BY id_commande ";
  $qry = $conn->query($sql);
  foreach($qry as $k){
    $prix=$k["prixt"];
  ?>
  <div class="row">
  <div class="col">
  <p>Commande N°: <?php echo $k["id_commande"]; ?></p>
  <p>Prix Totale: <?php echo $prix; ?></p>
  <p>Etat : <?php echo $k["Etat"]; ?></p>
  </div>
  <div class="col">
    <p>Adresse Livraison: <?php echo $k["adresse"]; ?></p>
  </div>
  </div>
  <hr>
  <h5>Liste Plats</h5>
    <hr>
<?php }
  $sql = "SELECT commande.*,plat.* FROM commande,plat WHERE commande.id_plat=plat.id_plat and commande.id_commande=".$_GET['idcmd']."";
  $qry = $conn->query($sql);
  foreach($qry as $k){
      $id_plat=$k["id_plat"];
      $id_client=$k["id_client"];
      $quantite=$k["quantite"];
      $intitule_plat=$k["intitule_plat"];
      $description_plat=$k["description_plat"];
      $prix_plat=$k["prix_plat"];
      $image_plat=$k["image_plat"]; ?>

  <div id="cmdliste" class="row">
    <div class="col">
      <img src="./images/<?php echo $image_plat ?>" >
    </div>
    <div class="col">
      <p><?php echo $intitule_plat ?></p>
    </div>
    <div class="col">
      <p>Prix:</p>
      <p><?php echo $prix_plat*$quantite ?></p>
    </div>

    </div>
<?php }
?>
</div>

<style media="screen">
.cmddetails{

}
#cmdliste{
  background-color: #E8F9FD;
  margin-top: 1%;
  margin-left: 1%;
  width: 95%;
  height: 100px;
}
#cmdliste img{
  width: 80%;
  height: 80%;
  margin-top:5px;
  margin-left:2%;
}
</style>
