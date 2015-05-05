<!-- Generelle tips:
-Offer approval, return and refund policies
-Provide clear concise instructions on how to buy
-Provide adequate contact information
-Think seriously about accompanying each series or body of your work with its own explanation or introduction.
-Text explanations and introductions to your art are extremely important, but keep the word count to a minimum.
-->

<?php
    include("header.php");
?>

<script type="text/javascript">
    $(document).ready(function(){ 
        $('.karusell').slick({
            autoplay: true,
            arrows: false,
            fade: true,
            speed: 1500,
            swipe: false
        });
    });
</script>

<!-- HOME -->

<div class="container">
    
    <div class="col-sm-12 col-md-6">
        
        <h3>Welcome to hildemorris.com!</h3>
        
        <p>
            I am an artist blablabla... Skrive overordnet introtekst om hva jeg driver med.
            Hovedsakelig driver jeg med å male hunder og hester. Jeg elsker hunder og hester!!!
        </p>
        <p>
            Feel free to browse around to see what I'm up to, click on the links above and
            get in touch if you have any questions.
        </p>    
        <p>
            In this website you will find examples of my paintings grouped by categories. Some of the paintings are
            privately owned, but some may also be available for sale.
        </p>
        
        <img src="http://fontmeme.com/embed.php?text=Hilde%20Morris&name=
Sunshine in my Soul.ttf&size=40&style_color=000000" alt="Handwriting Fonts">
    
    </div>
    
    <div class="col-sm-12 col-md-6">
        
        <div class="karusell">
            <?php
                $homepage = "homepage";
                $json = json_decode(file_get_contents("model/paintings.json"));
                $files = $json->$homepage;
                $numPaintings = count($files);
                for ($imNum = 0; $imNum < $numPaintings-1; $imNum++):
            ?>
            <div>
                <div class="karusellbilde" style="background-image: url('images/<?=$files[$imNum];?>');"></div>
            </div>
            <?php endfor; ?>
        </div>
        
    </div>
    
</div>

<script type="text/javascript" src="scripts/slick/slick.min.js"></script>
				
<?php
    include("footer.php");
?>