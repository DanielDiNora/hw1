<?php
    require_once 'dbinfo.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: home.php");
        exit;
    }

    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    
    
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    $query ="select * from esame where cf='".$cf."'";
    $res= mysqli_query($conn,$query); 
    $risultati=array();
    while($row= mysqli_fetch_assoc($res)){
        array_push($risultati,$row);
    }
    $query1 ="select c.ananmesi,c.cf,c.data_fine_ricovero,c.data_inizio_ricovero,c.diagnosi,c.id_cartella,c.id_reparto,r.nome from cartella_clinica as c join reparto as r on c.id_reparto=r.id_reparto where cf='".$cf."'";
    $res1= mysqli_query($conn,$query1);
    $risultati2=array();
    while($row2= mysqli_fetch_assoc($res1)){
        array_push($risultati2,$row2);
    }
    $totale=array(
        'esami' =>  $risultati,
        'cartelle' =>  $risultati2,
    );
    $json=json_encode($totale);
    print_r($json);
    return $json;
?>
