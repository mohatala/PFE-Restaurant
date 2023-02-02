<?php
require_once('../../DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();

$sql = "SELECT r.*,t.lib_categorie FROM plat r,categorie t WHERE r.id_categorie=t.id_categorie AND r.id_plat='{$_GET['id']}'";
$qry = $conn->query($sql);
foreach($qry as $k){
  $id_plat=$k["id_plat"];
  $image_plat=$k["image_plat"];
  $intitule_plat=$k["intitule_plat"];
  $description_plat=$k["description_plat"];
  $lib_categorie=$k["lib_categorie"];
  $prix_plat=$k["prix_plat"];
}

?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt class="text-info">Image</dt>
                    <dd class="ps-4"><img src="../images/<?php echo $image_plat; ?>" alt="" style="width:50px;height:50px;"></dd>
                    <dt class="text-info">id_plat</dt>
                    <dd class="ps-4"><?php echo isset($id_plat) ? $id_plat: '' ?></dd>
                    <dt class="text-info">intitule_plat</dt>
                    <dd class="ps-4"><?php echo isset($intitule_plat) ? $intitule_plat : '' ?></dd>
                    <dt class="text-info">description_plat</dt>
                    <dd class="ps-4"><?php echo isset($description_plat) ? $description_plat : '' ?></dd>
                    <dt class="text-info">lib_categorie</dt>
                    <dd class="ps-4"><?php echo isset($lib_categorie) ? $lib_categorie : '' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-info">prix_plat</dt>
                    <dd class="ps-4"><?php echo $prix_plat; ?> DHS</dd>

                </dl>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row justify-content-end">
            <div class="col-1">
                <div class="btn btn btn-dark btn-sm rounded-0" type="button" data-bs-dismiss="modal">Close</div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
