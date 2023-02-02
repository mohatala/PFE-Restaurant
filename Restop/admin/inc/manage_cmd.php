<?php
require_once("./../../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();
if(isset($_GET['id'])){
$qry = $conn->query("SELECT r.*,SUM(r.prix) as prixt,t.* FROM commande r inner join client t on r.id_client = t.Id_client WHERE r.id_commande = '{$_GET['id']}'");
foreach($qry as $k){
    $id_commande=$k["id_commande"];
    $id_client=$k["id_client"];
    $id_plat=$k["id_plat"];
    $quantite=$k["quantite"];
    $type_cmd=$k["type_cmd"];
    $note=$k["Note"];
    $adresse=$k["adresse"];
    $Etat=$k["Etat"];
    $Nom_client=$k["Nom_client"];
    $Prenom_client=$k["Prenom_client"];
}
}
?>
<div class="container-fluid">
    <form action="" id="reservation-form">
        <input type="hidden" name="id" value="<?php echo isset($id_commande) ? $id_commande : "" ?>">
        <input type="hidden" name="table_id" value="<?php echo isset($id_plat) ? $id_plat : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Fullname</label>
            <input type="text" name="customer_name" autofocus id="customer_name" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Nom_client) ? $Nom_client.' '.$Prenom_client : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Adresse</label>
            <input type="text" name="contact" autofocus id="adresse" required class="form-control form-control-sm rounded-0" value="<?php echo isset($adresse) ? $adresse : '' ?>">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Type Commamde</label>
            <input type="email" name="email" autofocus id="type_cmd" required class="form-control form-control-sm rounded-0" value="<?php echo isset($type_cmd) ? $type_cmd : '' ?>">
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Note</label>
            <textarea rows="2" name="address" id="note" required class="form-control form-control-sm rounded-0"><?php echo isset($note)? $note : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="datetime" class="control-label">Etat</label>
            <input type="text" name="datetime" autofocus id="etat" required class="form-control form-control-sm rounded-0" value="<?php echo isset($Etat) ? $Etat : '' ?>">
        </div>
    </form>
</div>

<script>
    $(function(){
        $('#reservation-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./../Actions.php?a=save_reservation',
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
                        if("<?php echo isset($reservation_id) ?>" != 1)
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
