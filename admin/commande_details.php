<?php 	
require_once('verifier_access.php'); 
require_once('../classes/ProduitCommande.php');
require_once('../classes/Commande.php');
$idcommande=$_GET['id'];
$c=new Commande();
$c=$c->details($idcommande);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Detail du Commande</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

  <?php require_once('header.php'); ?>
  
  <div class="container2">

      <h1>Detail du Commande 
      :
    </h1>
    <h2>Commande N°<?php echo $idcommande; ?></h2>
    <div class="col-sm-9">
      CLIENT : <?php echo $c->_nom ; ?><br>
      Effectué Le : <?php echo $c->_datecmd; ?>
    </div>
    </div>
    <div class="container2">

      <div class="clear"><p>&nbsp;</p></div>

      <div id="result">
       <table class="table table-striped">   
        <thead> 
          <tr>
            <th>Id</th>
            <th>Libelle</th>
            <th>PRIX</th>
            <th>QUANTITE</th>
            <th>TOTAL HT</th>
          </tr>
        </thead>
        <tbody id="resultat-diporama"> 
          <?php 

          $pc = new ProduitCommande();	
          $liste = $pc->liste_par_commande($idcommande);
          foreach($liste as $data )
          {
            $som=@$som+$data->_total;
           ?>
           <tr>
            <td><?php echo $data->_id; ?></td>
            <td><?php echo $data->_libelle; ?></td>
            <td><?php echo $data->_pu; ?></td>
            <td><?php echo $data->_qte; ?></td>
            <td><?php echo $data->_total; ?></td>
         </tr>
         <?php  } ?>
         <tr>
           <td></td>
           <td></td>
           <td></td>
           <td>TOTAL HT :</td>
           <td><?php echo @$som ;?></td>
         </tr>
         <tr>
           <td></td>
           <td></td>
           <td></td>
           <td>TVA (10%) :</td>
           <td><?php echo @$som/10 ;?></td>
         </tr>
         <tr>
           <td></td>
           <td></td>
           <td></td>
           <td>TOTAL TTC :</td>
           <td><?php echo @$som+@$som/10 ;?></td>
         </tr>
       </tbody>
     </table>
   </div>        

   <div style="text-align: center;">
    <div id="bootstrap-pagination"></div>
  </div>

</div>
<hr>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-paginator.js"></script>
<script src="js/bootstrap.validate.js"></script>
<script src="js/bootstrap.validate.en.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
  function confirmDelete(delUrl) {
    if (confirm("Voulez vous vraiment supprimer cette cat ? ?")) {
     document.location = delUrl;
   }
 }
</script>
</body>
</html>