<?php
require_once("Mysql.php");
class Commande extends Mysql
{
	// Les attributs privés
	private $_id;
	private $_nom;
	private $_email;
	private $_adresse;
	private $_datecmd;

	// Méthode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return ( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $attribut n'existe pas!");     
    }

    public function __set($attribut, $value) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = (mysqli_real_escape_string($this->get_cnx(), $value)) ;
        }
        else
        	exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $attribut n'existe pas!");
    }

	public function details($id)
	{
		$q = "SELECT * FROM commande WHERE id ='$id' ORDER BY nom";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$cat = new Commande();
		
		$cat->_id 			= $row['id'];
		$cat->_nom 			= $row['nom'];
		$cat->_email 		= $row['email'];
		$cat->_adresse		= $row['adresse'];
		$cat->_datecmd		= $row['datecmd'];
	
		return $cat;
	}


	public function liste()
	{
		$q = "SELECT * FROM commande ORDER BY nom";
		$list_c = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$c = new Commande();

			$c->_id 			= $row['id'];
			$c->_nom 			= $row['nom'];
			$c->_email			= $row['email'];
			$c->_adresse	    = $row['adresse'];
			$c->_datecmd	    = $row['datecmd'];
			$list_c[]=$c;
		}
		
		return $list_c;
	}
	
	public function ajouter()
	{
	    $q = "INSERT INTO commande(id, nom, email, adresse,datecmd) VALUES 
	  		(  null				, '$this->_nom'		,
			  '$this->_email'	, '$this->_adresse',NOW()
			)";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE categorie SET
			  libelle 	= '$this->_libelle',
			  image = IF('$this->_image' = '', image, '$this->_image') ,
			  description = '$this->_description'

			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM commande WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 
}
?>