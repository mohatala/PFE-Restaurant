<?php
include_once("model/Config.cls.php");
$base=new Connection();
$connect=$base->connect();
//session_start();
include_once("model/Photo.cls.php");?>
<style>
    #menuphoto ul{position:absolute; top:-3%; left:0%; width:96%; height:7%; background-color:rgba(127,28,29,0.79); list-style:none; overflow:hidden; border-bottom:2px solid rgba(187,149,84,1.00); }
    #menuphoto ul li{width:20%; height:100%; display:inline-block;padding-top:0.5%; text-align:center;   color:rgba(204,175,126,1.00);}
    #menuphoto ul li:hover{background-color:rgba(127,28,29,1);color:rgba(187,149,84,1.00);}
    h4{position: absolute; top: 5%;}
    #photosontainer{position:absolute; top:15%; left:0; width:100%; height:84.6%; overflow: auto;  }
    #photosontainer img{width: 30%; height: 30%;  margin-left: 2%; float: left; margin-bottom: 2%; }
    #photosontainer #modimg{width: 60%; height: 70%; position: absolute; top: 10%; left: 20%;  background-color:rgba(127,28,29,0.90);  }
    #photosontainer #modimg img{width: 70%; height: 60%;  position: absolute; top: 2%; left: 15%;   }
    #photosontainer #modimg form{width: 60%; height: 30%;  position: absolute; top: 63%; left: 20%;}
    #photosontainer #ajoutimg{width: 60%; height: 70%; position: absolute; top: 10%; left: 20%;  background-color:rgba(127,28,29,0.90);  }
    #photosontainer #ajoutimg img{width: 70%; height: 60%;  position: absolute; top: 2%; left: 15%;   }
    #photosontainer #ajoutimg form{width: 60%; height: 30%;  position: absolute; top: 63%; left: 20%;}
    #photosontainer #ajoutimg input{ height: 50%;margin-bottom: 2%;}
    #modimgbtn{width:100%; height:100%; background-color:rgba(106,4,4,1.00); border-radius:5px; border: none; margin-left: 0%; text-align:center; padding-top:1%; text-decoration:none; color:rgba(204,175,126,1.00); font-weight:bold;  }
    #modimgbtn:hover{background-color:rgba(106,4,4,0.72);color:rgba(187,149,84,1.00);  }
    #supimgbtn{width:100%; height:100%; background-color:rgba(106,4,4,1.00); border: none;  border-radius:5px;text-align:center; padding-top:1%; text-decoration:none; color:rgba(204,175,126,1.00); font-weight:bold;  }
    #supimgbtn:hover{background-color:rgba(106,4,4,0.72);color:rgba(187,149,84,1.00);  }
    #tblbtn{height: 50%;  width: 100%;}
    #tblbtn td{height: 30%;  width: 50%;}
    #tblbtn a{text-decoration: none;}
    #close{ background-image: url("image/close.png"); position:absolute;  width:5%; height:10%; left: 95%; cursor: pointer;  }
</style>
<nav id="menuphoto">
    <ul>
        <a href="?page=Photos&list=sld"><li>Slider Home</li></a>
        <a href="?page=Photos&list=gal"><li>Galeries</li></a>
        <a href="?page=Photos&list=menu"><li>Menus</li></a>
    </ul>
</nav>
<h4>
    <?php if(isset($_GET["list"])) {
        if ($_GET["list"]=="sld") { echo "Photos de Slider";}
        elseif ($_GET["list"]=="gal") { echo "Galeries";}
        elseif ($_GET["list"]=="menu") { echo "Menus";}
    }
    ?>
</h4>
<div id="photosontainer">
    <?php
    $fld="";
    if(isset($_GET["list"])) {
        if ($_GET["list"] == "sld") {
            $qry = 'select * from photos where typep="slider"';
            $fld="sld_img";
        } else if ($_GET["list"] == "gal") {
            $qry = 'select * from photos where typep="galerie"';
            $fld="gal_img";
        } else if ($_GET["list"] == "menu") {
            $qry = 'select * from photos where typep="menu"';
            $fld="menu";
        }

    $res=$connect->query($qry);
    while($ligne=$res->fetch()){
    ?>
  <a href="?page=Photos&list=<?php echo $_GET['list']?>&Modifierphoto&id=<?php echo $ligne["id"];?>&nom=<?php echo $ligne["nomp"];?>"><img src="image/<?php echo $fld."/".$ligne["nomp"];?>" alt="imgsld" ></a>
  <?php }
        //if ($_GET["list"] == "sld") {?>
    <a href="?page=Photos&list=<?php echo $_GET['list']?>&Ajouterphoto"><img src="image/sld_img/Ajouterimg.png" alt="Ajouter image" title="Ajouter Photo"  ></a>
      <?php //}
      }

    if(isset($_GET["Modifierphoto"])){
    ?>
 <div id="modimg">
     <span id="close"></span>
     <img src="image/<?php echo $fld;?>/<?php echo $_GET["nom"];?>" alt="imgsld" >
     <form action="control/control.php?list=<?php echo $_GET["list"];?>" method="post" enctype="multipart/form-data" >
         <input type="hidden" name="pg" value="modifierimage">
         <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
         <input type="hidden" name="fld" value="<?php echo $fld;?>">
         <input type="file" name="image"></br>
        <table id="tblbtn">
        <tr><td> <input type="submit" value="Modifier" id="modimgbtn"></td>
        <td> <a href="javascript:delete_id(<?php echo $_GET["id"]?>)" ><input type="button" value="Supprimer" id="supimgbtn"></a></td>
        </tr></table>
     </form>
     <?php $_SESSION["typep"]=$_GET["list"];?>

 </div>
    <?php }
    if(isset($_GET["Ajouterphoto"])){
        ?>
        <div id="ajoutimg">
            <span id="close"></span>
            <img src="image/sld_img/" alt="Choisie Une image " >
            <form action="control/control.php?list=<?php echo $_GET["list"];?>" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="pg" value="Ajouterimage">
                <input type="hidden" name="fld" value="<?php echo $fld;?>">
                <input type="file" name="image"></br>
                <input type="submit" value="Ajouter" id="modimgbtn">
            </form>

        </div>
    <?php }?>
</div>

<script type="text/javascript">
    $(function () {
        // A chaque sélection de fichier
        $('form').find('input[name="image"]').on('change', function (e) {
            var files = $(this)[0].files;

            if (files.length > 0) {
                var file = files[0],
                    $image_preview = $('#modimg');
                $image_preview.find('img').attr('src', window.URL.createObjectURL(file));

            }})
    });
</script>
    <script type="text/javascript">
        $(function () {
            // A chaque sélection de fichier
            $('form').find('input[name="image"]').on('change', function (e) {
                var files = $(this)[0].files;

                if (files.length > 0) {
                    var file = files[0],
                        $image_preview = $('#ajoutimg');
                    $image_preview.find('img').attr('src', window.URL.createObjectURL(file));

                }})
        });
</script>
<script type="text/javascript">
    function delete_id(id)
    {
        var rep =confirm('Voulez-Vous  supprimer cette Photo ?');
        if(rep==true)
        {
            window.location.href='control/control.php?delete_id='+id;
        }
    }</script>

<script type="text/javascript">
    $(document).ready(function() {
        $( "#close" ).click(function() {
            $("#modimg").css("visibility","hidden");
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $( "#close" ).click(function() {
            $("#ajoutimg").css("visibility","hidden");
        });
    });
</script>