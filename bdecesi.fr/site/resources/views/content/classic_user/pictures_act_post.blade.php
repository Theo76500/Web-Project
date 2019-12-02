@extends('layouts.master')

@section('content')

<!-- The page to post a picture on the site -->
<?php
if (isset($_FILES['file_picture']) AND $_FILES['file_picture']['error'] == 0)
{
        if ($_FILES['file_picture']['size'] <= 1000000)
        {
                $infosfichier = pathinfo($_FILES['file_picture']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                        move_uploaded_file($_FILES['file_picture']['tmp_name'], 'site/public/pictures/' . basename($_FILES['file_picture']['name']));

                        ?>

                        <form method="post" action="http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/picture">
                                <div class="container-fluid container">
                                        <input type="hidden" name="file_name" value="<?php echo basename($_FILES['file_picture']['name']); ?>" />
                                    <header class="header-body">
                                        <h1>Êtes vous sûr d'envoyer ces informations ?</h1>
                                    </header> <br />
                                    <div class="row">
                                        <div class="offset-lg-4 col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <a href="/activity/<?php echo $infos['id']; ?>" class="button-success">Retour</a>
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
?>

@endsection('content')