<?php
require "db_functions.php";
require "authenticate.php";

$error = false;
$password = $email = "";

if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["email"]) && isset($_POST["password"])) {

    $conn = connect_db();

    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $password = md5($password);

    $sql = "SELECT id,name,email,password FROM $table_users
            WHERE email = '$email';";

    $result = mysqli_query($conn, $sql);
    if($result){
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user["password"] == $password) {

          $_SESSION["user_id"] = $user["id"];
          $_SESSION["user_name"] = $user["name"];
          $_SESSION["user_email"] = $user["email"];

          header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");
          exit();
        }
        else {
          $error_msg = "Senha incorreta!";
          $error = true;
        }
      }
      else{
        $error_msg = "Usuário não encontrado!";
        $error = true;
      }
    }
    else {
      $error_msg = mysqli_error($conn);
      $error = true;
    }
  }
  else {
    $error_msg = "Por favor, preencha todos os dados.";
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include "Head.php"; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <meta charset="utf-8">
  <title>Login ou Cadastro ESSENCIAL</title>
</head>
<body>

  <?php include "header.php"?>

  <div id="container">
    <div id="login">

<br><br>
<h1>Bem-vindo
  <?php
    if ($login) {
      echo ", $user_name!";
    }
    else {
      echo "!";
    }
  ?>
</h1>
<br>
<p>
  Escolha uma das opções:
</p>
<ul>
  <?php if ($login): ?>
    <li><a href="logout.php"><button type="button" class="btn btn-dark">Logout</button></a></li>
  <?php else: ?>
    <li><a href="login.php"><button type="button" class="btn btn-dark">Login</button></a></li>
    <li><a href="register.php"><button type="button" class="btn btn-dark">Registrar-se</button></a></li>
  <?php endif; ?>
</ul>
</p>





</div>

  <div id="login-imagem">
        <img src="img/login.png">
      </div>
  </div>
<br><br>
</p>
  <?php include "footer.php"; ?>
</body>
</html>
