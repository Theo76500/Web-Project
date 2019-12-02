@extends('../layouts.master')

@section('content')

@include('layouts.callApi')

<?php
    
    $data = callApi('http://localhost:3000/api/' . $infos['id'] . '/profile');
    
?>

<div class="container">
    <div class="profil">
        <h3>Profil</h3>
        <div class="yellow-line"></div>
        <div class="information">
            <div class="row">
                <!-- The container where there is the description -->
                <div class="col-6 col-lg-3 row-description">
                    <div class="p_description">
                        <p class="username"><span class="key">Username</span> : <span class="value"><?php echo substr($data[0]["USE_username"],0,strlen($data[0]["USE_username"])-1) ?></span></p>
                        <p class="mail"><span class="key">Email</span> : <span class="value"><?php echo substr($data[0]['USE_email'],0,strlen($data[0]["USE_email"])-1); ?></span></p>
                        <p class="speciality"><span class="key">Spécialité</span> : <span class="value"><?php echo $data[0]['SPE_name']; ?></span></p>
                        <p class="statut"><span class="key">Statut</span> : <span class="value"><?php echo $data[0]['ROL_name']; ?></span></p>
                        <p class="campus"><span class="key">Campus</span> : <span class="value"><?php echo $data[0]['CAM_name']; ?></span></p>
                        <p class="description"><span class="key">Description</span> : <span class="value"><?php echo $data[0]['USE_description']; ?></span></p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <?php echo '<img src="/site/public/pictures/' . $data[0]['PIC_name'] . '" alt="event">' ;?>
                </div>

                <!-- The container where there is the activities -->
                <div class="activity col-12 col-lg-6">
                    <h4>Mes activités :</h4>
                    <div>
                        <?php 
        
                            if ($data[0]['ACT_id'] != null)
                            {
                                for ($i=0; $i<count($data); $i++)
                                {
                                    echo $data[$i]['ACT_name'] . ' - ' . $data[$i]['ACT_date_h']; 
                                    echo '<button class="cancel-button btn-activity"><a href="">Supprimer</a></button> <br><br>';
                                }
                            }
                            else
                            { ?>
                        <p>Vous n'êtes inscrit à aucune activité à venir</p> <?php
                            }
                            
                            ?>

                    </div>
                </div>
            </div>
            <div class="organisation">
                <div class="row">
                    <div class="col-3 col-md-2">
                        <button class="btn-bottom"><a href="/logout">Déconnecter</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')