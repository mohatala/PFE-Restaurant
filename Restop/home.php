<nav class="navbar navbar-expand-lg navbar-light ">
<a class="navbar-brand logo" href="#">Reservation dans Restaurant</a>
<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
  <li class="nav-item">
    <a class="nav-link" href="reservation.php?Type=T">Tables</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="reservation.php?Type=S">Salles</a>
  </li>
</ul>
</nav>
<hr>
<?php
if(isset($_GET['Type']) && $_GET['Type']=='T'){ ?>
<center><small class="text-muted">Reserver Table</small></center>
<?php
}else if(isset($_GET['Type']) && $_GET['Type']=='S'){ ?>
<center><small class="text-muted">Reserver Salle</small></center>
<?php
}else {?>
<center><small class="text-muted">Reserver Table</small></center>
<?php } ?>
<style>
    #fp-canvas-container{
        height:50vh;
        width:calc(100%);
        position:relative;
    }
    .fp-img,.fp-canvas,.fp-canvas-2{
        position:absolute;
        width:calc(100%);
        height:calc(100%);
        top:0;
        left:0;
        z-index: 1;
    }
    #fp-map{
        position:absolute;
        top:0;
        left:0;
        z-index: 1;
        width:calc(100%);
        height:calc(100%);
    }
    .fp-canvas {
        z-index: 2;
        background: #0000000d;
        cursor: crosshair;
    }
    #fp-map{
        z-index: 1;
    }
    area:hover {
        background: #0000004d;
        color: #fff !important;
    }
</style>
<?php
/*$sql = "SELECT * FROM `table_list` order by tbl_no asc";
$qry = $conn->query($sql);
$tbl = array();
    while($row = $qry->fetchArray()):
        $tbl[$row['table_id']] = array(
                                    "id"=>$row['table_id'],
                                    "tbl_no"=>$row['tbl_no'],
                                    "coordinates"=>$row['coordinates'],
                                    "name"=>$row['name']
                                        );
    endwhile;*/
    /***************************************************/
/*$host = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "reservation_table";
    $con=new mysqli($host, $userName, $password, $dbName);*/
  /*  $res=$con->query("SELECT * FROM table_list");
    $tbl = array();
			foreach ($res as $row) {
        $tbl[$row['table_id']] = array(
                                    "id"=>$row['table_id'],
                                    "tbl_no"=>$row['tbl_no'],
                                    "coordinates"=>$row['coordinates'],
                                    "name"=>$row['name']
                                        );
      }*/

    /********************************************/
if(isset($_GET['Type']) && $_GET['Type']=='T')
$sql = "SELECT * FROM table_list where type=1 order by tbl_no asc";
else if(isset($_GET['Type']) && $_GET['Type']=='S')
$sql = "SELECT * FROM table_list where type=0 order by tbl_no asc";
else
$sql = "SELECT * FROM table_list where type=1 order by tbl_no asc";
$qry = $conn->query($sql);
$tbl = array();
    foreach( $qry as $row){
        $tbl[$row['table_id']] = array(
                                    "id"=>$row['table_id'],
                                    "tbl_no"=>$row['tbl_no'],
                                    "coordinates"=>$row['coordinates'],
                                    "name"=>$row['name']
                                        );

    }
?>
<div class="col-12 mt-3">
    <div class="row">
        <div id="fp-canvas-container">
            <img src="./admin/uploads/floorplan.png" alt="Floor Plan" class='fp-img border p-1' id="fp-img" usemap="#fp-map">
            <map name="fp-map" id="fp-map" class="">
            </map>
        </div>
    </div>
</div>
<script>
    var tbl = $.parseJSON('<?php echo json_encode($tbl) ?>')
    function map_tbls(){
        if(Object.keys(tbl).length > 0){
            $('#fp-map').html('')

            Object.keys(tbl).map(k=>{
                var data = tbl[k]
                var area = $("<area shape='rect'>")
                    area.attr('href',"javascript:void(0)")
                var perc = data.coordinates
                perc = perc.replace(" ",'')
                perc = perc.split(",")
                var x = $('#fp-img').width() * perc[0];
                var y = $('#fp-img').height() * perc[1];
                var width = ($('#fp-img').width() * perc[2]) - x;
                var height = ($('#fp-img').height() * perc[3]) - y;
                area.attr('coords',x+", "+y+", "+width+", "+height)
                area.text("#"+data.tbl_no)
                area.addClass('fw-bolder text-muted')
                area.css({
                    'position':'absolute',
                    // 'border':"1px solid blue",
                    'height':height+'px',
                    'width':width+'px',
                    'top':y+'px',
                    'left':x+'px',
                    'display':'flex',
                    'text-align':'center',
                    'justify-content':'center',
                    'align-items':'center',
                })
                $('#fp-map').append(area)
                area.click(function(){
                    uni_modal('Reservation',"manage_reservation.php?table_id="+data.id)
                })
            })
        }
    }
    $(function(){
        map_tbls()
        $(window).on('resize',function(){
            map_tbls()
        })
    })
</script>
