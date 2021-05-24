<?php
    require_once 'dbinfo.php';
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: mypage.php");
        exit;
    }
    //effettuo il login tramite l'invio del form ricaricando la pagina
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    
    $error='';
    
    if(isset($_POST['cf']) && isset($_POST['pwd'])){
        $cf=mysqli_real_escape_string($conn,$_POST['cf']);
        $query ="SELECT cf,psw,nome FROM PERSONA  where cf='".$cf."'";
        $res= mysqli_query($conn,$query);
        
        $row= mysqli_fetch_object($res);
        $p='psw';
        $n='nome';
        $c='cf';
        if(mysqli_num_rows($res)>0){
            if(!($row->$p==NULL)){
                if($row->$p==$_POST['pwd']){
                    $_SESSION['username']=$row->$c;
                    header("Location: mypage.php");
                    exit;
                }
                else{
                    $error='Password errata';
                        
                }
            }
            else{
                $error='Non sei ancora registrato al nostro portale';
            }      
        }
        else{
            $error='Il tuo codice fiscale non è presente nei nostri sistemi';
        }
        
    }
?>

<html>
    <head>
        <meta charset= "utfs-8">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100&display=swap" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='style/Login.css'>
        <script src="scripts/Login.js" defer></script>
        <script src="content.js" defer></script>
        <title>Azienda Ospedaliera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
            <header>
                <nav>
                    <a href="HW1.php">Home </a>
                    <a href="login.php">Log In </a>
                    <div id="hiddenMenu">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </nav>
                <div id="overlay"></div>
                    
                <h1>Azienda Ospedaliera</h1>
                
            </header>

            <section>
                <form id="login" method="post">
                    <h2>Accedi ai nostri servizi online</h2>
                    <div class="error invisible">Attenzione compilare tutti i campi</div>
                    <?php
                    if($error!=''){
                    echo "<div class='error'>";
                    echo $error;
                    echo "</div>";
                    }
                    ?>
                    <label for="cf">Codice Fiscale</label><input type="text" id="cf" name="cf">
                    <label for="pwd">Password</label><input type="password" id="pwd" name="pwd">
                    <input type = "submit" class = "submit" value = "Accedi">
                    <a href=''>Non sei registrato? Registrati ora</a>
                </form>
                <form id="signup" class='invisible' method="post">
                    <h2>Registrati ai nostri servizi online</h2>
                    <div class="error invisible">Attenzione compilare tutti i campi</div>
                    <label for="nome">Nome</label><input type="text" id="nome" name="nome">
                    <label for="cognome">Cognome</label><input type="text" id="cognome" name="cognome">
                    <label for="e-mail">E-mail</label><input type="text" id="e-mail" name="e-mail">
                    <div id="errormail" class="invisible">Attenzione errore nell'inserimento della e-mail</div>
                    <label for="citta">Città</label><input type="text" id="citta" name="citta">
                    <label for="date">Data Di Nascita <br>(aaaa-mm-gg)</br></label><input type="text" id="date" name="date">
                    <div id="errordate" class="invisible">Attenzione errore nell'inserimento della data</div>
                    <label for="cf">Codice Fiscale</label><input type="text" id="cf2" name="cf">
                    <div id="errorcf" class="invisible">Attenzione errore nell'inserimento del codice fiscale</div>
                    <label for="pwd">Password</label><input type="password" id="pwd2" name="pwd">
                    <div id="errorpwd" class="invisible">Errore: la password deve 
                                                        <ul>
                                                        <li>essere lunga tra 8-16 caratteri</li>
                                                        <li>contenere almeno un carattere maiuscolo</li>
                                                        <li>contenere almeno un numero</li> 
                                                        </ul>
                    </div>
                    <label for="pwdc">Conferma Password</label><input type="password" id="pwdc" name="pwdc">
                    <div id="errorpwdc" class="invisible">Attenzione le password non corrispondono</div>
                    <input type = "submit" class="submit" value = "Registrati">
                    <div class="error2"></div>
                </form>
            </section>

            <footer>
                <div id='name'>Daniel Di Nora O46002100</div>
                <em>Progetto Web Programming</em>
                
            </footer>
        </main>
    </body>
</html>