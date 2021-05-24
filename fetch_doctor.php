
<?php
    require_once 'dbinfo.php';
    //recupero i dati dei dottori dal mio database invece di prenderli dal file content js come nel precedente homework
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $query =" select p.cognome as Nome,m.specializzazione as Specializzazione ,p.img as image,r.nome as reparto from medico as m join impiegato as i on m.id_impiegato=i.id join persona as p on p.cf=i.cf join reparto as r on r.id_reparto=m.ID_reparto";
    $res= mysqli_query($conn,$query);
    
    $servizi=array();
    while($row= mysqli_fetch_assoc($res)){
        array_push($servizi,$row);
    }
    $json=json_encode($servizi);
    print_r($json);
    return $json;
?>
