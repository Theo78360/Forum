<?php auth(2); ?>
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
    <link href="css/forum.css" rel="stylesheet"> 
</head>
<body>
    <div class="container">
    <h2>Utilisateurs</h2>
    <hr>
    <?php
        
        if(isset($_GET['ban']))//bannir
            $bdd->query("UPDATE users SET lvl = 0 WHERE id = ".$_GET['ban']);
        if(isset($_GET['deban']))//debannir
            $bdd->query("UPDATE users SET lvl = 1 WHERE id = ".$_GET['deban']);
        
        $requete = $bdd->query("SELECT * FROM users");
        $users = $requete->fetchAll();
        
        foreach($users as $user){
            
            echo "<p>";
            echo $user['id']."<br>";
            echo $user['login']."<br>";
            echo $user['email']."<br>";
            echo $user['lvl']."<br>";
            echo "</p>";
            
            if($user['lvl'] == 0)
                echo "<a href='admin.php?deban={$user['id']}' class='btn btn-success'>Débannir</a>";
            else
                echo "<a href='admin.php?ban={$user['id']}' class='btn btn-warning'>Bannir</a>";
        }
        
    ?>
    <h2>Categories</h2>
    <hr>
    </div>
    </body>
</html>