<?php
    $galleryDir = opendir("images/oryginał");

    $restricted = array(".", "..");

    $meter = 0;
                         
    while(false !== ($fileNameNew = readdir($galleryDir))){
    if (!in_array($fileNameNew, $restricted)) {
        $files_array[] = $fileNameNew;
        $meter++;
    }
 }   
 if($meter==0){
    die("Dodaj pierwsze zdjęcie!");
}              
?>