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

    $data = callApi('http://localhost:3000/api/activities');

?>

<!-- The carousel with the 5 best activities -->
<div class="container_carousel1">
    <div class="title col-lg-12 col-md-11">Nos actualités les plus appréciées !</div>
    <div id="carousel1">
        <!-- The loop to display the 5 best activities-->
        <?php for ($i=0; $i<5; $i++):?>
                    <a class="link-item" href="activity/<?= $data[$i]['ACT_id']; ?>">
                    <div class="item">
                            <div class="item__image">
                                <img src="/site/public/pictures/<?= $data[$i]['PIC_name']?>" alt="event">
                            </div>
                            <div class="item__body">
                                <div class="item__title">
                                <?= $data[$i]['ACT_name']?>
                                </div>
                                <div class="item__description">
                                <?= $data[$i]['ACT_description']?>
                                </div>
                            </div>
                        </div>
        <?php endfor;?>
            </a>

    </div>
</div>

<!-- The container where are all the activities -->
<div class="container site">
    <div class="title-event">ÉVÉNEMENTS</div>
    <div class="title-divider"></div>

    <nav>
        <ul class="nav nav-pills">
        </ul>
    </nav>
    <div class="tab-content">
        <div class="row">
            
            <!-- The loop to display all the activities -->
           <?php for ($i=0; $i<count($data); $i++){ ?>

                   <div class="col-sm-6 col-md-4 block" >
                        <div class="card">
                            <img src="/site/public/pictures/<?= $data[$i]['PIC_name']?>" alt="event">
                            <div class="price"><?= number_format($data[$i]['ACT_price'], 2, '.', '')?> €</div>
                            <div class="caption">
                                <div class="divider"></div>
                                <h4><?= $data[$i]['ACT_name']?></h4>
                                <p><?= $data[$i]['ACT_description']?></p>
                                <p><?= $data[$i]['ACT_date_h']?></p>
                                <a href="activity/<?= $data[$i]['ACT_id']?>" class="btn btn-order" role="button"> VOIR PLUS</a>
                            </div>
                        </div>
                    </div> <?php
                }

        ?>

        </div>
    </div>
</div>

@endsection('content')