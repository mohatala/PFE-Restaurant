<?php
require_once("./../../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();

?>
<div class="container-fluid">
    <form action="" id="plat-form1" method="post">

        <input type="hidden" name="dj" value="<?php echo isset($_GET['dj']) ? $_GET['dj'] : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Date Du Jour</label>
            <label for=""><?php echo isset($_GET['dj']) ? $_GET['dj'] : "" ?></label>
          </div>

        <div class="form-group">
            <label for="email" class="control-label">Plats</label>
            <select size=1 name="plat">
              <?php
              $sql = "SELECT id_plat,intitule_plat FROM plat";
              $qry = $conn->query($sql);
              foreach($qry as $k){
                  $id_plat=$k["id_plat"];
                  $intitule_plat=$k["intitule_plat"];
                   ?>
              <option value="<?php echo $id_plat; ?>"><?php echo $intitule_plat ?></option>
              <?php } ?>
          </select>
        </div>

    </form>
</div>

<script>
    $(function(){
        $('#plat-form1').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./../Actions.php?a=save_plat_mj',
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
