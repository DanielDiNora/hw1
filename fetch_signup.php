<?php
    require_once 'dbinfo.php';
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    //mi vengono mandati i dati tramite fetch per la registrazione controllo i dati e registro la persona
    $controllo=true;
    $response=array();
    $_POST = json_decode(file_get_contents('php://input'),true);
    if(isset($_POST['cf']) && isset($_POST['pwd']) && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email'])){
        if(!preg_match('/[a-z0-9]+@[a-z0-9]+\.[a-z]+$/i',$_POST['email'])){
            array_push($response,'Errore mail non corretta');
            $controllo=false;
        }
        if(!preg_match('/[a-z]{6}[0-9]{2}[a-z]{1}[0-9]{2}[a-z][0-9]{3}[a-z]$/i',$_POST['cf'])){
            array_push($response,"Errore codice ficale non corretto");
            $controllo=false;
        }
        if(!preg_match('/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,16}$/',$_POST['pwd'])){
            array_push($response,"Errore password non corretta");
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
            $pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
            $data=mysqli_real_escape_string($conn,$_POST['data']);
            $citta=mysqli_real_escape_string($conn,$_POST['citta']);
            $query ="SELECT cf,psw,nome,cognome,Data_Di_Nascita,citta FROM PERSONA  where cf='".$cf."'";
            $res=mysqli_query($conn,$query);
            if(mysqli_num_rows($res)>0){
                $query ="SELECT cf,psw,nome,cognome,Data_Di_Nascita,citta FROM PERSONA  where cf='".$cf."'";
                
                $res=mysqli_query($conn,$query);
                
                while($row= mysqli_fetch_assoc($res)){
                    if($row['psw']==null){
                        //controllo se il campo psw è vuoto vuol dire che quella persona è presente nei sistemi ma non ancora registrato
                        //quindi controllo se i dati anagrafici sono giusti e in caso positivi registro.
                        if($row['nome']==$nome && $row['cognome']==$cognome &&
                            $row['Data_Di_Nascita']==$data && $row['citta']==$citta){
                                $query="UPDATE persona SET psw='".$pwd."',email='".$email."' where cf='".$cf."'";
                                $res3=mysqli_query($conn,$query);
                                 array_push($response,"Registrazione effettuata");
                            }
                            else{
                                array_push($response,"Sei presente nel nostro database ma hai sbagliato qualche dato nella tua anagrafica");
                            }
                    }
                    else{
                        array_push($response,"Sei già registrato");
                    }
                }
            }
            if(mysqli_num_rows($res)==0){
                $query="INSERT INTO `persona` (`cf`, `nome`, `cognome`, `psw`,`email`, `img`, `Data_Di_Nascita`, `citta`) VALUES ('".$cf."','".$nome."','".$cognome."','".$pwd."','".$email."',NULL,'".$data."', '".$citta."')";
                 $res2=mysqli_query($conn,$query);
                 array_push($response,"Registrazione effettuata");
            }
        }
    }else{
        array_push($response,"Sono qui");
    }
    $json=json_encode($response);
    print_r($json);
    return $json;
?>
