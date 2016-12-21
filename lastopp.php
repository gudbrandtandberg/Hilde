<?php
    session_start();
    if ($_SESSION["loggedin"] !== "true")
        header("Location: http://hildemorris.com/login.php");
?>
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

            $("#slett_select").change(function() {
               var slett_arr = $("#slett_select").val().split(";");
               $("#slett_img").attr("src", "images/" + slett_arr[0] + "/" + slett_arr[1]);
            });

            $("#logout").click(function() {
                window.location.replace("http://hildemorris.com/logout.php");
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
    <h1>Slett bilde</h1>
    <div style="width: 600px; margin: auto;"> 
    <form id="slettform" name="slettform" action="slettbilde.php" method="post" enctype="multipart/form-data">
        <select id="slett_select" form="slettform" name="delete_pic">
        <?php
            echo "<optgroup label=\" -- HUNDER -- \">"; 
            $pics = json_decode(file_get_contents("model/paintings.json"));
            $dogs = $pics->dogs;
            $dogCount = count($dogs);
            for ($i = 0; $i < $dogCount; $i++){
                echo "<option value=\"dogs;" . $dogs[$i][0] . ";" . $i . "\">" . $dogs[$i][1] . "</option>";
            }
            echo "</optgroup>";

            echo "<optgroup label=\" -- HESTER -- \">";
            $horses = $pics->horses;
            $horseCount = count($horses);
            for ($i = 0; $i < $horseCount; $i++) {
                echo "<option value=\"horses;" . $horses[$i][0] . ";" . $i . "\">" . $horses[$i][1] . "</option>";
            }
            echo "</optgroup>";
            
            echo "<optgroup label=\" -- ANDRE -- \">";
            $other = $pics->other;
            $otherCount = count($other);
            for ($i = 0; $i < $otherCount; $i++) {
                echo "<option value=\"other;" . $other[$i][0] . ";" . $i . "\">" . $other[$i][1] . "</option>";
            }
            echo "</optgroup>";
        ?>
        </select>
        <button class="btn btn-default" id="slettknapp"> Slett </button>
    </form>
    <img id="slett_img" width=500px src=<?php echo "\"images/dogs/" . $dogs[0][0] . "\""?>>
    <form id="newsform" name="newsform" action="nynytt.php" method="post" enctype="multipart/farm-data">
        <h1>Oppdater siste nytt</h1>
        <textarea id="news" form="newsform" name="news" rows="10" cols="70">
            <?php
                $news_file_name = "siste_nytt.txt";
                $news_file = fopen($news_file_name, "r");
                echo fread($news_file, filesize($news_file_name));
                fclose($news_file);
           ?>
        </textarea>
        <button class="btn btn-default" id="oppdaterknapp"> Oppdater </button>
    </form>
    <button class="btn btn-danger" id="logout"> Logg ut </button>
    </div>
</body>
</html>
