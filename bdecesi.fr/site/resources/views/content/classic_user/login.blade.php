@extends('../layouts.master')

@section('content')

<?php
    if(isset($_GET['success']) && $_GET['success'] == 'true'){ ?>

<header class="header-body">
    <h1>CONNEXION RÉUSSIE !</h1>
</header>
<!-- The container when your connection is success -->
<div class="container-fluid container">
    <p>Votre naviguez désormais en tant que membre CESI !</p>
    <a href="/" class="button-success">Jeter un oeil aux événements</a>
    <a href="/shop" class="button-success">Visiter la boutique</a>
</div>
<footer class="footer-body">
    <ul class="ul-body">
        <li class="li-body"><a href="/">Retour à l'accueil</a></li>
    </ul>
</footer>

<?php

    } elseif (isset($_GET['success']) && $_GET['success'] == 'false'){ ?>
        <header class="header-body">
            <h1>CONNEXION ÉCHOUÉE !</h1>
        </header>
        <!-- The container when your connection is fail -->
        <div class="container-fluid container">
            <p>Identifiant ou mot de passe incorrect !</p>
            <a href="login" class="button-success">Retour à la connexion</a>
        </div>
        <footer class="footer-body">
            <ul class="ul-body">
                <li class="li-body"><a href="/">Retour à l'accueil</a></li>
            </ul>
        </footer>

<?php

    } else { ?>

<header class="header-body">
    <h1>CONNEXION</h1>
</header>*
<!-- The container for the connection -->
<div class="container-fluid container">
    <form method="post" action="login">
        {{ csrf_field() }}
        <div class="form-group div-form">
            <label for="user">Mail ou Pseudo</label>
            <input type="text" class="form-control text-imput" placeholder="Entrez votre mail ou pseudo" name="user" id="user" />
        </div>
        <div class="form-group div-form">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control text-imput" placeholder="Entrez votre mot de passe" name="password" id="password" />
        </div>
        <div class="form-group form-check div-form">
            <input type="checkbox" class="form-check-input" name="stay_connect" id="stay_connect" />
            <label for="stay_connect">Rester connecté</label>
        </div>
        <div class="form-group button-login">
            <button type="submit" name="login">Se connecter</button>
        </div>
    </form>
</div>
<footer class="footer-body">
    <ul class="ul-body">
        <li class="li-body"><a href="#">Mot de passe oublié ?</a></li>
        <li class="li-body"><a href="registration">Pas encore inscrit ?</a></li>
    </ul>
</footer>

<?php
}?>

@endsection('content')