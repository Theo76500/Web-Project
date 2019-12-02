<?php 
if (isset($infos['session']) && $infos['session'] != null) {
  $session = callApi('http://localhost:3000/api/session/' . $infos['session']);
  if ($session[0] != null) {
    $user_ID = $session[0]["USE_id"];
    $user_role = $session[0]["ROL_id"];
  }
}
?>
<nav class="navbar navbar-expand-md">
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="/">

    <img src="/site/public/pictures/image_bde.png" class="collapse navbar-collapse navbar-brand navbar-img" alt="bde_img" />

    </a>
    <form class="offset-lg-2 offset-md-2 offset-sm-3 offset-xs-3 navbar-form navbar-left" action="/result" method="post">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control search-bar" name="search" placeholder="Search.." />
            <input type="text" class="form-control search-bar2" />
            <input src="/site/public/pictures/loupe.png" type="image" name="searchSubmit" class="btn btn-default search-button submit-img" alt="loupe" />
        </div>
    </form>
    <div class="collapse navbar-collapse" id="main-navigation">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/shop">Boutique</a>
            </li>
            <li class="nav-item">
                <?php if (isset($user_ID)) {
                    $data = callApi('http://localhost:3000/api/' . $user_ID . '/profile'); ?>
                <a class="nav-link" href="/<?php echo $user_ID; ?>/profile">
                    <span>
                        <img class="img_home" src="/site/public/pictures/<?php echo $data[0]['PIC_name']; ?>" alt="home" />
                    </span>
                Mon compte</a>
                <?php } else { ?>
                <a class="nav-link" href="/login">Connexion</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>