<?php
require "db_functions.php";
require "authenticate.php";

$error = false;
$success = false;
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {

    $conn = connect_db();

    $name = mysqli_real_escape_string($conn,$_POST["name"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn,$_POST["confirm_password"]);

    if ($password == $confirm_password) {
      $password = md5($password);

      $sql = "SELECT email from $table_users where email = '$email'";

      $resultado = mysqli_query($conn, $sql);
      
      if(mysqli_num_rows($resultado) != 0) {
        $error_msg = "E-mail já cadastrado.";
        $error = true;
      }
      else {
            $sql = "INSERT INTO $table_users
            (name, email, password) VALUES
            ('$name', '$email', '$password');";

            if(mysqli_query($conn, $sql)){
              $success = true;
            }
            else {
              $error_msg = mysqli_error($conn);
              $error = true;
            }
      }
    }
    else {
      $error_msg = "A senha não confere com a confirmação.";
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
  <title>Registro / Login ESSENCIAL</title>
</head>
<body>

    <?php include "header.php"?>

  <div id="container">
    <div id="login">

<h1>Digite seus dados para registrar-se:</h1>
<br>
<?php if ($success): ?>
  <h3 style="color:lightgreen;">Usuário criado com sucesso!</h3>
  <p>
    Seguir para <a href="login.php">login</a>.
  </p>
<?php endif; ?>

<?php if ($error): ?>
  <h3 style="color:red;"><?php echo $error_msg; ?></h3>
<?php endif; ?>

<form action="register.php" method="post">

<div class="form-group">
  <label for="name">Digite seu nome: </label>
  <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required><br>
</div>

<div class="form-group">
  <label for="email">Digite seu Email: </label>
  <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" required><br>
</div>

<div class="form-group">
  <label for="password">Digite sua Senha: </label>
  <input type="password" class="form-control" name="password" value="" required><br>
</div>

<div class="form-group">
  <label for="confirm_password">Confirme a senha digitada acima: </label>
  <input type="password" class="form-control" name="confirm_password" value="" required><br>
</div>

  <input type="submit"  class="btn btn-dark" name="submit" value="Cadastrar-se">
</form>

<ul>
  <li><a href="index.php">Voltar</a></li>
</ul>
</p>

</div>

  <div id="login-imagem"><br><br><br><br>
    <img src="img/login.png">
  </div>
</div>

</p>
  <?php include "footer.php"; ?>
</body>
</html>
