<?php
require_once("./../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();

$qry = $conn->query("SELECT * FROM `apropos`");
foreach($qry as $k){
    $id_apropos=$k["Id_apropos"];
    $title=$k["Title"];
    $desc=$k["Description"];
    $img_apropos=$k["Img_apropos"];
}

?>
<div class="container-fluid">
    <form action="" id="apropos-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($id_apropos) ? $id_apropos : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Title</label>
            <input type="text" name="title" autofocus id="title" required class="form-control form-control-sm rounded-0" value="<?php echo isset($title) ? $title : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Description</label>
            <textarea rows="4" name="description" id="description_plat" required class="form-control form-control-sm rounded-0"><?php echo isset($desc)? $desc : '' ?></textarea>
        </div>
        <div class="form-group">
            <label  class="control-label">Image</label>
            <img src="../images/<?php echo $img_apropos; ?>" alt="" style="width:100px;height:100px;">
            <input type="file" name="fp" class="form-control form-control-sm rounded-0" id="fp" onchange="readURL(this)" accept="image/png, image/jpeg, image/jpg">
        </div>
        <div class="form-group">
            <input type="submit" name="" value="Enregistrer">
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
        $('#apropos-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./../Actions.php?a=save_apropos',
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
                        if("<?php echo isset($id_apropos) ?>" != 1)
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
