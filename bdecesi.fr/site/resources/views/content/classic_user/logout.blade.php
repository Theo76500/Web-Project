@include(layout.callApi)

<?php 
  if (isset($infos['session']) && $infos['session'] != null) {
    $session = callApi('http://localhost:3000/api/session/'. $infos['session']);
    $user_ID = $session[0]["USE_id"];
    $user_role = $session[0]["ROL_id"];
  }



  callApi('http://localhost:3000/api/session/' . $user_ID . '/logout');
