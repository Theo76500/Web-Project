@extends('../layouts.master')

@section('content')

<?php

        $_POST['user'] = htmlspecialchars($_POST['user']);
        $_POST['password'] = htmlspecialchars($_POST['password']);

        $_POST['password'] = crypt($_POST['password'], '$6$rounds=5000$scdsjdcnjsdbcshbdchsb$');  ?>

<div class="container-fluid container">
    <form method="post" action="http://localhost:3000/api/users/login">
        {{ csrf_field() }}
        <div class="form-group dispnone div-form">
            <label for="user">Mail ou Pseudo</label>
            <input type="text" class="form-control text-imput" placeholder="Entrez votre mail ou pseudo" name="user" id="user" value=<?php echo $_POST['user']; ?>/>
        </div>
        <div class="form-group dispnone div-form">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control text-imput" placeholder="Entrez votre mot de passe" name="password" id="password" value=<?php echo $_POST['password']; ?>/>
        </div>
        <div class="form-group dispnone form-check div-form">
            <?php if(isset($_POST['stay_connect'])){ ?>
                <input type="checkbox" class="form-check-input" name="stay_connect" id="stay_connect" checked="checked"/> <?php
            } else { ?>
                <input type="checkbox" class="form-check-input" name="stay_connect" id="stay_connect" /> <?php
            } ?>
            <label for="stay_connect">Rester connecté</label>
        </div>
        <div class="form-group dispnone button-login">
            <button type="submit" name="login">Se connecter</button>
        </div>

        <div class="container-fluid container">
            <header class="header-body">
                <h1>En vous connectant vous aurez accès à : </h1>
            </header>
            <div class="form-group secure-login col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul>
                    <li>L'achat de produits CESI via la boutique</li>
                    <li>L'inscription aux activités organisées</li>
                    <li>la section commentaire des activités</li>
                </ul>
                <div class="secure-login-btn">
                    <a href="login" class="button-success btn-no">Retour (en tant que visiteur)</a>
                    <button class="button-success" type="submit" name="register">Valider les informations de connexion</button>
                </div>
            </div>
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
