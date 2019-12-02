@extends('layouts.master')

@section('content')

<div class="container">

    <div class="cart">
        <h3>Panier</h3>
        <div class="yellow-line"></div>
        <?php if (1==1) :?>
        <div class="list-product">
            <img src="img/imgTest.png" alt="ProductImage">
            <div class="row justify-content-between">
                <div class="col-12 col-lg-4">
                    <h4>Nom de l'article</h4>
                </div>
                <div class="col-12 col-lg-3">
                    <p class="price">Prix : X,xx€</p>
                </div>
            </div>
            <div class="row">
                <div class="description col-md-6">
                    Description : <br>
                    Bla bla bla bla bla bla bla bla bla <br> bla bla bla bla bla bla bla bla bla bla
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-12 col-md-3">
                    <select name="numberOfProduc" id="numberOfProduc">
                        <?php for ($i = 0; $i <= 10; $i++) :?>
                        <option value="<?= $i ?>"><?=$i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <button class="cancel-button">Supprimer</button>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="empty-page">
            <p class="empty-cart">
                Votre panier est vide
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>

@endsection('content')
