<?php
class ParticipantCol {
        public $mobileNumber,$collegeName,$name,$usn,$emailId,$accomodation,$event;
        function __construct($mb,$cn,$n,$u,$e,$a,$ev){
            $mobileNumber = $mb;
            $collegeName = $cn;
            $name = $n;
            $usn = $u;
            $emailId = $e;
            $accomodation = $a;
            $event = $ev;

        }

        
    }

?>