@extends('../layouts.master')

@section('content')

@include('layouts.callApi')

    <?php
    if (isset($infos['session']) && $infos['session'] != null) {
         $session = callApi('http://localhost:3000/api/session/' . $infos['session']);
         if ($infos['session'][0] != null){
             $user_ID = $session[0]["USE_id"];
             $user_role = $session[0]["ROL_id"];
         }
     }

     if(isset($user_role) && $user_role == 3){
        $display = array('name', 'description', 'price', 'quantity');
        $change = array( 'edit', 'remove');

        $compteur = 0;

        $data = callApi('http://localhost:3000/api/admin/product');
    
    ?>

    <div class="container admin">
        <div class="row">
            <h1><strong>Liste des items </strong><a href="admin/insert" class="btn btn-success btn-lg">➕ Ajouter</a></h1>

            <div class="container mb-3 mt-3">
                <p id="result">
                </p>
                <table class="table table-striped table-bordered mydatatable" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($f=0;$f<count($data);$f++):?>
                    <tr>
                        <?php for($i=0;$i<count($display);$i++): ?>
                        <td id="<?= $display[$i].$compteur?>" style="color: #5D89DA"></td>
                        <?php endfor; ?>

                        <td>
                            <a href="http://localhost:3000/api/admin/removeProduct/<?=$data[$f]["PRO_id"];?>"><button class="btn-danger">Supprimer</button>
                            </a>
                        </td>

                        <?php
                        $compteur++;
                        ?>
                    </tr>
                    <?php endfor;?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Supprimer</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> <?php
    }  else { ?>
    <div class="container container-admin">
        <p>Désolé mais c'est réservé aux admins CESI ici<br />
        Retourner à <a href="/" class="redirect">l'accueil</a>
    </div> <?php
}
    ?>

@endsection('content')
