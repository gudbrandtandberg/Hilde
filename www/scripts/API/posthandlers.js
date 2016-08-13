/*
 * handleNyttBilde/Feed(form)
 * - komprimerer bilde med JIC (hvis nødvendig) - eller i PHP?
 * - sender en ajax-request (POST) til lagrebilde/lagrefeed.php, som
 * - (lagrer bildet(hvis nødvendig) og oppdaterer json)
 */

function openFile(event){ 
    //HER KAN MAN OGSÅ VALIDERE FILTYPE/STØRRELSE
    //henter bildefilen
    var bildeInput = document.getElementById("bildefil");
    var sourceImage = document.getElementById("source_image");
    var resultImage = document.getElementById("result_image");
    var statusTekst = document.getElementById("statustekst");
    var file = bildeInput.files[0];
    
    //er det egentlig et bilde?
    if (!file.type.match('image.*')) {
        alert("Det må være et jpg bilde!");  //lyver litt
        return;
    }
    
    //laster bildefilen over i et img objekt
    reader = new FileReader();
    reader.onload = function(event) {
            var i = document.getElementById("source_image");
            statusTekst.innerHTML = "Slik ser bildet du har lastet opp ut"
	    i.src = event.target.result;
	    i.style.visibility = "visible";
            i.style.width = "auto";
	    }
    reader.readAsDataURL(file);
}

function handleNyttBilde(form){
    
    
    //henter bildeelementer
    var sourceImage = document.getElementById("source_image");
    var resultImage = document.getElementById("result_image");
 
    if (sourceImage.src == "") {
        alert("bilde ikke vedlagt, prøv igjen!");
        return false;
    }
    else {
        //endrer teksten på knappen og viser spinner
        var knappen = document.getElementById("submitbutton");    
        knappen.value = "lagrer...";
        var spinner = document.getElementById("spinner");  
        spinner.style.visibility = "visible";
    }   

    //BØR AVGJØRES AV HVOR STORT BILDET ER I UTGANGSPUNKTET
    var quality = 50;
    
    //komprimerer bildet - og viser det frem (unødvendig..)
    var compressed_image = jic.compress(sourceImage, quality, "jpg");
    resultImage.src = compressed_image.src;
    
    var callback = function(response){
        document.getElementById("spinner").style.display = "none";
        knappen.value = "Lagre nytt bilde";
        
        if (response == "YES") {
            alert("Det gikk kjempefint");
        }
        else{
            console.log(response);
            alert("Noe gikk galt.. Prøv igjen du.");
        }
    }

    //forbereder metadata og sender til lagrebilde.php
    var requestURL = "scripts/lagrebilde.php";
    var formElement = document.getElementById("legginnform");
    var bildetekst = formElement.elements["bildetekst"].value;
    var kategori = formElement.elements["kategori"].value;
    var params = "?kategori="+kategori+"&bildetekst="+bildetekst;
    
    jic.upload(compressed_image, requestURL+params, 'bildefil', 'nyttbilde.jpg', callback);
    
    return false;
}

function handleNyFeed(form){
    
    alert("feedny");
    return false;

}

