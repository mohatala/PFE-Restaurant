<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Commandes <?php echo $_GET['E']; ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th class="text-center p-0">N°Commande</th>
                      <th class="text-center p-0">Date</th>
                      <th class="text-center p-0">Type Commande</th>
                      <th class="text-center p-0">Nom Client</th>
                      <th class="text-center p-0">Prix</th>
                      <th class="text-center p-0">Status</th>
                      <th class="text-center p-0">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th class="text-center p-0">N°Commande</th>
                      <th class="text-center p-0">Date</th>
                      <th class="text-center p-0">Type Commande</th>
                      <th class="text-center p-0">Nom Client</th>
                      <th class="text-center p-0">Prix</th>
                      <th class="text-center p-0">Status</th>
                      <th class="text-center p-0">Action</th>
                    </tr>
                </tfoot>
                <tbody>

                  <?php
                  if (isset($_GET['E'])) {

                  $sql = "SELECT r.*,SUM(r.prix) as prixt,t.* FROM commande r inner join client t on r.id_client = t.Id_client WHERE r.Etat='".$_GET['E']."' GROUP BY r.id_commande DESC";
                  $qry = $conn->query($sql);
                  $i = 1;
                      foreach ($qry as $row) {
                  ?>
                  <tr>
                      <td class="text-center p-0"><?php echo $row['id_commande']; ?></td>
                      <td class="py-0 px-1"><?php echo $row['Date_commande']; ?></td>
                      <td class="py-0 px-1 "><?php echo $row['type_cmd'];?></td>
                      <td class="py-0 px-1"><?php echo $row['Nom_client'].' '. $row['Prenom_client'] ?></td>
                      <td class="py-0 px-1"><?php echo $row['prixt']; ?></td>
                      <td class="py-0 px-1 text-center">
                          <span class="badge bg-primary rounded-pill"><small><?php echo $row['Etat']; ?></small></span>
                      </td>
                      <th class="text-center py-0 px-1">
                          <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <li><a class="dropdown-item view_data" data-id = '<?php echo $row['id_commande'] ?>' href="javascript:void(0)">View</a></li>
                              <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['id_commande'] ?>' href="javascript:void(0)">Edit</a></li>
                              <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['id_commande'] ?>' href="javascript:void(0)">Delete</a></li>
                              </ul>
                          </div>
                      </th>
                  </tr>
                <?php }
              } ?>

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
            uni_modal('Modifier Details de commande',"inc/manage_cmd.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.view_data').click(function(){
            uni_modal('Details de commande',"inc/view_cmd.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete this command from list?",'delete_data',[$(this).attr('data-id')])
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
            url:'../Actions.php?a=delete_cmd',
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
