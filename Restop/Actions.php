<?php
require_once('DBConnection.php');
$base=new DBConnection();
Class Actions{

    function login(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        $sql = "SELECT * FROM admin_list where username = '{$username}' and `password` = '".md5($password)."' ";
        $qry = $conn->query($sql);

        if(!$qry){
            $resp['status'] = "failed";
            $resp['msg'] = "Invalid username or password.";
        }else{
            $resp['status'] = "success";
            $resp['msg'] = "Login successfully.";
            foreach($qry as $k){

                $_SESSION["admin_id"] = $k["admin_id"];
                $_SESSION["fullname"] = $k["fullname"];
                $_SESSION['username']=$k['username'];
                $_SESSION['password']=$k['password'];
                $_SESSION['status']=$k['status'];
            }
            /*foreach($qry as $k => $v){
               if(!is_numeric($k)){
                $_SESSION[$k] = $v;
              }
            }*/
        }
        return json_encode($resp);
    }
    function logout(){
        session_destroy();
        header("location:./admin");
    }
    function Deconnexion(){
        session_destroy();
        header("location:./index.php");
    }
    function update_credentials(){
        extract($_POST);
        $data = "";
        foreach($_POST as $k => $v){
            if(!in_array($k,array('id','old_password')) && !empty($v)){
                if(!empty($data)) $data .= ",";
                if($k == 'password') $v = md5($v);
                $data .= " `{$k}` = '{$v}' ";
            }
        }
        if(!empty($password) && md5($old_password) != $_SESSION['password']){
            $resp['status'] = 'failed';
            $resp['msg'] = "Old password is incorrect.";
        }else{
            $sql = "UPDATE `admin_list` set {$data} where admin_id = '{$_SESSION['admin_id']}'";
            @$save = $conn->query($sql);
            if($save){
                $resp['status'] = 'success';
                $_SESSION['flashdata']['type'] = 'success';
                $_SESSION['flashdata']['msg'] = 'Credential successfully updated.';
                foreach($_POST as $k => $v){
                    if(!in_array($k,array('id','old_password')) && !empty($v)){
                        if(!empty($data)) $data .= ",";
                        if($k == 'password') $v = md5($v);
                        $_SESSION[$k] = $v;
                    }
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'Updating Credentials Failed. Error: '.$this->lastErrorMsg();
                $resp['sql'] =$sql;
            }
        }
        return json_encode($resp);
    }
    function save_admin(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        $data = "";
        foreach($_POST as $k => $v){
        if(!in_array($k,array('id','type'))){
            if(!empty($id)){
                if(!empty($data)) $data .= ",";
                $data .= " `{$k}` = '{$v}' ";
                }else{
                    $cols[] = $k;
                    $values[] = "'{$v}'";
                }
            }
        }
        if(empty($id)){
            $cols[] = 'password';
            $values[] = "'".md5($username)."'";
        }
        if(isset($cols) && isset($values)){
            $data = "(".implode(',',$cols).") VALUES (".implode(',',$values).")";
        }
        @$result= $conn->query("SELECT count(admin_id) as `count` FROM admin_list where `username` = '{$username}' ".($id > 0 ? " and admin_id != '{$id}' " : ""));
        while($row = mysqli_fetch_array($result)) {
            //echo "Total Rows is ". $row['count'];
            $check=$row['count'];
          //  echo "<br />";
        }
        if(@$check> 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Username already exists.";
        }else{
            if(empty($id)){
                $sql = "INSERT INTO `admin_list` {$data}";
            }else{
                $sql = "UPDATE `admin_list` set {$data} where admin_id = '{$id}'";
            }
            @$save = $conn->query($sql);
            if($save){
                $resp['status'] = 'success';
                if(empty($id))
                $resp['msg'] = 'New Admin User successfully saved.';
                else
                $resp['msg'] = 'Admin User Details successfully updated.';
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'Saving Admin User Details Failed. Error: '.$this->lastErrorMsg();
                $resp['sql'] =$sql;
            }
        }
        return json_encode($resp);
    }
    function delete_admin(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);

        @$delete = $conn->query("DELETE FROM `admin_list` where admin_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Admin User successfully deleted.';
        }else{
            $resp['status']='failed';
            $resp['error']=$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_floorplan(){
        extract($_FILES);
        $resp['status'] = "failed";
        if(isset($fp) && !empty($fp['tmp_name'])){
            if(!is_dir(__DIR__."/admin/uploads/"))
            mkdir(__DIR__."/admin/uploads/");
            $fname = "/admin/uploads/floorplan.png";
            $thumb_file = $fp['tmp_name'];
            $file_type = mime_content_type($thumb_file);
            list($width, $height) = getimagesize($thumb_file);
            $t_image = imagecreatetruecolor('1000', '800');
            if(in_array($file_type,array('image/png','image/jpeg','image/jpg'))){
                $gdImg = ($file_type =='image/png') ? imagecreatefrompng($thumb_file) : imagecreatefromjpeg($thumb_file);
                imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, '1000', '800', $width, $height);
                if($t_image){
                    if(is_file(__DIR__.$fname))
                        unlink(__DIR__.$fname);
                        $upload = imagepng($t_image,__DIR__.$fname);
                        imagedestroy($t_image);
                        if($upload){
                            $resp['status'] = "success";
                            $resp['msg'] = ' Floor Plan Successfully Updated.';
                    }
                }else{
                    $resp['msg'] = 'Floor Plan image has failed to upload.';
                }
            }else{
                    $resp['msg'] = 'Floor Plan image has failed to upload due to invalid file type.';
            }
        }
        return json_encode($resp);
    }
    function save_table(){
        extract($_POST);
        $data = "";
        foreach($_POST as $k =>$v){
            if(!in_array($k,array('id'))){
                if(!is_numeric($v)){
                    $base=new DBConnection();
                    $conn=$base->connect();
                      $v = $conn->real_escape_string($v);
                }
                if(empty($id)){
                    $columns[] = "`{$k}`";
                    $values[] = "'{$v}'";
                }else{
                    if(!empty($data)) $data .= ", ";
                    $data .= " `{$k}` = '{$v}'";
                }
            }
        }
        if(isset($columns) && isset($values)){
            $data = "(".(implode(",",$columns)).") VALUES (".(implode(",",$values)).")";
        }
        @$result= $conn->query("SELECT count(table_id) as `count` FROM table_list where `tbl_no` = '{$tbl_no}' ".($id > 0 ? " and table_id != '{$id}' " : ""));
        while($row = mysqli_fetch_array($result)) {
            //echo "Total Rows is ". $row['count'];
            $check=$row['count'];
          //  echo "<br />";
        }
        if(@$check> 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Table Number already exists.";
        }else{
            if(empty($id)){
                $sql = "INSERT INTO `table_list` {$data}";
            }else{
                $sql = "UPDATE `table_list` set {$data} where table_id = '{$id}'";
            }
            @$save = $conn->query($sql);
            if($save){
                $resp['status'] = 'success';
                if(empty($id))
                $resp['msg'] = 'Successfully added.';
                else
                $resp['msg'] = 'Details Successfully updated.';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = $resp['msg'];
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'An error occured. Error: '.$this->lastErrorMsg();
                $resp['sql'] = $sql;
            }
        }
            return json_encode($resp);
    }
    function delete_table(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        @$delete = $conn->query("DELETE FROM `table_list` where table_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Table successfully deleted.';

        }else{
            $resp['status']='failed';
            $resp['msg'] = 'An error occure. Error: '.$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function save_reservation(){
      //echo "string";
        extract($_POST);
        $data = "";
        foreach($_POST as $k =>$v){

            if(!in_array($k,array('id'))){
                if(!is_numeric($v)){
                  $base=new DBConnection();
                  $conn=$base->connect();
                    $v = $conn->real_escape_string($v);
                }
                if(empty($id)){
                    $columns[] = "`{$k}`";
                    $values[] = "'{$v}'";
                }else{
                    if(!empty($data)) $data .= ", ";
                    $data .= " `{$k}` = '{$v}'";
                }
            }
        }
        if(isset($columns) && isset($values)){
            $data = "(".(implode(",",$columns)).") VALUES (".(implode(",",$values)).")";
        }
        $reservation_ts = strtotime($datetime);
        $reservation_ts_end = strtotime($datetime.' +3 hours');
        $sql_chl ="SELECT count(reservation_id) as `count` FROM reservation_list where `table_id` = '{$table_id}' and ('{$reservation_ts}' BETWEEN STR_TO_DATE(datetime,'%s') and STR_TO_DATE(DATE_ADD(datetime, INTERVAL 3 HOUR),'%s') OR '{$reservation_ts_end}' BETWEEN STR_TO_DATE(datetime,'%s')  and STR_TO_DATE(DATE_ADD(datetime, INTERVAL 3 HOUR),'%s') )".($id > 0 ? " and reservation_id != '{$id}' " : "") ;
      //  $check= $conn->query($sql_chl)->fetchArray()['count'];
      /*  if(!$check= $conn->query($sql_chl)){
          echo "There was an error running the query".$conn->error;
        }*/
        $result = $conn->query($sql_chl);

// Display data on web page
while($row = mysqli_fetch_array($result)) {
    //echo "Total Rows is ". $row['count'];
    $check=$row['count'];
  //  echo "<br />";
}
        if(@$check> 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Table is not available on the selected date and time.";
        }else{
            if(empty($id)){
                $sql = "INSERT INTO `reservation_list` {$data}";
            }else{
                $sql = "UPDATE `reservation_list` set {$data} where reservation_id = '{$id}'";
            }
            @$save = $conn->query($sql);
            if($save){
                $resp['status'] = 'success';
                if(empty($id))
                $resp['msg'] = 'Reservation Successfully added.';
                else
                $resp['msg'] = 'Reservation Details Successfully updated.';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = $resp['msg'];
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'An error occured. Error: '.$conn->lastErrorMsg();
                $resp['sql'] = $sql;
            }
        }
            return json_encode($resp);
    }
    function delete_reservation(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        @$delete = $conn->query("DELETE FROM `reservation_list` where reservation_id = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Reservation successfully deleted.';

        }else{
            $resp['status']='failed';
            $resp['msg'] = 'An error occure. Error: '.$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function update_reservation_status(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        $get = $conn->query("SELECT * FROM `reservation_list` where reservation_id = '{$reservation_id}'");
        $update = $conn->query("UPDATE `reservation_list` set `status` = '{$status}' where reservation_id = '{$reservation_id}'");
        if($update){
            $resp['status'] = 'success';
            $resp['msg'] = "Reservation Status successfully updated";
            $resp['return_status'] = $status;
            //$res= $get->fetchArray();
            foreach($get as $res){}
            if($status == 2){
                $conn->query("UPDATE `table_list` set `status` = 0  where table_id = '{$res['table_id']}'");
            }else{
                $now =strtotime(date("Y-m-d H:i"));
                $result = $conn->query("SELECT count(reservation_id) as 'count' FROM reservation_list where table_id =  '{$res['table_id']}' and ('{$now}' BETWEEN STR_TO_DATE(`datetime`,'%s') and STR_TO_DATE(DATE_ADD(datetime, INTERVAL 3 HOUR),'%s') ) and reservation_id != '{$reservation_id}' ");
                while($row = mysqli_fetch_array($result)) {
                    //echo "Total Rows is ". $row['count'];
                    $check=$row['count'];
                  //  echo "<br />";
                }

                if($check > 0){
                    $conn->query("UPDATE `table_list` set `status` = 0  where table_id = '{$res['table_id']}'");
                }else{
                    $conn->query("UPDATE `table_list` set `status` = 1  where table_id = '{$res['table_id']}'");
                }
            }
        }else{
            $resp['status'] ='failed';
            $resp['msg'] = "An error occured while updating data. Error: ".$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
    function save_item(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        $data = "";
        //debug_to_console($_POST["id_client"]);
        foreach($_POST as $k =>$v){
            if(!in_array($k,array('id'))){
                if(!is_numeric($v)){
                    $v = $conn->real_escape_string($v);
                }
                    $columns[] = "`{$k}`";
                    $values[] = "'{$v}'";
            }
        }
        if(isset($columns) && isset($values)){
            $data = "(".(implode(",",$columns)).") VALUES (".(implode(",",$values)).")";
        }

            $sql = "INSERT INTO `panier` {$data}";

            @$save = $conn->query($sql);
            if($save){
                //$resp['status'] = 'success';
              //  $resp['msg'] = 'Reservation Successfully added.';
              header("Location:./Menu.php");
            }else{
                echo 'An error occured. Error: '.$conn->lastErrorMsg();
            }

            return json_encode($resp);
    }
    function Delete_panier(){
      //try{
      $base=new DBConnection();
      $conn=$base->connect();
          $conn->query("delete from panier where id_panier=".$_GET['idpanier']);
          header("Location:./Panier.php");
      // }catch(Exception $ex){}
    }
    function Quantite_panier(){
      //try{
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_GET['qu'])){
        //echo $_POST['quantiteinput'];
        echo $_GET['idpanier'];
        $sql = "UPDATE panier set quantite=".$_GET['qu']." where id_panier = '{$_GET['idpanier']}'";
        $conn->query($sql);
        header("Location:./Panier.php");
      }
      // }catch(Exception $ex){}
    }

    function Save_cmd(){
      //try{
      $base=new DBConnection();
      $conn=$base->connect();

        if(isset($_POST['adresse']) && isset($_POST['note']) && isset($_POST['typecmd'])){
          $id_cmd=0;
          $total=0;
            $sql = "SELECT id_commande FROM commande";
            $qry = $conn->query($sql);
            foreach($qry as $k){
              $id_cmd=$k["id_commande"];
            }

        $id_cmd+=1;
        //echo $id_cmd;
        $v=false;
          $sql = "SELECT panier.*,plat.* FROM `panier`,plat WHERE panier.id_plat=plat.id_plat and panier.id_client=".$_SESSION['Id_client']."";
          $qry = $conn->query($sql);
          foreach($qry as $k){
              $id_plat=$k["id_plat"];
              $id_client=$k["id_client"];
              $quantite=$k["quantite"];
              $prix_plat=$k["prix_plat"];
              $total+=$quantite*$prix_plat;
              $d=date('Y-m-d H:i:s');
            $sql = "INSERT INTO commande Values(".$id_cmd.",".$id_client.",".$id_plat.",".$quantite.",".$quantite*$prix_plat.",'".$_POST['typecmd']."','".$_POST['note']."','".$_POST['adresse']."','Enregistrer','".$d."')";
            @$save = $conn->query($sql);
            if($save){
              $v=true;
            }else{
              $v=false;
                echo 'An error occured. Error: '.$conn->error;
            }
          }
          if($v==true){
            $sql = "DELETE FROM  panier WHERE id_client=".$_SESSION['Id_client']."";
            $conn->query($sql);
            header("Location:./Panier.php?id_cmd=".$id_cmd);
            }

        }


      // }catch(Exception $ex){}
    }

    function update_cmd_status(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        $get = $conn->query("SELECT * FROM `commande` where id_commande = '{$cmd_id}'");
        $update = $conn->query("UPDATE `commande` set `Etat` = '{$status}' where id_commande = '{$cmd_id}'");
        if($update){
            $resp['status'] = 'success';
            $resp['msg'] = "Commande Status successfully updated";
            $resp['return_status'] = $status;
            //$res= $get->fetchArray();

        }else{
            $resp['status'] ='failed';
            $resp['msg'] = "An error occured while updating data. Error: ".$this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    function Delete_plat(){
      //try{
      $base=new DBConnection();
      $conn=$base->connect();
          $conn->query("delete from plat where id_plat=".$_GET['id_plat']);
          header("Location:./admin/?page=Plats");
      // }catch(Exception $ex){}
    }
    function save_plat(){
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_POST['intitule_plat'])&&isset($_POST['description_plat'])&&isset($_POST['categorie'])
    &&isset($_POST['prix_plat'])){
      /********************************************
      extract($_FILES);
      $resp['status'] = "failed";
      if(isset($fp) && !empty($fp['tmp_name'])){
          if(!is_dir(__DIR__."\images/"))
          mkdir(__DIR__."\images/");
          echo $fp['name'];
          $fname = $fp['tmp_name'];
          $thumb_file = $fp['tmp_name'];
          $file_type = mime_content_type($thumb_file);
          list($width, $height) = getimagesize($thumb_file);
          $t_image = imagecreatetruecolor('500', '500');
          if(in_array($file_type,array('image/png','image/jpeg','image/jpg'))){
              $gdImg = ($file_type =='image/png') ? imagecreatefrompng($thumb_file) : imagecreatefromjpeg($thumb_file);
              imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, '1000', '800', $width, $height);
              if($t_image){
                  if(is_file(__DIR__.$fname))
                      unlink(__DIR__.$fname);
                      $upload = imagepng($t_image);
                      imagedestroy($t_image);
                      if($upload){
                          $resp['status'] = "success";
                          $resp['msg'] = ' Floor Plan Successfully Updated.';
                  }
              }else{
                  $resp['msg'] = 'Floor Plan image has failed to upload.';
              }
          }else{
                  $resp['msg'] = 'Floor Plan image has failed to upload due to invalid file type.';
          }
      }

      ********************************************/
      extract($_FILES);
      if(isset($fp) && !empty($fp['tmp_name'])){
        $imgName=$fp['name'];
        $tmp_nom=$fp['tmp_name'];
        $taille=$fp['size'];
        $ext=strchr($imgName,'.');
        $extentions=array('.jpg','.png','.jpeg','.gif');
        $taille_max=10000000;
        if(!in_array($ext,$extentions)){
            $erreur="ext";
        } else if($taille>$taille_max){
            $erreur="taille";
        } else{
           // unlink("../image/vehicules/".$image1);
            move_uploaded_file($tmp_nom,'./images/'.$imgName);
            $erreur="yes";
        }
      }

           if(isset($_POST['id'])){
                  if(!empty($fp['name'])){
                  $sql = "UPDATE plat set intitule_plat='{$_POST['intitule_plat']}',description_plat='{$_POST['description_plat']}',id_categorie='{$_POST['categorie']}',prix_plat='{$_POST['prix_plat']}',image_plat='{$fp['name']}' where id_plat = '{$_POST['id']}'";
                  }else{
                    $sql = "UPDATE plat set intitule_plat='".$_POST['intitule_plat']."',description_plat='".$_POST['description_plat']."',id_categorie='".$_POST['categorie']."',prix_plat='".$_POST['prix_plat']."'
                          WHERE id_plat = '".$_POST['id']."'";

                  }
            }else{
              $sql = "INSERT INTO  plat VALUES(null,'{$_POST['intitule_plat']}','{$_POST['description_plat']}','{$_POST['categorie']}','{$_POST['prix_plat']}','{$fp['name']}')";
            }
            @$save = $conn->query($sql);
            if($save){
                $resp['status'] = 'success';
                if(empty($_POST['id']))
                $resp['msg'] = 'Plat Successfully added.';
                else
                $resp['msg'] = 'Plat Details Successfully updated.';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = $resp['msg'];
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'An error occured. Error: '.$conn->error;
                $resp['sql'] = $sql;
            }

            return json_encode($resp);
    }

    }
    function save_apropos(){
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_POST['id'])&&isset($_POST['title'])&&isset($_POST['description'])){
        $id=$_POST["id"];
        $title=$_POST["title"];
        $desc=$_POST["description"];
        extract($_FILES);
        if(isset($fp) && !empty($fp['tmp_name'])){
          $imgName=$fp['name'];
          $tmp_nom=$fp['tmp_name'];
          $taille=$fp['size'];
          $ext=strchr($imgName,'.');
          $extentions=array('.jpg','.png','.jpeg','.gif');
          $taille_max=10000000;
          if(!in_array($ext,$extentions)){
              $erreur="ext";
          } else if($taille>$taille_max){
              $erreur="taille";
          } else{
             // unlink("../image/vehicules/".$image1);
              move_uploaded_file($tmp_nom,'./images/'.$imgName);
              $erreur="yes";
          }
        }



           if(isset($_POST['id'])){
                  if(!empty($fp['name'])){
                  $sql = "UPDATE apropos set Title='{$_POST['title']}',Description='{$_POST['description']}',Img_apropos='{$fp['name']}' where Id_apropos = '{$_POST['id']}'";
                  }else{
                    $sql = "UPDATE apropos set `Title`='".$title."',`Description`='".$desc."' where Id_apropos='".$id."'";
                  }
                  $save = $conn->query($sql);
                  if($save){
                      $resp['status'] = 'success';
                      $resp['msg'] = 'Apropos Details Successfully updated.';
                  $_SESSION['flashdata']['type'] = 'success';
                  $_SESSION['flashdata']['msg'] = $resp['msg'];
                  }else{
                      $resp['status'] = 'failed';
                      $resp['msg'] = 'An error occured. Error: '.$conn->error;
                      $resp['sql'] = $sql;
                  }

                  return json_encode($resp);
            }

    }

    }
    function save_expert(){
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['specialite'])){
        $id=$_POST["id"];
        $nom=$_POST["nom"];
        $specialite=$_POST["specialite"];

        extract($_FILES);
        if(isset($fp) && !empty($fp['tmp_name'])){
          $imgName=$fp['name'];
          $tmp_nom=$fp['tmp_name'];
          $taille=$fp['size'];
          $ext=strchr($imgName,'.');
          $extentions=array('.jpg','.png','.jpeg','.gif');
          $taille_max=10000000;
          if(!in_array($ext,$extentions)){
              $erreur="ext";
          } else if($taille>$taille_max){
              $erreur="taille";
          } else{
             // unlink("../image/vehicules/".$image1);
              move_uploaded_file($tmp_nom,'./images/'.$imgName);
              $erreur="yes";
          }
        }


           if(isset($_POST['id'])){
                  if(!empty($fp['name'])){

                  $sql = "UPDATE expert set Nom_expert='{$nom}',Specialite_expert='{$specialite}',Img_expert='{$fp['name']}' where Id_expert = '{$_POST['id']}'";
                  }else{

                    $sql = "UPDATE expert set `Nom_expert`='".$nom."',`Specialite_expert`='".$specialite."' where Id_expert=".$id;
                  }
                  $save = $conn->query($sql);
                  if($save){
                      $resp['status'] = 'success';
                      $resp['msg'] = 'Expert Details Successfully updated.';
                  $_SESSION['flashdata']['type'] = 'success';
                  $_SESSION['flashdata']['msg'] = $resp['msg'];
                  }else{
                      $resp['status'] = 'failed';
                      $resp['msg'] = 'An error occured. Error: '.$conn->error;
                      $resp['sql'] = $sql;
                  }

                  return json_encode($resp);
            }

    }

    }
    function save_contact(){
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_POST['id'])&&isset($_POST['tel'])&&isset($_POST['email'])
    &&isset($_POST['adresse'])&&isset($_POST['maps'])){
        $id=$_POST["id"];
        $tel=$_POST["tel"];
        $email=$_POST["email"];
        $adresse=$_POST["adresse"];
        $maps=$_POST["maps"];
           if(isset($id)){
                  $sql = "UPDATE contact set `Phone_contact`='".$tel."',`Email_contact`='".$email."',`Adresse`='".$adresse."',`Adresse_map`='".$maps."' where Id_contact=".$id;
                  $save = $conn->query($sql);
                  if($save){
                      $resp['status'] = 'success';
                      $resp['msg'] = 'Contact Details Successfully updated.';
                  $_SESSION['flashdata']['type'] = 'success';
                  $_SESSION['flashdata']['msg'] = $resp['msg'];
                  }else{
                      $resp['status'] = 'failed';
                      $resp['msg'] = 'An error occured. Error: '.$conn->error;
                      $resp['sql'] = $sql;
                  }

                  return json_encode($resp);
            }

    }

    }
    function save_email(){
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_POST['nom'])&&isset($_POST['msg'])&&isset($_POST['email'])){
        $nom=$_POST["nom"];
        $email=$_POST["email"];
        $msg=$_POST["msg"];

                 $sql = "INSERT INTO emails values(null,'".$nom."','".$email."','".$msg."',0)";
                  $save = $conn->query($sql);
                  if($save){

                      header("Location:./index.php#contact");
                  }else{
                      echo 'An error occured. Error: '.$conn->error;

                  }
    }

    }
    function delete_email(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        @$delete = $conn->query("DELETE FROM `emails` where id_email = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Email successfully deleted.';

        }else{
            $resp['status']='failed';
            $resp['msg'] = 'An error occure. Error: '.$conn->error;
        }
        return json_encode($resp);
    }
    function delete_mj(){
      $base=new DBConnection();
      $conn=$base->connect();
        extract($_POST);
        @$delete = $conn->query("DELETE FROM `menu_du_jour` where id_mj = '{$id}'");
        if($delete){
            $resp['status']='success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'Plats successfully deleted.';

        }else{
            $resp['status']='failed';
            $resp['msg'] = 'An error occure. Error: '.$conn->error;
        }
        return json_encode($resp);
    }
    function save_plat_mj(){
      $base=new DBConnection();
      $conn=$base->connect();
      if(isset($_POST['plat'])&&isset($_POST['dj'])){

            $sql = "INSERT INTO  menu_du_jour VALUES(null,'{$_POST['plat']}','{$_POST['dj']}')";

            @$save = $conn->query($sql);
            if($save){
                $resp['status'] = 'success';
                $resp['msg'] = 'Plat Successfully added.';

            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = $resp['msg'];
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = 'An error occured. Error: '.$conn->error;
                $resp['sql'] = $sql;
            }

            return json_encode($resp);
    }

    }
}
$a = isset($_GET['a']) ?$_GET['a'] : '';
$action = new Actions();
switch($a){
    case 'login':
        echo $action->login();
    break;
    case 'logout':
        echo $action->logout();
    break;
    case 'update_credentials':
        echo $action->update_credentials();
    break;
    case 'save_floorplan':
        echo $action->save_floorplan();
    break;
    case 'save_admin':
        echo $action->save_admin();
    break;
    case 'delete_admin':
        echo $action->delete_admin();
    break;
    case 'save_table':
        echo $action->save_table();
    break;
    case 'delete_table':
        echo $action->delete_table();
    break;
    case 'save_reservation':
        echo $action->save_reservation();
    break;
    case 'delete_reservation':
        echo $action->delete_reservation();
    break;
    case 'update_reservation_status':
        echo $action->update_reservation_status();
    break;
    case 'save_item':
        echo $action->save_item();
    break;
    case 'dec':
        echo $action->Deconnexion();
    break;
    case 'delete_panier':
        echo $action->Delete_panier();
    break;
    case 'quantite_panier':
        echo $action->Quantite_panier();
    break;
    case 'save_cmd':
        echo $action->Save_cmd();
    break;
    case 'update_cmd_status':
        echo $action->update_cmd_status();
    break;
    case 'delete_plat':
        echo $action->Delete_plat();
    break;
    case 'save_plat':
        echo $action->save_plat();
    break;
    case 'save_apropos':
        echo $action->save_apropos();
    break;
    case 'save_expert':
        echo $action->save_expert();
    break;
    case 'save_contact':
        echo $action->save_contact();
    break;
    case 'save_email':
        echo $action->save_email();
    break;
    case 'delete_email':
        echo $action->delete_email();
    break;
    case 'delete_mj':
        echo $action->delete_mj();
    break;
    case 'save_plat_mj':
        echo $action->save_plat_mj();
    break;
    default:
    // default action here
    break;
}
