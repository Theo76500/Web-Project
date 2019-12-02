@extends('layouts.master')

@section('content')

@include('layouts.callApi')

<?php

  if (isset($infos['session']) && $infos['session'] != null) {
    $session = callApi('http://localhost:3000/api/session/'.$infos['session']);
    if ($session[0] != null) {
      $user_ID = $session[0]["USE_id"];
      $user_role = $session[0]["ROL_id"];
    }
  }

$display = array('username', 'email');
$compteur = 0;

$data = callApi('http://localhost:3000/api/staff/notif');

    if(isset($user_role) && $user_role == 2){ ?>
            <div class="container">
                <h1>Voici les admins :</h1>
                <div class="container mb-3 mt-3">
                    <table class="table table-striped table-bordered mydatatable" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for($f=0;$f<count($data);$f++):?>
                        <tr>
                            <?php for($i=0;$i<count($display);$i++): ?>
                            <td id="<?= $display[$i].$compteur?>" style="color: #5D89DA"></td>
                            <?php endfor;
                            $compteur++;?>
                        </tr>
                        <?php endfor;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Mail</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

    <p>Vous pouvez les contacter à leur adresse mail en cas de soucis</p> <br />

        <form role="form" method="post" action="/staff/download-pictures">
            {{ csrf_field() }}
            <input type='hidden' name="hidden" value="hidden" />
            <button name="submit" class="btn btn-success">Télécharger toutes les images du site</button>
        </form>

    <br />

    </div>

    <?php

} else { ?>
    <div class="container container-staff">
        <p>Désolé mais c'est réservé au staff CESI ici<br />
        Retourner à <a href="/" class="redirect">l'accueil</a>
    </div> <?php
}

?>


@endsection('content')
