@extends('layouts.master')

@section('content')

<header class="header-body">
    <h1>INSCRIPTION</h1>
</header>
<div class="container-fluid row">
    <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label>Mail</label>
        <input type="text" class="form-control text-imput" placeholder="Entrez votre mail" name="mail" />
    </div>
    <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label>Pseudo</label>
        <input type="text" class="form-control text-imput" placeholder="Entrez votre pseudo" name="username" />
    </div>
</div>
<div class="container-fluid row">
    <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label>Mot de passe</label>
        <input type="text" class="form-control text-imput" placeholder="Entrez votre mot de passe" name="password" />
    </div>
    <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label>Confirmation du mot de passe</label>
        <input type="text" class="form-control text-imput" placeholder="Entrez à nouveau votre mot de passe" name="password_confirm" />
    </div>
</div>
<div class="container-fluid row">
    <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label>Campus</label>
        <!-- A FAIRE AVEC PHP ET LA BDD -->
        <select class="form-control" name="campus">
            <option value="Rouen">Rouen</option>
            <option value="Nanterre">Nanterre</option>
        </select>
    </div>
    <div class="form-group button-submit col-lg-6 col-md-6 col-sm-12 col-xs-12 button-register">
        <button type="submit" name="register">S'inscrire</button>
    </div>
</div>
<footer class="footer-body">
    <a href="login">J'ai déjà un compte ?</a>
</footer>

@endsection('content')

