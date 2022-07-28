<?php
    require_once('./functions.php');
    db_connect();
    $sql = "SELECT adminId,adminEmail,adminPassword FROM admins WHERE adminEmail = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s',$_POST['email']);
    $statement->execute();
    $statement->store_result();
    $statement->bind_result($id,$email,$password);
    $statement->fetch();
    if(strcmp($_POST['password'],$password)==0){
        redirect_to('../admin/home.php');
    }
    else{
        redirect_to('../admin/');
    }
?>