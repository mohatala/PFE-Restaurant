<?php
require_once('../../DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();

$sql = "SELECT * FROM emails WHERE id_email = '{$_GET['id']}'";
$qry = $conn->query($sql);
foreach($qry as $k){
  $id_email=$k["id_email"];
  $nom=$k["nom"];
  $email=$k["email"];
  $msg=$k["msg"];
}
$conn->query("UPDATE emails set statut=1");
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
                    <dt class="text-info">N°Email</dt>
                    <dd class="ps-4"><?php echo $id_email ?></dd>
                    <dt class="text-info">Nom</dt>
                    <dd class="ps-4"><?php echo $nom ?></dd>
                    <dt class="text-info">Email</dt>
                    <dd class="ps-4"><?php echo isset($email) ? $email : '' ?></dd>
                    <dt class="text-info">Message</dt>
                    <dd class="ps-4"><?php echo isset($msg) ? $msg : '' ?></dd>

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
