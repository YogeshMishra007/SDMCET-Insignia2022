<?php 
    require_once('./php/functions.php');
    db_connect();
    $sql = "SELECT p.*,e.eventCategory FROM participants p INNER JOIN events e on p.eventID = e.eventId AND p.insigniaid=NULL";
    $result = $conn->query($sql);
    $partArray = [];
    var_dump($result);
    if($result){
        if($result->num_rows>0){
            echo "HERE";
            $count = 1;
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
                echo $count++.".";
                $idToAdd = $participant['participantId'];
                $idToAdd = str_pad($idToAdd, 4, "0", STR_PAD_LEFT);
                $insigniaId .=$idToAdd;
                echo $insigniaId."<BR>";
                
                $participantId = $participant['participantId'];
                $sql2 = "UPDATE participants SET insigniaid = ? WHERE participantId=?";
                $statement2 = $conn->prepare($sql2);
                $statement2->bind_param('ss',$insigniaId,$participantId);
                $statement2->execute();
                
            }
        }
    }
?>