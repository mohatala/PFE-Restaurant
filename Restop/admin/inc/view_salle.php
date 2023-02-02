<?php
require_once("../../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM table_list where table_id = '{$_GET['id']}'");
    foreach($qry as $k){
        $tbl_no=$k["tbl_no"];
        $name=$k["name"];
        $description=$k["description"];
        $status=$k["status"];
    }
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
            <dl>
                <dt class="text-info">Salle No:</dt>
                <dd class="ps-4">#<?php echo isset($tbl_no) ? $tbl_no : '' ?></dd>
                <dt class="text-info">Name</dt>
                <dd class="ps-4"><?php echo isset($name) ? ($name) : '' ?></dd>
                <dt class="text-info">Description</dt>
                <dd class="ps-4"><?php echo isset($description) ? $description : '' ?></dd>
                <dt class="text-info">Status</dt>
                <dd class="ps-4">
                    <span id="status">
                        <?php if($status == 0): ?>
                            <span class="badge bg-warning rounded-pill"><small>Unavailable</small></span>
                        <?php else: ?>
                            <span class="badge bg-success rounded-pill"><small>Available</small></span>
                        <?php endif; ?>
                    </span>
                </dd>
            </dl>
        </div>
        <div class="row justify-content-end mx-3">
            <div class="col-1">
                <div class="btn btn btn-dark btn-sm rounded-0" type="button" data-bs-dismiss="modal">Close</div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
    })
</script>
