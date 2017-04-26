<?php
include("../templates/header.php");
?>

<?php
    //gjør dette fra json!
    $hovedoya_paintings = scandir("../images/hovedoya");
    $cheval_paintings = scandir("../images/cheval");
    $rr_paintings = scandir("../images/reinensreise");
?>

<div id="blueimp-gallery-hovedoya" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<div id="blueimp-gallery-cheval" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<div id="blueimp-gallery-rr" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<div class="col-sm-12">
    <p><?=$utstillinger_tekst;?></p>
</div>

<div id="jakt">

        <!--<a href="../images/hovedoya/Baater_i_havn.jpg" data-gallery='#blueimp-gallery-hovedoya'>-->
        <div class="row">
            <div class="col-sm-12">
                <img src="../images/diverse/Plakat_utstilling_JAKT" style="display: block; width: 950px; margin: 0 auto;">
            </div>
        </div>
        <!--</a>-->
    
    <?php foreach ($hovedoya_paintings as $painting) {
        if ($painting != "." && $painting != ".." && $painting != "Baater_i_havn.jpg") {
        echo "<a href='../images/hovedoya/".$painting."' data-gallery='#blueimp-gallery-hovedoya'></a>";
        }
    }
    ?>
</div>

<hr>

<div id="hovedoya">

        <a href="../images/hovedoya/Baater_i_havn.jpg" data-gallery='#blueimp-gallery-hovedoya'>
        <div class="row">
            <div class="col-sm-12">
                <img src="../images/diverse/Hovedoya_flyer.png" style="display: block; width: 950px; margin: 0 auto;">
            </div>
        </div>
        </a>
    
    <?php foreach ($hovedoya_paintings as $painting) {
        if ($painting != "." && $painting != ".." && $painting != "Baater_i_havn.jpg") {
        echo "<a href='../images/hovedoya/".$painting."' data-gallery='#blueimp-gallery-hovedoya'></a>";
        }
    }
    ?>
</div>

<hr>

<div id="cheval">

        <a href="../images/cheval/Consolation.jpg" data-gallery='#blueimp-gallery-cheval'>
        <div class="row">
        	<div class="col-sm-12">
        		<img src="../images/diverse/plakat.jpg" style="display: block; width: 950px; margin: 0 auto;">
        	</div>
    	</div>
        </a>
    
    <?php foreach ($cheval_paintings as $painting) {
        if ($painting != "." && $painting != ".." && $painting != "Consolation.jpg") {
        echo "<a href='../images/cheval/".$painting."' data-gallery='#blueimp-gallery-cheval'></a>";
        }
    }
    ?>
</div>

<hr>

<div id="rr">

        <a href="../images/reinensreise/Skillegjerdemedutsikt.jpg" data-gallery='#blueimp-gallery-rr'>
        <div class="row">
        	<div class="col-sm-12">
        		<img src="../images/diverse/Samiskhus_poster.png" style="display: block; width: 950px; margin: 0 auto;">
        	</div>
    	</div>
        </a>
    
    <?php foreach ($rr_paintings as $painting) {
        if ($painting != "." && $painting != ".." && $painting != "Skillegjerdemedutsikt.jpg") {
        echo "<a href='../images/reinensreise/".$painting."' data-gallery='#blueimp-gallery-rr'></a>";
        }
    }
    ?>
</div>


<script src="../scripts/blueimp_gallery/blueimp-gallery.js"></script>
<script src="../scripts/blueimp_gallery/jquery.blueimp-gallery.js"></script>

<?php include("../templates/footer.php"); ?>