<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Affable Beans</title>
</head><!--/head-->

<body>
	<?php require_once("header.php") ?>
	
	
	<form id="form" name="form" methode="get">	
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Panier</li>
				</ol>
			</div>

		

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Produit</td>
							<td class="description">Détails</td>
							<td class="price">Prix</td>
							<td class="quantity">Quantité</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						require_once("./classes/Produit.php");
						@$tab=$_SESSION['panier'];
						if(isset($tab))
							foreach ($tab as  $key => $qte) 
							{
							$p= new Produit();
							$p=$p->details($key);
					?>
						<tr class="p<?php echo $p->_id; ?>">
							<td class="cart_product">
								<a href=""><img src="images/<?php echo $p->_image; ?> " alt="" class="img-prd"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $p->_libelle; ?></a></h4>
								<p><?php echo $p->_id; ?></p>
							</td>
							<td class="cart_price_<?php echo $p->_id; ?>">
								<p><?php echo $p->_prix; ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" onclick="panier_plus('<?php echo $p->_id; ?>')"> + </a>
									<input id="qte_<?php echo $p->_id; ?>" class="cart_quantity_input" type="text" name="quantity" value="<?php echo $qte; ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" onclick="panier_moins('<?php echo $p->_id; ?>')"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price" id="cart_<?php echo $p->_id; ?>"><?php echo $p->_prix*$qte; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="suppPanier.php?id=<?php echo $p->_id; ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						
						<?php }
						 ?>
					</tbody>
				</table>
			</div>

			
		</div>
	</section> <!--/#cart_items-->

<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<?php
							if(isset($tab))
								foreach ($tab as $key => $value) 
								{
									$p=new Produit();
									$p=$p->details($key);
									$som=@$som+$p->_prix*$value;
								}
							?>
							<li>Sous total <span><?php echo @$som; ?></span></li>
							<li>TVA (10%) <span><?php echo @$som/10; ?></span></li>
							<li>Frais de transport <span>Gratuit</span></li>
							<li>Total <span><?php echo @($som+$som/10); ?></span></li>
						</ul>
							<a class="btn btn-default update" href="#" onclick="form.submit()">Mettre à jour le panier</a>
							<a class="btn btn-default check_out" href="commander.php">Valider ma commande</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

		</form>	
<?php require_once("footer.php") ?>
<script>
	function panier_plus(id)
	{
		 	$("#qte_"+id).val(parseInt($("#qte_"+id).val()) +1);
		 	$("#cart_"+id).text((parseFloat($(".cart_price_"+id).text())*$("#qte_"+id).val()).toFixed(3));	
		 
	}
	function panier_moins(id)
	{
				
		if ($("#qte_"+id).val()==1) 
		{
			window.location.href = "suppPanier.php?id="+id;
			 
		}
		else
		{	
		 	$("#qte_"+id).val(parseInt($("#qte_"+id).val()) - 1);
			$("#cart_"+id).text((parseFloat($(".cart_price_"+id).text())*$("#qte_"+id).val()).toFixed(3));
		}

	}
	
</script>
</body>
</html>