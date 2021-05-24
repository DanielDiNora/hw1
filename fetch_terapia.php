<?php
    require_once 'dbinfo.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }

    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    
    $risultati=array();
    $risultati2=array();
    $query ="select m.id_reparto
            from medico as m 
            join reparto as r on m.id_reparto=r.id_reparto 
            join impiegato as i on(i.id=m.ID_impiegato) 
            where i.cf='".$cf."'";
    $resmedico= mysqli_query($conn,$query);
    if(mysqli_num_rows($resmedico)>0){
        $risultati2=mysqli_fetch_assoc($resinf);
        $query2 ="call terapia(".$risultati2['id_reparto'].")";
        $res= mysqli_query($conn,$query2);
        while($row=mysqli_fetch_assoc($res)){
            array_push($risultati,$row);
        }
    }

    $query ="select m.id_reparto
            from infermiere as m 
            join reparto as r on m.id_reparto=r.id_reparto 
            join impiegato as i on(i.id=m.ID_impiegato) 
            where i.cf='".$cf."'";
    $resinf= mysqli_query($conn,$query);
    if(mysqli_num_rows($resinf)>0){
        $risultati2=mysqli_fetch_assoc($resinf);
        $query2 ="call terapia(".$risultati2['id_reparto'].")";
        $res= mysqli_query($conn,$query2);
        while($row=mysqli_fetch_assoc($res)){
        array_push($risultati,$row);
        }
    }
    //array_push($row['ruolo'],'');
    $json=json_encode($risultati);
    print_r($json);
    return $json;
?>