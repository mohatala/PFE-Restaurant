<?php
require_once('./DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <FontAwesomeIcon icon="fa-brands fa-facebook-f" />
    <link rel="stylesheet" href="Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./select2/css/select2.min.css">
    <link rel="stylesheet" href="./summernote/summernote-lite.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="DataTables/datatables.min.css">
    <script src="DataTables/datatables.min.js"></script>
    <script src="Font-Awesome-master/js/all.min.js"></script>
    <script src="select2/js/select2.min.js"></script>
    <script src="./summernote/summernote-lite.js"></script>
    <script src="js/script.js"></script>
    <link href="admin/vendor/fontawesome-free1/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Resto</title>
<body>
<header>
  <style>
  nav{

      background-color:#fb911f;
  }
  .logo span{
      color: #2a4963;
  }

</style>
<nav class="navbar navbar-expand-lg navbar-light ">
<a class="navbar-brand logo" href="#"><span>R</span>estop</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
  <li class="nav-item">
    <a class="nav-link" href="index.php#banniere">Accueil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php#apropos">A propos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="Menu.php">Menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="reservation.php">Reservation</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php#expert">Expert</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php#temoignage">Temoignage</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php#contact">Contact</a>
  </li>
  <?php
  $check=0;
  if(isset($_SESSION['Id_client'])){
  @$result= $conn->query("SELECT count(id_panier) as `count` FROM panier where id_client=".$_SESSION['Id_client']."");
  while($row = mysqli_fetch_array($result)) {
      $check=$row['count'];
  }}
  ?>
  <li class="nav-item">
    <a class="nav-link " href="Panier.php" id="alertsDropdown" role="button">
        <i class="fa-solid fa-basket-shopping"></i>
        <span class="badge badge-danger badge-counter"><?php echo $check; ?></span>
        Panier
    </a>
  </li>

  <?php if(isset($_SESSION["Nom"])){ ?>
    <li class="nav-item">
      <div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Bonjour,<?php echo $_SESSION['Nom']; ?>
  </button>
  <div class="dropdown-menu bg-info" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="Compte.php">Votre Compte</a>
    <a class="dropdown-item" href="Panier.php">Votre Panier</a>
    <a class="dropdown-item" href="Compte.php?p=Vcmd">Vos Commandes</a>
    <a class="dropdown-item" href="Compte.php?p=Vres">Votre Reservation</a>
    <a class="dropdown-item" href="Actions.php?a=dec">Deconnexion</a>
  </div>
</div>

    </li>
    <!--<a href="Compte.php" class="btn-reserve"onclick="toggleMenu();">Votre Compte</a>-->
  <?php  } else {?>
      <li class="nav-item">
<a href="Seconnecter.php" class="btn btn-warning"onclick="toggleMenu();">Se Connecter</a>
</li>
<?php } ?>
</ul>

</div>
</nav>

</header>
<style media="screen">



.pagemenu{
    margin-top: 0px;
    width: 100%;

}

.pagemenu{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

</style>
<section class="pagemenu" id="pagemenu">

<style>
.panier{
  border-radius: 15px;
  background-color: #eeeee4;
  width: 60%;
  float: left;

}
.panier h1{
width: 100%;
min-height: 40px;
background-color: #33658A;
border-radius: 15px 15px 0 0;
align-items: center;
justify-content: space-around;
color: #fff;
padding: 10px 0;

}
.panier .vide{
margin-top: -5px;
font-size: 17px;
margin-bottom: 20px;
color: #21ccbb;
font-weight: bold;
margin-left: 30%;
}
.panier button{
border-radius: 15px;
width: 50%;
font-size: 17px;
margin-bottom: 20px;
color: gray;
font-weight: bold;
margin-left: 25%;
}
.panier_item{
  border-radius: 5px;
  background-color: #E8F9FD;
  margin-top: 2%;
  margin-left: 5%;
  width: 90%;
  height: 120px;
}
.panier_item img{
  float: left;
  width: 30%;
  height: 90%;
  margin-top:5px;
  margin-left:2%;
}
 .panier_item .panier_item_info{
  float: left;
  width: 40%;
  height: 100px;
  margin-top:5px;
  margin-left:2%;

}
 .panier_item .panier_item_info h3{
  font-size: 1rem;
  font-weight: bold;

}
 .panier_item .panier_item_info p{
  font-size: 0.8rem;
}
.panier_item .panier_item_prix{
 float: right;
 width: 20%;
 height: 100px;
 margin-top:5px;
 margin-left:2%;
}
.panier_item .panier_item_prix a{

   margin-top: 10%;
}

.counter {
    width: 100px;
    margin-left: 10%;
    margin-top: 10%;
    display: flex;
    align-items: center;
    justify-content: center;

}
.counter input {
    width: 35px;
    border: 0;
    line-height: 20px;
    font-size: 15px;
    text-align: center;
    background: #0052cc;
    color: #fff;
    appearance: none;
    outline: 0;
}
.counter span {
    display: block;
    font-size: 15px;
    padding: 0 5px;
    cursor: pointer;
    color: #0052cc;
    user-select: none;
}
.facture{
  background-color: #E8F9FD;
  width: 30%;
  margin-left: 10%;
  margin-top: 3%;

}
.facture table{
  margin-left: 21%;
}
.facture p{
font-size: 14px;
margin-left: 0%;
color: black;

}
.facture p span{
font-size: 14px;
margin-left: 40%;
color: black;
}
.btn_panier{
border-radius: 15px;
width: 70%;
font-size: 17px;
margin-bottom: 20px;
background-color: #fb911f;
font-weight: bold;
margin-left: 15%;
}
.btn_panier:hover{
background-color: #498dbf;
}
</style>
 <div class="panier">
   <h1>Votre Panier</h1>
   <?php
   $check=0;
   $total=0;
   if(isset($_SESSION['Id_client'])){
   @$result= $conn->query("SELECT count(id_panier) as `count` FROM panier where id_client=".$_SESSION['Id_client']."");
   while($row = mysqli_fetch_array($result)) {
       $check=$row['count'];
   }}
   if($check== 0){
   ?>
     <img src="./images/panier_vide.png" style="width: 70%; margin-top:5px;margin-left:15%;" >
     <p class="vide"> Votre panier est vide </p>
     <button   disabled="true"><span class="mat-button-wrapper"> Valider mon panier</button>
  <?php }
  else{

   ?>

          <?php
          $sql = "SELECT panier.*,plat.* FROM `panier`,plat WHERE panier.id_plat=plat.id_plat and panier.id_client=".$_SESSION['Id_client']."";
          $qry = $conn->query($sql);
          foreach($qry as $k){
              $id_plat=$k["id_plat"];
              $id_panier=$k["id_panier"];
              $id_client=$k["id_client"];
              $quantite=$k["quantite"];
              $intitule_plat=$k["intitule_plat"];
              $description_plat=$k["description_plat"];
              $prix_plat=$k["prix_plat"];
              $image_plat=$k["image_plat"];
              $total+=$quantite*$prix_plat; ?>
          <div class="panier_item">
            <img src="./images/<?php echo $image_plat ?>" >
            <div class="panier_item_info">
              <h3><?php echo $intitule_plat ?></h3>
              <p><?php echo $description_plat ?></p>

            </div>
          <!--  <form id="myForm" action="Actions.php?a=quantite_panier" method="post">-->
            <div class="panier_item_prix">
              <h5 id="prixquantite"><?php echo $quantite*$prix_plat; ?> DHS</h5>
              <div class="counter">

                <span class="down" onClick='decreaseCount(event, this,<?php echo $id_panier;?>)'>-</span>
                <input type="text" name="quantiteinput" value="<?php echo $quantite;?>">
                <span class="up" onClick='increaseCount(event, this,<?php echo $id_panier;?>)'>+</span>

              </div>
              <a href="javascript:delete_id(<?php echo $id_panier;?>)"><i class="fa-regular fa-trash-can"></i>Supprimer</a>

            </div>
  <!--</form>-->
          </div>
          <?php } ?>

  <?php } ?>

 </div>
 <div class="facture">
   <table>
     <tr>
       <td>Sous-total&nbsp&nbsp&nbsp</td><td><?php echo $total; ?> Dhs</td>
     </tr>
     <tr>
       <td>Frais de livraison&nbsp&nbsp&nbsp</td><td> 0 Dhs</td>
     </tr>
     <tr>
       <td>Frais de service&nbsp&nbsp&nbsp</td><td> 0 Dhs</td>
     </tr>
   </table>

<hr>
<a href="Panier.php?cmd"><button class="btn_panier" >Valider mon panier</button></a>
<hr>
<?php if(isset($_GET["cmd"])){ ?>
<div class="commande">
<form class="" action="Actions.php?a=save_cmd" method="post">
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
<p>Nom: <?php echo $Nom.' '.$Prenom; ?></p>
<p>Tel:<?php echo $Tel; ?></p>
<p>Adresse:<?php
$rqsel =$conn->query("SELECT * FROM Adresses where id_client=".$_SESSION["Id_client"]." ");
echo '<select size=1 id="adresse" name="adresse" class="form-select">'."\n";
echo '<option value="-1">--Liste des Adresses--</option>'."\n";
foreach ($rqsel as $row) {
$n=$row['id_adresse'];
  $adresse=$row['adresse'];
  echo '<option value="'.$adresse.'">'.$adresse.'</option>\n';
}

echo '</select>'."\n";
 ?></p>
<p>Notes:</p>
<textarea name="note" rows="4" cols="30"></textarea>
<p>total: <span> <?php echo $total; ?> Dhs</span></p>
<span id="type"><input type="radio" name="typecmd" value="livraison">livraison
<input type="radio" name="typecmd" value="Emporter">Emporter</span><br>
<input type="submit" name="" value="Commander" style="width:60%; margin-left:20%;background-color: #fb911f;">
</form>
</div>

<?php }?>
 </div>
</section>
<?php
if(isset($_GET["id_cmd"])){
echo "<script type='text/javascript'>
        if (window.confirm('Telecharger votre ticket: '))
        {

        window.open('./ticket.php?id=".$_GET['id_cmd']."','_blank');
        };
      </script>";

}
 ?>
<style>
.commande{


}
#type{
  width: 50%;
  margin-left: 25%;
}

</style>

<script type="text/javascript">
function increaseCount(a, b,c) {
var input = b.previousElementSibling;
var value = parseInt(input.value, 10);
value = isNaN(value) ? 0 : value;
value++;
input.value = value;
window.location.href='Actions.php?a=quantite_panier&idpanier='+c+'&qu='+value;
//document.getElementById("myForm").submit();
}

function decreaseCount(a, b,c) {
var input = b.nextElementSibling;
var value = parseInt(input.value, 10);
if (value > 1) {
  value = isNaN(value) ? 0 : value;
  value--;
  input.value = value;
  window.location.href='Actions.php?a=quantite_panier&idpanier='+c+'&qu='+value;
//document.getElementById("myForm").submit();
}
}
</script>
<script type="text/javascript">
    function delete_id(id)
    {
      //  var rep =confirm('Voulez-Vous  supprimer cette Photo ?');
        //if(rep==true)
      //  {
            window.location.href='Actions.php?a=delete_panier&idpanier='+id;
      //  }
    }</script>
</body>
</html>
