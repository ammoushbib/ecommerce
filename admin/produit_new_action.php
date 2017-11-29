<?php
require_once("../classes/Produit.php");
require_once("../classes/Util.php");

@$libelle = $_POST['libelle'];
@$description = $_POST['description'];
@$id = $_POST['id'];
@$prix = $_POST['prix'];
@$id_categorie = $_POST['id_categorie'];

if( !empty($libelle) && !empty($description) ) 
{
	$p = new Produit();
	$util = new Util();
    $p->_libelle = $libelle;
    $p->_prix = $prix;
    $p->_description = $description;
    $p->_id_categorie = $id_categorie;
	$p->_image = $util->upload('image', "../upload");
	
	if( empty($id) ) 	// Ajout
		$id = $p->ajouter();
	else				// Modifipion
	{
		$p->_id = $id;
		$p->modifier();
	}

	header("Location:produits_liste.php");
} 
else 
	exit('Tous les champs sont obligatoires !!');
?>