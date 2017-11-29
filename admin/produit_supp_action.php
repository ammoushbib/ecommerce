<?php
require_once('verifier_access.php'); 
require_once("../classes/Produit.php");
$cat = new Produit($bdd);

$cat->supprimer((int)$_REQUEST['id']);
header("Location: produits_liste.php");
?>