<?php
    require_once 'dbinfo.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }
    // recupero i dati dell'utente grazie al codice fiscale salvato nella sessione peer riempire la pagina
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass'],$dbconfig['name']);
    $cf=mysqli_real_escape_string($conn,$_SESSION['username']);
    $query ="SELECT cf,cognome,img,nome FROM PERSONA  where cf='".$cf."'";
    $res= mysqli_query($conn,$query); 
    $row= mysqli_fetch_object($res);
    $cognome='cognome';
    $n='nome';
    $c='cf';
    $img='img';
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

    $cognome='cognome';
    $n='nome';
    $c='cf';
?>

<html>
    <head>
        <meta charset= "utfs-8">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100&display=swap" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='style/mypage.css'>
        <script src="scripts/mypage.js" defer></script>
        <script src="content.js" defer></script>
        <title>Azienda Ospedaliera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
            <header>
                <nav>
                    <a href="HW1.php">Home </a>
                    <a href="LogOut.php">Log Out </a>
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
                <div id='sx'>
                    <div id='profilo'>
                        <img src=<?php
                        if($row->$img != null){
                            echo ($row->$img);
                        }
                        else{
                            echo "'image/imganonimo.png'";
                        }
                        ?>>
                        <h2><?php
                        echo ($row->$n).' '.($row->$cognome);
                        ?></h2>
                        <h2><?php
                        echo $ruolo;
                        ?></h2>
                    </div>
                    <div id='menu'>
                        <a id='profile'>Il Mio Profilo</a>
                        <a id='cartellaClinica'>La mia cartella clinica</a>
                    <?php
                    if( mysqli_num_rows($resinfermire)>0 ||mysqli_num_rows($resmedico)>0){
                        echo  "<a id='gestioneReparto'>Gestisci il mio reaparto</a>";
                    }
                    if( mysqli_num_rows($resinfermire)>0 ||mysqli_num_rows($resmedico)>0 || mysqli_num_rows($restecnico)>0 ||mysqli_num_rows($resOss)>0) {
                      
                      echo  "<a id='parchggio'>Prenota il tuo posto nel parcheggio</a>";
                    }
                    ?>
                    </div>
                </div>
                <div id='dx'>
                    <div class='contenuto'>

                    </div>
                    <div id='reparto' class='invisible'>
                        <h1>Reparto</h1>
                        <div id='info'>
                            <div id='id_reparto'>
                                <h2>Reparto</h2>
                            </div>
                            <div id='nome'>
                                <h2>Nome</h2>
                            </div>
                            <div id='sede'>
                                <h2>Sede</h2>
                            </div>
                            <div id='posti_occupati'>
                                <h2>Posti Occupati</h2>
                            </div>
                            <div id='posti_liberi'>
                                <h2>Posti Liberi</h2>
                            </div>
                            <div id='posti_totali'>
                                <h2>Posti Totali</h2>
                            </div>

                        </div>
                        <div id='terapia'>
                            <div id='bottoneTerapia'>Mostra Terapia</div>
                            <h1 class='invisible'>Terapia</h1>
                            <div class='terapia invisible'>
                                
                                <div id='nomePaziente'>
                                    <h2>Nome</h2>
                                </div>
                                <div id='cognomePaziente'>
                                    <h2>Cognome</h2>
                                </div>
                                <div id='farmaco'>
                                    <h2>Farmaco</h2>
                                </div>
                                <div id='quantita_giornaliera'>
                                    <h2>Quantità</h2>
                                </div>
                            </div>
                        </div>
                        <div id='styleRicovero'>
                            <form id='Ricovero'>
                                <h2>Effettua un ricovero</h2>
                                <div class="error invisible">Attenzione compilare tutti i campi</div>
                                <label for="nome">Nome</label><input type="text" id="nome" name="nome">
                                <label for="cognome">Cognome</label><input type="text" id="cognome" name="cognome">
                                <label for="e-mail">E-mail</label><input type="text" id="e-mail" name="e-mail">
                                <div id="errormail" class="invisible">Attenzione errore nell'inserimento della e-mail</div>
                                <label for="citta">Città</label><input type="text" id="citta" name="citta">
                                <label for="date">Data Di Nascita <br>(aaaa-mm-gg)</br></label><input type="text" id="date" name="date">
                                <div id="errordate" class="invisible">Attenzione errore nell'inserimento della data</div>
                                <label for="cf">Codice Fiscale</label><input type="text" id="cf" name="cf">
                                <div id="errorcf" class="invisible">Attenzione errore nell'inserimento del codice fiscale</div>
                                <label for="ananmesi">Ananmesi</label><input type="text" id="ananmesi" name="ananmesi">
                                <label for="submit"></label><input type="submit" id="submit" name="submit">
                            </form> 
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                <div id='name'>Daniel Di Nora O46002100</div>
                <em>Progetto Web Programming</em>
                
            </footer>
        </main>
    </body>
</html>