
@include('layouts.callApi')

<?php

if(isset($_POST['hidden'])){
        $dataPictures = callApi('http://localhost:3000/api/pictures');

        $zip = new ZipArchive();
        $filename = 'photos_bdecesi.zip';

        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            exit("Impossible d'ouvrir le fichier <$filename>\n");
        }

        for($i = 0; $i < count($dataPictures); $i++){
            $zip->addFile('site/public/pictures/' . $dataPictures[$i]['PIC_name']);
        }

        $zip->close();

        if(file_exists($filename)){
            header('Content-disposition: attachment; filename='. $filename); 
            header('Content-Type: application/force-download');
            readfile($filename);

            unlink($filename);
        }

    } ?>