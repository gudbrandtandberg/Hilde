<?php
    $page = $_GET["page"];
    $paintings = scandir("../images/".$page);
    $numPaintings = count($paintings)-2;  //scandir lister opp . og .. også
    
    $json = json_decode(file_get_contents("../model/paintings.json"));
    $file_title = $json->$page;
    $numPaintings = count($file_title);
?>
<?php
    include("../templates/header.php");
?>

<div
    id="blueimp-gallery"
    class="blueimp-gallery blueimp-gallery-controls"
    aria-label="image gallery"
    aria-modal="true"
    role="dialog"
>
    <div class="slides" aria-live="polite"></div>
    <h3 class="title"></h3>
    <a
    class="prev"
    aria-controls="blueimp-gallery"
    aria-label="previous slide"
    aria-keyshortcuts="ArrowLeft"
    ></a>
    <a
    class="next"
    aria-controls="blueimp-gallery"
    aria-label="next slide"
    aria-keyshortcuts="ArrowRight"
    ></a>
    <a
    class="close"
    aria-controls="blueimp-gallery"
    aria-label="close"
    aria-keyshortcuts="Escape"
    ></a>
    <a
    class="play-pause"
    aria-controls="blueimp-gallery"
    aria-label="play slideshow"
    aria-keyshortcuts="Space"
    aria-pressed="false"
    role="button"
    ></a>
    <ol class="indicator"></ol>
</div>

<!-- Dette er gridet -->

<div class="container-fluid" id="gallericontainer">
    <div class="col">
        <p><?=$clickimg;?></p>
    </div>
    <div id="links">
    <?php for ($imNum = 0; $imNum < $numPaintings; $imNum++):
        $file = $file_title[$imNum][0];
        $title = $file_title[$imNum][1];
        $subtitle = $file_title[$imNum][2];
    ?>
        <div class="col-xs-6 col-md-3">
            <a href="../images/<?=$page;?>/<?=$file;?>" class="thumbnail" data-gallery title="<?=$title;?>" data-description="<?=$subtitle;?>">
                <div class="tommelbildebeholder" style="background-image: url('../images/<?=$page;?>/<?=$file;?>');"></div>
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
                $("<div class='custom-menu'><?=$copyrightctx;?></div>")
                .appendTo("body").css({top: event.pageY + "px", left: event.pageX + "px"});
            }
        }
    });
</script>

<script src="../scripts/Gallery-master/js/blueimp-helper.js"></script>
<script src="../scripts/Gallery-master/js/blueimp-gallery.js"></script>
<script src="../scripts/Gallery-master/js/blueimp-gallery-indicator.js"></script>
<script src="../scripts/Gallery-master/js/jquery.blueimp-gallery.js"></script>

<script>
  document.getElementById('links').onclick = function (event) {
    event = event || window.event
    var target = event.target || event.srcElement
    var link = target.src ? target.parentNode : target
    var options = { index: link, event: event }
    var links = this.getElementsByTagName('a')
    blueimp.Gallery(links, options)
  }
</script>

<?php
    include("../templates/footer.php");
?>
