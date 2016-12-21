<?php
    include("../templates/header.php");
?>

<!-- Generelle tips:
-Offer approval, return and refund policies
-Provide clear concise instructions on how to buy
-Provide adequate contact information
-Think seriously about accompanying each series or body of your work with its own explanation or introduction.
-Text explanations and introductions to your art are extremely important, but keep the word count to a minimum.
-->

<div id="fb-root"></div>
Hello
<script>
(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
      fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

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
        
        <h3 style="margin-top: 0;"><?=$welcome;?></h3>
        <?=$maintext;?>
        
        <div id="signaturecontainer">
            
            <div style="top: 30px; margin-right: 20px;" class="fb-page" data-href="https://www.facebook.com/pages/Hilde-Morris-Horse-Dog-Portraiture/440544189448080" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/pages/Hilde-Morris-Horse-Dog-Portraiture/440544189448080"><a href="https://www.facebook.com/pages/Hilde-Morris-Horse-Dog-Portraiture/440544189448080">Hilde Morris Horse &amp; Dog Portraiture</a></blockquote></div></div>
            <img style="display: inline-block; width: 120px; left: 20px; position: relative;" src="../images/diverse/hestesko.png" />
        </div>
    </div>
	
    <div class="col-sm-12 col-md-6">

        <div class="karusell">
            <?php
                $homepageFolder = "homepage";
                $json = json_decode(file_get_contents("../model/paintings.json"));
                $files = $json->$homepageFolder;
                foreach ($files as $file):
            ?>
            <div class="karusellbildebeholder">
                <div class="karusellbilde" style="background-image: url('../images/<?=$file;?>');"></div>
            </div>
            <?php endforeach; ?>

        </div>
        
    </div>
    
	
</div>

<script type="text/javascript" src="../scripts/slick/slick.min.js"></script>
				
<?php
    include("../templates/footer.php");
?>