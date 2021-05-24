<?php
    require_once 'dbinfo.php';
    // controllo se il posto è libero e se l'utente non ha gia prenotato un parcheggio
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    session_start();
    $controllo=true;
    $response=array();
    $_POST = json_decode(file_get_contents('php://input'),true);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    $query=("select id from impiegato where cf='".$cf."'");
    $res=mysqli_query($conn,$query);
    $risultato=mysqli_fetch_assoc($res);
    $id_imp=$risultato['id'];
    $sede=mysqli_real_escape_string($conn,$_POST['sede']);
    $num_parcheggio=mysqli_real_escape_string($conn,$_POST['num_parcheggio']);
    if(isset($_POST['sede']) && isset($_POST['num_parcheggio'])){
        $query_controllo=("select num_parcheggio from parcheggio where id_impiegato='".$id_imp."'");
        $res_controllo=mysqli_query($conn,$query_controllo);
        if(mysqli_num_rows($res_controllo)>0){
            array_push($response,'Hai già prenotato un parcheggio');    
        }
        else{
            $query_occupato="select id_impiegato from parcheggio where num_parcheggio='".$num_parcheggio."' and sede='".$sede."'";
            $res_occupato=mysqli_query($conn,$query_occupato);
            $risultato=mysqli_fetch_assoc($res_occupato);
            if($risultato['id_impiegato'] == null){
                $query_inserimento=("Update parcheggio set id_impiegato=".$id_imp." where num_parcheggio='".$num_parcheggio."' and sede='".$sede."'");
                $res_controllo=mysqli_query($conn,$query_inserimento);
                if($res_controllo){
                    array_push($response,'Parcheggio prenotato');
                }
                else{
                    array_push($response,'Errore nella prenotazione');
                }
            }
            else{
                array_push($response,'Parcheggio era già occupato');
            }
        }
    }
    else{
        array_push($response,'Dati inviati al server sbagliati');
    }
    $json=json_encode($response);
    print_r($json);
    return $json;
?>
