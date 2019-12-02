@extends('../layouts.master')

@section('content')

@include('layouts.callApi')

<?php
  if (isset($infos['session']) && $infos['session'] != null) {
    $session = callApi('http://localhost:3000/api/session/'.$infos['session']);
    if ($session[0] != null) {
      $user_ID = $session[0]["USE_id"];
      $user_role = $session[0]["ROL_id"];
    }
  }
  use Illuminate\Support\Facades\Cookie;
  $value = Cookie::get('panier');
  if (isset($value)) {
    $list_product = [];
    $count = substr_count($value, "/");
    for($i = 0; $i < $count; $i++) {
      $product = str_replace('/','',substr($value,0,strpos($value,'/')));
      if (!in_array($product,$list_product) && $product != "") {
        array_push($list_product,$product);
      } else {

      }
      $value = str_replace($product.'/','',$value);
      $prix_total = 0;
    }
  }
?>

<div class="cart">
    <header class="panier-header">
      <h1>Panier</h1>
    </header>
    <div class="yellow-line"></div>
    <?php
      if(isset($value)):
        for($j = 0; $j < count($list_product); $j++):
          $data = callApi('http://localhost:3000/api/panier/'.$list_product[$j]);
          $prix_total = $data[0]['PRO_price'] + $prix_total;
    ?>
          <div class="list-product">
              <img src="/site/public/pictures/<?php echo $data[0]['PIC_name'] ?>" alt="ProductImage">
              <div class="row justify-content-between">
                  <div class="col-12 col-lg-4">
                      <h4>Nom de l'article : <?php echo $data[0]['PRO_name'] ?></h4>
                  </div>
                  <div class="col-12 col-lg-3">
                      <p class="price"><?php echo number_format($data[0]['PRO_price'], 2, '.', '')?> €</p>
                  </div>
              </div>
              <div class="row">
                  <div class="description col-md-6">
                      <p>Description : <?php echo $data[0]['PRO_description'] ?></p>
                  </div>
              </div>
              <div class="row justify-content-between">
                  <div class="col-12 col-md-3">
                    <p>Quantite : 1</p>
                  </div>
                  <div class="col-12 col-md-3">
                      <button class="cancel-button">Supprimer</button>
                  </div>
              </div>
          </div>
  <?php endfor; ?>
  <div class="total-price-container">
    <p>Prix total de votre panier : <?= $prix_total; ?> €</p>
  </div>
  <div class="bouton-container">
    <form>
      <button type="submit" class="commander" >Commander</button>
    </form>
  </div>
  <?php else: ?>
    <div class="empty-page">
        <p class="empty-cart">
            Votre panier est vide
        </p>
    </div>
  <?php endif; ?>
</div>

@endsection('content')
