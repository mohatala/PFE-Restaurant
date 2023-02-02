<?php
require_once("./DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();
if(isset($_GET['table_id'])){
$qry = $conn->query("SELECT * FROM table_list where table_id = '{$_GET['table_id']}'");
    /*foreach($qry->fetchArray() as $k => $v){
        $$k = $v;
    }*/
    $tbl_no='';
    $name='';
    $description='';
    foreach($qry as $k){
        $tbl_no=$k["tbl_no"];
        $name=$k["name"];
        $description=$k["description"];
    }
}
?>
<div class="container-fluid">
    <dl>
        <dt class="text-info">Numero Table<dt>
        <dd class="ps-4">#<?php echo isset($tbl_no) ? $tbl_no : "" ?><dd>
        <dt class="text-info">Nom<dt>
        <dd class="ps-4"><?php echo isset($name) ? $name : "" ?><dd>
        <dt class="text-info">Description<dt>
        <dd class="ps-4"><?php echo isset($description) ? $description : "" ?><dd>
    <dl>
    <hr>
    <fieldset>
        <legend class="text-info">Formulaire de Reservation</legend>
    <form action="" id="reservation-form">
        <input type="hidden" name="id" value="">
        <?php if(isset($_SESSION['Id_client'])){ ?>
        <input type="hidden" name="id_client" value="<?php echo $_SESSION['Id_client']; ?>">
      <?php }else{ ?>
        <input type="hidden" name="id_client" value="<?php echo 0; ?>">
      <?php } ?>

        <input type="hidden" name="table_id" value="<?php echo isset($_GET['table_id']) ? $_GET['table_id'] : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Nom et Prenom</label>
            <input type="text" name="customer_name" autofocus id="customer_name" required class="form-control form-control-sm rounded-0" value="<?php echo isset($customer_name) ? $customer_name : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Tel</label>
            <input type="text" name="contact" autofocus id="contact" required class="form-control form-control-sm rounded-0" value="<?php echo isset($contact) ? $contact : '' ?>">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" name="email" autofocus id="email" required class="form-control form-control-sm rounded-0" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Addresse</label>
            <textarea rows="2" name="address" id="address" required class="form-control form-control-sm rounded-0"><?php echo isset($address)? $address : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="datetime" class="control-label">Date et Temps de Reservation </label>
            <input type="datetime-local" name="datetime" autofocus id="datetime" required class="form-control form-control-sm rounded-0" value="<?php echo isset($datetime) ? $datetime : '' ?>">
        </div>
    </form>
    </fieldset>
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
                url:'./Actions.php?a=save_reservation',
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
