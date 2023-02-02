<?php
require_once('./DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();
//session_start();

$query = "UPDATE pages SET total_views = total_views + 1 WHERE id=1";
if(!mysqli_query($conn, $query))
      {
        echo "Error updating record: " . mysqli_error($conn);
      }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" >
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <FontAwesomeIcon icon="fa-brands fa-facebook-f" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;900&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="admin/vendor/fontawesome-free1/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Resto</title>
<style media="screen">
nav{

    background-color:#fb911f;
}
.logo{
    color: #fff;
    font-weight: bold;
    font-size: 2em;
    text-decoration: none;
}
.logo span{
    color: #2a4963;
}


.btn-reserve{
    padding: 10px 20px;
    background: #fb911f;
   margin-top: -10px;
   text-transform:uppercase ;
}

.btn-reserve:hover{
    background: #d87710;
    transition: ease-out;
}


.banniere{
    position: relative;
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url(./images/logo.jpg);
    background-size: cover;
}

.banniere .contenu{
    max-width: 70%;
    text-align: center;
}
.banniere .contenu h2{
    color: #fff;
    font-size: 3em;
    text-transform: capitalize;
}
.contenu p:nth-child(2){
    color: #ffff;
    font-size: 1.2em;
}

.btn1{
    font-size: 1em;
    color: #fff;
    background: #fb911f;
    padding: 10px 20px;
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: 0.5s;
    margin-left: 10px;
}
.btn2{
    font-size: 1em;
    color: #fff;
    background: #2a4963;
    padding: 10px 20px;
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: 0.5s;
    margin-left: 10px;
}

.btn1:hover{
letter-spacing: 4px;
}
section{
    padding: 100px;
}
.row{
    position: relative;
    width: 100%;
    display: flex;
    justify-content: space-between;
}

.row .col50{
    position: relative;
    width: 48%;
    justify-content: center;
    align-items: center;

}

.row .col50 h2{
    margin-bottom: 20px;
}

.titre-texte{
    color: #000;
    font-size: 2em;
    font-weight: 300px;
    text-transform: capitalize;
}

.titre-texte span{
    color: #fb911f;
    font-size: 1.5em;
    font-weight: 700px;
}

.row .col50 img{
    height: 450px;
    width: 600px;
    position: relative;
}

.titre{
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.menu{
    margin-top: -100px;
}

.menu .contenu{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

.menu .contenu .box{
    width: 100px;
    margin: 20px;
    border: 20px solid red;
    box-shadow: 20px 15px 35px rgba(0,0,0, 0.8);
}

.menu .contenu .box .imbox{
    position: relative;
    width: 100%;
    height: 100px;
}

.menu .contenu .box .imbox img{
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.menu .contenu .box .text{
    text-align: center;
    font-weight: 100px;
    color: #111;
}

.menu .contenu .box .text h3{
    font-weight: 400;
}

.expert{
    margin-top:-100px;
}

.expert .contenu{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 40px;
}

.expert .contenu .box{
    width: 250px;
    margin: 15px;
}
.expert .contenu .box img{
    position: relative;
    width: 100%;
    height: 300px;
    top: 0;
    left: 0;
    object-fit: cover;
}

.expert .contenu .box h3{
    color: #111;
    font-weight: 400;
    text-align: center;
}


.blanc .titre-texte{
    color: #fff;
}

.blanc .titre-texte,
.blanc p{
    color: #fff;
}

.contact{
    background-image: url(./images/img-form.jpg);
    background-size: cover;
    box-shadow: 2px 2px 12px rgba(0,0,0, 0.8);
    width: 100%;
    background-position: unset;
}

.contactform{
    padding: 75px 50px;
    background: #fff;
    box-shadow: 5px 15px 50px rgba(0,0,0, 0.8);
    max-width: 500px;
    margin-top: 50px;
    justify-content: center;
    align-items: center;
    margin-left: 38%;
}

.contactform .inputboite{
    position: relative;
    width: 100%;
    margin-bottom: 20px;
}

.contactform h3{
    color: #111;
    font-size: 1.2em;
    margin-bottom: 20px;
}

.contactform .inputboite input,
.contactform .inputboite textarea{
    width: 100%;
    border: 1px solid #555;
    padding: 10px;
    color: #111;
    outline: none;
    font-size: 16px;
    font-weight: 300;
    resize: none;
}

.contactform .inputboite input[type="submit"]{
    font-size: 1em;
    font-weight: 700;
    color: #ffff;
    background: #fb911f;
    display: inline-block;
    cursor: pointer;
    text-transform: uppercase;
    text-decoration: none;
    letter-spacing: 2px;
    outline: none;
    border: none;
    transition: 0.5s;
    max-width: 120px;
    align-items: center;
    justify-content: center;
}

.copyright{
    padding: 20px 40px;
    border-top: 2px solid rgba(0,0,0, 0.1);
    background: rgba(228,222,222,);
    text-align: center;
}

.copyright p:nth-child(1){
    color: #333;
}

.copyright a {
    color: #fb911f;
    text-decoration: none;
    font-weight: 600;
    font-style: italic;
}

.contact .titre-text span{
    color: #fb911f;
    font-size: 2em;
}




</style>
    </head>
<body>
<header>
  <style>


</style>

  <!--  <div class="menuToggle" onclick="toggleMenu();">

  </div>-->
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
        <div class="nav-link dropdown">
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
<section class="banniere" id="banniere">
    <div class="contenu">
        <h2>RESTOP SERVI QUE DES PLATS TOP</h2>
        <p></p>
        <a href="#menu" class="btn1">Notre Menu</a>
        <a href="reservation.php" class="btn2">Reservation</a>
    </div>
</section>
<section class="apropos" id="apropos">
    <div class="row">
        <div class="col50">
          <?php
          $sql = "SELECT * FROM apropos";
          $qry = $conn->query($sql);
          foreach($qry as $k){
              $Id_apropos=$k["Id_apropos"];
              $Title=$k["Title"];
              $Description=$k["Description"];
              $Img_apropos=$k["Img_apropos"];
            }
            $t=explode(" ",$Title);
    ?>
          <h2 class="titre-texte"><span><?php echo $t[0]; ?></span><?php echo ' '.$t[1].' '.$t[2].' '.$t[3]; ?></h2>
          <p> <?php echo $Description;?>  </p>
        </div>
        <div class="col50">
            <div class="img">
                <img src="./images/<?php echo $Img_apropos; ?>" alt="image">
            </div>
        </div>
    </div>
</section>
<style>
.menu{
    margin-top: -100px;
}

.menu .contenu{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

.menu .contenu .box{
    width: 200px;
    margin: 20px;
    border: 20px solid #fff;
    box-shadow: 20px 15px 35px rgba(0,0,0, 0.8);
}

.menu .contenu .box .imbox{
    position: relative;
    width: 100%;
    height: 100px;
}

.menu .contenu .box .imbox img{
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.menu .contenu .box .text{
    text-align: center;
    font-weight: 50px;
    color: #111;
}
.menu .contenu .box .text p{
    color: #111;
}
.menu .contenu .box .text h3{
    font-weight: 50;
}
</style>
<section class="menu" id="menu">

    <div class="titre">
        <h2 class="titre-texte"><span>M</span>enu De Jour</h2>

    </div>
    <div class="contenu">
      <?php
      $d=date("Y-m-d");
      $sql = "SELECT plat.* FROM plat,menu_du_jour WHERE plat.id_plat=menu_du_jour.id_plat and menu_du_jour.date_mj='".$d."'";
      $qry = $conn->query($sql);
      foreach($qry as $k){
          $id_plat=$k["id_plat"];
          $intitule_plat=$k["intitule_plat"];
          $description_plat=$k["description_plat"];
          $prix_plat=$k["prix_plat"];
          $image_plat=$k["image_plat"];
?>
<div class="box">
    <div class="imbox">
        <img src="./images/<?php echo $image_plat; ?>" alt="">
    </div>
    <div class="text">
      <form id="itemform" action="./Actions.php?a=save_item" method="post">
        <input type="text" name="id_client" value="<?php
          if(isset($_SESSION['Id_client'])){
         echo $_SESSION['Id_client'];} ?>" hidden>
        <input type="text" name="id_plat" value="<?php echo $id_plat; ?>" hidden>
        <input type="text" name="quantite" value="1" hidden>
        <h3><?php echo $intitule_plat; ?></h3>
        <p><?php echo $prix_plat; ?> DHS</p>
        <?php if(isset($_SESSION['Id_client'])){ ?>
        <input type="submit" class="btn btn-info" name="" value="Ajouter Panier">
      <?php }else {?>
        <a href="Seconnecter.php" class="btn btn-info" name="">Ajouter Panier</a>
      <?php  } ?>
      </form>
    </div>
</div>
<?php
      }
      ?>

    </div>
 </div>
 <div class="titre">
    <a href="Menu.php" class="btn1">Voir Plus</a>
 </div>


</section>
<section class="expert" id="expert">
    <div class="titre">
        <h2 class="titre-texte">Nos <span>E</span>xperts</h2>

    </div>
    <div class="contenu">
      <?php
      $sql = "SELECT * FROM expert";
      $qry = $conn->query($sql);
      foreach($qry as $k){
          $Id_expert=$k["Id_expert"];
          $Nom_expert=$k["Nom_expert"];
          $Specialite_expert=$k["Specialite_expert"];
          $Img_expert=$k["Img_expert"];

?>
        <div class="box">
            <div class="imbox">
                <img src="./images/<?php echo $Img_expert; ?>" alt="">
            </div>
            <div class="text">
                <h3><?php echo $Nom_expert; ?></h3>
            </div>
        </div>

      <?php } ?>
    </div>
 </div>
</section>
<style media="screen">
.temoignage{
    background-image: url(./images/bg2.jpg);
    background-size: cover;
}
.temoignage .contenu{
  width: 100%;
}


.temoignage .box{
    width: 340px;
    margin: 20px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 15px;
    padding: 40px;
    float: left;
}

.temoignage .box .imbox{
    width: 80px;
    height: 80px;
    border-radius: 50px;
    position: relative;
    margin-bottom: 20px;
    overflow: hidden;
}

.temoignage .box .imbox img{
    position: relative;
    width: 100%;
    height: 100%;
    top:0;
    left: 0;
    object-fit: cover;
    justify-content: center;
    align-items: center;
}

.temoignage .box .text{
    text-align: center;
    color: #666;
    font-style: italic;
}

.temoignage .box .text h3{
    color: #fb911f;
    margin-top: 20px;
    font-size: 1em;
    font-weight: 600;
}

</style>
 <section class="temoignage" id="temoignage">
    <div class="titre blanc">
        <h2 class="titre-texte">Que Disent Nos <span>C</span>lients</h2>
    </div>
    <?php
    $Data=array();
    $sql = "SELECT * FROM temoignage";
    $qry = $conn->query($sql);
    foreach($qry as $k){
        $Id_temoignage=$k["Id_temoignage"];
        $Avis=$k["Avis"];
        $Id_client=$k["Id_client"];
        $Affichernom=$k["Affichernom"];
          if($Affichernom==1){
            $sql1 = "SELECT Nom_client FROM client where Id_client=".$Id_client."";
            $qry1 = $conn->query($sql1);
            foreach($qry1 as $k1){
              $Nom_client=$k1["Nom_client"];
            }
          }
          else {
            $Nom_client="Client";
          }
       array_push($Data,array($Id_temoignage,$Avis,$Nom_client));
      }
      //print_r($Data);

?>
    <div class="contenu">

      <!-------------------------------------------------->
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
    <!-- use jssor.slider.debug.js instead for debug -->
    <script>
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
              $AutoPlay: true,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>

    <style>

        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('image/img/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        */
        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('image/img/a22.png') center center no-repeat;
            overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
        .temoignage #jssor_1{

            position: relative; margin: 0 auto; top: 0px; left: 0px;width: 1300px; height: 500px; overflow: hidden; visibility: hidden;
        }
    </style>


    <div id="jssor_1" >
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('image/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
           <?php
           for ($i = 0; $i < count($Data); $i+=3) {
           ?>
           <div class="data-p="225.00" style="display: none;"">
             <?php if (array_key_exists($i,$Data))
              { ?>
           <div class="box">
               <div class="imbox" data-u="image">
                   <img src="./images/client.png" alt="">
               </div>
               <div class="text">
                   <p><?php echo $Data[$i][1]; ?></p>
                   <h3><?php echo $Data[$i][2]; ?></h3>
               </div>
           </div>
         <?php }
         if (array_key_exists($i+1,$Data))
          {?>
           <div class="box">
               <div class="imbox">
                   <img src="./images/client.png" alt="">
               </div>
               <div class="text">
                   <p><?php echo $Data[$i+1][1]; ?></p>
                   <h3><?php echo $Data[$i+1][2]; ?></h3>
               </div>
           </div>
         <?php }
         if (array_key_exists($i+2,$Data))
          {?>
           <div class="box">
               <div class="imbox">
                   <img src="./images/client.png" alt="">
               </div>
               <div class="text">
                   <p><?php echo $Data[$i+2][1]; ?></p>
                   <h3><?php echo $Data[$i+2][2]; ?></h3>
               </div>
           </div>
         <?php } ?>
         </div>
            <?php }?>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>



<!------------*****************-------------------->
    </div>


 </section>
 <section class="contact" id="contact">
   <style media="screen">
   .contact{
       background-image: url(./images/img-form.jpg);
       background-size: cover;
       box-shadow: 2px 2px 12px rgba(0,0,0, 0.8);
       width: 100%;
       height: 800px;
       background-position: unset;
   }
   .contactform{
       padding: 75px 50px;
       background: #fff;
       box-shadow: 5px 15px 50px rgba(0,0,0, 0.8);
       width: 40%;
       margin-top: 50px;
       justify-content: center;
       align-items: center;
       margin-left: 5%;
       float:left;
   }
   #restinfos{
     width: 50%;
     margin-top: 20px;
     float: right;
   }
   </style>
   <?php
   $sql = "SELECT * FROM contact";
   $qry = $conn->query($sql);
   foreach($qry as $k){
       $Id_contact=$k["Id_contact"];
       $Phone_contact=$k["Phone_contact"];
       $Email_contact=$k["Email_contact"];
       $Adresse=$k["Adresse"];
       $Adresse_map=$k["Adresse_map"];
     }
     //print_r($Data);

?>
     <div class="titre noir">
         <h2 class="titre-text"><span>C</span>ontact</h2>
     </div>
     <div class="contactform">
         <h3>Envoyer un message</h3>
         <form class="" action="Actions.php?a=save_email" method="post">
         <div class="inputboite">
             <input type="text" name="nom" placeholder="Nom">
         </div>
         <div class="inputboite">
            <input type="text" name="email" placeholder="email">
         </div>
         <div class="inputboite">
            <textarea name="msg" placeholder="message"></textarea>
         </div>
         <div class="inputboite">
             <input type="submit" value="envoyer">
         </div>
       </form>
     </div>
     <div id="restinfos">
        <div>
          <h2>Nos Infos</h2>
          <h3><b>Phone:</b><?php echo $Phone_contact; ?></h3>
          <h3><b>Email:</b><?php echo $Email_contact; ?></h3>
          <h3><b>Adresse:</b><?php echo $Adresse; ?></h3>
        </div>
        <div id="map">
          <iframe src="<?php echo $Adresse_map; ?>" width="100%" height="55%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>

 </section>



 <div class="copyright">
      <a href="#">Restop</a>  © Copyright 2022
 </div>

</body>
</html>
