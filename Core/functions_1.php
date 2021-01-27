<?php

function connectBDD(){
    
    try{
        $bdd = new PDO("mysql:host=localhost;dbname=correc","root","");
        return $bdd;
    }catch(Exception $e){
        die("erreur bdd");
    }
}

function auth($lvl){// fonction qui controle si le lvl de l utilisateur est suffisant
    
    if(isset($_SESSION['lvl']) && $_SESSION['lvl'] >= $lvl)
        return true;
    else
        header("Location:login.php");
}

function setFlash($message,$type = "success"){
    
		$_SESSION['flash']['message'] = $message;
		$_SESSION['flash']['type'] = $type;
}  
                  
function flash(){
		
    if(isset($_SESSION['flash'])){
			
        extract($_SESSION['flash']);//recupere et créé les variables correspondantes
        unset($_SESSION['flash']);
        return "<div class='alert alert-$type'>$message</div>";
    }
}

