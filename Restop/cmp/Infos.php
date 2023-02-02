<div class="infos_pers">
  <h2>Informations personnelles</h2>
  <hr>
  <?php

  $sql = "SELECT * FROM client where id_client=".$_SESSION["Id_client"]."";
  $qry = $conn->query($sql);
  foreach($qry as $k){
      $Id_client=$k["Id_client"];
      $Nom=$k["Nom_client"];
      $Prenom=$k["Prenom_client"];
      $Tel=$k["Tel"];
      $Email=$k["Email"];
    }
   ?>
<form class="" action="" method="post">
  <input type="text" name="p" value="update" hidden>
  <div class="row">
  <div class="form-floating mb-1 mt-2 col">
    <input type="text" class="form-control" id="nom" placeholder="Votre Nom" value="<?php echo $Nom; ?>" name="nom">
    <label for="nom">Nom</label>
  </div>
  <div class="form-floating mb-1 mt-2 col">
    <input type="text" class="form-control" id="prenom" placeholder="Votre Prenom" value="<?php echo $Prenom; ?>" name="prenom">
    <label for="prenom">Prenom</label>
  </div>
  </div>
<div class="row">
<div class="form-floating mb-1 mt-2 col">
  <input type="text" class="form-control" id="email" placeholder="Enter email" value="<?php echo $Email; ?>" name="email">
  <label for="email">Email</label>
</div>
<div class="form-floating mb-1 mt-2 col">
  <input type="text" class="form-control" id="tel" placeholder="Enter Tel" value="<?php echo $Tel; ?>" name="tel">
  <label for="email">Tel</label>
</div>
</div>
<div class="row">
  <input type="submit" name="" class="btn btn-warning" value="Enregistrer">
</div>
<?php
if(isset($_POST['p'])){
  if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['email'])&&isset($_POST['tel'])){
  $sql="UPDATE `client` SET `Nom_client`='".$_POST['nom']."',`Prenom_client`='".$_POST['prenom']."',`Email`='".$_POST['email']."',`Tel`='".$_POST['tel']."' WHERE `Id_client`=".$_SESSION["Id_client"]."";
    			if(!$result = $conn->query($sql)){
    				echo "There was an error running the query"+$conn->error;
    			}
          header("Refresh:0");
    }

}
 ?>
</form>

</div>
