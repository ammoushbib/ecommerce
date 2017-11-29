<?php
session_start();
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Affable Beans</title>
</head><!--/head-->

<body>
	<?php require_once("header.php")?>
	<section>
		<div class="container">
			<h2>Votre Commande N°<?php echo $id; ?></h2>
			<div class="row">
				<div  class="col-sm-9">
					<h4><?php
					require_once("./classes/Commande.php");
					$c=new Commande();
					$c=$c->details($id);
					echo $c->_nom;
					?></h4>
					<h4>Merci pour votre commande. Nous l'avons recue et la traiterons dans les plus brefs délais.<br><br>
					Votre Numéro de commande est le <?php echo $id; ?>.</h4>
				</div>
				</div>
				<div >
					<?php
					require_once("./classes/ProduitCommande.php");
					$pc=new ProduitCommande();
					$liste=$pc->liste_par_commande($id);
					
					?>
					<table class="table table-condensed">
						<tr>
							<td><?php echo count($liste); ?> Article(s) dans votre commande</td>
							<td>Prix</td>
							<td>Quantité</td>
							<td>Total</td>
						</tr>
						<?php 
						foreach ($liste as  $value) 
						{
							$som=@$som+$value->_total;
						?>

							<tr>
								<td><?php echo $value->_libelle;?></td>	
								<td><?php echo $value->_pu;?></td>
								<td><?php echo $value->_qte;?></td>
								<td><?php echo $value->_total;?></td>
							</tr>
							<?php }?>
					</table>
				</div>
				<div class="col-sm-9">
				</div>
				<div class="col-sm-3">
					<div class="total_area">
						<ul>
							<?php
							if(isset($tab))
								foreach ($tab as $key => $value) 
								{
									$p=new Produit();
									$p=$p->details($key);
									$som=@$som+$p->_prix;
								}
							?>
							<li>Sous total <span><?php echo @$som; ?></span></li>
							<li>TVA (10%) <span><?php echo @$som/10; ?></span></li>
							<li>Frais de transport <span>Gratuit</span></li>
							<li>Total <span><?php echo @($som+$som/10); ?></span></li>
						</ul>
					</div>
				
				</div>
			</div>
		</div>
	</section>
	<?php require_once("footer.php") ?>
<script >
	$(".col-sm-8").hide();
</script>
</body>

</html>