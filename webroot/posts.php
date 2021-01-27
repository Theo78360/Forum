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
            
            setFlash("Votre post a bien été supprimé");
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
                    <a href='index.php?p=posts&edit=<?= $post['id'] ?>' class='btn btn-success'>Modifier</a>
                    <a href='index.php?p=posts&delete=<?= $post['id'] ?>' class='btn btn-warning' onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet article?'));">Supprimer</a>
                <?php
                }
        }
    
        
    ?>   
    <form action="" method="post">
    <h2>Ajouter un article</h2>
    <textarea name="contenu" id="editor1" cols="30" rows="10"><?= $contenuTextarea ?></textarea><br>
    <input type="hidden" name="edit"  value="<?= $id ?>">
    <button name="submit" class="btn btn-primary">Ajouter</button>  
    </form> 
    
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>
    