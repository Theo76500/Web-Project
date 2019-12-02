    <?php
        function callApi($url){
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_CAINFO => 'CERT.cer',
            CURLOPT_RETURNTRANSFER => true
        ]);

        $data = curl_exec($curl);
        
        if($data === false){
            var_dump(curl_error($curl));
        } else {
            if(curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200){
                // Balises HTML
                $data = json_decode($data, true);
            }
            else {
                echo 'Erreur lors de la connection à l\'API';
            }
        }
        
        curl_close($curl);

        return $data;
    }
    
    ?>