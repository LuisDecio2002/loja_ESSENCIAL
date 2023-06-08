<?php

require 'iniciaSessao.php';

require 'sanitize.php';
require 'db_credentials.php';
require_once ('./component.php');
require_once ('./criaDB_roupas.php');

$database = new criaDB($dbname,$table,$servername,$username,$password);

if(isset($_POST['Add'])){
  if(isset($_SESSION['cart'])){
    $item_array_id = array_column($_SESSION['cart'],"prodid");

    if(in_array($_POST['prodid'],$item_array_id)){
      echo "<script>alert(\"*O item já se encontra no carrinho!\")</script>";
      echo "<script>window.location = 'index.php'</script>";
    }else{
      $count = count($_SESSION['cart']);
      $item_array = array('prodid' => $_POST['prodid']);
      $_SESSION['cart'][$count] = $item_array;
      // print_r($_SESSION['cart']);
    }
  }else{
    $item_array = array('prodid' => $_POST['prodid']);
    $_SESSION['cart'][0] = $item_array;
  }
}

$conn = mysqli_connect($servername,$username,$password,$dbname);
  if (!$conn){
    die("Problemas ao conectar com o BD!<br>".
         mysqli_connect_error());
}
$sql = "SELECT id, produto, categoria, preco, imagem, promocao FROM $table WHERE categoria = 'masculino'";
if(!($produtos_set = mysqli_query($conn,$sql))){
  die("Problemas para carregar os produtos do BD!<br>".
       mysqli_error($conn));
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Loja ESSENCIAL masculino</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" href="css/pagamento.css" media="screen">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <?php include "header.php"?>
</head>
<body class="bg-light">
  <main>
    <?php require_once ("paghead.php"); ?>
    <div id="propaganda-img">
      <img width="100%" id="propaganda-img-roupa" src="img/propaganda.png">
    </div>
      <div class="container">
        <div class="row text-center py-5">

        <?php
         $result = $database->getData($sql);
         while($row = mysqli_fetch_assoc($result)){
           component($row['imagem'], $row['produto'], $row['preco'], $row['id']);
         }
        ?>

    </div>
  </div>
      <div class="conteudo" id="conteudo-outros">
        <div class="caixa-conteudo">
          <a href="masculino.php"><img src="img/promocao1.jpg" alt="promoção 1"></a>
        </div>
        <div class="caixa-conteudo">
          <a href="masculino.php"><img src="img/promocao2.jpg" alt="promoção 2"></a>
        </div>
        <div class="caixa-conteudo">
          <a href="feminino.php"><img src="img/promocao3.jpg" alt="promoção 3"></a>
        </div>
      </div>
  </div>
</div>
</main>

<?php include "footer.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>
