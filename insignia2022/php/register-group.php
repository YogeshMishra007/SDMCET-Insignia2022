<?php
    include('./functions.php');
    db_connect();            
    
    
    $participantNames = explode(',',$_POST['participantNames']);
    $participantUsns = explode(',',$_POST['participantUsns']);
    for($i=0;$i<count($participantNames);$i++){
        $sql = "INSERT INTO participants(name,mobilenumber,collegename,usn,emailid,accomodation,eventid) VALUES (?,?,?,?,?,?,?)";
        $statement = $conn->prepare($sql);
        
        $statement->bind_param('sssssss',$participantNames[$i],$_POST['contactNumber'],$_POST['collegeName'],$participantUsns[$i],$_POST['emailId'],$_POST['accomo-check'],$_GET['id']);
        $statement->execute(); 
        
        $sql = "SELECT MAX(participantid) FROM participants";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($idOfP);
        $statement->fetch();
        $sql = "SELECT p.*,e.eventCategory FROM participants p INNER JOIN events e on p.eventID = e.eventId AND p.participantId=".$idOfP;
        $result = $conn->query($sql);
        if($result){
            if($result->num_rows>0){
                while($participant = $result->fetch_assoc()){
                    $participantNumber = $participant['mobilenumber'];
                    
                    $insigniaId="INS-";
                    if(strcmp($participant['eventCategory'],"1")==0){
                        $insigniaId .= "OCENT-";
                        
                    }
                    else if(strcmp($participant['eventCategory'],"2")==0){
                        $insigniaId .= "OCUL-";
                    }
                    else{
                        $insigniaId .= "OT-";
                        $eventId = intval($participant['eventId']);
                        if($eventId>=30&&$eventId<=34){
                            $insigniaId .= "CS-";
                        }
                        else if($eventId>=35&&$eventId<=39){
                            $insigniaId .= "IS-";
                        }
                        else if($eventId>=40&&$eventId<=43||$eventId==70){
                            $insigniaId .= "EC-";
                        }
                        else if($eventId>=44&&$eventId<=46){
                            $insigniaId .= "E&E-";
                        }
                        else if($eventId>=47&&$eventId<=51){
                            $insigniaId .= "CV-";
                        }
                        else if($eventId>=52&&$eventId<=55||$eventId==66){
                            $insigniaId .= "ME-";
                        }
                        else if($eventId>=56&&$eventId<=60){
                            $insigniaId .= "CH-";
                        }
                        else if($eventId==61){
                            $insigniaId .= "MAT-";
                        }
                        else if($eventId==63){
                            $insigniaId .= "CHE-";
                        }
                        else if($eventId==64){
                            $insigniaId .= "PHY-";
                        }
                        
                        
                    }
                    $idToAdd = $participant['participantId'];
                    $idToAdd = str_pad($idToAdd, 4, "0", STR_PAD_LEFT);
                    $insigniaId .=$idToAdd;
                    
                    $participantId = $participant['participantId'];
                    $sql2 = "UPDATE participants SET insigniaid = ? WHERE participantId=?";
                    $statement2 = $conn->prepare($sql2);
                    $statement2->bind_param('ss',$insigniaId,$participantId);
                    $statement2->execute();
                    
                }
            }
        }
   
    }
     
    redirect_to('../thank-you.php');

?>