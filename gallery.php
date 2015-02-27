<?php
    include("header.php");
?>

<?php
    $page = $_GET["page"];
    $paintings = scandir("images/".$page);
    $numPaintings = count($paintings)-2;  //scandir lister opp . og .. også
    $numRows = $numPaintings/4;
    //print_r($paintings);
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