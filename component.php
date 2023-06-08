<?php
function component($img_address,$prodnome,$prodprice,$prodid){
  $element = "
  <div class=\"col-md-3 col-sm-6 mt-3 my-md-0\">
    <form class=\"form-horizontal\" method=\"POST\" action='index.php'>
      <div class=\"card shadow\">
        <div>
          <img src=\"$img_address\" alt=\"imagem do produto\" class=\"img-fluid card-img-top\">
        </div>
        <div class=\"card-body\">
          <h5 class=\"card-title\">$prodnome</h5>
          <h5><strong><span class=\"price\">R$ $prodprice</span></strong></h5>
          <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"Add\">Adicionar ao carrinho<i class=\"fas fa-shopping-cart\"></i></button>
          <input type=\"hidden\" name=\"prodid\" value=\"$prodid\">
        </div>
      </div>
    </form>
  </div>";
  echo $element;
}

function cartElement($img_address,$prodnome,$prodprice,$prodcat,$prodid){
  $element = "
  <form class=\"cart-itens\" action=\"cart.php?action=remove&id=$prodid\" method=\"POST\">
    <div class=\"border rounded\">
      <div class=\"row bg-white\">
        <div class=\"col-md-5 pl-0\">
          <img src=\"$img_address\" alt=\"imagem do produto\" class=\"img-fluid\">
        </div>
        <div class=\"col-md-6\">
          <h5 class=\"pt-5\">$prodnome</h5>
          <small class=\"text-secondary\">$prodcat</small>
          <h5 class=\"pt-2\">R$ $prodprice</h5>
          <button type=\"submit\" class=\"btn btn-warning\" name=\"Reservar\">Reservar produto</button>
          <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remover</button>
        </div>
      </div>
    </div>
  </form>";
  echo $element;
}

?>
