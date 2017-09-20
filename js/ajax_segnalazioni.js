
/* AJAX = Asynchronous JavaScript and XML */

function loadXMLDoc()
{
    /* questa prima parte della funzione apre la comunicazione con il server in background , senza dover riaggiornare la pagina */

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// codice per le nuove versioni di browser che hanno XMLHttpRequest integrato IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// codice per le vecchie versioni di browser  IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    /*  qui catturiamo l'evento di quando il readyState cambia                           */
    /* 0: richiesta non inizializzata                                                    */
    /* 1: connessione con il server attivata                                             */
    /* 2: il server ha ricevuto la richiesta                                             */
    /* 3: il server sta eseguendo la richiesta [query]                                   */
    /* 4: il server ha finito e la risposta e' pronta !                                  */
    /* mentre lo STATUS e' lo stato della pagina , cioe' : 200: "OK" 404: Page not found */


    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            /* qui si inserisce la risposta dal server (quindi l'informazione che abbiamo chiesto al nostro file php    */
            /* di prendere dal DataBase , e la si passa al nostro elemento (in questo caso un div)                      */
            /* da notare che abbiamo richiesto una stringa come risposta , questo perche' non stiamo usando un file XML */
            /* altrimenti avremmo dovuto usare responseXML                                                              */
            document.getElementById("contenitore").innerHTML=xmlhttp.responseText;
        }
    }

    /* qui apri il file refresh_segnalazioni.php e imposti il parametro asincrono=true                        */
    /* l'importanza di avere una comunicazione asincrona e' che JS non deve aspettare la risposta del server  */
    /* ma puo' continuare ad eseguire il codice ed eventualmente a ritardare la risposta in attesa del server */
    /* in questo modo non si creano "colli di bottiglia" , ovvero rallentamenti dovuti a lunghe attese        */
    /* chiaramente se si imposta asincrono=false (quindi sincrono) JS fermera' l'esecuzione del codice fino a */
    /* quando il server non gli avra' fornito la risposta ..                                                  */

    xmlhttp.open("GET","refresh_segnalazioni.php",true);
    xmlhttp.send();


}


function loadCategoria(categoria)
{

    /* questa prima parte della funzione apre la comunicazione con il server in background , senza dover riaggiornare la pagina */

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// codice per le nuove versioni di browser che hanno XMLHttpRequest integrato IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// codice per le vecchie versioni di browser  IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    /*  qui catturiamo l'evento di quando il readyState cambia                           */
    /* 0: richiesta non inizializzata                                                    */
    /* 1: connessione con il server attivata                                             */
    /* 2: il server ha ricevuto la richiesta                                             */
    /* 3: il server sta eseguendo la richiesta [query]                                   */
    /* 4: il server ha finito e la risposta e' pronta !                                  */
    /* mentre lo STATUS e' lo stato della pagina , cioe' : 200: "OK" 404: Page not found */


    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            /* qui si inserisce la risposta dal server (quindi l'informazione che abbiamo chiesto al nostro file php    */
            /* di prendere dal DataBase , e la si passa al nostro elemento (in questo caso un div)                      */
            /* da notare che abbiamo richiesto una stringa come risposta , questo perche' non stiamo usando un file XML */
            /* altrimenti avremmo dovuto usare responseXML                                                              */
            document.getElementById("contenitore").innerHTML=xmlhttp.responseText;
        }
    }

    /* qui apri il file refresh_segnalazioni.php e imposti il parametro asincrono=true                        */
    /* l'importanza di avere una comunicazione asincrona e' che JS non deve aspettare la risposta del server  */
    /* ma puo' continuare ad eseguire il codice ed eventualmente a ritardare la risposta in attesa del server */
    /* in questo modo non si creano "colli di bottiglia" , ovvero rallentamenti dovuti a lunghe attese        */
    /* chiaramente se si imposta asincrono=false (quindi sincrono) JS fermera' l'esecuzione del codice fino a */
    /* quando il server non gli avra' fornito la risposta ..                                                  */

    xmlhttp.open("GET","refresh_segnalazioni.php?categoria="+categoria,true);
    xmlhttp.send();


}





function loadPost(id)
{
    /* questa prima parte della funzione apre la comunicazione con il server in background , senza dover riaggiornare la pagina */

    var xmlhttp;
    if (window.XMLHttpRequest)
    {// codice per le nuove versioni di browser che hanno XMLHttpRequest integrato IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// codice per le vecchie versioni di browser  IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    /*  qui catturiamo l'evento di quando il readyState cambia                           */
    /* 0: richiesta non inizializzata                                                    */
    /* 1: connessione con il server attivata                                             */
    /* 2: il server ha ricevuto la richiesta                                             */
    /* 3: il server sta eseguendo la richiesta [query]                                   */
    /* 4: il server ha finito e la risposta e' pronta !                                  */
    /* mentre lo STATUS e' lo stato della pagina , cioe' : 200: "OK" 404: Page not found */


    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            /* qui si inserisce la risposta dal server (quindi l'informazione che abbiamo chiesto al nostro file php    */
            /* di prendere dal DataBase , e la si passa al nostro elemento (in questo caso un div)                      */
            /* da notare che abbiamo richiesto una stringa come risposta , questo perche' non stiamo usando un file XML */
            /* altrimenti avremmo dovuto usare responseXML                                                              */
            document.getElementById("pagina").innerHTML=xmlhttp.responseText;
        }
    }

    /* qui apri il file post.php a cui passi la richiesta id  e imposti il parametro asincrono=true           */
    /* l'importanza di avere una comunicazione asincrona e' che JS non deve aspettare la risposta del server  */
    /* ma puo' continuare ad eseguire il codice ed eventualmente a ritardare la risposta in attesa del server */
    /* in questo modo non si creano "colli di bottiglia" , ovvero rallentamenti dovuti a lunghe attese        */
    /* chiaramente se si imposta asincrono=false (quindi sincrono) JS fermera' l'esecuzione del codice fino a */
    /* quando il server non gli avra' fornito la risposta ..                                                  */


    xmlhttp.open("GET","post.php?id="+id,true);
    xmlhttp.send();


}
