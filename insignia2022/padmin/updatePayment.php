<?php 

    include('../php/functions.php');
    db_connect();
    $sql = "UPDATE participants SET payment = ? WHERE participantId = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ss',$_POST['payment'],$_GET['id']);
    $statement->execute();
    redirect_to('../padmin/participants.php');

    ?>