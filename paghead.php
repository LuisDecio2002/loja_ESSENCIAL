<header>
  <div id="header">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="mr-auto"></div>
    <div class="navbar-nav">
      <a href="cart.php" class="nav-item nav-link active">
        <h5 class="px-5 cart">
          <i class="fas fa-shopping-cart">Carrinho</i>
          <?php
          if(isset($_SESSION['cart'])){
            $count = count($_SESSION['cart']);
            echo "<span id=\"cart-count\" class=\"text-warning\">$count</span>";
          }else{
            echo "<span id=\"cart-count\" class=\"text-warning\">0</span>";
          }
          ?>
        </h5>
      </a>
    </div>
  </div>
</nav>
</header>
