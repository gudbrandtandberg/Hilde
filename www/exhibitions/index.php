<?php
include("../templates/header.php");
?>

<?php
    //gjør dette fra json!
    $cheval_paintings = scandir("../images/cheval");
    $rr_paintings = scandir("../images/reinensreise");
?>

<div id="blueimp-gallery-cheval" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <p class="modal-description"></p>
                    <button type="button" class="btn btn-default next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="blueimp-gallery-rr" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <p class="modal-description"></p>
                    <button type="button" class="btn btn-default next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <p><?=$utstillinger_tekst;?></p>
</div>

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

<div id="cheval">

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
<script src="../scripts/bootstrap_image_gallery/js/bootstrap-image-gallery.js"></script>

<?php include("../templates/footer.php"); ?>