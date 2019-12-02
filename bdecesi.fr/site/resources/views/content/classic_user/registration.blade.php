@extends('../layouts.master')

@section('content')

@include('layouts.callApi')

<!-- The container when your registration is success --> 
<?php 
    if(isset($_GET['success']) && $_GET['success'] == 'true'){ ?>

<header class="header-body">
    <h1>COMPTE CRÉÉ !</h1>
</header>
<div class="container-fluid container">
    <p>N'hésitez pas à vous connecter dès à présent !</p>
    <a href="login" class="button-success">Me connecter maintenant !</a>
</div>
<footer class="footer-body">
    <ul class="ul-body">
        <li class="li-body"><a href="/">Retour à l'accueil</a></li>
    </ul>
</footer>

<!-- The container when your registration is fail --> 
<?php
    } elseif(isset($_GET['success']) && $_GET['success'] == 'false') {?>
        <header class="header-body">
            <h1>VOTRE COMPTE N'A PAS PU ÊTRE CRÉÉ !</h1>
        </header>
        <div class="container-fluid container">
            <p>Raison : <?php if(isset($_GET['twins']) && $_GET['twins'] == 'username'){ 
                echo 'Pseudo déjà pris !'; 
            } elseif(isset($_GET['twins']) && $_GET['twins'] == 'email') {
                echo 'Email déjà pris !';
            } elseif(isset($_GET['twins']) && $_GET['twins'] == 'password') {
                echo 'Mot de passe déjà pris !';
            } ?> </p>
            <a href="registration" class="button-success">Recommencer une procédure d'inscription</a>
        </div>
        <footer class="footer-body">
            <ul class="ul-body">
                <li class="li-body"><a href="/">Retour à l'accueil</a></li>
            </ul>
        </footer>

        <?php
    } else { ?>

<header class="header-body">
    <h1>INSCRIPTION</h1>
</header>
<form method="post" action="registration">
    @csrf
    <!-- The container for the registration -->
    <div class="container-fluid row">
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Mail</label>
            <input type="email" class="form-control text-input email" placeholder="Entrez votre mail" name="email" />
            <small class="small-email"></small>
        </div>
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Pseudo</label>
            <input type="text" class="form-control text-input pseudo" placeholder="Entrez votre pseudo" name="username" />
            <small class="small-pseudo">Note : Il est préférable que votre pseudo soit de la forme "nom.prenom" ou sous tout autre forme qui permetrait de vous identifier</small>
        </div>
    </div>
    <div class="container-fluid row">
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Mot de passe</label>
            <input type="password" class="form-control text-input password" placeholder="Entrez votre mot de passe" name="password" />
            <small class="small-password"></small>
        </div>
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Confirmation du mot de passe</label>
            <input type="password" class="form-control text-input password_confirm" placeholder="Entrez à nouveau votre mot de passe" name="password_confirm" />
            <small class="small-password_confirm"></small>
        </div>
    </div>
    <div class="container-fluid row">
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Campus</label>
            <select class="form-control campus" name="campus">
                <option>Selectionnez un campus</option>
                <optgroup label="Hauts de France">
                    <option value="1">Lille</option>
                    <option value="2">Arras</option>
                <optgroup label="Normandie">
                    <option value="3">Rouen</option>
                    <option value="4">Caen</option>
                <optgroup label="Grand Est">
                    <option value="6">Reims</option>
                    <option value="9">Nancy</option>
                    <option value="10">Strasbourg</option>
                <optgroup label="Ile de France">
                    <option value="8">Paris-Nanterre</option>
                <optgroup label="Bretagne">
                    <option value="7">Brest</option>
                <optgroup label="Pays de la Loire">
                    <option value="11">Le Mans</option>
                    <option value="12">Saint-Nazaire</option>
                    <option value="14">Nantes</option>
                <optgroup label="Centre Val de Loire">
                    <option value="13">Orléans</option>
                    <option value="15">Châteauroux</option>
                <optgroup label="Bourgogne Franche Compté">
                    <option value="16">Dijon</option>
                <optgroup label="Nouvelle Acquitaine">
                    <option value="17">La Rochelle</option>
                    <option value="24">Pau</option>
                    <option value="18">Angoulême</option>
                    <option value="21">Bordeaux</option>
                <optgroup label="Auvergne Rhône Alpes">
                    <option value="19">Lyon</option>
                    <option value="20">Grenoble</option>
                <optgroup label="Occitanie">
                    <option value="22">Toulouse</option>
                    <option value="23">Montpellier</option>
                <optgroup label="Provence Alpes Côte d'Azur">
                    <option value="5">Nice</option>
                    <option value="25">Aix-en-Provence</option>
            </select>
            <small class="small-select"></small>
        </div>
        <div class="form-group button-submit col-lg-6 col-md-6 col-sm-12 col-xs-12 button-register">
            <button type="submit" name="register">S'inscrire</button>
        </div>
    </div>
</form>
<footer class="footer-body">
    <a href="login">J'ai déjà un compte ?</a>
</footer> <?php
    }
?>

@endsection('content')
