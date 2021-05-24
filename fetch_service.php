
<?php
    require_once 'dbinfo.php';
    
    
    //recupero i dati dei servizi dal mio database invece di prenderli dal file content js come nel precedente homework
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $query ="select s.nome as Nome, r.nome as reparto,s.image, s.descrizione as Descrizione from servizi as s join reparto as r where s.reparto=r.id_reparto";
    $res= mysqli_query($conn,$query);
    
    $servizi=array();
    while($row= mysqli_fetch_assoc($res)){
        array_push($servizi,$row);
    }
    $json=json_encode($servizi);
    print_r($json);
    return $json;
?>
