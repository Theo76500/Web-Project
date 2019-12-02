@extends('../layouts.master')

@section('content')

@include('layouts.callApi')

<?php
  if (isset($_POST["search"])) {
    $wanted = htmlspecialchars($_POST["search"]);
  } else {
    $wanted = "rien";
  }
  if (isset($_POST['prix-result'])) {
    $prix = htmlspecialchars($_POST['prix-result']);
  } else {
    $prix = "croissant";
  }
  if (isset($_POST['date-result'])) {
    $date = htmlspecialchars($_POST['date-result']);
  } else {
    $date = "recent";
  }
  if (isset($_POST['number-result'])) {
    $limit = htmlspecialchars($_POST['number-result']);
  } else {
    $limit = "10";
  }
  if (isset($_POST['zone-result'])) {
    $zone = htmlspecialchars($_POST['zone-result']);
  } else {
    $zone = "activite";
  }
  if (isset($_POST['category-result'])) {
    $category = htmlspecialchars($_POST['category-result']);
  } else {
    $category = "all";
  }

  $data = callApi('http://localhost:3000/api/result/'.$wanted.'/'.$zone.'/'.$limit.'/'.$date.'/'.$prix.'/'.$category);
  ?>

<main class="result-main">
  <header class="result-header">
    <h1 class="result-h1">Résultat de la recherche pour : "<?= $wanted ?>"</h1>
  </header>
  <aside class="result-aside">
    <h2 class="result-h2">Affiner vos recherches</h2>
    <form method="post" action="result" id="form" accept-charset="utf-8">
      @csrf
      <div class="result-form-container">
        <div class="row">
          <div class="form-group result-form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="prix">
            <label class="result-label">Par prix : </label>
            <select class="form-control result-select" name="prix-result" id="prix-result">
              <option value="croissant" <?php if($prix == "croissant"){echo "selected='selected'";} ?>>Prix croissant</option>
              <option value="decroissant" <?php if($prix == "decroissant"){echo "selected='selected'";} ?>>Prix décroissant</option>
            </select>
          </div>
          <div class="form-group result-form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="date">
            <label class="result-label">Par date : </label>
            <select class="form-control result-select" name="date-result" id="date-result">
              <option value="recent" <?php if($date == "recent"){echo "selected='selected'";} ?>>Les plus récents </option>
              <option value="ancien" <?php if($date == "ancien"){echo "selected='selected'";} ?>>Les plus anciens </option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group result-form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="number">
            <label class="result-label">Nombre de résultats sur la page : </label>
            <select class="form-control result-select" name="number-result" id="number-result" >
              <option value="10" <?php if($limit == 10){echo "selected='selected'";} ?>>10</option>
              <option value="15" <?php if($limit == 15){echo "selected='selected'";} ?>>15</option>
              <option value="20" <?php if($limit == 20){echo "selected='selected'";} ?>>20</option>
              <option value="30" <?php if($limit == 30){echo "selected='selected'";} ?>>30</option>
              <option value="40" <?php if($limit == 40){echo "selected='selected'";} ?>>40</option>
            </select>
          </div>
          <div class="form-group result-form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="zone">
            <label class="result-label">Zone de recherche : </label>
            <select class="form-control result-select" name="zone-result" id="zone-result">
              <option value="activite" <?php if($zone == "activite"){echo "selected='selected'";} ?>>Activités</option>
              <option value="boutique" <?php if($zone == "boutique"){echo "selected='selected'";} ?>>Boutique</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group result-form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="category">
            <label class="result-label">Préciser une catégorie : </label><br>
            <input type="radio" name="category-result" value="all" <?php if($category == "all") {echo 'checked';} ?>/> Tous<br>
            <input type="radio" name="category-result" value="vetement" <?php if($category == "vetement") {echo 'checked';} ?>/> Vêtements<br>
            <input type="radio" name="category-result" value="goodie" <?php if($category == "goodie") {echo 'checked';} ?>/> Goodies<br>
          </div>
          <div class="form-group result-form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="search">
            <label class="result-label" for="search-input">Rechercher avec un filtre : </label>
            <input type="text" class="form-control" name="search" value="<?= $_POST["search"]?>" id="search-input"/>
          </div>
        </div>
        <div class="form-group result-form-group" id="button-container">
          <button class="result-bottom" id="search-button" type="submit">Valider</button>
        </div>
      </div>
    </form>
  </aside>
  <div class="result-container">
    <div>
      <?php if(!isset($data[0])) {?>
        <div class="result-item">
          <p>Aucun résultat trouvé...</p>
        </div>
      <?php }
       if ($zone == "activite") {
       ?>
      <?php for ($i = 0; $i < count($data); $i++) { ?>
        <div class="result-item">
          <a class="result-item-link" href="/activity/<?php echo $data[$i]['ACT_id'] ?>">
            <div class="result-div-img">
              <img class="result-img" src="/site/public/pictures/<?php echo $data[$i]['PIC_name'] ?>" alt="event">
            </div>
            <div class="result-body-item">
              <div class="result-title">
                <?= $data[$i]['ACT_name'] ?>
              </div>
              <div class="result-description">
                <?= $data[$i]['ACT_description'] ?>
              </div>
              <div class="result-prix">
                <?= $data[$i]['ACT_price']?> €
              </div>
              <div class="result-date">
                <?= $data[$i]['ACT_date'] ?>
              </div>
            </div>
          </a>
        </div>
      <?php }} else { ?>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
          <div class="result-item">
            <a class="result-item-link" href="/shop">
              <div class="result-div-img">
                <img class="result-img" src="/site/public/pictures/<?php echo $data[$i]['PIC_name'] ?>" alt="event">
              </div>
              <div class="result-body-item">
                <div class="result-title">
                  <?= $data[$i]['PRO_name'] ?>
                </div>
                <div class="result-description">
                  <?= $data[$i]['PRO_description'] ?>
                </div>
                <div class="result-prix">
                  <?= $data[$i]['PRO_price'] ?> €
                </div>
                <div class="result-date">
                  <?= $data[$i]['PRO_updated_at'] ?>
                </div>
              </div>
            </a>
          </div>
      <?php }} ?>
    </div>
  </div>
</main>

@endsection('content')
