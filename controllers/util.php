<?php

class Util{

    static function isInvalidCSRFToken($POST_csrf, $SESSION_csrf){
        if(!isset($POST_csrf)){
            return true;
        }
        if($POST_csrf !== $SESSION_csrf){
            return true;
        }
        return false;
    }

    static function isEmptyInput($str){
        if(empty($str)){
            return true;
        }
        if($str == ""){
            return true;
        }
        if($str == null){
            return true;
        }
        return false;
    }

}

?>