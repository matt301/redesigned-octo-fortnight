//Se l'utente invia il messaggio
$("#submitmsg").click( function(){
    var clientmsg = $("#usermsg").val();
    $.post("send_msg.php", {text: clientmsg});
    $("#usermsg").attr("value", "");
    loadLog;
    return false;
});

function loadLog(){

    $.ajax({
        url: "log.php",
        cache: false,
        success:  function(html){
            $("#chatbox").html(html); //Inserisce il chat log in #chatbox div
        }

    });
}

setInterval (loadLog, 1000);