<?php

if(isset($_COOKIE['auth']) && !isset($_SESSION['login'])){
    
    $auth = $_COOKIE['auth'];//recuperation du cookie
    $auth = explode('-----',$auth);//1------nskdnvjksnvsnsnn
    $user = $bdd->prepare("SELECT * FROM users WHERE id=:id");
    $user->bindValue(':id',$auth[0],PDO::PARAM_INT);
    $user->execute();
    $donnee = $user->fetch();
    $key = sha1($donnee['login'].$donnee['password'].$_SERVER['REMOTE_ADDR']);
    if($key == $auth[1])
    {
        $_SESSION['login'] = $reponse['login'];
            $_SESSION['lvl'] = $reponse['lvl'];
            $_SESSION['id'] = $reponse['id'];// Va permettre de donner des autorisations
        setcookie('auth',$donnee['id'].'-----'.sha1($donnee['login'].$donnee['password'].$_SERVER['REMOTE_ADDR']),time()*3600*24*3,'/','localhost',false,true);
        //le dernier argument evite que le cookie soit editable en javascript
        header("location:posts");
    }
    else
    {
        setcookie('auth','',time()-3600,'/','localhost',false,true);
        //A mettre aussi sur la page de deconnexion
    }
}


if(isset($_POST['submit'])){
    
    $login = $_POST['login'];
    $password = sha1($_POST['password']);
    
    $requete = $bdd->prepare("SELECT * FROM users WHERE login =:login AND password =:password");
    $requete->bindValue(":login", $login, PDO::PARAM_STR);
    $requete->bindValue(":password", $password, PDO::PARAM_STR);
    $requete->execute();
    
    if($requete->rowCount()>0){// Correspondance ou pas
        
        $reponse = $requete->fetch();
        
        if($reponse["lvl"] == 0)
            setFlash("Vous êtes banni","danger");
        else
        {
            if(isset($_POST['remember'])){
                
                setcookie('auth',$reponse['id'].'-----'.sha1($reponse['login'].$reponse['password'].$_SERVER['REMOTE_ADDR']),time()*3600*24*3,'/','localhost',false,true);
            }
            
            $_SESSION['login'] = $reponse['login'];
            $_SESSION['lvl'] = $reponse['lvl'];
            $_SESSION['id'] = $reponse['id'];// Va permettre de donner des autorisations
            
            header("Location:posts");
        }
        
    }
    else
    {
        setFlash("Identifiants incorrect","danger");
    }
    
   
}


?>
 
<form method="post">
  <div class="mb-3">
    <label for="exampleInput" class="form-label">login</label>
    <input type="text" name="login" class="form-control" id="exampleInput">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
   <div class="mb-3 form-check">
    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>


