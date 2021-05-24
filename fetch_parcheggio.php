<?php
    require_once 'dbinfo.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }

    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    
    
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    
    $risultati=array();
    //recupero le informazioni del reparto con due query perche non so se è medico o infermiere a priori
    $query ="select * from parcheggio";
    $resparcheggio= mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($resparcheggio)){
        if(!($row['id_impiegato']==null)){
            $row['id_impiegato']=true;
        }
        array_push($risultati,$row);
    }
    $json=json_encode($risultati);
    print_r($json);
    return $json;
?>