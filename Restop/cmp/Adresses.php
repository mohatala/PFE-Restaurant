<div class="adresses">
  <h2>Mes Adresses</h2>
  <hr>
<form class="" action="" method="post">
<div class="row">
  <div class="col">
<?php
$rqsel =$conn->query("SELECT * FROM Adresses where id_client=".$_SESSION["Id_client"]." ");
echo '<select size=1 id="adresse" name="adresse" class="form-select">'."\n";
echo '<option value="-1">--Liste des Adresses--</option>'."\n";
foreach ($rqsel as $row) {
$n=$row['id_adresse'];
  $adresse=$row['adresse'];
  echo '<option value="'.$n.'">'.$adresse.'</option>\n';
}

echo '</select>'."\n";
 ?>
 </div>
 <div class="col">
 <input type="submit" name="" class="btn btn-info" value="Afficher">
 </div>
</div>
</form>
<?php
if(isset($_POST["adresse"])){
  ?>
<div id="box" class="row">
  <form class="" action="" method="post">

<?php
    $qry =$conn->query("SELECT * FROM Adresses where id_adresse=".$_POST["adresse"]." ");
    foreach($qry as $k){
        $id_adresse=$k["id_adresse"];
        $adresse=$k["adresse"];
    }
   ?>
   <input type="text" name="id_adresse" value="<?php echo $id_adresse; ?>" hidden>
  <textarea name="adr" rows="3" cols="60"><?php echo $adresse;  ?></textarea>
</div>
<div class="row" id="btnsave">
  <input type="submit" class="btn btn-warning" value="Enregistrer">
</div>

</form>
<?php } ?>
<?php
if(isset($_POST["adr"])&& isset($_POST["id_adresse"])){
  $sql="UPDATE `adresses` SET `adresse`='".$_POST['adr']."' WHERE `id_adresse`=".$_POST["id_adresse"]."";
    			if(!$result = $conn->query($sql)){
    				echo "There was an error running the query".$conn->error;
    			}
          header("Refresh:0");
}
 ?>
<style>
#box{
  margin-top: 10px;
}
#btnsave{
    margin-top: 10px;
}
</style>
</div>
