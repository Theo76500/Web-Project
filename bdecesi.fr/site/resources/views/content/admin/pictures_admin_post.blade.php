@extends('layouts.master')

@section('content')

@include('layouts.callApi')

<?php

if (isset($infos['session']) && $infos['session'] != null) {
    $session = callApi('http://localhost:3000/api/session/'.$infos['session']);
    if ($infos['session'][0] != null){
        $user_ID = $session[0]["USE_id"];
        $user_role = $session[0]["ROL_id"];
    }
 }

if(isset($user_role) && $user_role == 3){
    if (isset($_FILES['file_picture']) AND $_FILES['file_picture']['error'] == 0){
        if ($_FILES['file_picture']['size'] <= 1000000){
                $infosfichier = pathinfo($_FILES['file_picture']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'png');
                if (in_array($extension_upload, $extensions_autorisees)){
                        move_uploaded_file($_FILES['file_picture']['tmp_name'], 'site/public/pictures/' . basename($_FILES['file_picture']['name']));

                        ?>

                        <form method="post" action="http://localhost:3000/api/admin/addProduct">
                                <div class="container-fluid container">
                                        <input type="hidden" name="file_name" class="dispnone" value="<?php echo basename($_FILES['file_picture']['name']); ?>" />
                                        <input type="text" class="form-control dispnone" id="name" name="name" placeholder="Nom" value=<?php echo $_POST['name']; ?> />
                                        <input type="text" class="form-control dispnone" id="path" name="path" placeholder="Nom" value=<?php echo basename($_FILES['file_picture']['name']); ?> />
                                        <input type="number" step="0.01" class="form-control dispnone" id="price" name="price" placeholder="Prix" value=<?php echo $_POST['price']; ?> />
                                        <input type="text" class="form-control dispnone" id="description" name="description" placeholder="Description" value=<?php echo $_POST['description']; ?> />


                                    <header class="header-body">
                                        <h1>Êtes vous sûr d'envoyer ces informations ?</h1>
                                    </header> <br />
                                    <div class="row">
                                        <div class="offset-lg-4 col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <a href="/admin/insert ?>" class="button-success">Retour</a>
                                        </div>
                                        <div>
                                                <button class="button-success" type="submit" name="register">Valider</button>
                                        </div>
                                    <br />
                                    </div>
                                </div>
                        </form> <?php
                }
        }
    }
}
?>

@endsection('content')