@extends('../layouts.master')

@section('content')

    @include('layouts.callApi')
    <?php
    /*if (isset($_FILES['namePic']) AND $_FILES['namePic']['error'] == 0)
    {
            // Testons si le fichier n'est pas trop gros
            if ($_FILES['namePic']['size'] <= 1000000)
            {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['namePic']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees))
                    {
                            // On peut valider le fichier et le stocker définitivement
                            move_uploaded_file($_FILES['namePic']['tmp_name'], 'public/' . basename($_FILES['namePic']['name']));
                            echo "L'envoi a bien été effectué !";
                    }
            }
    }*/

    if (isset($infos['session']) && $infos['session'] != null) {
        $session = callApi('http://localhost:3000/api/session/'.$infos['session']);
        if ($infos['session'][0] != null){
            $user_ID = $session[0]["USE_id"];
            $user_role = $session[0]["ROL_id"];
        }
     }

    if(isset($user_role) && $user_role == 3){ ?>
        <div class="container admin">
        <h1><strong>Ajouter un item</strong></h1>
        <div class="row">
            <br>
            <form class="form" role="form" method="post" action="pictures-admin-post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom">
                    <span class="help-inline"><?php /* echo  $nameError; */ ?></span>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                    <span class="help-inline"><?php /* echo  $descriptionError; */?></span>
                </div>

                <div class="form-group">
                    <label for="price">Prix : (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix">
                    <span class="help-inline"><?php /* echo $priceError; */ ?></span>
                </div>

                <div class="form-group">

                        <label for="file_picture">Sélectionner une image: </label>
                        <input type="file" id="namePic" name="file_picture">


                    <span class="help-inline"><?php /* echo  $imageError; */ ?></span>
                </div>


                <br>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">➕ Ajouter</button>
                    <a class="btn btn-warning" href="../admin"> Retour</a>
                </div>
            </form>
        </div>
    </div> <?php
    } else { ?>
    <div class="container container-admin">
        <p>Désolé mais c'est réservé aux admins CESI ici<br />
        Retourner à <a href="/" class="redirect">l'accueil</a>
    </div> <?php
}
?>

@endsection('content')
