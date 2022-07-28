<?php 
    require_once('functions.php');
    db_connect();
    $sql = "DELETE FROM participants WHERE participantId = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s',$_GET['id']);
    $statement->execute();


    redirect_to('../padmin/participants.php');
?>