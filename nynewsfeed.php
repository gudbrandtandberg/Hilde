<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <!--JQuery-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <!--Bootstrap JS-->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!--Bootstrap CSS-->
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        
        <style>
            td {
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
    
            <h2>Legg inn ny newsitem</h2>
        
            <form action="scripts/lagreFeed.php" method="POST" id="legginnform" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Tittel: </td>
                        <td><input type="text" name="tittel"></td>
                    </tr>
                    
                    <tr>
                        <td>Tekst: </td>
                        <td><textarea rows="4" cols="80" form="legginnform" name="tekst"></textarea></td>
                    </tr>
            
                    <tr>
                        <td>Bildefil: </td>
                        <td><input type="file" name="bildefil" id="bildefil" accept="image/*"></td>   
                    </tr>
                    
                    <tr>
                        <td>Bildetekst: </td>
                        <td><textarea rows="2" cols="80" form="legginnform" name="bildetekst"></textarea></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Lagre"></td>
                    </tr>
                </table>    
            </form>
            
        </div>
    </body>
</html>
