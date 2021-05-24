<?php
    require_once 'dbinfo.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }

    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    
    $error='';
    
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    $query ="SELECT * FROM PERSONA  where cf='".$cf."'";
    $res= mysqli_query($conn,$query); 
    $row= mysqli_fetch_assoc($res);
    $cognome='cognome';
    $n='nome';
    $c='cf';
    $e='e-mail';
    $d='Data_Di_Nascita';
    $citta='Data_Di_Nascita';
    

    $query ="select * from impiegato as i join persona as p on i.cf=p.cf join medico as d on i.id=d.id_impiegato where p.cf='".$cf."'";
    $resmedico= mysqli_query($conn,$query);
    $ruolo='Paziente';
    if( mysqli_num_rows($resmedico)>0 ) {
        $ruolo='Medico';
    }

    $query ="select * from impiegato as i join persona as p on i.cf=p.cf join infermiere as inf on i.id=inf.id_impiegato where p.cf='".$cf."'";
    $resinfermire= mysqli_query($conn,$query);
    if( mysqli_num_rows($resinfermire)>0) {
        $ruolo='Infermiere';
    }

    $query ="select * from impiegato as i join persona as p on i.cf=p.cf join tecnico as inf on i.id=inf.id_impiegato where p.cf='".$cf."'";
    $restecnico= mysqli_query($conn,$query);
    if( mysqli_num_rows($restecnico)>0) {
        $ruolo='Tecnico';
    }

    $query ="select * from impiegato as i join persona as p on i.cf=p.cf join oss as inf on i.id=inf.id_impiegato where p.cf='".$cf."'";
    $resOss= mysqli_query($conn,$query);
    if( mysqli_num_rows($resOss)>0) {
        $ruolo='Operatore Socio Sanitario';
    }
    //array_push($row['ruolo'],'');
    $row['ruolo']=$ruolo;
    $json=json_encode($row);
    print_r($json);
    return $json;
?>