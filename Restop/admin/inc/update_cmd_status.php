<div class="container-fluid">
    <form action="" id="update-status">
        <input type="hidden" name="cmd_id" value="<?php echo $_GET['id'] ?>">
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select type="text" name="status" class="form-select form-select-sm" required>
                <option value="Enregistrer" <?php echo $_GET['status'] == "Enregistrer" ? "selected" : '' ?>>Enregistrer</option>
                <option value="Confirmer" <?php echo $_GET['status'] == "Confirmer" ? "selected" : '' ?>>Confirmer</option>
                <option value="En Cours Preparation" <?php echo $_GET['status'] == "En Cours Preparation" ? "selected" : '' ?>>En Cours Preparation</option>
                <option value="En Cours Livraison" <?php echo $_GET['status'] == "En Cours Livraison" ? "selected" : '' ?>>En Cours Livraison</option>
                <option value="Livree" <?php echo $_GET['status'] == "Livree" ? "selected" : '' ?>>Livree</option>
                <option value="Annuller" <?php echo $_GET['status'] == "Annuller" ? "selected" : '' ?>>Annuller</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#update-status').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.closest('.modal').find('button').attr('disabled',true)
            $.ajax({
                url:'../Actions.php?a=update_cmd_status',
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
                    _this.closest('.modal').find('button').attr('disabled',false)
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            _this.closest('.modal').modal('hide')
                            if(resp.return_status == "Confirmer")
                                new_stat = '<span class="badge bg-primary"><small>Confirmer</small></span>';
                            else if(resp.return_status == "En Cours Preparation")
                                new_stat = '<span class="badge bg-warning"><small>En Cours Preparation</small></span>';
                            else if(resp.return_status == "En Cours Livraison")
                                new_stat = '<span class="badge bg-success"><small>En Cours Livraison</small></span>';
                            else if(resp.return_status == "Livree")
                                new_stat = '<span class="badge bg-danger"><small>Livree</small></span>';
                            else if(resp.return_status == "Annuller")
                                new_stat = '<span class="badge bg-danger"><small>Annuller</small></span>';
                            else
                                new_stat = '<span class="badge bg-dark text-light"><small>Enregistrer</small></span>';
                            $('#status').html(new_stat)
                            $('.update_status').attr('data-status',resp.return_status)
                            $('#uni_modal').on('hide.bs.modal',function(){
                                location.reload()
                            })
                            _this.closest('.modal').find('button').attr('disabled',false)

                        }, 2000);

                    }else{
                        _el.addClass('alert alert-danger')
                        _this.closest('.modal').find('button').attr('disabled',false)
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                }
            })
        })
    })
</script>
