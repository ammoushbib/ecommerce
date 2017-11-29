<?php 
require_once("verifier_access.php");
require_once("../classes/Commande.php");
require_once("../classes/Produit.php");
$id_page = "dashboard";
$c=new Commande();
$listeCommande=$c->liste();
$p=new Produit();
$listeProduit=$p->liste();
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>The Affable Beans - Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>

    <?php require_once('header.php'); ?>
	
    <div class="container2">
      <h1><span class="glyphicon glyphicon-dashboard"> </span> Dashboard</h1>
    </div>

    <div class="jumbotron">      
         Nombre des commandes : <a href="commande_liste.php"><?php echo count($listeCommande); ?></a> <br/>
        Nombre des produits : <a href="produits_liste.php"><?php echo count($listeProduit); ?> </a><br/>

    </div>

<hr>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>

    </body>
</html>
