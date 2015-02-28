<?php
    $page = $_GET["page"];
    $paintings = scandir("images/".$page);
    $numPaintings = count($paintings)-2;  //scandir lister opp . og .. også
    $numRows = $numPaintings/4;
?>

<script type="text/javascript">
    $(document).ready(function(){
        
        $("img").click(function(){
           
           // 1) finn ut hvilket bilde som ble klikket
           // 2) hent tilhørende bildetekst - kanskje få paintings og texts som arrays fra json
           // 3) lag en <div id=karusell> og sett opp alle attributter
           // 4) insert karusell i DOM'en - animér den synlig!
           alert("jeg skal vise deg et bilde jeg!");
            
        });
    });
</script>

<?php
    include("header.php");
?>

<div class="container-fluid" id="gallericontainer">
    
    <?php for ($r = 0; $r < $numRows; $r++): ?>
    <div class="row">
        <?php for ($c = 0; $c < 4; $c++): ?>
        <?php
            $imNum = 1 + 4*$r +$c;
            if (!($imNum >= $numPaintings)):
        ?>
        <div class="col-xs-6 col-md-3">
            <div class="thumbnail">
                <img src="images/<?=$page;?>/<?=$imNum;?>.jpg" alt="bilde">
            </div>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
        
    </div>
    <?php endfor; ?>
    
</div>

<?php
    include("footer.php");
?>