<?php
require_once('../../DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();

$sql = "SELECT r.*,SUM(r.prix) as prixt,t.* FROM commande r inner join client t on r.id_client = t.Id_client WHERE r.id_commande = '{$_GET['id']}'";
$qry = $conn->query($sql);
foreach($qry as $k){
  $id_commande=$k["id_commande"];
  $id_client=$k["id_client"];
  $id_plat=$k["id_plat"];
  $quantite=$k["quantite"];
  $type_cmd=$k["type_cmd"];
  $note=$k["Note"];
  $adresse=$k["adresse"];
  $Etat=$k["Etat"];
  $Nom_client=$k["Nom_client"];
  $Prenom_client=$k["Prenom_client"];
  $Datecmd=$k["Date_commande"];
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
                    <dt class="text-info">N°Commande</dt>
                    <dd class="ps-4"><?php echo $id_commande ?></dd>
                    <dt class="text-info">Client</dt>
                    <dd class="ps-4"><?php echo isset($Nom_client) ? $Nom_client.' '.$Prenom_client : '' ?></dd>
                    <dt class="text-info">Adresse</dt>
                    <dd class="ps-4"><?php echo isset($adresse) ? $adresse : '' ?></dd>
                    <dt class="text-info">Type Commande</dt>
                    <dd class="ps-4"><?php echo isset($type_cmd) ? $type_cmd : '' ?></dd>
                    <dt class="text-info">Note</dt>
                    <dd class="ps-4"><?php echo isset($note) ? $note : '' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-info">Date commande</dt>
                    <dd class="ps-4"><?php echo date("Y-m-d h:i A",strtotime($Datecmd)) ?></dd>
                      <dt class="text-info">Etat</dt>
                    <dd class="ps-4">
                        <div class="col-auto flex-grow-1">
                            <span id="status">
                                <span class="badge bg-primary rounded-pill"><small><?php echo isset($Etat) ? $Etat : '' ?></small></span>
                            </span>
                            <span><a href="javascript:void(0)" class="text-dark btn-light fs-6 text-decoration-none update_status" data-status="<?php echo $Etat ?>"><i class="fa fa-edit"></i> Update</a></span>
                        </div>
                    </dd>
                    <dt class="text-info">Ticket de commande</dt>
                    <dd class="ps-4">
                        <div class="col-auto flex-grow-1">
                            <span><a href="../ticket.php?id=<?php echo $id_commande; ?>" class="text-dark btn-light fs-6 text-decoration-none" ><i class="fa fa-download"></i> Telecharger Ticket</a></span>
                        </div>
                    </dd>
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
    $(function(){
        $('.update_status').click(function(){
            uni_modal_secondary('Update Status',"inc/update_cmd_status.php?id=<?php echo $id_commande ?>&status="+$(this).attr('data-status'))
        })
    })

</script>
