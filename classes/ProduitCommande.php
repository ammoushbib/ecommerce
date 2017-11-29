<?php
require_once("Mysql.php");
class ProduitCommande extends Mysql
{
	// Les attributs privés
	private $_id;
	private $_libelle;
	private $_pu;
	private $_qte;
	private $_total;
	private $_idcommande;

	// Méthode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return ( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");     
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
		$q = "SELECT * FROM produitcommande WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$p = new ProduitCommande();
		
		$p->_id 			= $row['id'];
		$p->_libelle 		= $row['libelle'];
		$p->_pu 		    = $row['pu'];
		$p->_qte			= $row['qte'];
		$p->_total	        = $row['total'];
		$p->_idcommande     = $row['idcommande'];
		return $p;
	}


	public function liste_par_commande($idcommande)
	{
		$q = "SELECT * FROM produitCommande WHERE idcommande=$idcommande ORDER BY libelle";
		$list_prod = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$p= new ProduitCommande();

			$p->_id 			= $row['id'];
		$p->_libelle 		= $row['libelle'];
		$p->_pu 		    = $row['pu'];
		$p->_qte			= $row['qte'];
		$p->_total	        = $row['total'];
		$list_prod[]=$p;
		}
		
		return $list_prod;
	}
	public function ajouter()
	{
	    $q = "INSERT INTO produitCommande (id, libelle, pu, qte,total,idcommande) VALUES 
	  		(  '$this->_id'			, '$this->_libelle'		,
			  '$this->_pu'	, '$this->_qte'	, '$this->_total'
			, '$this->_idcommande')";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE produitCommande SET
			  libelle 	= '$this->_libelle',prix='$this->_prix',
			  image = IF('$this->_image' = '', image, '$this->_image') ,
			  description = '$this->_description' ,
			  id_categorie = '$this->_id_categorie'

			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM produit WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 




	
}
?>