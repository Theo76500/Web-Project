@extends('../layouts.master')

@section('content')

@include('layouts.callApi')


        <?php
        $_POST['password'] = htmlspecialchars($_POST['password']);
        $_POST['password_confirm'] = htmlspecialchars($_POST['password_confirm']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['username'] = htmlspecialchars($_POST['username']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['campus'] = htmlspecialchars($_POST['campus']);

        $_POST['password'] = crypt($_POST['password'], '$6$rounds=5000$scdsjdcnjsdbcshbdchsb$'); 
        $_POST['password_confirm'] = crypt($_POST['password_confirm'], '$6$rounds=5000$scdsjdcnjsdbcshbdchsb$'); ?>

        <form method="post" action="http://localhost:3000/api/users/register">
        	@csrf
    {{ csrf_field() }}
    <div class="container-fluid row dispnone">
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Mail</label>
            <input type="text" class="form-control text-imput" placeholder="Entrez votre mail" name="email" value=<?php echo $_POST['email']; ?>/>
        </div>
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Pseudo</label>
            <input type="text" class="form-control text-imput" placeholder="Entrez votre pseudo" name="username" value=<?php echo $_POST['username']; ?>/>
        </div>
    </div>
    <div class="container-fluid row dispnone">
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Mot de passe</label>
            <input type="password" class="form-control text-imput" placeholder="Entrez votre mot de passe" name="password" value=<?php echo $_POST['password']; ?>/>
        </div>
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Confirmation du mot de passe</label>
            <input type="password" class="form-control text-imput" placeholder="Entrez à nouveau votre mot de passe" name="password_confirm" value=<?php echo $_POST['password_confirm']; ?>/>
        </div>
    </div>
    <div class="container-fluid row dispnone">
        <div class="form-group div-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Campus</label>
            <select class="form-control" name="campus">
                <option><?php echo $_POST['campus']; ?></option>
            </select>
        </div>
    </div>
    <div class="container-fluid container">
        <header class="header-body">
            <h1>Êtes vous sûr d'avoir entré les bonnes informations ?</h1>
        </header>
        <div class="row">
            <div class="form-group button-submit col-lg-6 col-md-6 col-sm-12 col-xs-12 button-register">
                <a href="registration" class="button-success">Non, retour</a>
                <button class="button-success btn-submit" type="submit" name="register">Oui, je m'inscris</button>
            </div>
        </div>
     </div>
</form>
<footer class="footer-body">
    <a href="login">J'ai déjà un compte ?</a>
</footer>

@endsection('content')