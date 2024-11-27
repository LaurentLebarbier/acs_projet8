<?php
session_start();
require_once('bddconnect.php');
if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
}else{

};

    ?>

  
<?php
    
    
        if($_POST){
            $acheteur_pseudo = strip_tags($_POST["acheteur_pseudo"]);
            $acheteur_email = strip_tags($_POST["acheteur_email"]);
            $message = strip_tags($_POST["message"]);
            $vendeur_pseudo = strip_tags($_POST["vendeur_pseudo"]);
            $object = strip_tags($_POST["object"]);
            $vendeur_email = strip_tags($_POST["vendeur_email"]);
        
            $content = "<html><head><title>Vous avez un message de " . $acheteur_pseudo . "</title></head><body>";
            $content .= "<p>Bonjour " . $vendeur_pseudo . ", vous avez reçu un message de " . $acheteur_pseudo . ".</p>";
            $content .= "<p><strong>Message</strong> : " . $message . "</p>";
            $content .= "<br/>";
            $content .= "Voici les coordonnées de " . $acheteur_pseudo . " :";
            $content .= "<p><strong>Prénom</strong> : " . $acheteur_pseudo . "</p>";
            $content .= "<p><strong>Email</strong> : " . $acheteur_email . "</p>";
            $content .= "</body></html>";
        
            $title = 'MIME-Version: 1.0'."\r\n";
            $title .= 'Content-type: text/html; charset=UTF-8'."\r\n";
        
            mail($vendeur_email, $object, $content, $title);
    
        header('Location:index.php');
    }

    ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <link rel="stylesheet" href="CSS/connect.css">
    <link rel="stylesheet" href="CSS/users.css">

    <title>BAD CORNER - Mes Annonces</title>
</head>

<body>

    <header>
        <a href="index.php"><h1>BAD CORNER</h1></a>
    </header>

    <?php
$getid=$_GET['id'];


$sql = "SELECT * FROM annonces INNER JOIN users ON annonces.id_users=users.id_users WHERE id = $getid";
$query = $bdd->prepare($sql);
$query->execute(); 
$result = $query->fetchAll(PDO::FETCH_ASSOC); 

?>
<?php
      foreach ($result as $projet) {  
        ?>
        
    <div class="categories">
        <h2 id="view_titre"><?= $projet['titre']?></h2>
    </div>
    <hr>



    <div class="img_view">
        <img src="uploads/<?=$projet['image']?>" width="auto" height="300px" alt="">
    </div>
    <div class="prix_view">
        <h2>Prix<br><?= $projet['prix']?> €</h2>
    </div>
    <hr>
    <div class="userfav_view">
        <div class="user_view">
            <img src="IMG/userimg/<?=$projet['image_users']?>" width="30px" height="30px" alt="">
            <h3><?=$projet['nom_users']?></h3>
        </div>
        <div class="fav_view">
            <h3>Favoris</h3>
            <img src="IMG/star.png" width="30px" id="star" height="30px" alt="">
        </div>
    </div>
    <hr>
    <div class="userinfo_view">
        <div class="cat_view">
            <h3>CATEGORIE</h3><br>
            <h4><?= $projet['categorie']?></h4>
        </div>
        <div class="date_view">
            <h3>DATE</h3><br>
            <h4><?= $projet['date']?></h4>
        </div> 
        <div class="lieu_view">
            <h3>LIEU</h3><br>
            <h4><?= $projet['lieu']?></h4>
        </div>
    </div>
    <hr>
    <div class="description_view">
        <p><?= $projet['description']?></p>
    </div>

    <hr>
      <?php
    if(isset($_SESSION['admin'])){
        $user = $_SESSION['admin'];
        $test="SELECT * FROM users WHERE id_users=$user";
        $query = $bdd->prepare($test);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC); 
    }
    ?> 
    <div id="form_contact">
        <form action="" method="POST">


                <!-- informations de l'acheteur -->
                <input type="text" placeholder="Votre pseudo" name="acheteur_pseudo" value="<?=$result['nom_users']?>">
                <input type="text" placeholder="Adresse mail" name="acheteur_email" value="<?=$result['mail']?>"> 
                <!-- informations du vendeur -->
                <input type="text" placeholder="Votre pseudo" name="vendeur_pseudo" value="<?=$projet['nom_users']?>">
                <input type="text" placeholder="Adresse mail" name="vendeur_email" value="<?=$projet['mail']?>">
            
                <input type="text" placeholder="Objet" name="object" required>
                <textarea type="text" placeholder="Message" id="describ" name="message" required></textarea><br>

                <input type="submit" value="Envoyer" id="contact_submit" name="mailform">


            </form>
        </div>

       
        <?php
   if(isset($_SESSION['admin'])){
   
      echo "<a><button id=\"contacter\">Contacter le vendeur</button></a>";
      
       
    }else {
      
    }

    ?>


<br><br><br><br><br>

   <?php
        }
    ?>
    <?php
   if(isset($_SESSION['admin'])){
      include 'footer2.php';
      
       
    }else {
      include 'footer1.php';
    }

    ?>


    <script src="JS/view.js"></script>
    <script src="https://kit.fontawesome.com/508ebce8fc.js"></script>
</body>
</html>