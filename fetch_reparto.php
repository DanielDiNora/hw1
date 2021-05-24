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
    //recupero le informazioni del reparto con due query perche non so se è medico o infermiere a priori
    $query ="select m.id_reparto, r.nome ,r.sede,r.num_posti_liberi,r.Num_posti_tot,r.Num_posti_occupati
            from medico as m 
            join reparto as r on m.id_reparto=r.id_reparto 
            join impiegato as i on(i.id=m.ID_impiegato) 
            where i.cf='".$cf."'";
    $resmedico= mysqli_query($conn,$query);
    if(mysqli_num_rows($resmedico)>0){
        array_push($risultati,mysqli_fetch_assoc($resmedico));

    }

    $query ="select m.id_reparto, r.nome ,r.sede,r.num_posti_liberi,r.Num_posti_tot,r.Num_posti_occupati
            from infermiere as m 
            join reparto as r on m.id_reparto=r.id_reparto 
            join impiegato as i on(i.id=m.ID_impiegato) 
            where i.cf='".$cf."'";
    $resinf= mysqli_query($conn,$query);
    if(mysqli_num_rows($resinf)>0){
        array_push($risultati,mysqli_fetch_assoc($resinf));
        
    }
    $json=json_encode($risultati);
    print_r($json);
    return $json;
?>