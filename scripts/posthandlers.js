/*
 * handleNyttBilde/Feed(form)
 * - komprimerer bilde med JIC (hvis nødvendig) - eller i PHP?
 * - sender en ajax-request (POST) til lagrebilde/lagrefeed.php, som
 * - (lagrer bildet(hvis nødvendig) og oppdaterer json)
 */

function handleNyttBilde(form){
    
    //endrer teksten på knappen (evt. statuswheel)
    var knappen = document.getElementById("submitbutton");    
    knappen.value = "lagrer...";
    
    //henter bildefilen
    var bildeInput = document.getElementById("bildefil");
    var file = bildeInput.files[0];

    //er det egentlig et bilde?
    if (!file.type.match('image.*')) {
        alert("no image");
    
    }
    
    //forbereder ajax forespørsel
    var formData = $(form).serialize();
    
    $.ajax({url: "scripts/lagrebilde.php",
           data: formData,
           type: "POST",
           success: function(data){
                        alert("suksé!");
                        knappen.value = "Ferdig! Last opp nytt bilde";
                        respons = data;
                        alert(respons);
           },
            cache: false,
            contentType: false,
            processData: false
    });
    
    return false;
}

function handleNyFeed(form){
    
    alert("feedny");
    return false;

}

function compressImage(image){
    
    
    return;
}