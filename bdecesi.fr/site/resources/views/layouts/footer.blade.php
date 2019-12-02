<?php
  if (isset($infos['session']) && $infos['session'] != null) {

    $curl = curl_init('http://localhost:3000/api/session/'.$infos['session']);
    curl_setopt_array($curl, [
        CURLOPT_CAINFO => 'CERT.cer',
        CURLOPT_RETURNTRANSFER => true
    ]);
    $session = curl_exec($curl);
    if($session === false){
        var_dump(curl_error($curl));
    } else {
        if(curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200){
            $session = json_decode($session, true);
        }
        else {
            echo 'Erreur lors de la connection à l\'API';
        }
    }
    curl_close($curl);

    if ($session[0] != null) {
      $user_ID = $session[0]["USE_id"];
      $user_role = $session[0]["ROL_id"];
    }
  }
?>

<div class="footer-page">
    <div class="footer-page-group footer-page-left-bloc">
        <ul class="footer-page-list-media">
            <li class="footer-page-point-media"><a href="https://www.facebook.com/CesiCampusRouen/"><img class="media" src="https://image.flaticon.com/icons/svg/124/124010.svg" alt="icon" /></a></li>
            <li class="footer-page-point-media"><a href="https://twitter.com/GroupeCESI?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img class="media" src="https://image.flaticon.com/icons/svg/174/174876.svg" alt="icon"/></a></li>
            <li class="footer-page-point-media"><a href="https://www.instagram.com/campus_cesi/?hl=fr"><img class="media" src="https://image.flaticon.com/icons/svg/2111/2111463.svg" alt="icon"/></a></li>
            <li class="footer-page-point-media"><a href="https://www.linkedin.com/company/groupe-cesi/?originalSubdomain=fr"><img class="media" src="https://image.flaticon.com/icons/svg/174/174857.svg" alt="icon"/></a></li>
        </ul>
        <p class="footer-page-text">Groupe 9©️</p>
    </div>
    <div class="footer-page-right-bloc">
        <div class="footer-page-group">
          <?php if (!isset($user_ID)):?>
            <h4><a href="/login">Mon compte</a></h4>
            <ul class="footer-page-list">
                <li class="footer-page-point"><a href="/login">Se connecter</a></li>
                <li class="footer-page-point"><a href="/registration">S'inscrire</a></li>
            </ul>
          <?php else: ?>
            <h4><a href="<?= '/'.$user_ID.'/profile' ?>">Mon compte</a></h4>
            <ul class="footer-page-list">
                <li class="footer-page-point"><a href="/logout">Se Déconnecter</a></li>
            </ul>
          <?php endif; ?>
        </div>
        <div class="footer-page-group">
            <h4><a href="/shop">Boutique</a></h4>
            <?php if (!isset($user_ID)):?>
            <ul class="footer-page-list">
                <li class="footer-page-point"><a href="/login">Mon Panier</a></li>
            </ul>
            <?php else: ?>
              <ul class="footer-page-list">
                  <li class="footer-page-point"><a href="<?= '/' . $user_ID . '/mon-panier' ?>">Mon Panier</a></li>
              </ul>
            <?php endif; ?>
        </div>
        <div class="footer-page-group">
            <h4><a href="/legal-mentions">A propos</a></h4>
            <ul class="footer-page-list">
                <li class="footer-page-point"><a href="/legal-mentions">Mentions légales</a></li>
                <li class="footer-page-point"><a href="/CGU">Conditions générales d'utilisation</a></li>
                <li class="footer-page-point"><a href="/CGV">Conditions générales de vente</a></li>
            </ul>
        </div>
    </div>
</div>
