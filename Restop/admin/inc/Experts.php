<?php
require_once("./../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();


?>
<div class="container-fluid">
  <div class="form-group">
      <label for="customer_name" class="control-label">Choisie Expert</label>
      <select class="form-control form-control-sm rounded-0" onchange="showdata(this)"  name="idexp">
<option value="-1">---Choisie Expert---</option>
        <?php $qry = $conn->query("SELECT * FROM `expert`");
        foreach($qry as $k){
            $Id_expert=$k["Id_expert"];
            $Nom_expert=$k["Nom_expert"];?>
  <option value="<?php echo $Id_expert ; ?>"><?php echo $Nom_expert ; ?></option>
            <?php
        } ?>
      </select>
  </div>
  <?php if(isset($_GET['idexp'])){
    $qry = $conn->query("SELECT * FROM `expert` WHERE Id_expert=".$_GET['idexp']);
    foreach($qry as $k){
        $Id_expert=$k["Id_expert"];
        $Nom_expert=$k["Nom_expert"];
        $Specialite_expert=$k["Specialite_expert"];
        $Img_expert=$k["Img_expert"];
    }
    ?>
    <form action="" id="expert-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($Id_expert) ? $Id_expert : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Nom expert</label>
            <input type="text" name="nom" autofocus id="title" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Nom_expert) ? $Nom_expert : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Specialite_expert</label>
            <input type="text" name="specialite" autofocus id="specialite" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Specialite_expert) ? $Specialite_expert : '' ?>">
        </div>
        <div class="form-group">
            <label  class="control-label">Image</label>
            <img src="../images/<?php echo $Img_expert; ?>" alt="" style="width:100px;height:100px;">
            <input type="file" name="fp" class="form-control form-control-sm rounded-0" id="fp" onchange="readURL(this)" accept="image/png, image/jpeg, image/jpg">
        </div>
        <div class="form-group">
            <input type="submit" name="" value="Enregistrer">
        </div>
    </form>
  <?php } ?>
</div>

<style>
    #img-fp{
        width:calc(100%);
        height:35vh
    }
</style>
<script>
function readURL(input){
   if (input.files && input.files[0]) {
       var reader = new FileReader();
       reader.onload = function (e) {
           $('#img-fp').attr('src', e.target.result);
       }
       reader.readAsDataURL(input.files[0]);
   }else{
       $('#img-fp').attr('src', '');
   }
}
function showdata(opval){
  window.location.href = "./?page=Experts&idexp="+opval.value;
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
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
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
