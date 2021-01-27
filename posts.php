<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Forum SIO2</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/forum.css" rel="stylesheet"> </head>

<body>
    <div class="container">
    <?php
        
        $contenuTextarea = "";
        $edit = 0;
        
        if(isset($_GET['edit'])){
            
            $id = intval($_GET['edit']);
            
            $requete = $bdd->query("SELECT * FROM posts WHERE id = ".$id);
            $reponse = $requete->fetch();
            
            $contenuTextarea = $reponse['contenu'];
            $edit = $id;
        }
        
        if(isset($_POST['submit'])){
            
            $user_id = $_SESSION['id'];
            $contenu = $_POST['contenu'];
            $id = $_POST['edit'];
            
            if($_POST['edit'] == 0){

                $requete = $bdd->prepare("INSERT INTO posts VALUES('',:contenu,NOW(),:user_id)");
                $requete->bindValue(":contenu",$contenu,PDO::PARAM_STR);
                $requete->bindValue(":user_id",$user_id,PDO::PARAM_INT);
                $requete->execute();
            }
            else{
                
                $requete = $bdd->prepare("UPDATE posts SET contenu = :contenu WHERE id = :id");
                $requete->bindValue(":contenu",$contenu,PDO::PARAM_STR);
                $requete->bindValue(":id",$id,PDO::PARAM_INT);
                $requete->execute();
            }
            
            $contenuTextarea = "";
            $edit = 0;
        }
        
        
        
        if(isset($_GET['delete'])){//suppression post
            
            $id = intval($_GET['delete']);//securite
            
            $bdd->query("DELETE FROM posts WHERE id = ".$id);
            
            echo "Le post a bien ete supprime";
        }
        
        $requete = $bdd->query("SELECT * FROM posts");// envoie de la requete
        $posts = $requete->fetchAll(); 
        
        foreach($posts as $post)
        {
            ?><p>
            <blockquote>
                <?= $post['contenu'] ?>
            </blockquote>
            </p>
            <?php
                if(isset($_SESSION['id']) && $_SESSION['id'] == $post['user_id'])
                {
                ?>
                    <a href='posts.php?edit=<?= $post['id'] ?>' class='btn btn-success'>Modifier</a>
                    <a href='posts.php?delete=<?= $post['id'] ?>' class='btn btn-warning'>Supprimer</a>
                <?php
                }
        }
    
        
    ?>   
    <form action="" method="post">
    <h2>Ajouter un article</h2>
    <textarea name="contenu" id="" cols="30" rows="10"><?= $contenuTextarea ?></textarea><br>
    <input type="hidden" name="edit" value="<?= $id ?>">
    <button name="submit" class="btn btn-primary">Ajouter</button>  
    </form> 
    </div>
</body>
</html>