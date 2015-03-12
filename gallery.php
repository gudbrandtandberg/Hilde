<?php
    $page = $_GET["page"];
    $paintings = scandir("images/".$page);
    $numPaintings = count($paintings)-2;  //scandir lister opp . og .. også
    $numRows = $numPaintings/4;
?>
<?php
    include("header.php");
?>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<!-- https://github.com/blueimp/Bootstrap-Image-Gallery -->

<div id="blueimp-gallery" class="blueimp-gallery">
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
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dette er gridet -->

<div class="container-fluid" id="gallericontainer">
    <?php for ($r = 0; $r < $numRows; $r++): ?>
    <div class="row">
        <?php for ($c = 0; $c < 4; $c++): ?>
        <?php
            $imNum = 1 + 4*$r +$c;
            if (!($imNum >= $numPaintings)):
        ?>
        <div class="col-xs-6 col-md-3">
            <a href="images/<?=$page;?>/<?=$imNum;?>.jpg" class="thumbnail" data-gallery>
                <img class="img-responsive" src="images/<?=$page;?>/<?=$imNum;?>.jpg" alt="bilde">
            </a>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
        
    </div>
    <?php endfor; ?>
    
</div>

<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="bootstrap_image_gallery/js/bootstrap-image-gallery.min.js"></script>

<?php
    include("footer.php");
?>