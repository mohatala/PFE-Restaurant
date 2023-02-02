<?php
ob_start();
//session_start();
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
    <style media="screen">

    .logo span{
        color: #33658A;
        font-weight: bold;
        font-size: 1em;
        text-decoration: none;
    }

    .pagemenu{
        width: 100%;

        background-color: #eeeee4;
    }


    </style>

    </head>
<body>
<header>
  <style>
  nav{

      background-color:#fb911f;
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

<section class="pagemenu" id="pagemenu">
  <style media="screen">
    .leftmenu{float: left;width: 30%;background-color:#fff;}
    .content{background-color: #fff;width: 65%;margin-left: 35%;padding: 20px;}
    .leftmenu a {color: black;display: block;padding: 12px;margin-bottom: 2px;}
  </style>
  <div class="leftmenu">
    <a href="Compte.php?p=Infos" class="btn btn-outline-warning">Informations personnelles</a>
      <a href="Compte.php?p=Adresses" class="btn btn-outline-warning">Adresses</a>
      <a href="Compte.php?p=Npass" class="btn btn-outline-warning">Modifier votre mot de passe</a>
      <a href="Compte.php?p=Vcmd" class="btn btn-outline-warning">Vos commandes</a>
      <a href="Compte.php?p=Vres" class="btn btn-outline-warning">Vos reservations</a>
  </div>
  <div class="content">
    <?php //echo $_SESSION["Nom"];
    if(isset($_GET["p"])){
          if($_GET["p"]=="Infos"){
              include_once("cmp/Infos.php");
          }
          else if($_GET["p"]=="Adresses"){
              include_once("cmp/Adresses.php");
          }
          else if($_GET["p"]=="Npass"){
              include_once("cmp/newpass.php");
          }
          else if($_GET["p"]=="Vcmd"){
              include_once("cmp/Vos_commandes.php");
          }
          else if($_GET["p"]=="Vres"){
              include_once("cmp/Vos_reservations.php");
          }
          else if($_GET["p"]=="Dcmd"){
              include_once("cmp/Details_cmd.php");
          }
          }
    //  else{ header("Location:Compte.php");}
     ?>
  </div>

</section>

</body>
</html>
