@extends('../layouts.master')

@section('content')

@include('layouts.callApi')

<?php
  $data = callApi('http://localhost:3000/api/products');
  if (isset($infos['session']) && $infos['session'] != null) {
    $session = callApi('http://localhost:3000/api/session/'.$infos['session']);
    if ($session[0] != null) {
      $user_ID = $session[0]["USE_id"];
      $user_role = $session[0]["ROL_id"];
    }
  }
?>

<?php

        $data = callApi('http://localhost:3000/api/products_best');

   ?>

<!-- The carousel with the 3 best products -->
<div class="container_carousel2">
    <div class="title col-lg-12 col-md-11">Les 3 produits les plus vendus</div>
    <div id="carousel2">

        <!-- The loop to display the 3 best products-->
        <?php for ($i=0; $i<3; $i++):?>
                    <div class="item">
                            <div class="item__image">
                                <img src="/site/public/pictures/<?= $data[$i]['PIC_name']?>" alt="event">
                            </div>
                            <div class="item__body">
                                <div class="item__title">
                                <?= $data[$i]['PRO_name']?>
                                </div>
                                <div class="item__description">
                                <?= $data[$i]['PRO_description']?>
                                </div>
                            </div>
                        </div>
        <?php endfor;?>

    </div>
</div>

<!-- The container where are all the products -->
<div class="container site">
  <div class="title">BOUTIQUE</div>
    <div class="title-divider"></div>
    <nav>
      <ul class="nav nav-pills"></ul>
    </nav>
    <div class="tab-content">
      <div class="row">
        <!-- The loop to display all the products -->
        <?php for ($i = 0; $i < count($data); $i++): ?>
          <div class="col-sm-6 col-md-4 block">
            <div class="card">
              <img src="/site/public/pictures/<?php echo $data[$i]['PIC_name'] ?>">
                <div class="price"><?php echo number_format($data[$i]['PRO_price'], 2, '.', '')?> €</div>
                <div class="caption">
                  <div class="divider"></div>
                  <h4><?php echo $data[$i]['PRO_name'] ?></h4>
                  <p><?php echo $data[$i]['PRO_description'] ?></p>
                  <?php if(isset($user_ID)):?>
                  <a href="/addCommand/<?= $data[$i]['PRO_name']?>" class="btn btn-order" role="button">🛒 COMMANDER</a>
                  <?php else: ?>
                  <a href="/login" class="btn btn-order" role="button">🛒 COMMANDER</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>

@endsection('content')