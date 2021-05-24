<?php
    require_once 'dbinfo.php';
    session_start();
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);

    $controllo=true;
    $response=array();
    $_POST = json_decode(file_get_contents('php://input'),true);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    $query ="select m.id_reparto
            from medico as m 
            join reparto as r on m.id_reparto=r.id_reparto 
            join impiegato as i on(i.id=m.ID_impiegato) 
            where i.cf='".$cf."'";
    $resmedico= mysqli_query($conn,$query);
    if(mysqli_num_rows($resmedico)>0){
        $reparto=mysqli_fetch_assoc($resmedico);
    }

    $query ="select m.id_reparto
            from infermiere as m 
            join reparto as r on m.id_reparto=r.id_reparto 
            join impiegato as i on(i.id=m.ID_impiegato) 
            where i.cf='".$cf."'";
    $resinf= mysqli_query($conn,$query);
    if(mysqli_num_rows($resinf)>0){
        $reparto=mysqli_fetch_assoc($resinf);
    }
    $id_reparto=$reparto["id_reparto"];
    if(isset($_POST['cf']) && isset($_POST['ananmesi']) && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['data'])){
        if(!preg_match('/[a-z0-9]+@[a-z0-9]+\.[a-z]+$/i',$_POST['email'])){
            array_push($response,'Errore mail non corretta');
            $controllo=false;
        }
        if(!preg_match('/[a-z]{6}[0-9]{2}[a-z]{1}[0-9]{2}[a-z][0-9]{3}[a-z]$/i',$_POST['cf'])){
            array_push($response,"Errore codice ficale non corretto");
            $controllo=false;
        }
        if(!preg_match('/[0-9]{4}[-][0-9]{2}[-][0-9]{2}$/',$_POST['data'])){
        
            array_push($response,"Errore data non corretta");
            $controllo=false;
        }
        if($controllo){
            $cf=mysqli_real_escape_string($conn,$_POST['cf']);
            $nome=mysqli_real_escape_string($conn,$_POST['nome']);
            $cognome=mysqli_real_escape_string($conn,$_POST['cognome']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $ananmesi=mysqli_real_escape_string($conn,$_POST['ananmesi']);
            $data=mysqli_real_escape_string($conn,$_POST['data']);
            $citta=mysqli_real_escape_string($conn,$_POST['citta']);
            $query ="SELECT cf,email,nome,cognome,Data_Di_Nascita,citta FROM PERSONA  where cf='".$cf."'";
            $res=mysqli_query($conn,$query);
            if(mysqli_num_rows($res)>0){
                $query ="SELECT cf,psw,nome,cognome,Data_Di_Nascita,citta FROM PERSONA  where cf='".$cf."'";
                
                $res=mysqli_query($conn,$query);
                $result=mysqli_fetch_assoc($res);
                if(strtoupper($result['cf'])==strtoupper($cf) && strtoupper($result['nome'])==strtoupper($nome) && 
                    strtoupper($result['cognome'])==strtoupper($cognome) &&
                    strtoupper($result['Data_Di_Nascita'])==strtoupper($data) && strtoupper($result['citta'])==strtoupper($citta))
                {

                    //ok i dai anagrafici corrispondono ma devo controllare che la persona non sia gia ricoverata
                    $query_giaPresente="select id_cartella from cartella_clinica where cf='".$cf."' and data_fine_ricovero is NULL";
                    $resPresente=mysqli_query($conn,$query_giaPresente);
                    if(!(mysqli_num_rows($resPresente)>0)){
                        $query_inserimento="INSERT INTO `cartella_clinica` (`cf`, `data_inizio_ricovero`, `data_fine_ricovero`, `diagnosi`, `ananmesi`, `id_reparto`) VALUES
                        ('".$cf."', '".date("Y-m-d")."', NULL, 'NULL', '".$ananmesi."',".$id_reparto." )";
                        $res=mysqli_query($conn,$query_inserimento);
                        if($res){
                            array_push($response,"Inserimento del ricovero riuscito" );
                        }
                    }
                    else{
                        array_push($response,"Paziente già ricoverato" );
                    }
                }
                else {
                    array_push($response,"I dati inseriti non corrisponsdono con quelli nel nostro sistema");
                }
            }
            else{
                //Devo inserire anche la persona
                $query_inserimento_persona="INSERT INTO `persona` (`cf`, `nome`, `psw`, `email`, `img`, `cognome`, `Data_Di_Nascita`, `citta`) VALUES
                 ('".$cf."', ".$nome.", 'NULL', '".$email."', 'NULL','".$cognome."','".$data."','".$citta."' )";
                    $res_persona=mysqli_query($conn,$query_inserimento_persona);
                    if($res_persona){
                        $query_inserimento="INSERT INTO `cartella_clinica` (`cf`, `data_inizio_ricovero`, `data_fine_ricovero`, `diagnosi`, `ananmesi`, `id_reparto`) VALUES
                        ('".$cf."', '".date("Y-m-d")."', 'NULL', 'NULL', '".$ananmesi."',".$id_reparto." ),";
                        $res=mysqli_query($conn,$query_inserimento);
                        if($res){
                            array_push($response,"Inserimento del ricovero riuscito" );
                        }
                    }
                }
               
            }
        
    }else{
        array_push($response,"Sono qui");
    }
    $json=json_encode($response);
    print_r($json);
    return $json;
?>
