<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <!--JQuery-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <!--Bootstrap JS-->
        <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
        <!--Bootstrap CSS-->
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        
        <style>
            td {
                padding: 10px;
            }
            #source_image {
                border: solid black 2px;
                width: 350px;
                padding: 10px;
                height: 350px;
            }
        </style>
        
        <!-- Inni her skjer magien  -->
        <script type="text/javascript" src="scripts/JIC.js"></script>
        <script type="text/javascript" src="scripts/posthandlers.js"></script>
    
    </head>
    
    <body>
        <div class="container">
    
            <h2>Legg inn nytt bilde</h2>
        
            <form id="legginnform" action="scripts/lagrebilde.php" onsubmit="return handleNyttBilde(this);">
                <table>
                    <tr>
                        <td>Velg bilde: </td>
                        <td><input type="file" name="bildefil" id="bildefil" accept="image/*" onchange="openFile(event)"></td>
                    </tr>
                    <tr>
                        <td>Bildetekst: </td>
                        <td><textarea cols="80" rows="1" form="legginnform" name="bildetekst" id="bildetekst"></textarea></td>
                    </tr>
                    <tr>
                        <td>Kategori: </td>
                        <td>
                            <select form="legginnform" name="kategori" id="kategori">
                                <option>horses</option>
                                <option>dogs</option>
                                <option>other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="submitbutton" name="submit" value="Lagre bilde"></td>
                        <td><div id="spinner" style="visibility: hidden;"><img src="images/diverse/spinner.gif"</div></td>
                    </tr>
                </table>
            </form>
            
            <!-- Må ha img-elementer tilgjengelig for mellomlagring under kompresjon -->
            <div class="container">
                <img id="source_image">
                <p id="statustekst">
                    Du har ikke valgt et bilde ennå.
                </p>
            </div>
            
            <!--vises ikke-->
            <img id="result_image" style="display: none;">  
        </div>
    </body>
</html>