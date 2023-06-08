<?php

session_start();

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
$sql = "SELECT produto, preco, imagem FROM $table WHERE promocao='1'";
if(!($produtos_set = mysqli_query($conn,$sql))){
  die("Problemas para carregar os produtos do BD!<br>".
       mysqli_error($conn));
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Loja Virtual ESSENCIAL</title>
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

     <div id="conteudos">
      <div class="conteudo">

      <div>

      <h2>ESSENCIAL</h2>

      <div id="empresa-imagem">
        <img src="img/loja.jpg">
      </div><BR>

      <p id="empresa-historia">

A ESSENCIAL teve seu início em 1922, com o começo das atividades fabris do então Grupo A. J., e desvinculou-se do grupo fundado pelo gaúcho Antônio Jacob somente em 1965, quando suas lojas começaram a tomar um formato mais próximo do atual.
<br><br>
Em 2017, a empresa criou a subsidiária incorporada Realize Soluções Financeiras, passando a oferecer serviços de crédito, seguros e assistências aos seus clientes.
<br><br>
Em 2010, outro marco na história da empresa foi o lançamento do e-commerce. Já em 2011, a ESSENCIAL adquiriu a Camicado, uma empresa no segmento de casa e decoração que hoje já está presente em todo o país com mais de 110 lojas. Em 2013, lançou a Youcom, um novo modelo de negócio para o público jovem em um ambiente de loja especializada, e conta com 98 lojas no Brasil. Em 2016, a Renner lançou a Ashua, uma marca de moda plus size, que já possui 8 lojas pelo país. Em 2017, constitui-se a Realize CFI, instituição financeira.
<br><br>
Em 2017, a ESSENCIAL deu mais um passo importante ao inaugurar sua primeira operação no exterior. Hoje são 9 lojas no Uruguai e, em 2019, foram inauguradas 4 lojas na Argentina. Ao todo, a Lojas S.A. conta com 600 lojas em operação.

      </p>
</div>

</div>
    </div>
</main>

<?php include "footer.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>
