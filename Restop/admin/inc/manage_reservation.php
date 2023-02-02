<?php
require_once("./../../DBConnection.php");
$base=new DBConnection();
$conn=$base->connect();
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM `reservation_list` where reservation_id = '{$_GET['id']}'");
foreach($qry as $k){
    $reservation_id=$k["reservation_id"];
    $table_id=$k["table_id"];
    $customer_name=$k["customer_name"];
    $contact=$k["contact"];
    $email=$k["email"];
    $address=$k["address"];
    $date_created=$k["date_created"];
    $datetime=$k["datetime"];
}
}
?>
<div class="container-fluid">
    <form action="" id="reservation-form">
        <input type="hidden" name="id" value="<?php echo isset($reservation_id) ? $reservation_id : "" ?>">
        <input type="hidden" name="table_id" value="<?php echo isset($table_id) ? $table_id : "" ?>">
        <div class="form-group">
            <label for="customer_name" class="control-label">Fullname</label>
            <input type="text" name="customer_name" autofocus id="customer_name" required class="form-control form-control-sm rounded-0" value="<?php echo isset($customer_name) ? $customer_name : '' ?>">
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Contact</label>
            <input type="text" name="contact" autofocus id="contact" required class="form-control form-control-sm rounded-0" value="<?php echo isset($contact) ? $contact : '' ?>">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" name="email" autofocus id="email" required class="form-control form-control-sm rounded-0" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Address</label>
            <textarea rows="2" name="address" id="address" required class="form-control form-control-sm rounded-0"><?php echo isset($address)? $address : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="datetime" class="control-label">Reservation Date and Time</label>
            <input type="datetime-local" name="datetime" autofocus id="datetime" required class="form-control form-control-sm rounded-0" value="<?php echo isset($datetime) ? $datetime : '' ?>">
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
