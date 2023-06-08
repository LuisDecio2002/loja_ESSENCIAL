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
  <title>Login ESSENCIAL</title>
</head>
<body>

  <?php include "header.php"?>

  <div id="container">
    <div id="login">
      <h1>Login:</h1><br>

      <?php if ($login): ?>
        <h3>Você já está logado!</h3>
      </body>
      </html>
      <?php exit(); ?>
      <?php endif; ?>

      <?php if ($error): ?>
        <h3 style="color:red;"><?php echo $error_msg; ?></h3>
      <?php endif; ?>

      <form action="login.php" method="post">

      <div class="form-group">
        <label for="email">Email: </label>
        <input type="text" name="email"  class="form-control" value="<?php echo $email; ?>" required>
      </div>
<br>
      <div class="form-group">
        <label for="password">Senha: </label>
        <input type="password" name="password"  class="form-control" value="" required>
      </div>
<br>
        <input type="submit" class="btn btn-dark" name="submit" value="Entrar">

      </form>

      <ul>
        <li><a href="indexLogin.php">Voltar</a></li>
      </ul>
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
