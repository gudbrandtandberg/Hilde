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
        </style>
        
        <!-- Inni her skjer magien  -->
        <script type="text/javascript" src="scripts/JIC.js"></script>
        <script type="text/javascript" src="scripts/posthandlers.js"></script>
    
    </head>
    
    <body>
        <div class="container">
    
            <h2>Legg inn nytt bilde</h2>
        
            <form id="legginnform" enctype="multipart/form-data" onsubmit="return handleNyttBilde(this);">
                <table>
                    <tr>
                        <td>Velg bilde: </td>
                        <td><input type="file" name="bildefil" id="bildefil" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Bildetekst: </td>
                        <td><textarea cols="80" rows="1" form="legginnform" name="bildetekst"></textarea></td>
                    </tr>
                    <tr>
                        <td>Kategori: </td>
                        <td>
                            <select form="legginnform" name="kategori">
                                <option>horses</option>
                                <option>dogs</option>
                                <option>other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" id="submitbutton" name="submit" value="Lagre bilde"></td>
                    </tr>
                </table>
            </form>

        </div>
    </body>
</html>