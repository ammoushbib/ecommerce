<?php
session_start();
require_once("./classes/ProduitCommande.php");
require_once("./classes/Produit.php");
require_once("./classes/Commande.php");

$nom=$_GET['nom'];
$email=$_GET['email'];
$adresse=$_GET['adresse'];
if (!isset($_SESSION['panier']))
	header("Location: panier.php");
else
{
	$c=new Commande();
	$c->_nom=$nom;
	$c->_email=$email;
	$c->_adresse=$adresse;
	$id=$c->ajouter();
	foreach ($_SESSION['panier'] as $key => $value) 
	{
		echo $key.'  '.$value;
		$p=new Produit();
		$p=$p->details($key);
		$pc= new ProduitCommande();
		$pc->_id=$key;
		$pc->_libelle=$p->_libelle;
		$pc->_pu=$p->_prix;
		$pc->_qte=$value;
		$pc->_total=$pc->_pu*$pc->_qte;
		$pc->_idcommande=$id;
		$pc->ajouter();
		require_once("./videPanier.php");
		header("Location:valider.php?id=$id");
	}
}
?>