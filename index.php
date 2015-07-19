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
        
        <h3 style="margin-top: 0;">Welcome to hildemorris.com!</h3>
        
        <p>
            I am an artist and a veterinarian. By combining my two professions I am now doing what I love: painting portraits of dogs and horses. My goal is to create a personal portrait that conveys your animal’s character in a way that you will appreciate, so you can have a beautiful piece of art portraying your own dog or horse.
        </p>
        <p>
            I work from life, because that way I can understand better the animal’s personality. To learn more about the process, see <a href="process.php">PROCESS</a>.
        </p>    
        <p>
            On this website you will find examples of my paintings grouped by categories. Some of the paintings are
            privately owned, but some may also be available for sale.
        </p>
        
        <div id="signaturecontainer">
            <img style="display: block; width: 120px; margin: 0 auto;" src="images/diverse/hestesko.png" />
        </div>
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