<div class="infos_pers">
  <h2>Modifier votre mot de passe</h2>
  <hr>
<form class="" action="" method="post">
  <input type="text" name="p" value="pass" hidden>
  <div class="row">
  <div class="form-floating mb-1 mt-2 col">
    <input type="password" class="form-control" id="passactuel" placeholder="Mot de passe actuel" value="" name="passactuel">
    <label for="nom">Mot de passe actuel</label>
  </div>
  </div>
  <div class="row">
  <div class="form-floating mb-1 mt-2 col">
    <input type="password" class="form-control" id="Npass" placeholder="Nouveau mot de passe" value="" name="Npass">
    <label for="prenom">Nouveau mot de passe</label>
  </div>
  </div>
<div class="row">
<div class="form-floating mb-1 mt-2 col">
  <input type="password" class="form-control" id="SNpass" placeholder="Saisissez à nouveau le mot de passe" value="" name="SNpass">
  <label for="email">Saisissez à nouveau le mot de passe</label>
</div>

</div>
<div class="row">
  <input type="submit" name="" class="btn btn-warning" onclick="matchPassword()" value="Enregistrer">
</div>
<?php

if(isset($_POST['p'])){
  if(isset($_POST['passactuel'])&&isset($_POST['Npass'])&&isset($_POST['SNpass'])){
    if($_POST['Npass']==$_POST['SNpass']){
   $sql = "SELECT * FROM client where id_client=".$_SESSION["Id_client"]." and Password='".md5($_POST['passactuel'])."'";
    $qry = $conn->query($sql);
    foreach($qry as $k){
        $Id_client=$k["Id_client"];
      }

  $sql="UPDATE `client` SET `Password`='".md5($_POST['Npass'])."'WHERE `Id_client`=".$Id_client."";
    			if(!$result = $conn->query($sql)){
    				echo "There was an error running the query"+$conn->error;
    			}
          //header("Refresh:0");
    }
    else {
      echo "<script> alert('Passwords did not match');</script>";
    }
  }

}
 ?>
</form>

</div>
