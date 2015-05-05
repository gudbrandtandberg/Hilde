<?php
    $page = $_GET["page"];
    $paintings = scandir("images/".$page);
    $numPaintings = count($paintings)-2;  //scandir lister opp . og .. også
    
    $json = json_decode(file_get_contents("model/paintings.json"));
    $file_title = $json->$page;
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
    <p class="description"></p>
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

<!-- Dette er gridet -->

<div class="container-fluid" id="gallericontainer">
    <div class="col">
        <p>Click on the images below to see them in full format</p>
    </div>
    <div id="links">
    <?php for ($imNum = 0; $imNum < $numPaintings-1; $imNum++):
        $file = $file_title[$imNum][0];
        $title = $file_title[$imNum][1];
        $subtitle = $file_title[$imNum][2];
    ?>
        <div class="col-xs-6 col-md-3">
            <a href="images/<?=$page;?>/<?=$file;?>" class="thumbnail" data-gallery title="<?=$title;?>" data-description="<?=$subtitle;?>">
                <div class="tommelbildebeholder" style="background-image: url('images/<?=$page;?>/<?=$file;?>');"></div>
            </a>
        </div>
    <?php endfor; ?>
    </div>
</div>

<script type="text/javascript">
    //håndter høyreklikk på gallerithumbnailsiden
    var visible = false;
    $(document).ready(function(){
        var visible = false;
        $(".tommelbildebeholder, div.modal-body.next").bind("contextmenu", customContext);
        $(document).bind("click", function(event) {
            visible = false;
            $("div.custom-menu").hide();
        });

        function customContext(event){
            event.preventDefault();
            if (!visible) {
                visible = true;
                $("<div class='custom-menu'>These photos are copyrighted by Hilde Morris. All rights reserved. Unauthorized use prohibited.</div>")
                .appendTo("body").css({top: event.pageY + "px", left: event.pageX + "px"});
            }
        }
    });
</script>
<script src="scripts/blueimp_gallery/blueimp-gallery.js"></script>
<script src="scripts/blueimp_gallery/jquery.blueimp-gallery.js"></script>
<script src="scripts/bootstrap_image_gallery/js/bootstrap-image-gallery.js"></script>

<?php
    include("footer.php");
?>
