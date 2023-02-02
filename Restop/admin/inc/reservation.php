
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reservation List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th class="text-center p-0">#</th>
                      <th class="text-center p-0">Date Created</th>
                      <th class="text-center p-0">Table</th>
                      <th class="text-center p-0">Customer Name</th>
                      <th class="text-center p-0">DateTime</th>
                      <th class="text-center p-0">Status</th>
                      <th class="text-center p-0">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th class="text-center p-0">#</th>
                      <th class="text-center p-0">Date Created</th>
                      <th class="text-center p-0">Table</th>
                      <th class="text-center p-0">Customer Name</th>
                      <th class="text-center p-0">DateTime</th>
                      <th class="text-center p-0">Status</th>
                      <th class="text-center p-0">Action</th>
                    </tr>
                </tfoot>
                <tbody>

                  <?php
                  $sql = "SELECT r.*,t.tbl_no, t.name as tname FROM `reservation_list` r inner join `table_list` t on r.table_id = t.table_id order by r.`status` asc, STR_TO_DATE(r.`datetime`,'%s') asc";
                  $qry = $conn->query($sql);
                  $i = 1;
                      foreach ($qry as $row) {
                        /*  $row['date_created'] = new DateTime($row['date_created'], new DateTimeZone(dZone));
                          $row['date_created']->setTimezone(new DateTimeZone(tZone));
                          $row['date_created'] = $row['date_created']->format('Y-m-d h:i A');*/
                  ?>
                  <tr>
                      <td class="text-center p-0"><?php echo $i++; ?></td>
                      <td class="py-0 px-1"><?php echo date("Y-m-d h:i A",strtotime($row['date_created'])) ?></td>
                      <td class="py-0 px-1 text-truncate" title="<?php echo $row['tbl_no'].' - '.$row['tname'] ?>"><?php echo $row['tbl_no'].' - '.$row['tname'] ?></td>
                      <td class="py-0 px-1"><?php echo $row['customer_name'] ?></td>
                      <td class="py-0 px-1"><?php echo date("Y-m-d h:i A",strtotime($row['datetime'])) ?></td>
                      <td class="py-0 px-1 text-center">
                      <?php if($row['status'] == 1): ?>
                          <span class="badge bg-primary rounded-pill"><small>Confirmed</small></span>
                      <?php elseif($row['status'] == 2): ?>
                          <span class="badge bg-warning rounded-pill"><small>Arrived</small></span>
                      <?php elseif($row['status'] == 3): ?>
                          <span class="badge bg-success rounded-pill"><small>Done</small></span>
                      <?php elseif($row['status'] == 4): ?>
                          <span class="badge bg-danger rounded-pill"><small>No Show</small></span>
                      <?php elseif($row['status'] == 5): ?>
                          <span class="badge bg-danger rounded-pill"><small>Cancelled</small></span>
                      <?php else: ?>
                          <span class="badge bg-dark text-light rounded-pill"><small>Pending</small></span>
                      <?php endif; ?>
                      </td>
                      <th class="text-center py-0 px-1">
                          <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <li><a class="dropdown-item view_data" data-id = '<?php echo $row['reservation_id'] ?>' href="javascript:void(0)">View</a></li>
                              <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['reservation_id'] ?>' href="javascript:void(0)">Edit</a></li>
                              <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['reservation_id'] ?>' href="javascript:void(0)">Delete</a></li>
                              </ul>
                          </div>
                      </th>
                  </tr>
                  <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New Reservation',"inc/manage_reservation.php",'mid-large')
        })
        $('.edit_data').click(function(){
            uni_modal('Edit Reservation Details',"inc/manage_reservation.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.view_data').click(function(){
            uni_modal('Reservation Details',"inc/view_reservation.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete this reservation from list?",'delete_data',[$(this).attr('data-id')])
        })
        $('table td,table th').addClass('align-middle')
        $('table').dataTable({
            columnDefs: [
                { orderable: false, targets:6 }
            ]
        })
    })
    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'../Actions.php?a=delete_reservation',
            method:'POST',
            data:{id:$id},
            dataType:'JSON',
            error:err=>{
                console.log(err)
                alert("An error occurred.")
                $('#confirm_modal button').attr('disabled',false)
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else{
                    alert("An error occurred.")
                    $('#confirm_modal button').attr('disabled',false)
                }
            }
        })
    }
</script>
