<html>
    <head>
        <meta charset= "utfs-8">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100&display=swap" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='style/HW1.css'>
        <script src="scripts/script.js" defer></script>
        <script src="content.js" defer></script>
        <title>Azienda Ospedaliera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
            <header>
                <nav>
                    <a href="HW1.php">Home </a>
                    <a href="login.php">
                    <?php
                    session_start();
                    if(isset($_SESSION['username'])) {
                        echo 'Area personale di '.$_SESSION['username'];
                    }
                    else echo 'Log in' ; 
                    ?>
                     <?php
                    if(isset($_SESSION['username'])) {
                        echo '<a href="LogOut.php">Log Out</a>';
                    }
                    ?>
                    
                    </a>
                    <div id="hiddenMenu">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                
                </nav>
                
                

                <div id="overlay"></div>
                <em>Benvenuto nella nostra</em>
                <h1>Azienda Ospedaliera</h1>
               
            </header>
            
            <section>
                    <h1>I Nostri Reparti</h1>
                    <div class='ricerca'>
                        <h2>Cerca i nostri servizi</h2>
                        
                            <input type="text" id="search">
                            <input type = "submit" id = "submit" value = "cerca">
                        
                        <div id="risultati"></div>
                        
                    </div>

                    <div class='preferiti invisible'>
                        <h2>Aggiunti ai preferiti</h2>
                    </div>

                   <div id='covid'>
                       <h2>Aggiornamento dati covid-19</h2>
                       <div id='dati'>
                            <div id='generale'>
                                <h3>Casi Totali</h3>
                            </div>    
                            <div id='new'>
                                <h3>Casi odierni</h3>
                            </div>      
                       </div>
                   </div>

                    <div class=reparto>
                        <img src="image/imgEndo.jpg">
                        <div class=descrizione>
                            <h2>Endocrinologia</h2>  
                            <p> L'endocrinologia ?? quella branca della medicina interna che studia il sistema endocrino con particolare attenzione verso le patologie delle ghiandole a secrezione interna, ossia quelle il cui prodotto viene direttamente immesso nel sangue: tali prodotti prendono il nome di ormoni.

                                La Scuola di specializzazione medica viene ufficialmente denominata in Endocrinologia e malattie del metabolismo, formando infatti specialisti che abbiano maturato conoscenze teoriche, scientifiche e professionali nel campo della fisiopatologia e clinica delle malattie del sistema endocrino, comprendente anche tutto ci?? che ?? riconducibile al metabolismo in senso lato. Gli ambiti di specifica competenza sono quindi, pi?? in dettaglio, la fisiopatologia endocrina, la semeiotica funzionale e strumentale endocrino-metabolica; la metodologia clinica e la terapia in endocrinologia, diabetologia e andrologia; la fisiopatologia e clinica endocrina della riproduzione umana, dell'accrescimento e delle attivit?? motorie; la fisiopatologia e clinica del ricambio con particolare riguardo all'obesit?? e al metabolismo glucidico, lipidico ed elettrolitico.
                                <div class=button>Scopri di pi??</div>
                            </p>  
                            <h1 class="invisible">I Medici di questo reparto</h1>
                            <div id="endocrinologia" class="content invisible" >
                            </div>

                            <div class="button2 invisible">Scopri i servizi</div>
                            <div class="servizi">
                                <h1 class="invisible">I Servizi Di Questo Reparto</h1>
                            </div>
                        </div>
                          
                    </div>

                    
                   

                    <div class=reparto>
                        <img src="image/imgOrto.jpg">
                        <div class=descrizione>
                            <h2>Ortopedia</h2>  
                            <p> L'ortopedia ?? una branca iperspecialistica della chirurgia che si occupa dello studio e del trattamento delle patologie dell'apparato locomotore. Essa, tradizionalmente, comprende la traumatologia, anche se questa materia ?? sempre pi?? considerata multidisciplinare visto che non pu?? non avvalersi di diverse competenze specialistiche (medicina d'urgenza, rianimazione, chirurgia plastica, chirurgia vascolare, radiologia interventistica ecc.)

                                In altre parole, il medico chirurgo specialista in Ortopedia e Traumatologia deve aver maturato conoscenze teoriche e sviluppato capacit?? pratico-professionali nel campo della fisiopatologia e terapia sia medica sia chirurgica (correttivo-conservativa, ricostruttiva e sostitutiva) delle malattie dell'apparato locomotore nell'et?? pediatrica e adulta con specifici campi di competenza nella semeiotica funzionale e strumentale, nella metodologia clinica e nella terapia in Ortopedia, nella Chirurgia della Mano e nella Traumatologia compresa la Traumatologia dello Sport nonch?? nelle patologie a carattere oncologico di pertinenza.
                                <div class=button>Scopri di pi??</div>
                            </p>


                            <h1 class="invisible">I Medici di questo reparto</h1>
                            <div id="ortopedia" class="content invisible" >
                            </div> 

                            <div class="button2 invisible">Scopri i servizi</div>
                            
                            <div class="servizi">
                                <h1 class="invisible">I Servizi Di Questo Reparto</h1>
                            </div>
                        </div>
                    </div>


                    <div class=reparto>
                        <img src="image/imgCardio.jpg">
                        <div class=descrizione>
                            <h2>Cardiologia</h2>  
                            <p> 
                                La cardiologia ?? quella branca della medicina interna che si occupa dello studio, della diagnosi e della cura (farmacologica e/o invasiva) delle malattie cardiovascolari acquisite o congenite. Chi si occupa di tale branca della medicina, come medico specialista, viene chiamato cardiologo.

                                La cardiologia ?? una disciplina che negli anni pi?? recenti si ?? molto evoluta e al suo interno si sono sviluppate specialit?? come l'emodinamica e l'elettrofisiologia.
                                
                                Va inoltre segnalato che il miglioramento terapeutico medico e chirurgico delle cardiopatie congenite ha permesso la sopravvivenza di numerosi bambini che, diventati adulti, hanno determinato il crearsi di una nuova branca della cardiologia dedicata ai cardiopatici congeniti adulti.
                                <div class=button>Scopri di pi??</div>            
                            </p> 
                            <h1 class="invisible">I Medici di questo reparto</h1>
                            <div id="cardiologia" class="content invisible" >
                            </div>

                            <div class="button2 invisible">Scopri i servizi</div>
                            
                            <div class="servizi">
                                <h1 class="invisible">I Servizi Di Questo Reparto</h1>
                            </div>
                        </div>
                    </div>

                    
                    <div class=reparto>
                        <img src="image/imgNeuro.jpg">
                        <div class=descrizione>
                            <h2>Neurochirurgia</h2>  
                            <p> 
                                Per poter agire direttamente al cervello viene effettuata una craniotomia che solitamente viene effettuata in anestesia generale, ma in alcuni casi in anestesia locale (soprattutto quando si deve asportare un tumore nei pressi della zona che controlla il linguaggio, o altro). Si procede rasando completamente o parzialmente la testa del paziente e successivamente deve essere detersa accuratamente onde evitare infezioni. Si incide il cuoio capelluto nella parte da operare con un taglio semi-circolare, successivamente vengono effettuati tramite un trapano dei fori in alcune parti del cranio. Poi i fori creati vengono uniti mediante l'uso di una sega elettrica detta craniotomo; mentre in alcuni casi possono essere usate delle frese da taglio. Rimosso l'osso, viene incisa la dura madre per l'accesso allo spazio subdurale ed al parenchima cerebrale.
                                <div class=button>Scopri di pi??</div>
                            </p> 
                            <h1 class="invisible">I Medici di questo reparto</h1>
                            <div id="Neurochirurgia" class="content invisible" >
                            
                            </div>

                            <div class="button2 invisible">Scopri i servizi</div>
                            <h1 class="invisible">I Servizi Di Questo Reparto</h1>
                            <div class="servizi">
                                <h1 class="invisible">I Servizi Di Questo Reparto</h1>
                            </div>
                        </div>
                    </div>
                    <div id='dieta'>
                        <h1>La nostra azienda ?? attenta alla tua salute</h1>
                        <h2>In questa sezione del nostro sito potrai cercare le calorie dei principali cibi dei maggiori brand (es. big mac)</h2>
                        <form>
                            <input type="text" id="cibo">
                            <input type="submit" id="SearchCibo" value="cerca">
                        </form> 
                        <div id='risposte'>

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