<?php
session_start();
$id_produit = $_GET['id'];
if (!isset($_SESSION['panier']))
	$liste = array();
else
	$liste = $_SESSION['panier'];
$liste[$id_produit]++;
$_SESSION['panier'] = $liste;

header("Location: panier.php");
?>