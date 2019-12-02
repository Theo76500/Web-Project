@extends('layouts.master')

@section('content')

@include('layouts.callApi')

<?php

    $isConnected = false;
    $isOccured = false;

          if (isset($infos['session']) && $infos['session'] != null) {
            $session = callApi('http://localhost:3000/api/session/' . $infos['session']);
            if ($session[0] != null) {
              $user_ID = $session[0]["USE_id"];
              $user_role = $session[0]["ROL_id"];

              if($user_ID !== null){
                $isConnected = true;
              }
            }
          }

    $participant = callApi('http://localhost:3000/api/admin/participantsList/' . $infos['id']);

    $ecrire = fopen('site/public/participantList.csv',"w");

    ftruncate($ecrire,0);

    $monfichier = fopen("site/public/participantList.csv", "r+");

    for ($i = 0; $i < count($participant); $i++) {
        fputcsv($monfichier, $participant[$i]);
    }

    $data = callApi('http://localhost:3000/api/activity/' . $infos['id']);

    $dataPictures = callApi('http://localhost:3000/api/activity/' . $infos['id'] . '/pictures');

    if($isConnected){
        $dataUser = callApi('http://localhost:3000/api/' . $user_ID . '/register');
    }

    $dataComment = callApi('http://localhost:3000/api/activity/' . $infos['id'] . '/comments');


    $dateLimit = strtotime('now');

    $dateAct = strtotime($data[0]['ACT_date']);

    if($dateAct < $dateLimit){
        $isOccured = true;
    }

    $participation = false;
?>

<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <h1>
                <strong> <?php echo $data[0]['ACT_name'] ?></strong>
            </h1>
            <br>

        <?php
            if($isConnected){ ?>
               <form class="form info" role="form" action="http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/comment/user/<?php echo $user_ID; ?>" method="post"> <?php
            } else { ?>
                <form class="form info" role="form"> <?php
            }

                if(!$isOccured){ ?>
                <div class="form-group"> 
                    {{ csrf_field() }}
                    <input type="text" class="form-control" id="comment" name="comment" placeholder="Ecrivez un commentaire :" readonly>
                </div> <?php
            } else { ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="comment" name="comment" placeholder="Ecrivez un commentaire :"> 
                </div>
                <?php
            }

                if (!$isOccured) { ?>
                    <div class="form-actions">
                        <a href="/login" class="btn btn-success disabled">LA SECTION COMMENTAIRES SERA OUVERTE A LA FIN DE L'ÉVÉNEMENT</a><br />
                    </div> <?php
                } else if($isConnected){ ?>
                    <div class="form-actions col-lg-5">
                        <button type="submit" class="btn btn-success btn-submit">POSTER</button><br />
                    </div> <?php
                } else { ?>
                    <div class="form-actions">
                        <a href="/login" class="btn btn-success">CONNECTEZ VOUS POUR POSTER UN COMMENTAIRE</a><br />
                    </div> <?php
                }      
            ?>

            <br />
        </form>
        <?php if($isOccured){ ?>
            <div class="comments">
                <label>
                    <strong>Commentaires :</strong>
                </label>
                <br>
                <?php
                    for($i = 0; $i < count($dataComment); $i++){        
                        $dataComment[$i]['USE_username'] = substr($dataComment[$i]['USE_username'], 0, -1);                           
                         
                        if($dataComment[$i]['COM_content'] != null){ ?>
                            <div class="container comment col-md-10">
                                    <div class="row comment-text">
                                        <h1><?php echo $dataComment[$i]['USE_username']; ?> : </h1>
                                        <p><?php echo $dataComment[$i]['COM_content']; ?></p>
                                    </div>

                                    <?php if(isset($user_role) && $user_role == 3){ ?>
                                    <form class="form form-delete" role="form" action="http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/delete/<?php echo $dataComment[$i]['COM_id']; ?>" method="post">
                                        <button type="submit" class="btn btn-danger">Supprimer</button><br />
                                    </form> <?php
                                } ?>

                                </div>
                            
                            <br> <?php
                        }
                    }

                    if(count($dataComment) == 0){ ?>
                        <span>Soyez le premier à commenter pour cet événement !</span> <?php
                    }

                ?>

            </div> <?php
        } ?>

        <br>

                <?php if(count($dataPictures) != 0){ ?>
                    <div class="form-group pictures">
                    <label>
                        <strong>Photos de l'événement :</strong>
                    </label>
                    <br>
                
                    <?php 
                        for($i = 0; $i < count($dataPictures); $i++){ ?>
                            <span>
                                <img class="imgs_act" src="/site/public/pictures/<?php echo $dataPictures[$i]['PIC_name']; ?>" alt="product"/>
                            </span>
                            <?php
                        }

                    ?>

                </div> 
                <?php
            }

            if(!$isOccured){ ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-submit btn-img disabled">LA SECTION PHOTOS SERA OUVERTE A LA FIN DE L'ÉVÉNEMENT</button><br />
                </div>
                <?php
            }
            else if($isConnected){ ?>
                <form action="/activity/<?php echo $infos['id']; ?>/pictures-act-post" method="post" class="form-group" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <input type="file" name="file_picture" /><br />
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success btn-submit btn-img">POSTER UNE PHOTO</button><br />
                    </div>
                </form>
                        <?php
            } else { ?>
                <div class="form-actions">
                    <a href="/login" class="btn btn-success">CONNECTEZ VOUS POUR POSTER UNE PHOTO</a>
                </div> <br /> <?php
            }
            ?>

            <div>
                <br />
                <a class="btn btn-warning" href="../">Retour</a>
            </div>



    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 block" >
        <div class="card">
            <img src="/site/public/pictures/<?php echo $data[0]['PIC_name']; ?>" alt='event' />
            <div class="price"><?php echo number_format($data[0]['ACT_price'], 2, '.', ''); ?> €</div>
            <div class="caption">
                <div class="divider col-lg-10 col-md-8 col-sm-8"></div>
                    <h4><?php echo $data[0]['ACT_name']; ?></h4>
                    <p><?php echo $data[0]['ACT_description']; ?></p>
                    <p>Date et heure : <?php echo $data[0]['ACT_date_h']; ?></p>

                    <?php if($isOccured){ ?>
                        <button class="btn btn-order disabled" role="button"> CET ÉVÉNEMENT EST TERMINÉ</button> <?php
                    } else if($isConnected){
                        for($i = 0; $i < count($dataUser); $i++){
                        if($dataUser[$i]['ACT_id'] == $infos['id'] && $isConnected){ ?>
                            <form method="post" action='http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/cancel/user/<?php echo $user_ID; ?>'>
                                <button class="btn btn-registrated" role="button"> VOUS PARTICIPEZ !</button>
                            </form><?php $participation = true; break;
                        }
                        }
                    }

                    if(!$participation && $isConnected && !$isOccured){ ?>
                        <form method="post" action='http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/register/user/<?php echo $user_ID; ?>'>
                            {{ csrf_field() }}
                            <button class="btn btn-order offset-lg-1 col-lg-10" role="button"> PARTICIPER</button>
                        </form> <?php
                    }

                    if(!$isConnected && !$isOccured){ ?>
                        <a class="btn btn-order offset-lg-1 col-lg-10" href="/login" role="button"> VOUS DEVEZ VOUS CONNECTER POUR PARTICIPER A CET ÉVÉNEMENT</a>
                        <?php
                    }

                    if($isOccured){ ?>
                    <form class="form info" role="form" action="http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/likes" method="post">
                        <div class="form-group">
                            <span class="likes">
                                <?php echo ' ' . $data[0]['ACT_likes']; ?> personne(s) ont aimé(s) cet événement !
                            </span>

                            <div class="form-actions">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success">👍</button><br />
                            </div>
                        </div>
                    </form> <?php
                    } else if(!$isOccured){ ?>
                        <form class="form info" role="form" action="http://localhost:3000/api/activity/<?php echo $infos['id']; ?>/likes" method="post">
                        <div class="form-group">
                            <span class="likes">
                                Vous pourrez liker cet événement quand il sera terminé
                            </span>

                            <div class="form-actions">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success disabled">👍</button><br />
                            </div>
                        </div>
                    </form> <?php
                    }

                    if(isset($user_role)){
                            if($user_role === 3){ ?>
                            <a class="btn btn-order" href="../../site/public/participantList.csv" download="participantList.csv">Récuperer les participants de cet événement</a> <?php
                        }
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')