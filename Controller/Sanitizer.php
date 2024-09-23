<?php

class Sanitizer{
    
    function stringSanitize($string){
        $cleanString = filter_var($string, FILTER_SANITIZE_STRING);
        return $cleanString;
    }
    
    function intSanitize($int){
        $cleanInt = filter_var($int, FILTER_SANITIZE_NUMBER_INT);
        return $cleanInt;
    }
}

