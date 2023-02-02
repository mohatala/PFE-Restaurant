<?php
require_once("./../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();


?>
<div class="container-fluid">
  <div class="form-group">
      <label for="customer_name" class="control-label">Choisie Client</label>
      <select class="form-control form-control-sm rounded-0" onchange="showdata(this)"  name="idexp">
<option value="-1">---Choisie Client---</option>
        <?php $qry = $conn->query("SELECT temoignage.*,client.Nom_client as 'nom' FROM `temoignage`,client WHERE client.Id_client=temoignage.Id_client");
        foreach($qry as $k){
            $Id_temoignage=$k["Id_temoignage"];
            $nomcl=$k["nom"];?>
  <option value="<?php echo $Id_temoignage ; ?>"><?php echo $nomcl ; ?></option>
            <?php
        } ?>
      </select>
  </div>
  <?php if(isset($_GET['idtem'])){
    $qry = $conn->query("SELECT temoignage.*,client.Nom_client as 'nom' FROM `temoignage`,client WHERE client.Id_client=temoignage.Id_client and temoignage.Id_temoignage=".$_GET['idtem']);
    foreach($qry as $k){
        $Id_temoignage=$k["Id_temoignage"];
        $nom=$k["nom"];
        $Avis=$k["Avis"];

    }
    ?>
    <form action="" id="expert-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($Id_expert) ? $Id_expert : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Nom Client</label>
            <input type="text" name="nom" autofocus id="nom" required class="form-control form-control-sm rounded-0" value="<?php echo isset($nom) ? $nom : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Avis</label>
            <input type="text" name="avis" autofocus id="avis" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Avis) ? $Avis : '' ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="" value="Enregistrer">
        </div>
    </form>
  <?php } ?>
</div>

<script>
function showdata(opval){
  window.location.href = "./?page=Avis&idtem="+opval.value;
}
    $(function(){
        $('#expert-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./../Actions.php?a=save_expert',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                     $('#uni_modal button').attr('disabled',false)
                     $('#uni_modal button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                            location.reload()
                        if("<?php echo isset($Id_expert) ?>" != 1)
                        _this.get(0).reset();
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                     $('#uni_modal button').attr('disabled',false)
                     $('#uni_modal button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
