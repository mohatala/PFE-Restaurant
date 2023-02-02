<div class="commande">
  <h2>Vos Commandes</h2>
  <hr>
  <?php
  $sql = "SELECT commande.*,SUM(prix) as 'prixt' FROM commande where id_client=".$_SESSION['Id_client']." GROUP BY id_commande ";
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
   </div>

 <div class="col">
 <a href="Compte.php?p=Dcmd&idcmd=<?php echo $k["id_commande"];?>" class="btn btn-primary">Details</a>
 </div>
</div>
<?php
}
  ?>
<style>
.row{
  border: 1px solid;
  margin-top: 2%;
  margin-left: 1%;
}
</style>
</div>
