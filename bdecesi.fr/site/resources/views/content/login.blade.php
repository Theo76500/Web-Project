@extends('layouts.master')

@section('content')

<header class="header-body">
    <h1>CONNEXION</h1>
</header>
<div class="container-fluid container">
    <form action="connexionScript.php" method="post">
        <div class="form-group div-form">
            <label for="user">Mail ou Pseudo</label>
            <input type="text" class="form-control text-imput" placeholder="Entrez votre mail ou pseudo" name="user" id="user" />
        </div>
        <div class="form-group div-form">
            <label for="password">Mot de passe</label>
            <input type="text" class="form-control text-imput" placeholder="Entrez votre mot de passe" name="password" id="password" />
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

@endsection('content')
