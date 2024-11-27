<?php
session_start();
?>
<?php

require_once('bddconnect.php');

$sql="SELECT * from annonces WHERE categorie='Ordinateurs' ORDER BY id DESC";
$query = $bdd->prepare($sql);
$query->execute(); 
$result = $query->fetchAll(PDO::FETCH_ASSOC); 

// var_dump($result);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <title>BAD CORNER - Catégorie Ordinateurs</title>
</head>
<body>
    <header>
        <a href="index.php"><h1>BAD CORNER</h1></a>
    </header>
    
   <div class="bulles">
        <div class="bulle1">
            <div class="content">
        
                <div class="text">
                    Ordinateurs
                </div>
            </div>
        </div>
   </div>
   <hr>

   <!-- Annonces -->

   <div class="titre_annonces">      
        <h2>Les annonces dans la catégorie : Ordinateurs</h2>
    </div>

    <div class="annonces">
        <?php
            foreach ($result as $projet) {
            ?>
            <div class="cartes">

                <div class="photo_annonce"><a href="view_annonce.php?id=<?= $projet['id']?>"><img src="uploads/<?=$projet['image']?>" alt=""></a></div>
                <div class="texte_annonce">
                    <h3><?= $projet['titre']?></h3>
                    <h4><?= $projet['prix']?> €</h4>
                    <h5><?= $projet['lieu']?></h5>
                </div>

            </div>
            
        
            
            <?php
            }
        ?>
    </div>

    <hr>
    <div class="divers">
    <a href="users/modif_annonce.php">modif annonce</a><br>
    <a href="users/add_annonce.php">ajout annonce</a><br>
    <a href="users/mes_annonces.php">mes annonces</a><br>
    <a href="users/mes_favoris.php">mes favoris</a><br>
    <a href="users/mon_profil.php">mon profil</a><br>
    <a href="users/view_annonce.php">view</a>


<br><br><br><br><br>

    </div>

   <hr>
   <?php
   if(isset($_SESSION['admin'])){
      include 'footer2.php';
      
       
    }else {
      include 'footer1.php';
    }
    ?>
</body>
</html>