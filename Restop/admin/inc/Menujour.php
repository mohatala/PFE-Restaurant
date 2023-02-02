<?php
require_once("./../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();
?>
<div class="container-fluid">
    <form action="" id="plat-form" method="post">
        <div class="form-group">
            <label for="customer_name" class="control-label">Date Du Jour</label>
            <input type="date" name="datejour" autofocus id="datejour" value="<?php echo date('Y-m-d'); ?>" required class="form-control form-control-sm rounded-0">
        </div>
        <div class="form-group">
            <input type="submit" value="Afficher"/>
        </div>
    </form>
</div>
<?php
if(isset($_POST['datejour'])){
  ?>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?php echo ucwords(str_replace('_','',$page)) ?></h1>
      <a data-id = '<?php echo $_POST['datejour'] ?>' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm add_data"><i
              class="fas fa-download fa-sm text-white-50"></i> Ajouter Plat</a>
  </div>
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Liste Plats de <?php echo $_POST['datejour']; ?> </h6>
      </div>

      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th class="text-center p-0">Photo</th>
                        <th class="text-center p-0">Intitule</th>
                        <th class="text-center p-0">Description</th>
                        <th class="text-center p-0">Prix</th>
                        <th class="text-center p-0">Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th class="text-center p-0">Photo</th>
                        <th class="text-center p-0">Intitule</th>
                        <th class="text-center p-0">Description</th>
                        <th class="text-center p-0">Prix</th>
                        <th class="text-center p-0">Action</th>
                      </tr>
                  </tfoot>
                  <tbody>

                    <?php
                    $sql = "SELECT menu_du_jour.*,plat.* FROM menu_du_jour,plat WHERE menu_du_jour.id_plat=plat.id_plat and menu_du_jour.date_mj='".$_POST['datejour']."'";
                    $qry = $conn->query($sql);
                    $i = 1;
                        foreach ($qry as $row) {
                    ?>
                    <tr>

                        <td class="text-center p-0"><img src="../images/<?php echo $row['image_plat']; ?>" alt="" style="width:50px;height:50px;"></td>
                        <td class="py-0 px-1"><?php echo $row['intitule_plat']; ?></td>
                        <td class="py-0 px-1 "><?php echo $row['description_plat'];?></td>
                        <td class="py-0 px-1"><?php echo $row['prix_plat']; ?></td>
                        <th class="text-center py-0 px-1">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item view_data" data-id = '<?php echo $row['id_plat'] ?>' href="javascript:void(0)">View</a></li>
                                <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['id_mj'] ?>' href="javascript:void(0)">Delete</a></li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                  <?php }
                 ?>

                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <script>
      $(function(){
          $('.add_data').click(function(){
              uni_modal('Ajouter Plats',"inc/Add_plat_Mj.php?dj="+$(this).attr('data-id'),'mid-large')
          })
          $('.view_data').click(function(){
              uni_modal('Details de Plat',"inc/view_plat.php?id="+$(this).attr('data-id'),'mid-large')
          })
          $('.delete_data').click(function(){
              _conf("Are you sure to delete this plat from list?",'delete_data',[$(this).attr('data-id')])
          })
          $('table td,table th').addClass('align-middle')
          $('table').dataTable({
              columnDefs: [
                  { orderable: false, targets:4 }
              ]
          })
      })
      function delete_data($id){
          $('#confirm_modal button').attr('disabled',true)
          $.ajax({
              url:'../Actions.php?a=delete_mj',
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

    <?php
}
 ?>
