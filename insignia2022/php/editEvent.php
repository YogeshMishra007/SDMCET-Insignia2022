<?php 
    require_once('./functions.php');
    db_connect();
    $sql = "UPDATE events SET 
            eventName = ?,
            eventDate = ?,
            eventTime = ?,
            eventDescription = ?,
            eventCoordinators = ?,
            eventVenue = ?,
            eventContact = ?,
            eventRules = ?,
            eventMinSize = ?,
            eventMaxSize = ?
            WHERE eventId = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssssssssss',$_POST['eventName'],$_POST['eventDate'],$_POST['eventTime'],$_POST['eventDescription'],$_POST['eventCoordinators'],
    $_POST['eventVenue'],$_POST['eventContact'],$_POST['eventRules'],
    $_POST['eventMinSize'],$_POST['eventMaxSize'],$_GET['id']);
    echo $conn->error;
    $statement->execute();
    redirect_to('../admin/events.php');
?>