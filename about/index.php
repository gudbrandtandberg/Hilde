<?php
    include("../templates/header.php");
?>

<div class="container"  style="position: relative; top: -15px;">
    
    <div class="col-md-6">
        <h3>
            <?=$abouttitle;?>
        </h3>
        
        <p>
            <?=$abouttext;?>
        </p>
        
        <img style="margin: 0 auto; display: block; border: solid 2px black;" src="../images/diverse/hilde.jpg" width="100%"/>
    </div>

    <div class="col-md-6">
        <?=$CV;?>
    </div>
</div>


<?php
    include("../templates/footer.php");
?>
