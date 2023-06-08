<?php

require 'iniciaSessao.php';
require 'sanitize.php';
require 'db_credentials.php';
require_once ("criaDB_roupas.php");
require_once ("component.php");

$db = new criaDB($dbname,$table,$servername,$username,$password);

if(isset($_POST['remove'])){
  if($_GET['action'] == 'remove'){
    foreach ($_SESSION['cart'] as $key => $value) {
      if($value["prodid"] == $_GET['id']){
        unset($_SESSION['cart'][$key]);
        echo "<script>alert('Produto removido!')</script>";
        echo "<script>window.location = 'cart.php'</script>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="css/store.css" media="screen">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <?php include "header.php"?>

    <title>Carrinho da ESSENCIAL</title>

  </head>
  <body class="bg-light">
    <?php require_once ('paghead.php'); ?>

    <div class="container-fluid">
      <div class="row px-5">
        <div class="col-md-7">
          <div class="shop-cart">
            <h6>Meu carrinho</h6>
            <hr>
            <?php
              $total = 0;

              if(isset($_SESSION['cart'])){
                $prodid = array_column($_SESSION['cart'], 'prodid');
                $result = $db->getData();
                while($row = mysqli_fetch_assoc($result)){
                  foreach ($prodid as $id) {
                    if($row['id'] == $id){
                     cartElement($row['imagem'], $row['produto'], $row['preco'], $row['categoria'], $row['id']);
                     $total += (float)$row['preco'];
                    }
                  }
                }
              }else{
                echo "<h5>*Não há produtos no carrinho!<h5>";
              }
            ?>
          </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
          <div class="pt-4">
            <h6> <strong>Calculadora de pagamento</strong></h6>
            <hr>
            <div class="row price-details">
              <div class="col-md-6">
                <?php
                if(isset($_SESSION['cart'])){
                  $count = count($_SESSION['cart']);
                  echo "<h6>Preço ($count itens):</h6>";
                }else{
                  echo "<h6>Preço (0 itens):</h6>";
                }
                 ?>
                 <h6>Frete:</h6>
                 <hr>
                 <h6>Total a ser pago:</h6>
              </div>
              <div class="col-md-6">
                <h6><?php echo "R$" . number_format((float)"$total",2,".","");?></h6>
                <h6 class="text-success">Grátis</h6>
                <hr>
                <h6><?php echo "R$" . number_format((float)"$total",2,".","");?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>
