<?php
require_once('DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo ucwords(str_replace('_',' ',$page)) ?> | Restaurant Table Reservation System</title>

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
  <style>

      #page-container{

          flex: 1 1 auto;
          overflow:auto;
      }
      #topNavBar{
          flex: 0 1 auto;
      }
      .thumbnail-img{
          width:50px;
          height:50px;
          margin:2px
      }
      .truncate-1 {
          overflow: hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 1;
          -webkit-box-orient: vertical;
      }
      .truncate-3 {
          overflow: hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 3;
          -webkit-box-orient: vertical;
      }
      .modal-dialog.large {
          width: 80% !important;
          max-width: unset;
      }
      .modal-dialog.mid-large {
          width: 50% !important;
          max-width: unset;
      }
      @media (max-width:720px){

          .modal-dialog.large {
              width: 100% !important;
              max-width: unset;
          }
          .modal-dialog.mid-large {
              width: 100% !important;
              max-width: unset;
          }

      }
      .display-select-image{
          width:60px;
          height:60px;
          margin:2px
      }
      img.display-image {
          width: 100%;
          height: 45vh;
          object-fit: cover;
          background: black;
      }
      /* width */
      ::-webkit-scrollbar {
      width: 5px;
      }

      /* Track */
      ::-webkit-scrollbar-track {
      background: #f1f1f1;
      }

      /* Handle */
      ::-webkit-scrollbar-thumb {
      background: #888;
      }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
      background: #555;
      }
      .img-del-btn{
          right: 2px;
          top: -3px;
      }
      .img-del-btn>.btn{
          font-size: 10px;
          padding: 0px 2px !important;
      }
      #top-avatar{
          height:35px;
          width:35px;
          object-fit:scale-down;
          object-position:center center;
          border-radius: 50% 50%;
      }
  </style>

  </head>
<body>
<header>
  <style>
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
<style>

header nav{

    background-color:#fb911f;
}

.logo span{
    color: #33658A;
}




</style>
<section class="pagemenu" id="pagemenu">
  <div class="container py-3" id="page-container">
      <?php
          if(isset($_SESSION['flashdata'])):
      ?>
      <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?>">
      <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a></div>
          <?php echo $_SESSION['flashdata']['msg'] ?>
      </div>
      <?php unset($_SESSION['flashdata']) ?>
      <?php endif; ?>
      <?php
          include $page.'.php';
      ?>
  </div>
  </main>
  <div class="modal fade" id="uni_modal" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer py-1">
          <button type="button" class="btn btn-sm rounded-0 btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-sm rounded-0 btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
  </div>
  <div class="modal fade" id="uni_modal_secondary" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer py-1">
          <button type="button" class="btn btn-sm rounded-0 btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-sm rounded-0 btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
  </div>
  <div class="modal fade" id="confirm_modal" role='dialog'>
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content rounded-0">
          <div class="modal-header py-2">
          <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
          <div id="delete_content"></div>
      </div>
      <div class="modal-footer py-1">
          <button type="button" class="btn btn-primary btn-sm rounded-0" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
  </div>

  <script>
      $(function(){

      })
  </script>
</section>
</body>
</html>
