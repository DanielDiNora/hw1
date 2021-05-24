<?php
    require_once 'dbinfo.php';
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    session_start();
    $controllo=true;
    $response=array();
    $imagePath=explode('/',$_FILES['file']['type']);
    $imageFileType=$imagePath[1];
    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"){
        if($_FILES['file']['type']<5000000){
            if(move_uploaded_file($_FILES['file']['tmp_name'],"./imageProfile/".$_SESSION['username'].".".$imageFileType)){
                array_push($response,"Immagine caricata con successo");
                $query="UPDATE PERSONA SET img='./imageProfile/".$_SESSION['username'].".".$imageFileType."' where cf='".$_SESSION['username']."'";
                $res=mysqli_query($conn,$query);
                if(!$res){
                    array_push($response,"Errore nell'inserimento nel database");
                }
            }else{
                array_push($response,"Errore nel caricare l'immagine");
            }
        }
        else{
            array_push($response,"Errore foto troppo grande(max 5MB)");
        }
    }
    else{
        array_push($response,"Imaggine nel formato sbagliato(formati consentiti:jpg,png,jpeg)");
    }
    
    $json=json_encode($response);
    print_r($json);
    return $json;
?>
