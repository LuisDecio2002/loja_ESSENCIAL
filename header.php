
<header>
  <div id="topo">
    <div id="topo-logo">
      <h1>ESSENCIAL</h1>
    </div>
    <div id="topo-login">
        <a href="indexLogin.php">
          <?php if(isset($_SESSION["user_name"])){
            echo "<button type='button' value='Entre ou Cadastre-se' id='login'>" . $_SESSION["user_name"] . "</button>";
          }else{
            echo "<button type='button' value='Entre ou Cadastre-se' id='login'>Entre ou Cadastre-se</button>";
          }?>
        </a>
    </div>
  </div>
  <div id="menu">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="empresa.php">Empresa</a></li>
      <li><a href="index.php">Produtos</a></li>
      <li><a href="contato.php">Contato</a></li>
    </ul>
  </div>
</header>
