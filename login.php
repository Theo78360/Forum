 <form method="post">
  <div class="mb-3">
    <label for="exampleInput" class="form-label">login</label>
    <input type="text" name="login" class="form-control" id="exampleInput">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>


<?php


if(isset($_POST['submit'])){
    
    $login = $_POST['login'];
    $password = sha1($_POST['password']);
    
    $requete = $bdd->prepare("SELECT * FROM users WHERE login =:login AND password =:password");
    $requete->bindValue(":login", $login, PDO::PARAM_STR);
    $requete->bindValue(":password", $password, PDO::PARAM_STR);
    $requete->execute();
    
    if($requete->rowCount()>0){
        
        $reponse = $requete->fetch();
        
        if($reponse["lvl"] == 0)
            echo "Vous êtes pour le moment banni";
        else
        {
            $_SESSION['login'] = $reponse['login'];
            $_SESSION['lvl'] = $reponse['lvl'];
            $_SESSION['id'] = $reponse['id'];// Va permettre de donner des autorisations
            
            header("Location:posts.php");
        }
        
    }
    else
    {
        echo "Identifiant incorrect";
    }
    
   
}


?>