<?php

class Alert{
    


public static function setFlash($message,$type = "success"){
    
		$_SESSION['flash']['message'] = $message;
		$_SESSION['flash']['type'] = $type;
}  
public static function flash(){
		
    if(isset($_SESSION['flash'])){
			
        extract($_SESSION['flash']);//recupere et créé les variables correspondantes
        unset($_SESSION['flash']);
        return "<div class='alert alert-$type'>$message</div>";
    }
}
}

