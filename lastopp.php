<!DOCTYPE html>
<html>
<head>
    <title>Hilde Morris Portraiture</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="horse and dog portraits, commision, Hilde Morris, artist">
    <link rel="shortcut icon" href="images/diverse/ikon1.ico">
	
    <!--JQuery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!--style.css-->
    <link rel="stylesheet" href="style.css"></link>
    <script type="text/javascript">
	
	function sjekkbilde(event){
	    
	    var bildeInput = document.getElementById("bildeinput");
	    var file = bildeInput.files[0];
	    var fileSize = file.size;
	    
	    if (fileSize < 600000) {
		$("#respons").html("Du har valgt et fint bilde på "+fileSize+" bits. Klar til opplastning!");	
	    } else {
		$("#respons").html("Filstørrelsen, "+fileSize+" bits er litt for stor. Ikke klar til opplastning");
	    }
	    
	}
	
	$(document).ready(function(){
	    $("#lastoppknapp").click(function(){
	       $("#formen").submit();
	    });
	});
    </script>
</head>

<body>
	
    <h1>Last opp bilde Hilde!</h1>
    
    <form id="formen" name="formen" action="lagrebilde.php" method="post" enctype="multipart/form-data">
	
	<table style="width: 600px; margin: 0 auto;">
	
	    <tr>
		<td>
		    <input id="bildeinput" type="file" accept="image/jpg" name="bilde" onchange="sjekkbilde(event);">
		</td>
	    </tr>
	    
	    <tr>
		<td>
		    <div id="respons" style="padding-top: 10px;">Du har ikke valgt noe bilde</div>
		</td>
	    </tr>
	    
	    <tr>
		<td>
		    <select form="formen" name="kategori">
			<option value="dogs">Hund</option>
			<option value="horses">Hest</option>
			<option value="other">Andre</option>
		    </select>
		</td>
	    </tr>
	    
	    <tr>
		<td>Navn:</td>
		<td><input type="text" name="navn"></td>
	    </tr>
	    
	    <tr>
		<td>Beskrivelse:</td>
		<td><input type="text" name="beskrivelse"> </td>
	    </tr>
	    
	    <tr>
		<td>
		    <button class="btn btn-default" id="lastoppknapp">Last opp</button>
		</td>
	    </tr>
	
	</table>
    
    </form>
</body>
</html>



