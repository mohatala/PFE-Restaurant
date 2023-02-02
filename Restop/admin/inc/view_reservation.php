<?php
require_once('../../DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();

$sql = "SELECT r.*,t.tbl_no,t.name as tname FROM `reservation_list` r inner join `table_list` t on r.table_id = t.table_id  where r.`reservation_id` = '{$_GET['id']}'";
$qry = $conn->query($sql);
foreach($qry as $k){
  $reservation_id=$k["reservation_id"];
    $tbl_no=$k["tbl_no"];
    $tname=$k["tname"];
    $customer_name=$k["customer_name"];
    $contact=$k["contact"];
    $email=$k["email"];
    $address=$k["address"];
    $date_created=$k["date_created"];
    $datetime=$k["datetime"];
    $status=$k["status"];
}
/*$date_created = new DateTime($date_created, new DateTimeZone(dZone));
$date_created->setTimezone(new DateTimeZone(tZone));
$date_created = $date_created->format('Y-m-d H:i'); */
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
                    <dt class="text-info">Table</dt>
                    <dd class="ps-4"><?php echo $tbl_no." - ".$tname ?></dd>
                    <dt class="text-info">Customer Name</dt>
                    <dd class="ps-4"><?php echo isset($customer_name) ? $customer_name : '' ?></dd>
                    <dt class="text-info">Contact #</dt>
                    <dd class="ps-4"><?php echo isset($contact) ? $contact : '' ?></dd>
                    <dt class="text-info">Email</dt>
                    <dd class="ps-4"><?php echo isset($email) ? $email : '' ?></dd>
                    <dt class="text-info">Address</dt>
                    <dd class="ps-4"><?php echo isset($address) ? $address : '' ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt class="text-info">Date Created</dt>
                    <dd class="ps-4"><?php echo date("Y-m-d h:i A",strtotime($date_created)) ?></dd>
                    <dt class="text-info">Reservation DateTime</dt>
                    <dd class="ps-4"><?php echo !is_null($datetime) ? date("F d, Y h:i A",strtotime($datetime)) : "N/A" ?></dd>
                    <dt class="text-info">Status</dt>
                    <dd class="ps-4">
                        <div class="col-auto flex-grow-1">
                            <span id="status">
                            <?php if($status == 1): ?>
                                <span class="badge bg-primary rounded-pill"><small>Confirmed</small></span>
                            <?php elseif($status == 2): ?>
                                <span class="badge bg-warning rounded-pill"><small>Arrived</small></span>
                            <?php elseif($status == 3): ?>
                                <span class="badge bg-success rounded-pill"><small>Done</small></span>
                            <?php elseif($status == 3): ?>
                                <span class="badge bg-danger rounded-pill"><small>No Show</small></span>
                            <?php elseif($status == 3): ?>
                                <span class="badge bg-danger rounded-pill"><small>Cancelled</small></span>
                            <?php else: ?>
                                <span class="badge bg-dark text-light rounded-pill"><small>Pending</small></span>
                            <?php endif; ?>
                            </span>
                            <span><a href="javascript:void(0)" class="text-dark btn-light fs-6 text-decoration-none update_status" data-status="<?php echo $status ?>"><i class="fa fa-edit"></i> Update</a></span>
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
            uni_modal_secondary('Update Status',"inc/update_reservation_status.php?id=<?php echo $reservation_id ?>&status="+$(this).attr('data-status'))
        })
    })

</script>
