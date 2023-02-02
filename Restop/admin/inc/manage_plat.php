<?php
require_once("./../../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();
$lib_categorie1='';

if(isset($_GET['id'])){
$qry = $conn->query("SELECT r.*,t.lib_categorie FROM plat r,categorie t WHERE r.id_categorie=t.id_categorie AND r.id_plat= '{$_GET['id']}'");
foreach($qry as $k){
  $id_plat=$k["id_plat"];
  $image_plat=$k["image_plat"];
  $intitule_plat=$k["intitule_plat"];
  $description_plat=$k["description_plat"];
  $lib_categorie1=$k["lib_categorie"];
  $prix_plat=$k["prix_plat"];
}
}
?>
<div class="container-fluid">
    <form action="" id="plat-form" method="post">

      <?php if(isset($_GET['id'])){ ?>
        <input type="hidden" name="id" value="<?php echo isset($id_plat) ? $id_plat : "" ?>">
      <?php } ?>
        <div class="form-group">
            <label for="customer_name" class="control-label">intitule_plat</label>
            <input type="text" name="intitule_plat" autofocus id="intitule_plat" required class="form-control form-control-sm rounded-0" value="<?php echo isset($intitule_plat) ? $intitule_plat : '' ?>">
        </div>
        <div class="form-group">
            <label for="address" class="control-label">description_plat</label>
            <textarea rows="2" name="description_plat" id="description_plat" required class="form-control form-control-sm rounded-0"><?php echo isset($description_plat)? $description_plat : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">categorie</label>
            <?php
            $rqsel =$conn->query("SELECT * FROM categorie");?>
            <select size=1 name="categorie">
              <?php
            foreach ($rqsel as $row) {
            	$id_categorie=$row['id_categorie'];
                $lib_categorie=$row['lib_categorie'];
                if($lib_categorie1!=''){
                ?>
                <option value="<?php echo $id_categorie; ?>"<?=$lib_categorie == $lib_categorie1 ? ' selected="selected"' : '';?>><?php echo $lib_categorie; ?></option>
              <?php }
            else {?>
              <option value="<?php echo $id_categorie; ?>"><?php echo $lib_categorie; ?></option>
              <?php } }?>
          </select>

        </div>
        <div class="form-group">
            <label for="contact" class="control-label">prix_plat</label>
            <input type="text" name="prix_plat" autofocus id="prix_plat" required class="form-control form-control-sm rounded-0" value="<?php echo isset($prix_plat) ? $prix_plat : '' ?>">
        </div>


        <div class="form-group">
            <label for="img" class="control-label">image_plat</label>
            <img src="../images/<?php echo $image_plat; ?>" alt="" style="width:50px;height:50px;">
            <input type="file" name="fp" class="form-control form-control-sm rounded-0" id="fp" onchange="readURL(this)" accept="image/png, image/jpeg, image/jpg">
        </div>
    </form>
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
    $(function(){
        $('#plat-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./../Actions.php?a=save_plat',
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
                        if("<?php echo isset($id_plat) ?>" != 1)
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
