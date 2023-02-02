<?php
require_once("./../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();

$qry = $conn->query("SELECT * FROM `contact`");
foreach($qry as $k){
    $Id_contact=$k["Id_contact"];
    $Phone_contact=$k["Phone_contact"];
    $Email_contact=$k["Email_contact"];
    $Adresse=$k["Adresse"];
    $Adresse_map=$k["Adresse_map"];
}
?>
<div class="container-fluid">
    <form action="" id="contact-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($Id_contact) ? $Id_contact : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Telephone</label>
            <input type="text" name="tel" autofocus id="tel" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Phone_contact) ? $Phone_contact : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Email</label>
            <input type="text" name="email" autofocus id="email" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Email_contact) ? $Email_contact : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Adresse</label>
            <textarea rows="4" name="adresse" id="adresse" required class="form-control form-control-sm rounded-0"><?php echo isset($Adresse)? $Adresse : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Maps</label>
            <textarea rows="4" name="maps" id="maps" required class="form-control form-control-sm rounded-0"><?php echo isset($Adresse_map)? $Adresse_map : '' ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="" value="Enregistrer">
        </div>
    </form>
</div>

<script>

    $(function(){
        $('#contact-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./../Actions.php?a=save_contact',
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
