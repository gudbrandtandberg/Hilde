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
                    <p class="description"></p>
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
    <div class="links">
    <?php for ($imNum = 0; $imNum < $numPaintings-1; $imNum++):
        $file = $file_title[$imNum][0];
        $title = $file_title[$imNum][1];
    ?>
        <a>
        <div class="col-xs-6 col-md-3">
            <a href="images/<?=$page;?>/<?=$file;?>" class="thumbnail" data-gallery title="<?=$title;?>" data-description="This is a banana.">
                <div class="tommelbildebeholder" style="background-image: url('images/<?=$page;?>/<?=$file;?>');"></div>
            </a>
        </div>
        </a>
    <?php endfor; ?>
    </div>
    
    
</div>

<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="bootstrap_image_gallery/js/bootstrap-image-gallery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    blueimp.Gallery(
        document.getElementById('links'),
        {
            onslide: function (index, slide) {
                var text = this.list[index].getAttribute('data-description'),
                    node = this.container.find('.description');
                node.empty();
                if (text) {
                    node[0].appendChild(document.createTextNode(text));
                }
            }
        }
    );
    
    // håndter høyreklikk her
    var visible = false;
    $(".tommelbildebeholder, div.modal-body.next").bind("contextmenu", function(event) {
        event.preventDefault();
        if (!visible) {
            visible = true;
            $("<div class='custom-menu'>These photos are copyrighted by Hilde Morris. All rights reserved. Unauthorized use prohibited.</div>")
            .appendTo("body").css({top: event.pageY + "px", left: event.pageX + "px"});
        }
    });
    $(document).bind("click", function(event) {
        visible = false;
        $("div.custom-menu").hide();
    });
});
</script>

<?php
    include("footer.php");
?>