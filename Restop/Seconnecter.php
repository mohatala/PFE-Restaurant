<?php
ob_start();
require_once('./DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();
session_start();
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
    <title>Resto</title>
    <style media="screen">

    nav{
        background-color:#fb911f;
    }


    .logo{
        color: #fff;
        font-weight: bold;
        font-size: 1.5em;
        text-decoration: none;
    }
    .logo span{
        color: #2a4963;
        font-size: 1.5em;
    }

    .pagemenu{
        margin-top: 0px;
    }

    .pagemenu .contenu{

        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .pagemenu .contenu .box{
        width: 180px;
        margin: 20px;
        border: 20px solid #fff;
        box-shadow: 5px 10px 15px rgba(0,0,0, 0.8);
    }

    .pagemenu .contenu .box .imbox{
        position: relative;
        width: 100%;
        height: 100px;
    }

    .pagemenu .contenu .box .imbox img{
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 100px;
        object-fit: cover;
    }

    .pagemenu .contenu .box .text{
        text-align: center;
        font-weight: 100px;
        color: #111;
    }
    .pagemenu .contenu .box .text p{
        color: #111;
    }
    .pagemenu .contenu .box .text h3{
      font-size: 1.2rem;
        font-weight: 100;

    }

    </style>

    </head>
<body>
<header>
  <style>
  .dropbtn {
  background-color: #33658A;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;

  }

  .dropdown {
  position: relative;
  display: inline-block;
  margin-left: 20px;
  margin-top: -20px;
  }

  .dropdown-content {
  display: none;
  position: absolute;
  background-color: #33658A;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  }

  .dropdown-content a {
  color: black;
  padding: 5px 15px;
  text-decoration: none;
  display: block;
  }

  .dropdown-content a:hover {background-color: #498dbf;}

  .dropdown:hover .dropdown-content {display: block;}

  .dropdown:hover .dropbtn {background-color: #498dbf;}
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
      ?>
      <li class="nav-item">
        <a class="nav-link " href="Panier.php" id="alertsDropdown" role="button">
            <i class="fa-solid fa-basket-shopping"></i>
            <span class="badge badge-danger badge-counter"><?php echo $check; ?></span>
            Panier
        </a>
      </li>

          <li class="nav-item">
    <a href="Seconnecter.php" class="btn btn-warning"onclick="toggleMenu();">Se Connecter</a>
    </li>
    </ul>

    </div>
    </nav>

</header>

<section class="pagemenu" id="pagemenu">
  <div class="container" id="container">
  	<div class="form-container sign-up-container">
  		<form action="" method="post">
  			<h1>Créer un compte</h1>
        <input type="text" name="p" value="create" hidden />
  			<input type="text" name="nom" placeholder="Nom" required />
        <input type="text" name="prenom" placeholder="Prenom" required />
  			<input type="email" name="email" placeholder="Email" required />
        <input type="tel" name="tel" placeholder="Tel"  required/>
        <input type="text" name="adresse" placeholder="Adresse" required />
  			<input type="password" name="password" placeholder="Password"  required/>
  			<button>S'inscrire</button>
  		</form>
  	</div>
  	<div class="form-container sign-in-container">
  		<form action="" method="post">
  			<h1>S'identifier</h1>
        <input type="text" name="p" value="login" hidden />
  			<input type="email" name="email" placeholder="Email" />
  			<input type="password" name="password" placeholder="Password" />
  			<!--<a href="#">Forgot your password?</a>-->
  			<button>S'identifier</button>
  		</form>
  	</div>
  	<div class="overlay-container">
  		<div class="overlay">
  			<div class="overlay-panel overlay-left">
  				<h1>Content de te revoir!</h1>
  				<p>Pour rester en contact avec nous, veuillez vous connecter avec vos informations personnelles</p>
  				<button class="ghost" id="signIn">S'identifier</button>
  			</div>
  			<div class="overlay-panel overlay-right">
  				<h1>Salut l'ami!</h1>
  				<p>Entrez vos données personnelles et commander votre menu</p>
  				<button class="ghost" id="signUp">S'inscrire</button>
  			</div>
  		</div>
  	</div>
  </div>
  <script type="text/javascript">

  </script>
<?php
if (isset($_POST["p"])) {
if($_POST["p"]=="login"){
        //try{
        //echo "<script type='text/javascript'>alert('hi')</script>";
            //$rep=$conn->query("select * from client where Email='".$_POST['email']."' and Password='".md5($_POST['password'])."'");

  // If form submitted, insert values into the database.
  if (isset($_POST['email'])&&isset($_POST['password'])){
  	$username = stripslashes($_REQUEST['email']);
  	$username = mysqli_real_escape_string($conn,$username);
  	$password = stripslashes($_REQUEST['password']);
  	$password = mysqli_real_escape_string($conn,$password);
  	//Checking is user existing in the database or not
          $query = "SELECT * FROM `client` WHERE Email='$username'
  and Password='".md5($password)."'";
  	$result = mysqli_query($conn,$query) or die(mysql_error());
  	$rows = mysqli_num_rows($result);
          if($rows==1){

                foreach ($result as $ligne ){
                  $_SESSION['Id_client'] = $ligne['Id_client'];
                  $_SESSION['Nom'] = $ligne['Nom_client'];
                  // Redirect user to index.php

      	           header("Location: index.php");
                }

           }else{
  	echo "<div class='form'>
  <h3>Username/password is incorrect.</h3>
  <br/>Click here to <a href='Seconnecter.php'>Login</a></div>";
  	}
  }else{
    header("Location: Seconnecter.php");
  }

      //  }catch(Exception $ex){}
    }
    else if($_POST["p"]=="create"){
    //  try{
            $sql="INSERT INTO client VALUES (null,'".$_POST['nom']."','".$_POST['prenom']."','".$_POST['email']."','".$_POST['tel']."','".md5($_POST['password'])."')";
                if(!$result = $conn->query($sql)){
                  echo "There was an error running the query"+$conn->error;
                }
                //'".$_POST['adresse']."',
            $res=$conn->query("select Id_client from client where Nom_client='".$_POST['nom']."' and Prenom_client='".$_POST['prenom']."'");
        			foreach ($res as $row) {
                $id =$row['Id_client'];
      			}
      		  if(isset($_POST['adresse'])){
      			  $a=$_POST['adresse'];
      				  $sql="INSERT INTO adresses  VALUES (null,".$id.",'".$a."')";
          			if(!$result = $conn->query($sql)){
          				echo "There was an error running the query"+$conn->error;
          			}

      		  }
    //  }catch(Exception $ex){}
    }
  }
 ?>
</section>
<style media="screen">
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
box-sizing: border-box;
}



h1 {
font-weight: bold;
margin: 0;
}

h2 {
text-align: center;
}

p {
font-size: 14px;
font-weight: 100;
line-height: 20px;
letter-spacing: 0.5px;
margin: 20px 0 30px;
}

span {
font-size: 12px;
}

a {
color: #333;
font-size: 14px;
text-decoration: none;
margin: 15px 0;
}

button {
border-radius: 20px;
border: 1px solid #FF4B2B;
background-color: #FF4B2B;
color: #FFFFFF;
font-size: 12px;
font-weight: bold;
padding: 12px 45px;
letter-spacing: 1px;
text-transform: uppercase;
transition: transform 80ms ease-in;
}

button:active {
transform: scale(0.95);
}

button:focus {
outline: none;
}

button.ghost {
background-color: transparent;
border-color: #FFFFFF;
}

form {
background-color: #FFFFFF;
display: flex;
align-items: center;
justify-content: center;
flex-direction: column;
padding: 0 50px;
height: 100%;
text-align: center;
}

input {
background-color: #eee;
border: none;
padding: 12px 15px;
margin: 8px 0;
width: 100%;
}

.container {
background-color: #fff;
border-radius: 10px;
  box-shadow: 0 14px 28px rgba(0,0,0,0.25),
    0 10px 10px rgba(0,0,0,0.22);
position: relative;
overflow: hidden;
width: 768px;
height: 550px;
max-width: 100%;
min-height: 480px;
top: -20px;
}

.form-container {
position: absolute;
top: 0;
height: 100%;
transition: all 0.6s ease-in-out;
}

.sign-in-container {
left: 0;
width: 50%;
z-index: 2;
}

.container.right-panel-active .sign-in-container {
transform: translateX(100%);
}

.sign-up-container {
left: 0;
width: 50%;
opacity: 0;
z-index: 1;
}

.container.right-panel-active .sign-up-container {
transform: translateX(100%);
opacity: 1;
z-index: 5;
animation: show 0.6s;
}

@keyframes show {
0%, 49.99% {
  opacity: 0;
  z-index: 1;
}

50%, 100% {
  opacity: 1;
  z-index: 5;
}
}

.overlay-container {
position: absolute;
top: 0;
left: 50%;
width: 50%;
height: 100%;
overflow: hidden;
transition: transform 0.6s ease-in-out;
z-index: 100;
}

.container.right-panel-active .overlay-container{
transform: translateX(-100%);
}

.overlay {
background: #FF416C;
background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
background: linear-gradient(to right, #FF4B2B, #FF416C);
background-repeat: no-repeat;
background-size: cover;
background-position: 0 0;
color: #FFFFFF;
position: relative;
left: -100%;
height: 100%;
width: 200%;
  transform: translateX(0);
transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  transform: translateX(50%);
}

.overlay-panel {
position: absolute;
display: flex;
align-items: center;
justify-content: center;
flex-direction: column;
padding: 0 40px;
text-align: center;
top: 0;
height: 100%;
width: 50%;
transform: translateX(0);
transition: transform 0.6s ease-in-out;
}

.overlay-left {
transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
transform: translateX(0);
}

.overlay-right {
right: 0;
transform: translateX(0);
}

.container.right-panel-active .overlay-right {
transform: translateX(20%);
}

.social-container {
margin: 20px 0;
}

.social-container a {
border: 1px solid #DDDDDD;
border-radius: 50%;
display: inline-flex;
justify-content: center;
align-items: center;
margin: 0 5px;
height: 40px;
width: 40px;
}

</style>
<script type="text/javascript">
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
container.classList.remove("right-panel-active");
});
</script>
</body>
</html>
